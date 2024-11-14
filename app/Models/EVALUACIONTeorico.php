<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluacionTeorico extends Model
{
    protected $table = 'EVALUACION_Teorico';
    public $timestamps = false;

    protected $fillable = [
        'id_revisor_usuario',
        'id_docente_usuario',
        'id_portafolio_curso',
        'caratula',
        'carga_academica',
        'filosofia',
        'cv',
        'silabo',
        'avance_por_sesiones',
        'registro_entrega_silabo',
        'asistencia_alumnos',
        'evidencia_actividades_ensenianza',
        'evaluacion_entrada',
        'informe_resultado_evaluacion_entrada',
        'resolucion_evaluacion_entrada',
        'enunciados_primera_parcial',
        'resolucion_primera_parcial',
        'enunciados_segunda_parcial',
        'resolucion_segunda_parcial',
        'enunciados_tercera_parcial',
        'resolucion_tercera_parcial',
        'asistencia_resolucion_primera_parcial',
        'asistencia_resolucion_segunda_parcial',
        'asistencia_resolucion_tercera_parcial',
        'registro_ingreso_notas',
        'rubrica_proyecto',
        'asignacion_proyectos_individuales_o_grupales',
        'informe_entrega_final_proyectos',
        'otras_evaluaciones',
        'cierre_portafolio',
        'fecha_de_revision'
    ];

    protected $casts = [
        'id_revisor_usuario' => 'int',
        'id_docente_usuario' => 'int',
        'id_portafolio_curso' => 'int',
        'fecha_de_revision' => 'datetime'
    ];

    public function revisor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_revisor_usuario');
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_docente_usuario');
    }

    public function portafolioCurso(): BelongsTo
    {
        return $this->belongsTo(PortafolioCurso::class, 'id_portafolio_curso');
    }
}
