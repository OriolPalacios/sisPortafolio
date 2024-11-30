<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use Illuminate\Http\Request;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semestres = Semestre::all();
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
            'nombre_semestre' => 'required|string|max:255',
            'inicio' => 'required|date',
            'fin' => 'required|date|after:inicio',
            'estado' => 'nullable|string|in:Activo,Inactivo',
        ]);

        Semestre::create([
            'nombre_semestre' => $request->nombre_semestre,
            'inicio' => $request->inicio,
            'fin' => $request->fin,
            'activo' => $request->estado ?? 'Inactivo',
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

    public function update(Request $request, $id)
{
    $semestre = Semestre::findOrFail($id);
    $semestre->update([
        'nombre' => $request->nombre,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'estado' => $request->estado == 'Activo' ? 'Activo' : 'Inactivo',
    ]);

    return redirect()->route('admin.semestre')->with('success', 'Semestre actualizado correctamente.');
}
}
