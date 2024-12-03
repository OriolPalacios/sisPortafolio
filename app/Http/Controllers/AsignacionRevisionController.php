<?php

namespace App\Http\Controllers;
use App\Models\USUARIO;
use App\Models\ASIGNACIONREVISION;
use App\Models\EVALUACIONPractico;
use App\Models\EVALUACIONTeorico;
use App\Models\PORTAFOLIOCURSO;
use Illuminate\Http\Request;

class AsignacionRevisionController extends Controller
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
    public function show(AsignacionRevision $asignacionRevision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsignacionRevision $asignacionRevision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsignacionRevision $asignacionRevision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsignacionRevision $asignacionRevision)
    {
        //
    }

    public function showRevisorMain()
    {
        $asignaciones = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id)->get();
        \Log::info("Todas las asignaciones del revisor: " . $asignaciones->pluck('id'));
    
        $portafolios_revisados = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
            ->where('estado', 'Completado')
            ->count();
        \Log::info("ASIGNACIONREVISIONCONTROLLER portafolios revisados:\n".$portafolios_revisados);
        $portafolios_observados = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
        ->where('estado', 'Observado')
        ->count();
        \Log::info("ASIGNACIONREVISIONCONTROLLER portafolios revisados:\n".$portafolios_observados);
        $portafolios_pendientes = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
        ->where('estado', 'Pendiente')
        ->count();
        \Log::info("ASIGNACIONREVISIONCONTROLLER portafolios revisados:\n".$portafolios_pendientes);
        $docentes_asginados = $asignaciones->pluck('id_docente_usuario')->unique();
        $docentes = Usuario::whereIn('id', $docentes_asginados)->get();
    
        
        return view('revisor.main', compact('asignaciones', 'docentes', 'portafolios_revisados', 'portafolios_observados', 'portafolios_pendientes'));
    }

    public function showRevisorPortafolios()
    {
        $portafolios_practico = EvaluacionPractico::where('id_revisor_usuario', auth()->user()->id)->get(); 
        if($portafolios_practico->count() > 0){
            $portafolios_practico->each(function ($portafolio) {
                $portafolio->curso = PortafolioCurso::where('id', $portafolio->id_portafolio_curso)->first()->codigo_curso_semestre;
                $portafolio->docente = Usuario::where('id', $portafolio->id_docente_usuario)->first()->nombres . ', ' . Usuario::where('id', $portafolio->id_docente_usuario)->first()->apellido_paterno . ' ' . Usuario::where('id', $portafolio->id_docente_usuario)->first()->apellido_materno;
            });
        }
        $portafolios_teorico = EvaluacionTeorico::where('id_revisor_usuario', auth()->user()->id)->get();
        if($portafolios_teorico->count() > 0){
            $portafolios_teorico->each(function ($portafolio) {
                $portafolio->curso = PortafolioCurso::where('id', $portafolio->id_portafolio_curso)->first()->codigo_curso_semestre;
                $portafolio->docente = Usuario::where('id', $portafolio->id_docente_usuario)->first()->nombres . ', ' . Usuario::where('id', $portafolio->id_docente_usuario)->first()->apellido_paterno . ' ' . Usuario::where('id', $portafolio->id_docente_usuario)->first()->apellido_materno;
            });
        }
    
        return view('revisor.portafolios', compact('portafolios_practico', 'portafolios_teorico'));
    }  


    

    public function showRevisorMainTest()
    {
        $asignaciones = AsignacionRevision::where('id_revisor_usuario', 6)->get();
        \Log::info("ASIGNACIONREVISIONCONTROLLER:\n".$asignaciones);
    
        $docentes_asginados = $asignaciones->pluck('id_docente_usuario')->unique();
        $docentes = Usuario::whereIn('id', $docentes_asginados)->get();
    
        $asignaciones->each(function ($asignacion) {
            $id_portafolio_curso = $asignacion->id;
    
            $evaluacionPractico = EvaluacionPractico::where('id_portafolio_curso', $id_portafolio_curso)->first();
            $evaluacionTeorico = EvaluacionTeorico::where('id_portafolio_curso', $id_portafolio_curso)->first();
    
            $practicoFields = [
                "caratula", "carga_academica", "filosofia", "cv", "plan_sesiones", "asistencia_alumnos", 
                "evidencia_actividades_ensenianza", "relacion_estudiantes", "registro_notas_practicas_primera_parcial", 
                "registro_notas_practicas_segunda_parcial", "proyecto_individual_grupal", "fecha_de_revision"
            ];
    
            $teoricoFields = [
                "caratula", "carga_academica", "filosofia", "cv", "silabo", "avance_por_sesiones", 
                "registro_entrega_silabo", "asistencia_alumnos", "evidencia_actividades_ensenianza", 
                "relacion_estudiantes", "evaluacion_entrada", "informe_resultado_evaluacion_entrada", 
                "resolucion_evaluacion_entrada", "resolucion_primera_parcial", "resolucion_segunda_parcial", 
                "resolucion_tercera_parcial", "resolucion_sustiturio", "enunciados_primera_parcial", 
                "enunciados_segunda_parcial", "enunciados_tercera_parcial", "enunciados_sustitutorio", 
                "asistencia_resolucion_primera_parcial", "asistencia_resolucion_segunda_parcial", 
                "asistencia_resolucion_tercera_parcial", "registro_ingreso_notas_primera_parcial", 
                "registro_ingreso_notas_segunda_parcial", "min_max_mean_notas_tercera_parcial", 
                "rubrica_proyecto", "asignacion_proyectos_individuales_o_grupales", 
                "informe_entrega_final_proyectos", "otras_evaluaciones", "cierre_portafolio", "fecha_de_revision"
            ];
            $expectedSum = 0;
            if ($evaluacionPractico) {
                $expectedSum = collect($practicoFields)->sum(function ($field) use ($evaluacionPractico) {
                    return (int) $evaluacionPractico->$field;
                });
            }
            if ($evaluacionTeorico){
                $expectedSum = collect($teoricoFields)->sum(function ($field) use ($evaluacionTeorico) {
                    return (int) $evaluacionTeorico->$field;
                });
            }
    
            $percentage = ($expectedSum / 100) * 100;
    
            if ($percentage >= 80) {
                $asignacion->status = 'complete';
            } elseif ($percentage > 50 && $percentage < 80) {
                $asignacion->status = 'pendent';
            } else {
                $asignacion->status = 'incomplete';
            }
            \Log::info("ASIGNACIONREVISIONCONTROLLER:\n".$asignacion);
        });    
        return view('revisor.main', compact('asignaciones', 'docentes'));
    }
}
