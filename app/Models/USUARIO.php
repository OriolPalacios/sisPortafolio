<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 
use Illuminate\Notifications\Notifiable;


class Usuario extends Authenticatable
{
    use Notifiable;

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

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Rol::class, 'USUARIO_ROL', 'id_usuario', 'id_rol');
    }

    public function getRoleAttribute()
    {
        return $this->roles()->pluck('nombre_rol');
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

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('nombre_rol', (array) $roles)->exists();
    }

}
