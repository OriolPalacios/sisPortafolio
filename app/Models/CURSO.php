<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'CURSO';
    public $timestamps = false;

    protected $fillable = [
        'id_malla',
        'codigo_curso',
        'area_curricular',
        'nombre_curso',
        'tipo'
    ];

    protected $casts = [
        'id_malla' => 'int'
    ];

    public function mallaCurricular(): BelongsTo
    {
        return $this->belongsTo(MallaCurricular::class, 'id_malla');
    }

    public function cursoSemestres(): HasMany
    {
        return $this->hasMany(CursoSemestre::class, 'id_curso');
    }
}
