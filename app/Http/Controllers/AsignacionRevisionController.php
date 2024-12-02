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

    public function showReporteEvaluacion()
    {
        $reportes = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id)->paginate(10);
        return view('revisor.reportes.evaluacion', compact('reportes'));
    }
    public function showReporteCumplimiento()   
    {
        return view('revisor.reportes.cumplimiento',);
    }
    public function exportarReporteCumplimiento()
    {
        return view('revisor.reportes.pdf.cumplimiento');
    }
}
