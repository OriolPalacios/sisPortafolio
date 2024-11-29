<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AsignacionRevision extends Model
{
    protected $table = 'ASIGNACION_REVISION';
    public $timestamps = false;

    protected $fillable = [
        'id_administrador_usuario',
        'id_revisor_usuario',
        'id_docente_usuario',
        'id_semestre',
        'fecha_asignacion',
        'activo'
    ];

    protected $casts = [
        'id_administrador_usuario' => 'int',
        'id_revisor_usuario' => 'int',
        'id_docente_usuario' => 'int',
        'id_semestre' => 'int',
        'fecha_asignacion' => 'date',
        'activo' => 'boolean'
    ];

    public function administrador(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_administrador_usuario');
    }

    public function revisor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_revisor_usuario');
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_docente_usuario');
    }

    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class, 'id_semestre');
    }

    public function portafoliosCurso(): HasMany
    {
        return $this->hasMany(PortafolioCurso::class, 'id_asignacion_revision');
    }
}
