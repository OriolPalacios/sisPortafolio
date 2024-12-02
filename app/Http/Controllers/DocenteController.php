<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\ASIGNACIONREVISION;
use App\Models\CURSO;
use App\Models\PORTAFOLIOCURSO;
class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar'); 

        $docentes = Usuario::whereHas('roles', function ($query) {
            $query->whereIn('nombre_rol', ['docente', 'revisor']);
        })
        ->when($buscar, function ($query, $buscar) {
            $query->where(function ($query) use ($buscar) {
                $query->where('nombres', 'like', "%{$buscar}%")
                    ->orWhere('apellido_paterno', 'like', "%{$buscar}%")
                    ->orWhere('apellido_materno', 'like', "%{$buscar}%");
            });
        })
        ->distinct()
        ->with('roles')
        ->paginate(10); 

        return view('administrador.docentes', compact('docentes', 'buscar'));
    }

    public function edit($id)
    {
        $docente = Usuario::with('roles')->findOrFail($id);
        $roles = \App\Models\Rol::whereIn('nombre_rol', ['docente', 'revisor'])->get();
        return view('administrador.editar-docente', compact('docente','roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'correo' => 'required|email',
            'estado' => 'required|boolean',
        ]);
    
        $docente = Usuario::findOrFail($id);
    
        $docente->update([
            'nombres' => $request->nombres,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'activo' => $request->estado,
        ]);
        if (!$request->estado) { 
            
            AsignacionRevision::where('id_revisor_usuario', $docente->id)->delete();
            
            AsignacionRevision::where('id_docente_usuario', $docente->id)->delete();
        }
        $rolesSeleccionados = $request->input('rol', []);
        $roles = array_merge(['2'], $rolesSeleccionados); 
        $docente->roles()->syncWithPivotValues($roles, ['fecha_asignacion' => now()]);
    
        return redirect()->route('admin.docentes')->with('success', 'Docente actualizado correctamente.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'correo' => 'required|email|unique:USUARIO,correo',
            'curso' => 'required|exists:CURSO,id', // Validar el curso seleccionado
        ]);

        // Crear el docente
        $docente = Usuario::create([
            'nombres' => $request->nombres,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo' => $request->sexo,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contrasena' => bcrypt('password'), // Contraseña predeterminada
            'departamento' => $request->departamento,
            'especialidad' => $request->especialidad,
            'activo' => true, // Por defecto activo
        ]);

        // Asignar rol de docente
        $docente->roles()->attach(2, ['fecha_asignacion' => now()]);

        // Crear registro en ASIGNACION_REVISION con id_revisor_usuario NULL y id_semestre en 1
        $asignacionRevision = AsignacionRevision::create([
            'id_administrador_usuario' => auth()->id(),
            'id_revisor_usuario' => null,
            'id_docente_usuario' => $docente->id,
            'id_semestre' => 1, // Por defecto el semestre inicial
            'fecha_asignacion' => now(),
            'activo' => false, // Por defecto inactivo hasta asignar un revisor
        ]);

        // Crear registro en PORTAFOLIO_CURSO
        $curso = Curso::find($request->curso);
        PortafolioCurso::create([
            'id_asignacion_revision' => $asignacionRevision->id, // Relacionar con la asignación creada
            'id_curso_semestre' => $curso->id,
            'codigo_curso_semestre' => $curso->codigo_curso,
            'formato' => 'pdf', // Formato predeterminado
            'estado' => 'Completado', // Estado predeterminado
            'tipo' => $curso->tipo,
        ]);

        return redirect()->route('admin.docentes')->with('success', 'Docente agregado correctamente.');
    }



    public function revisores(Request $request)
    {
        $buscar = $request->input('buscar');

        $revisores = Usuario::where('activo', true) 
            ->whereHas('roles', function ($query) {
                $query->where('nombre_rol', 'revisor');
            })
            ->when($buscar, function ($query, $buscar) {
                $query->where('nombres', 'like', "%{$buscar}%")
                    ->orWhere('apellido_paterno', 'like', "%{$buscar}%")
                    ->orWhere('apellido_materno', 'like', "%{$buscar}%");
            })
            ->with(['asignacionesComoRevisor' => function ($query) {
                $query->with('docente')->where('activo', false); 
            }])
            ->paginate(5);

        return view('administrador.revisores', compact('revisores', 'buscar'));
    }


    public function editarAsignacion($id)
    {
        $revisor = Usuario::with('asignacionesComoRevisor')->findOrFail($id);

        $docentesConRevisores = AsignacionRevision::pluck('id_docente_usuario')->toArray();

        $docentesAsignadosRevisor = $revisor->asignacionesComoRevisor->pluck('id_docente_usuario')->toArray();

        $docentesDisponibles = Usuario::where('activo', 1) 
            ->whereHas('roles', function ($query) {
                $query->where('nombre_rol', 'docente');
            })
            ->get()
            ->map(function ($docente) use ($docentesConRevisores, $docentesAsignadosRevisor, $revisor) {
                $docente->bloqueado = in_array($docente->id, $docentesConRevisores) && !in_array($docente->id, $docentesAsignadosRevisor);
                $docente->asignado = in_array($docente->id, $docentesAsignadosRevisor);
                $docente->esRevisorActual = $docente->id === $revisor->id; 
                return $docente;
            })->reject(fn($docente) => $docente->esRevisorActual); 

        return view('administrador.editar-asignacion', compact('revisor', 'docentesDisponibles'));
    }




    public function actualizarAsignacion(Request $request, $id)
    {
        $docentesSeleccionados = $request->input('docentes', []);
        $revisor = Usuario::findOrFail($id);
        $docentesAsignadosRevisor = $revisor->asignacionesComoRevisor->pluck('id_docente_usuario')->toArray();
        $docentesAEliminar = array_diff($docentesAsignadosRevisor, $docentesSeleccionados);
        $docentesNuevos = array_diff($docentesSeleccionados, $docentesAsignadosRevisor);
        AsignacionRevision::where('id_revisor_usuario', $revisor->id)
            ->whereIn('id_docente_usuario', $docentesAEliminar)
            ->delete();

        foreach ($docentesNuevos as $docenteId) {
            $revisor->asignacionesComoRevisor()->create([
                'id_docente_usuario' => $docenteId,
                'id_revisor_usuario' => $revisor->id,
                'id_administrador_usuario' => auth()->user()->id, 
                'fecha_asignacion' => now(),
                'activo' => false,
            ]);
        }

        return redirect()->route('admin.revisores')->with('success', 'Asignaciones actualizadas correctamente.');
    }

    public function indexRevisores(Request $request)
    {
        $buscar = $request->input('buscar');

        $revisores = Usuario::where('activo', true) 
            ->whereHas('roles', function ($query) {
                $query->where('nombre_rol', 'revisor');
            })
            ->when($buscar, function ($query, $buscar) {
                $query->where('nombres', 'like', "%{$buscar}%")
                    ->orWhere('apellido_paterno', 'like', "%{$buscar}%")
                    ->orWhere('apellido_materno', 'like', "%{$buscar}%");
            })
            ->with(['asignacionesComoRevisor' => function ($query) {
                $query->with('docente')->where('activo', true); 
            }])
            ->paginate(10);

        return view('administrador.revisores', compact('revisores', 'buscar'));
    }

    public function create()
    {
        // Obtener cursos no asignados en PORTAFOLIO_CURSO
        $cursosDisponibles = Curso::whereNotIn('id', PortafolioCurso::pluck('id_curso_semestre'))->get();

        return view('administrador.agregar-docente', compact('cursosDisponibles'));
    }




}
