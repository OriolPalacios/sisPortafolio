<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluacionPractico extends Model
{
    protected $table = 'EVALUACION_Practico';
    public $timestamps = false;

    protected $fillable = [
        'id_revisor_usuario',
        'id_docente_usuario',
        'id_portafolio',
        'caratula',
        'carga_academica',
        'filosofia',
        'cv',
        'plan_sesiones',
        'asistencia_alumnos',
        'evidencia_actividades_ensenianza',
        'registro_notas_practicas',
        'proyecto_individual_grupal',
        'fecha_de_revision'
    ];

    protected $casts = [
        'id_revisor_usuario' => 'int',
        'id_docente_usuario' => 'int',
        'id_portafolio' => 'int',
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
        return $this->belongsTo(PortafolioCurso::class, 'id_portafolio');
    }
}
