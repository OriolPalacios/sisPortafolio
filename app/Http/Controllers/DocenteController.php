<?php

namespace App\Http\Controllers;
use App\Models\USUARIO;
use Illuminate\Http\Request;
use App\Models\ASIGNACIONREVISION;
use App\Models\CURSO;
use App\Models\PORTAFOLIOCURSO;
use App\Models\EVALUACIONTeorico;
use App\Models\EVALUACIONPractico;
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

    // Obtener el curso seleccionado por el administrador
    $curso = Curso::find($request->curso);

    // Crear registro en ASIGNACION_REVISION
    $asignacionRevision = AsignacionRevision::create([
        'id_administrador_usuario' => auth()->id(),
        'id_revisor_usuario' => null,
        'id_docente_usuario' => $docente->id,
        'id_semestre' => 1, 
        'fecha_asignacion' => now(),
        'activo' => false, 
    ]);
    
    // Crear registro en PORTAFOLIO_CURSO con el id_asignacion_revision correcto
    $curso = Curso::find($request->curso);
    PortafolioCurso::create([
        'id_asignacion_revision' => $asignacionRevision->id, // Relacionar con el id de AsignacionRevision creado
        'id_curso_semestre' => $curso->id,
        'codigo_curso_semestre' => $curso->codigo_curso,
        'formato' => 'pdf', // Formato predeterminado
        'estado' => 'Completado', // Estado predeterminado
        'tipo' => $curso->tipo,
    ]);

    // Crear los registros en las tablas EVALUACION_Teorico y EVALUACION_Practico con el id_revisor_usuario como NULL
    // Los evaluadores se asignarán más tarde, pero debemos insertar las filas vacías para los cursos asignados.
    EvaluacionTeorico::create([
        'id_revisor_usuario' => null,
        'id_docente_usuario' => $docente->id,
        'id_portafolio_curso' => $portafolioCurso->id,
    ]);

    EvaluacionPractico::create([
        'id_revisor_usuario' => null,
        'id_docente_usuario' => $docente->id,
        'id_portafolio_curso' => $portafolioCurso->id,
    ]);

    return redirect()->route('admin.docentes')->with('success', 'Docente agregado correctamente');
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
                $docente->bloqueado = !is_null(AsignacionRevision::where('id_docente_usuario', $docente->id)->value('id_revisor_usuario')) && 
    !in_array($docente->id, $docentesAsignadosRevisor);

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

        // Obtener los docentes actualmente asignados al revisor
        $docentesAsignadosRevisor = AsignacionRevision::where('id_revisor_usuario', $revisor->id)
            ->pluck('id_docente_usuario')
            ->toArray();

        // Determinar los docentes a desasignar (pasar id_revisor_usuario a NULL)
        $docentesAEliminar = array_diff($docentesAsignadosRevisor, $docentesSeleccionados);
        AsignacionRevision::where('id_revisor_usuario', $revisor->id)
            ->whereIn('id_docente_usuario', $docentesAEliminar)
            ->update(['id_revisor_usuario' => null]);

        // También debemos actualizar el id_revisor_usuario en EVALUACION_Teorico y EVALUACION_Practico
        // Desasignar los docentes eliminados de las evaluaciones
        EvaluacionTeorico::whereIn('id_docente_usuario', $docentesAEliminar)
            ->where('id_revisor_usuario', $revisor->id)
            ->update(['id_revisor_usuario' => null]);

        EvaluacionPractico::whereIn('id_docente_usuario', $docentesAEliminar)
            ->where('id_revisor_usuario', $revisor->id)
            ->update(['id_revisor_usuario' => null]);

        // Determinar los nuevos docentes a asignar al revisor
        $docentesNuevos = array_diff($docentesSeleccionados, $docentesAsignadosRevisor);
        AsignacionRevision::whereIn('id_docente_usuario', $docentesNuevos)
            ->update(['id_revisor_usuario' => $revisor->id]);

        // Asignar el nuevo revisor en EVALUACION_Teorico y EVALUACION_Practico para los nuevos docentes
        EvaluacionTeorico::whereIn('id_docente_usuario', $docentesNuevos)
            ->update(['id_revisor_usuario' => $revisor->id]);

        EvaluacionPractico::whereIn('id_docente_usuario', $docentesNuevos)
            ->update(['id_revisor_usuario' => $revisor->id]);

        return redirect()->route('admin.revisores')->with('success', 'Asignaciones actualizadas correctamente.');
    }


    public function indexRevisores(Request $request)
    {
        $buscar = $request->input('buscar');

        $revisores = Usuario::where('activo', false) 
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
