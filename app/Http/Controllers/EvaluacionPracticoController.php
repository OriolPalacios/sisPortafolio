<?php

namespace App\Http\Controllers;

use App\Models\EVALUACIONPractico;
use Illuminate\Http\Request;

class EvaluacionPracticoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPractico $evaluacionPractico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvaluacionPractico $evaluacionPractico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $evaluacionPractico = EvaluacionPractico::findOrfail($id);
        $id_portafolio_curso = $evaluacionPractico->id_portafolio_curso;
        $evaluacionPractico->caratula = $request->input('caratula'.$id_portafolio_curso);
        $evaluacionPractico->carga_academica = $request->input('carga_academica'.$id_portafolio_curso);
        $evaluacionPractico->filosofia = $request->input('filosofia'.$id_portafolio_curso);
        $evaluacionPractico->cv = $request->input('cv'.$id_portafolio_curso);
        $evaluacionPractico->plan_sesiones = $request->input('plan_sesiones'.$id_portafolio_curso);
        $evaluacionPractico->asistencia_alumnos = $request->input('asistencia_alumnos'.$id_portafolio_curso);
        $evaluacionPractico->evidencia_actividades_ensenianza = $request->input('evidencia_actividades_ensenianza'.$id_portafolio_curso);
        $evaluacionPractico->relacion_estudiantes = $request->input('relacion_estudiantes'.$id_portafolio_curso);
        $evaluacionPractico->registro_notas_practicas_primera_parcial = $request->input('registro_notas_practicas_primera_parcial'.$id_portafolio_curso);
        $evaluacionPractico->registro_notas_practicas_segunda_parcial = $request->input('registro_notas_practicas_segunda_parcial'.$id_portafolio_curso);
        $evaluacionPractico->proyecto_individual_grupal = $request->input('proyecto_individual'.$id_portafolio_curso);
        $evaluacionPractico->save();
        return redirect('Revisor/Portafolios')->with('Success', 'Evaluación actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPractico $evaluacionPractico)
    {
        //
    }
}
