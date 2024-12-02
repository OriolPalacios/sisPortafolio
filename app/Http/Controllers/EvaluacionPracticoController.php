<?php

namespace App\Http\Controllers;

use App\Models\EVALUACIONPractico;
use App\Models\PORTAFOLIOCURSO;
use App\Models\Observacion;
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
        $evaluacionPractico->proyecto_individual_grupal = $request->input('proyecto_individual_grupal'.$id_portafolio_curso);
        $evaluacionPractico->save();
        // cast all the updated values to integers and add them up, then divide by 100. Use a switch data control structure to decide between three options, if the result is greater than 0.8 then the portfolio is complete, if it's greater than 0.5 then it's observed, otherwise it's incomplete
        $total = intval($evaluacionPractico->caratula) + intval($evaluacionPractico->carga_academica) + intval($evaluacionPractico->filosofia) + intval($evaluacionPractico->cv) + intval($evaluacionPractico->plan_sesiones) + intval($evaluacionPractico->asistencia_alumnos) + intval($evaluacionPractico->evidencia_actividades_ensenianza) + intval($evaluacionPractico->relacion_estudiantes) + intval($evaluacionPractico->registro_notas_practicas_primera_parcial) + intval($evaluacionPractico->registro_notas_practicas_segunda_parcial) + intval($evaluacionPractico->proyecto_individual_grupal);
        $total = ($total / 22)  * 100;
        $current_portfolio = PortafolioCurso::find($id_portafolio_curso);
        if ($request->observacion != null) {
            $observacion = new Observacion();
            $observacion->observacion = $request->observacion;
            $observacion->id_portafolio_curso = $id_portafolio_curso;
            $observacion->save();
        }
        \Log::info("EVALUACIONPRACTICOCONTROLLER total calificacion:\n".$total);
        if ($total > 80) {
            \Log::info("cayo en 0.9:\n".$total);
            $current_portfolio->estado = 'Completado';
        } elseif ($total > 50) {
            \Log::info("cayo en 0.5:\n");
            $current_portfolio->estado = 'Observado';
        } else {
            \Log::info("cayo en 0.0:\n");
            $current_portfolio->estado = 'Pendiente';
        }
        $current_portfolio->save();
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
