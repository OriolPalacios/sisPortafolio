<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CursoSemestre extends Model
{
    use HasFactory;

    protected $table = 'CURSO_SEMESTRE';
    public $timestamps = false;

    protected $fillable = [
        'id_curso',
        'id_semestre',
        'activo'
    ];

    protected $casts = [
        'id_curso' => 'int',
        'id_semestre' => 'int',
        'activo' => 'bool'
    ];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class, 'id_semestre');
    }

    public function portafoliosCurso(): HasMany
    {
        return $this->hasMany(PortafolioCurso::class, 'id_curso_semestre');
    }
}
