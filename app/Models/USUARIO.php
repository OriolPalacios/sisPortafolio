<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class USUARIO
 * 
 * @property int $id
 * @property string $nombres
 * @property string $apellido_paterno
 * @property string|null $apellido_materno
 * @property Carbon|null $fecha_nacimiento
 * @property string|null $sexo
 * @property string $correo
 * @property string|null $telefono
 * @property string $contrasena
 * @property string|null $departamento
 * @property string|null $especialidad
 * @property bool|null $revisor_asignado
 * @property bool|null $activo
 * @property Carbon|null $fecha_creacion
 * @property Carbon|null $fecha_actualizacion
 * 
 * @property Collection|ASIGNACIONREVISION[] $a_s_i_g_n_a_c_i_o_n_r_e_v_i_s_i_o_n_s
 * @property Collection|EVALUACIONPractico[] $e_v_a_l_u_a_c_i_o_n_practicos
 * @property Collection|EVALUACIONTeorico[] $e_v_a_l_u_a_c_i_o_n_teoricos
 * @property Collection|USUARIOROL[] $u_s_u_a_r_i_o_r_o_l_s
 *
 * @package App\Models
 */
class USUARIO extends Model
{
	protected $connection = 'mysql';
	protected $table = 'USUARIO';
	public $timestamps = false;

	protected $casts = [
		'fecha_nacimiento' => 'datetime',
		'revisor_asignado' => 'bool',
		'activo' => 'bool',
		'fecha_creacion' => 'datetime',
		'fecha_actualizacion' => 'datetime'
	];

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

	public function a_s_i_g_n_a_c_i_o_n_r_e_v_i_s_i_o_n_s()
	{
		return $this->hasMany(ASIGNACIONREVISION::class, 'id_docente_usuario');
	}

	public function e_v_a_l_u_a_c_i_o_n_practicos()
	{
		return $this->hasMany(EVALUACIONPractico::class, 'id_docente_usuario');
	}

	public function e_v_a_l_u_a_c_i_o_n_teoricos()
	{
		return $this->hasMany(EVALUACIONTeorico::class, 'id_docente_usuario');
	}

	public function u_s_u_a_r_i_o_r_o_l_s()
	{
		return $this->hasMany(USUARIOROL::class, 'id_usuario');
	}
}
