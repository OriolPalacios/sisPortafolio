<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar'); 

        $docentes = Usuario::whereHas('roles', function ($query) {
            $query->whereIn('nombre_rol', ['docente', 'revisor']);
        })
        ->when($buscar, function ($query, $buscar) {
            $query->where('apellido_paterno', 'like', "%{$buscar}%");
        })
        ->distinct()
        ->paginate(10); 

        return view('administrador.docentes', compact('docentes', 'buscar'));
    }

    public function edit($id)
    {
        // Obtener el docente por su ID
        $docente = Usuario::with('roles')->findOrFail($id);

        // Pasar los datos del docente a la vista
        return view('administrador.editar-docente', compact('docente'));
    }

    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'correo' => 'required|email',
            'estado' => 'required|boolean',
        ]);

        // Encontrar el docente
        $docente = Usuario::findOrFail($id);

        // Actualizar datos del docente
        $docente->update([
            'nombres' => $request->nombres,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'activo' => $request->estado,
        ]);

        // Actualizar roles
        $roles = [$request->has('revisor') ? 2 : 1]; // 1 = docente, 2 = revisor
        $docente->roles()->syncWithPivotValues($roles, ['fecha_asignacion' => now()]);

        return redirect()->route('admin.docentes')->with('success', 'Docente actualizado correctamente.');

    }


}
