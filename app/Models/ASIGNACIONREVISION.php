<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ASIGNACIONREVISION
 * 
 * @property int $id
 * @property int|null $id_administrador_usuario
 * @property int|null $id_revisor_usuario
 * @property int|null $id_docente_usuario
 * @property int|null $id_semestre
 * @property Carbon $fecha_asignacion
 * @property bool|null $activo
 * 
 * @property USUARIO|null $u_s_u_a_r_i_o
 * @property SEMESTRE|null $s_e_m_e_s_t_r_e
 * @property Collection|PORTAFOLIOCURSO[] $p_o_r_t_a_f_o_l_i_o_c_u_r_s_o_s
 *
 * @package App\Models
 */
class ASIGNACIONREVISION extends Model
{
	protected $connection = 'mysql';
	protected $table = 'ASIGNACION_REVISION';
	public $timestamps = false;

	protected $casts = [
		'id_administrador_usuario' => 'int',
		'id_revisor_usuario' => 'int',
		'id_docente_usuario' => 'int',
		'id_semestre' => 'int',
		'fecha_asignacion' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'id_administrador_usuario',
		'id_revisor_usuario',
		'id_docente_usuario',
		'id_semestre',
		'fecha_asignacion',
		'activo'
	];

	public function u_s_u_a_r_i_o()
	{
		return $this->belongsTo(USUARIO::class, 'id_docente_usuario');
	}

	public function s_e_m_e_s_t_r_e()
	{
		return $this->belongsTo(SEMESTRE::class, 'id_semestre');
	}

	public function p_o_r_t_a_f_o_l_i_o_c_u_r_s_o_s()
	{
		return $this->hasMany(PORTAFOLIOCURSO::class, 'id_asignacion_revision');
	}
}
