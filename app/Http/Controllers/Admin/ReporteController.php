<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\Usuario;
use App\Models\PortafolioCurso;
use App\Models\AsignacionRevision;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function reporteGeneral()
    {
        $semestres = Semestre::with(['portafolioCursos'])
            ->get()
            ->map(function ($semestre) {
                $portafolios = $semestre->portafolioCursos;
                return [
                    'semestre' => $semestre->nombre_semestre,
                    'inicio' => $semestre->inicio,
                    'fin' => $semestre->fin,
                    'total' => $portafolios->count(),
                    'observados' => $portafolios->where('estado', 'Observado')->count(),
                    'completados' => $portafolios->where('estado', 'Completado')->count(),
                    'pendientes' => $portafolios->where('estado', 'Pendiente')->count(),
                ];
            });

        return view('administrador.reportes.general', compact('semestres'));
    }

    public function reporteDocente(Request $request)
    {
        $query = Usuario::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'LIKE', "%{$search}%")
                  ->orWhere('apellido_paterno', 'LIKE', "%{$search}%")
                  ->orWhere('apellido_materno', 'LIKE', "%{$search}%");
            });
        }

        $docentes = $query->whereHas('roles', function($q) {
            $q->where('nombre_rol', 'Docente');
        })->paginate(10);

        foreach ($docentes as $docente) {
            // Datos como revisor
            $asignacionesComoRevisor = AsignacionRevision::where('id_revisor_usuario', $docente->id)->get();
            $docente->docentes_asignados = $asignacionesComoRevisor->unique('id_docente_usuario')->count();
            $docente->portafolios_revisados = PortafolioCurso::whereIn('id_asignacion_revision', $asignacionesComoRevisor->pluck('id'))
                                            ->where('estado', 'Completado')
                                            ->count();
            $docente->portafolios_pendientes = PortafolioCurso::whereIn('id_asignacion_revision', $asignacionesComoRevisor->pluck('id'))
                                            ->where('estado', 'Pendiente')
                                            ->count();

            // Datos como docente
            $asignacionesComoDocente = AsignacionRevision::where('id_docente_usuario', $docente->id)->get();
            $docente->cursos_asignados = $asignacionesComoDocente->count();
            $docente->observaciones = PortafolioCurso::whereIn('id_asignacion_revision', $asignacionesComoDocente->pluck('id'))
                                    ->where('estado', 'Observado')
                                    ->count();
        }

        return view('administrador.reportes.docente', compact('docentes'));
    }

    public function exportarReporteGeneral()
    {
        $semestres = Semestre::with(['portafolioCursos'])->get();
        $pdf = Pdf::loadView('administrador.reportes.pdf.general', compact('semestres'));
        return $pdf->stream('reporte-general-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportarReporteDocente($id)
    {
        $docente = Usuario::with([
            'asignacionesComoRevisor.portafoliosCurso',
            'asignacionesComoRevisor.semestre',
            'asignacionesComoRevisor.docente',
            'asignacionesComoDocente.portafoliosCurso',
            'asignacionesComoDocente.semestre',
            'asignacionesComoDocente.revisor'
        ])->findOrFail($id);

        // Agrupar datos por semestre para el rol de revisor
        $datosRevisor = $docente->asignacionesComoRevisor
            ->groupBy('semestre.nombre_semestre')
            ->map(function ($asignaciones) {
                return [
                    'docentes_asignados' => $asignaciones->unique('id_docente_usuario')->count(),
                    'portafolios_revisados' => $asignaciones->flatMap->portafoliosCurso
                        ->where('estado', 'Completado')->count(),
                    'portafolios_pendientes' => $asignaciones->flatMap->portafoliosCurso
                        ->where('estado', 'Pendiente')->count(),
                    'fecha_inicio' => $asignaciones->first()->semestre->inicio,
                    'fecha_fin' => $asignaciones->first()->semestre->fin
                ];
            });

        // Agrupar datos por semestre para el rol de docente
        $datosDocente = $docente->asignacionesComoDocente
            ->groupBy('semestre.nombre_semestre')
            ->map(function ($asignaciones) {
                return [
                    'cursos_asignados' => $asignaciones->count(),
                    'observaciones' => $asignaciones->flatMap->portafoliosCurso
                        ->where('estado', 'Observado')->count(),
                    'completados' => $asignaciones->flatMap->portafoliosCurso
                        ->where('estado', 'Completado')->count(),
                    'fecha_inicio' => $asignaciones->first()->semestre->inicio,
                    'fecha_fin' => $asignaciones->first()->semestre->fin
                ];
            });

        $pdf = Pdf::loadView('administrador.reportes.pdf.docente', compact('docente', 'datosRevisor', 'datosDocente'));
        return $pdf->stream('reporte-docente-' . $docente->apellido_paterno . '-' . now()->format('Y-m-d') . '.pdf');
    }
} 