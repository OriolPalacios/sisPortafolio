<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PortafolioCurso extends Model
{
    protected $table = 'PORTAFOLIO_CURSO';
    public $timestamps = false;

    protected $fillable = [
        'id_asignacion_revision',
        'id_curso_semestre',
        'codigo_curso_semestre',
        'formato',
        'estado',
        'tipo',
        'fecha_creacion',
        'fecha_actualizacion'
    ];

    protected $casts = [
        'id_asignacion_revision' => 'int',
        'id_curso_semestre' => 'int',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime'
    ];

    public function asignacionRevision(): BelongsTo
    {
        return $this->belongsTo(AsignacionRevision::class, 'id_asignacion_revision');
    }

    public function cursoSemestre(): BelongsTo
    {
        return $this->belongsTo(CursoSemestre::class, 'id_curso_semestre');
    }

    public function evaluacionTeorico(): HasOne
    {
        return $this->hasOne(EvaluacionTeorico::class, 'id_portafolio_curso');
    }

    public function evaluacionPractico(): HasOne
    {
        return $this->hasOne(EvaluacionPractico::class, 'id_portafolio');
    }

    public function observaciones(): HasMany
    {
        return $this->hasMany(Observacion::class, 'id_portafolio');
    }
}
