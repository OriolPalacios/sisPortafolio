<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Observacion extends Model
{
    protected $table = 'OBSERVACIONES';
    public $timestamps = false;

    protected $fillable = [
        'id_portafolio',
        'observacion',
        'fecha_observacion'
    ];

    protected $casts = [
        'id_portafolio' => 'int',
        'fecha_observacion' => 'datetime'
    ];

    public function portafolioCurso(): BelongsTo
    {
        return $this->belongsTo(PortafolioCurso::class, 'id_portafolio');
    }
}
