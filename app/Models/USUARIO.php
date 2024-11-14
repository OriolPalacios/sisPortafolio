<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'USUARIO';
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'sexo',
        'correo',
        'telefono',
        'contrasena',
        'departamento',
        'especialidad',
        'revisor_asignado',
        'activo',
        'fecha_creacion',
        'fecha_actualizacion'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'datetime',
        'revisor_asignado' => 'bool',
        'activo' => 'bool',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime'
    ];

    protected $hidden = [
        'contrasena'
    ];

    public function roles(): HasMany
    {
        return $this->hasMany(UsuarioRol::class, 'id_usuario');
    }

    public function asignacionesComoAdministrador(): HasMany
    {
        return $this->hasMany(AsignacionRevision::class, 'id_administrador_usuario');
    }

    public function asignacionesComoRevisor(): HasMany
    {
        return $this->hasMany(AsignacionRevision::class, 'id_revisor_usuario');
    }

    public function asignacionesComoDocente(): HasMany
    {
        return $this->hasMany(AsignacionRevision::class, 'id_docente_usuario');
    }
}
