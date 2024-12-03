<?php

namespace App\Http\Controllers;
use App\Models\USUARIO;
use App\Models\ASIGNACIONREVISION;
use App\Models\EVALUACIONPractico;
use App\Models\EVALUACIONTeorico;
use App\Models\PORTAFOLIOCURSO;
use App\Models\Observacion;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function showReporteEvaluacion(Request $request)
    {
        $docentes = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id);
        $reportesPractico = EvaluacionPractico::join('PORTAFOLIO_CURSO', 'EVALUACION_Practico.id_portafolio_curso', '=', 'PORTAFOLIO_CURSO.id')
            ->where('EVALUACION_Practico.id_revisor_usuario', auth()->user()->id)
            ->whereIn('EVALUACION_Practico.id_docente_usuario', $docentes->pluck('id_docente_usuario'))
            ->select('EVALUACION_Practico.id_docente_usuario', 'EVALUACION_Practico.id_portafolio_curso');

        $reportesTeorico = EvaluacionTeorico::join('PORTAFOLIO_CURSO', 'EVALUACION_Teorico.id_portafolio_curso', '=', 'PORTAFOLIO_CURSO.id')
            ->where('EVALUACION_Teorico.id_revisor_usuario', auth()->user()->id)
            ->whereIn('EVALUACION_Teorico.id_docente_usuario', $docentes->pluck('id_docente_usuario'))
            ->select('EVALUACION_Teorico.id_docente_usuario', 'EVALUACION_Teorico.id_portafolio_curso');
        $reportes = $reportesPractico->union($reportesTeorico)
            ->get()
            ->groupBy('id_docente_usuario');
        $reportes = $reportes->map(function ($portafolios, $docenteId) {
            $docente = Usuario::find($docenteId);
            $docenteNombre = $docente->nombres . ' ' . $docente->apellido_paterno . ' ' . $docente->apellido_materno;
            $completados = 0;
            $pendientes = 0;
            $observados = 0;
            $observaciones = collect([]);
            foreach ($portafolios as $portafolio) {
                $curso = PortafolioCurso::find($portafolio->id_portafolio_curso);
                if ($curso->estado == 'Completado') {
                    $completados++;
                } elseif ($curso->estado == 'Pendiente') {
                    $pendientes++;
                } elseif ($curso->estado == 'Observado') {
                    $observados++;
                }
                $observaciones = $observaciones->merge(Observacion::where('id_portafolio_curso', $curso->id)->pluck('observacion'));
                \Log::info("Observacion: " . Observacion::where('id_portafolio_curso', $curso->id)->get()->pluck('observacion'));
            }
            return [
            'docente' => $docenteNombre,
            'completados' => $completados,
            'pendientes' => $pendientes,
            'observados' => $observados,
            'observaciones' => $observaciones
            ];
        });

        // Filter by docenteNombre if search order is present
        if ($request->has('filter')) {
            $search = $request->input('filter');
            $reportes = $reportes->filter(function ($reporte) use ($search) {
                return stripos($reporte['docente'], $search) !== false;
            });
        }
        
        // Add pagination to reportes
        $reportes = collect($reportes);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 1;
        $currentItems = $reportes->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $reportes = new LengthAwarePaginator($currentItems, $reportes->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);
        
        return view('revisor.reportes.evaluacion', compact('reportes'));
    }
    public function exportarReporteEvaluacion(Request $request)
    {
        $docentes = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id);
        $reportesPractico = EvaluacionPractico::join('PORTAFOLIO_CURSO', 'EVALUACION_Practico.id_portafolio_curso', '=', 'PORTAFOLIO_CURSO.id')
            ->where('EVALUACION_Practico.id_revisor_usuario', auth()->user()->id)
            ->whereIn('EVALUACION_Practico.id_docente_usuario', $docentes->pluck('id_docente_usuario'))
            ->select('EVALUACION_Practico.id_docente_usuario', 'EVALUACION_Practico.id_portafolio_curso');

        $reportesTeorico = EvaluacionTeorico::join('PORTAFOLIO_CURSO', 'EVALUACION_Teorico.id_portafolio_curso', '=', 'PORTAFOLIO_CURSO.id')
            ->where('EVALUACION_Teorico.id_revisor_usuario', auth()->user()->id)
            ->whereIn('EVALUACION_Teorico.id_docente_usuario', $docentes->pluck('id_docente_usuario'))
            ->select('EVALUACION_Teorico.id_docente_usuario', 'EVALUACION_Teorico.id_portafolio_curso');
        $reportes = $reportesPractico->union($reportesTeorico)
            ->get()
            ->groupBy('id_docente_usuario');
        $reportes = $reportes->map(function ($portafolios, $docenteId) {
            $docente = Usuario::find($docenteId);
            $docenteNombre = $docente->nombres . ' ' . $docente->apellido_paterno . ' ' . $docente->apellido_materno;
            $completados = 0;
            $pendientes = 0;
            $observados = 0;
            $observaciones = collect([]);
            foreach ($portafolios as $portafolio) {
                $curso = PortafolioCurso::find($portafolio->id_portafolio_curso);
                if ($curso->estado == 'Completado') {
                    $completados++;
                } elseif ($curso->estado == 'Pendiente') {
                    $pendientes++;
                } elseif ($curso->estado == 'Observado') {
                    $observados++;
                }
                $observaciones = $observaciones->merge(Observacion::where('id_portafolio_curso', $curso->id)->pluck('observacion'));
                \Log::info("Observacion: " . Observacion::where('id_portafolio_curso', $curso->id)->get()->pluck('observacion'));
            }
            return [
            'docente' => $docenteNombre,
            'completados' => $completados,
            'pendientes' => $pendientes,
            'observados' => $observados,
            'observaciones' => $observaciones
            ];
        });
        
        return view('revisor.reportes.pdf.evaluacion', compact('reportes'));
    }

    public function showReporteCumplimiento()   
    {
        $revisor_nombre = auth()->user()->nombres . ' ' . auth()->user()->apellido_paterno . ' ' . auth()->user()->apellido_materno;
        $revisor_correo = auth()->user()->correo;
        $docentes_asignados = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id)->pluck('id_docente_usuario')->unique();
        $asignaciones = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id)->get();
        $portafolios_revisados = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
            ->where('estado', 'Completado')
            ->count();
        $portafolios_observados = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
        ->where('estado', 'Observado')
        ->count();
        $portafolios_pendientes = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
        ->where('estado', 'Pendiente')
        ->count();
        $docentes_asginados = $asignaciones->pluck('id_docente_usuario')->unique();
        $docentes = Usuario::whereIn('id', $docentes_asginados)->get();
        $docentes = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id);
        $reportesPractico = EvaluacionPractico::join('PORTAFOLIO_CURSO', 'EVALUACION_Practico.id_portafolio_curso', '=', 'PORTAFOLIO_CURSO.id')
            ->where('EVALUACION_Practico.id_revisor_usuario', auth()->user()->id)
            ->whereIn('EVALUACION_Practico.id_docente_usuario', $docentes->pluck('id_docente_usuario'))
            ->select('EVALUACION_Practico.id_docente_usuario', 'EVALUACION_Practico.id_portafolio_curso');

        $reportesTeorico = EvaluacionTeorico::join('PORTAFOLIO_CURSO', 'EVALUACION_Teorico.id_portafolio_curso', '=', 'PORTAFOLIO_CURSO.id')
            ->where('EVALUACION_Teorico.id_revisor_usuario', auth()->user()->id)
            ->whereIn('EVALUACION_Teorico.id_docente_usuario', $docentes->pluck('id_docente_usuario'))
            ->select('EVALUACION_Teorico.id_docente_usuario', 'EVALUACION_Teorico.id_portafolio_curso');
        $reportes = $reportesPractico->union($reportesTeorico)
            ->get()
            ->groupBy('id_docente_usuario');
        $reportes = $reportes->map(function ($portafolios, $docenteId) {
            $docente = Usuario::find($docenteId);
            $docenteNombre = $docente->nombres . ' ' . $docente->apellido_paterno . ' ' . $docente->apellido_materno;
            $completados = 0;
            $pendientes = 0;
            $observados = 0;
            $observaciones = collect([]);
            foreach ($portafolios as $portafolio) {
                $curso = PortafolioCurso::find($portafolio->id_portafolio_curso);
                if ($curso->estado == 'Completado') {
                    $completados++;
                } elseif ($curso->estado == 'Pendiente') {
                    $pendientes++;
                } elseif ($curso->estado == 'Observado') {
                    $observados++;
                }
                $observaciones = $observaciones->merge(Observacion::where('id_portafolio_curso', $curso->id)->pluck('observacion'));
                \Log::info("Observacion: " . Observacion::where('id_portafolio_curso', $curso->id)->get()->pluck('observacion'));
            }
            return [
            'docente' => $docenteNombre,
            'completados' => $completados,
            'pendientes' => $pendientes,
            'observados' => $observados,
            'observaciones' => $observaciones
            ];
        });

        return view('revisor.reportes.cumplimiento', compact('revisor_nombre', 'revisor_correo', 'docentes_asignados', 'portafolios_revisados', 'portafolios_observados', 'portafolios_pendientes', 'reportes'));
    }
    public function exportarReporteCumplimiento()
    {
        $revisor_nombre = auth()->user()->nombres . ' ' . auth()->user()->apellido_paterno . ' ' . auth()->user()->apellido_materno;
        $revisor_correo = auth()->user()->correo;
        $docentes_asignados = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id)->pluck('id_docente_usuario')->unique();
        $asignaciones = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id)->get();
        $portafolios_revisados = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
            ->where('estado', 'Completado')
            ->count();
        $portafolios_observados = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
        ->where('estado', 'Observado')
        ->count();
        $portafolios_pendientes = PortafolioCurso::whereIn('id_asignacion_revision', $asignaciones->pluck('id'))
        ->where('estado', 'Pendiente')
        ->count();
        $docentes_asginados = $asignaciones->pluck('id_docente_usuario')->unique();
        $docentes = Usuario::whereIn('id', $docentes_asginados)->get();
        $docentes = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id);
        $reportesPractico = EvaluacionPractico::join('PORTAFOLIO_CURSO', 'EVALUACION_Practico.id_portafolio_curso', '=', 'PORTAFOLIO_CURSO.id')
            ->where('EVALUACION_Practico.id_revisor_usuario', auth()->user()->id)
            ->whereIn('EVALUACION_Practico.id_docente_usuario', $docentes->pluck('id_docente_usuario'))
            ->select('EVALUACION_Practico.id_docente_usuario', 'EVALUACION_Practico.id_portafolio_curso');

        $reportesTeorico = EvaluacionTeorico::join('PORTAFOLIO_CURSO', 'EVALUACION_Teorico.id_portafolio_curso', '=', 'PORTAFOLIO_CURSO.id')
            ->where('EVALUACION_Teorico.id_revisor_usuario', auth()->user()->id)
            ->whereIn('EVALUACION_Teorico.id_docente_usuario', $docentes->pluck('id_docente_usuario'))
            ->select('EVALUACION_Teorico.id_docente_usuario', 'EVALUACION_Teorico.id_portafolio_curso');
        $reportes = $reportesPractico->union($reportesTeorico)
            ->get()
            ->groupBy('id_docente_usuario');
        $reportes = $reportes->map(function ($portafolios, $docenteId) {
            $docente = Usuario::find($docenteId);
            $docenteNombre = $docente->nombres . ' ' . $docente->apellido_paterno . ' ' . $docente->apellido_materno;
            $completados = 0;
            $pendientes = 0;
            $observados = 0;
            $observaciones = collect([]);
            foreach ($portafolios as $portafolio) {
                $curso = PortafolioCurso::find($portafolio->id_portafolio_curso);
                if ($curso->estado == 'Completado') {
                    $completados++;
                } elseif ($curso->estado == 'Pendiente') {
                    $pendientes++;
                } elseif ($curso->estado == 'Observado') {
                    $observados++;
                }
                $observaciones = $observaciones->merge(Observacion::where('id_portafolio_curso', $curso->id)->pluck('observacion'));
                \Log::info("Observacion: " . Observacion::where('id_portafolio_curso', $curso->id)->get()->pluck('observacion'));
            }
            return [
            'docente' => $docenteNombre,
            'completados' => $completados,
            'pendientes' => $pendientes,
            'observados' => $observados,
            'observaciones' => $observaciones
            ];
        });
        return view('revisor.reportes.pdf.cumplimiento', compact('revisor_nombre', 'revisor_correo', 'docentes_asignados', 'portafolios_revisados', 'portafolios_observados', 'portafolios_pendientes', 'reportes'));
    }
}
