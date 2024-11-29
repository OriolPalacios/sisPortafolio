<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ASIGNACIONREVISION;
use App\Models\PORTAFOLIOCURSO;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semestre extends Model
{
    use HasFactory;

    protected $table = 'SEMESTRE';
    public $timestamps = false;

    protected $fillable = [
        'nombre_semestre',
        'inicio',
        'fin',
        'activo'
    ];

    protected $casts = [
        'inicio' => 'datetime',
        'fin' => 'datetime',
        'activo' => 'bool'
    ];

    public function cursoSemestres(): HasMany
    {
        return $this->hasMany(CursoSemestre::class, 'id_semestre');
    }

    public function portafolioCursos()
    {
        return $this->hasManyThrough(
            PortafolioCurso::class,
            AsignacionRevision::class,
            'id_semestre',
            'id_asignacion_revision'
        );
    }
}
