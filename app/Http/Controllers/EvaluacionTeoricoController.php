<?php

namespace App\Http\Controllers;

use App\Models\EVALUACIONTeorico;
use App\Models\PORTAFOLIOCURSO;
use App\Models\Observacion;
use Illuminate\Http\Request;

class EvaluacionTeoricoController extends Controller
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
    public function show(EvaluacionTeorico $evaluacionTeorico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvaluacionTeorico $evaluacionTeorico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvaluacionTeorico $evaluacionTeorico, $id)
    {
        $evaluacionTeorico = EvaluacionTeorico::findOrfail($id);
        $id_portafolio_curso = $evaluacionTeorico->id_portafolio_curso;
        $evaluacionTeorico->caratula = $request->input('caratula'.$id_portafolio_curso);
        $evaluacionTeorico->carga_academica = $request->input('carga_academica'.$id_portafolio_curso);
        $evaluacionTeorico->filosofia = $request->input('filosofia'.$id_portafolio_curso);
        $evaluacionTeorico->cv = $request->input('cv'.$id_portafolio_curso);
        $evaluacionTeorico->silabo = $request->input('silabo'.$id_portafolio_curso);
        $evaluacionTeorico->avance_por_sesiones = $request->input('avance_por_sesiones'.$id_portafolio_curso);
        $evaluacionTeorico->registro_entrega_silabo = $request->input('registro_entrega_silabo'.$id_portafolio_curso);
        $evaluacionTeorico->asistencia_alumnos = $request->input('asistencia_alumnos'.$id_portafolio_curso);
        $evaluacionTeorico->evidencia_actividades_ensenianza = $request->input('evidencia_actividades_ensenianza'.$id_portafolio_curso);
        $evaluacionTeorico->relacion_estudiantes = $request->input('relacion_estudiantes'.$id_portafolio_curso);
        $evaluacionTeorico->evaluacion_entrada = $request->input('evaluacion_entrada'.$id_portafolio_curso);
        $evaluacionTeorico->informe_resultado_evaluacion_entrada = $request->input('informe_resultado_evaluacion_entrada'.$id_portafolio_curso);
        $evaluacionTeorico->resolucion_evaluacion_entrada = $request->input('resolucion_evaluacion_entrada'.$id_portafolio_curso);
        $evaluacionTeorico->resolucion_primera_parcial = $request->input('resolucion_primera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->resolucion_segunda_parcial = $request->input('resolucion_segunda_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->resolucion_tercera_parcial = $request->input('resolucion_tercera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->resolucion_sustitutorio = $request->input('resolucion_sustitutorio'.$id_portafolio_curso);
        $evaluacionTeorico->enunciados_primera_parcial = $request->input('enunciados_primera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->enunciados_segunda_parcial = $request->input('enunciados_segunda_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->enunciados_tercera_parcial = $request->input('enunciados_tercera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->enunciados_sustitutorio = $request->input('enunciados_sustitutorio'.$id_portafolio_curso);
        $evaluacionTeorico->asistencia_resolucion_primera_parcial = $request->input('asistencia_resolucion_primera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->asistencia_resolucion_segunda_parcial = $request->input('asistencia_resolucion_segunda_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->asistencia_resolucion_tercera_parcial = $request->input('asistencia_resolucion_tercera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->registro_ingreso_notas_primera_parcial = $request->input('registro_ingreso_notas_primera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->registro_ingreso_notas_segunda_parcial = $request->input('registro_ingreso_notas_segunda_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->registro_ingreso_notas_tercera_parcial = $request->input('registro_ingreso_notas_tercera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->registro_ingreso_notas_sustiturio = $request->input('registro_ingreso_notas_sustiturio'.$id_portafolio_curso);
        $evaluacionTeorico->min_max_mean_notas_primera_parcial = $request->input('min_max_mean_notas_primera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->min_max_mean_notas_segunda_parcial = $request->input('min_max_mean_notas_segunda_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->min_max_mean_notas_tercera_parcial = $request->input('min_max_mean_notas_tercera_parcial'.$id_portafolio_curso);
        $evaluacionTeorico->rubrica_proyecto = $request->input('rubrica_proyecto'.$id_portafolio_curso);
        $evaluacionTeorico->asignacion_proyectos_individuales_o_grupales = $request->input('asignacion_proyectos_individuales_o_grupales'.$id_portafolio_curso);
        $evaluacionTeorico->informe_entrega_final_proyectos = $request->input('informe_entrega_final_proyectos'.$id_portafolio_curso);
        $evaluacionTeorico->otras_evaluaciones = $request->input('otras_evaluaciones'.$id_portafolio_curso);
        $evaluacionTeorico->cierre_portafolio = $request->input('cierre_portafolio'.$id_portafolio_curso);
        $evaluacionTeorico->save();
        \Log::info('Observacion del request '. $request->observacion);
        if ($request->observacion != null) {
            $observacion = new Observacion();
            $observacion->observacion = $request->observacion;
            $observacion->id_portafolio_curso = $id_portafolio_curso;
            $observacion->save();
        }
        // cast all the updated values to integers and add them up, then divide by 100. Use a switch data control structure to decide between three options, if the result is greater than 0.8 then the portfolio is complete, if it's greater than 0.5 then it's observed, otherwise it's incomplete
        $total = intval($evaluacionTeorico->caratula) + intval($evaluacionTeorico->carga_academica) + intval($evaluacionTeorico->filosofia) + intval($evaluacionTeorico->cv) + intval($evaluacionTeorico->silabo) + intval($evaluacionTeorico->avance_por_sesiones) + intval($evaluacionTeorico->registro_entrega_silabo) + intval($evaluacionTeorico->asistencia_alumnos) + intval($evaluacionTeorico->evidencia_actividades_ensenianza) + intval($evaluacionTeorico->relacion_estudiantes) + intval($evaluacionTeorico->evaluacion_entrada) + intval($evaluacionTeorico->informe_resultado_evaluacion_entrada) + intval($evaluacionTeorico->resolucion_evaluacion_entrada) + intval($evaluacionTeorico->resolucion_primera_parcial) + intval($evaluacionTeorico->resolucion_segunda_parcial) + intval($evaluacionTeorico->resolucion_tercera_parcial) + intval($evaluacionTeorico->resolucion_sustitutorio) + intval($evaluacionTeorico->enunciados_primera_parcial) + intval($evaluacionTeorico->enunciados_segunda_parcial) + intval($evaluacionTeorico->enunciados_tercera_parcial) + intval($evaluacionTeorico->enunciados_sustitutorio) + intval($evaluacionTeorico->asistencia_resolucion_primera_parcial) + intval($evaluacionTeorico->asistencia_resolucion_segunda_parcial) + intval($evaluacionTeorico->asistencia_resolucion_tercera_parcial) + intval($evaluacionTeorico->registro_ingreso_notas_primera_parcial) + intval($evaluacionTeorico->registro_ingreso_notas_segunda_parcial) + intval($evaluacionTeorico->registro_ingreso_notas_tercera_parcial) + intval($evaluacionTeorico->registro_ingreso_notas_sustiturio) + intval($evaluacionTeorico->min_max_mean_notas_primera_parcial) + intval($evaluacionTeorico->min_max_mean_notas_segunda_parcial) + intval($evaluacionTeorico->min_max_mean_notas_tercera_parcial) + intval($evaluacionTeorico->rubrica_proyecto) + intval($evaluacionTeorico->asignacion_proyectos_individuales_o_grupales) + intval($evaluacionTeorico->informe_entrega_final_proyectos) + intval($evaluacionTeorico->otras_evaluaciones) + intval($evaluacionTeorico->cierre_portafolio);
        $total = ($total / 72) * 100;
        $current_portfolio = PortafolioCurso::find($id_portafolio_curso);
        if ($total > 80) {
            $current_portfolio->estado = 'Completado';
        } elseif ($total > 50) {
            $current_portfolio->estado = 'Observado';
        } else {
            $current_portfolio->estado = 'Pendiente';
        }
        $current_portfolio->save();
        return redirect('Revisor/Portafolios')->with('Success', 'Evaluación actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionTeorico $evaluacionTeorico)
    {
        //
    }
}
