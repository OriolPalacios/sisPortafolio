<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'ROLES';
    public $timestamps = false;

    protected $fillable = [
        'nombre_rol'
    ];

    public function usuarioRoles(): HasMany
    {
        return $this->hasMany(UsuarioRol::class, 'id_rol');
    }
}
