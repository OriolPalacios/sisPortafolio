<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MallaCurricular extends Model
{
    protected $table = 'MALLA_CURRICULAR';
    public $timestamps = false;

    protected $fillable = [
        'nombre_carrera',
        'facultad',
        'duracion_semestres',
        'anio_vigencia',
        'activo'
    ];

    protected $casts = [
        'duracion_semestres' => 'int',
        'anio_vigencia' => 'datetime',
        'activo' => 'bool'
    ];

    public function cursos(): HasMany
    {
        return $this->hasMany(Curso::class, 'id_malla');
    }
}
