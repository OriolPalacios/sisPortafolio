<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class USUARIOROL
 * 
 * @property int $id
 * @property int|null $id_usuario
 * @property int|null $id_rol
 * @property Carbon $fecha_asignacion
 * @property bool|null $activo
 * 
 * @property USUARIO|null $u_s_u_a_r_i_o
 * @property ROLE|null $r_o_l_e
 *
 * @package App\Models
 */
class USUARIOROL extends Model
{
	protected $connection = 'mysql';
	protected $table = 'USUARIO_ROL';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_rol' => 'int',
		'fecha_asignacion' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'id_usuario',
		'id_rol',
		'fecha_asignacion',
		'activo'
	];

	public function u_s_u_a_r_i_o()
	{
		return $this->belongsTo(USUARIO::class, 'id_usuario');
	}

	public function r_o_l_e()
	{
		return $this->belongsTo(ROLE::class, 'id_rol');
	}
}
