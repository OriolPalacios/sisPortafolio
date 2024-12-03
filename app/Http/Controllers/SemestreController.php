<?php

namespace App\Http\Controllers;

use App\Models\SEMESTRE;
use Illuminate\Http\Request;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semestres = Semestre::orderBy('inicio', 'desc')->get();
        $semestreActivo = Semestre::where('activo', true)->first();

        return view('administrador.semestre', compact('semestres', 'semestreActivo'));
    }



    public function formulario()
    {
        return view('/administrador/agregar_semestre');
    }


    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        Semestre::create([
            'nombre_semestre' => $request->nombre,
            'inicio' => $request->fecha_inicio,
            'fin' => $request->fecha_fin,
            'activo' => false,
        ]);

        return redirect()->route('admin.semestre')->with('success', 'Semestre agregado correctamente.');
    }


    /**
     * Store a newly created resource in storage.
     */

    public function edit($id)
    {
        $semestre = Semestre::findOrFail($id);
        return view('administrador.editar_semestre', compact('semestre'));
    }


    public function actualizarEstados(Request $request)
    {
        $estados = $request->input('estados', []);

        // Verificar que no haya más de un semestre activo
        $activos = array_filter($estados, fn($estado) => $estado);
        if (count($activos) > 1) {
            return response()->json(['success' => false, 'message' => 'No puede haber más de un semestre activo a la vez.']);
        }

        // Actualizar los estados
        foreach ($estados as $id => $activo) {
            $semestre = Semestre::findOrFail($id);
            $semestre->update(['activo' => $activo]);
        }

        return response()->json(['success' => true]);
    }


}
