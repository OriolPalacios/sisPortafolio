<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PORTAFOLIOCURSO
 * 
 * @property int $id
 * @property int|null $id_asignacion_revision
 * @property int|null $id_curso_semestre
 * @property string|null $codigo_curso_semestre
 * @property string|null $formato
 * @property string|null $estado
 * @property string|null $tipo
 * @property Carbon|null $fecha_creacion
 * @property Carbon|null $fecha_actualizacion
 * 
 * @property ASIGNACIONREVISION|null $a_s_i_g_n_a_c_i_o_n_r_e_v_i_s_i_o_n
 * @property CURSOSEMESTRE|null $c_u_r_s_o_s_e_m_e_s_t_r_e
 * @property Collection|EVALUACIONPractico[] $e_v_a_l_u_a_c_i_o_n_practicos
 * @property Collection|EVALUACIONTeorico[] $e_v_a_l_u_a_c_i_o_n_teoricos
 * @property Collection|OBSERVACIONE[] $o_b_s_e_r_v_a_c_i_o_n_e_s
 *
 * @package App\Models
 */
class PORTAFOLIOCURSO extends Model
{
	protected $connection = 'mysql';
	protected $table = 'PORTAFOLIO_CURSO';
	public $timestamps = false;

	protected $casts = [
		'id_asignacion_revision' => 'int',
		'id_curso_semestre' => 'int',
		'fecha_creacion' => 'datetime',
		'fecha_actualizacion' => 'datetime'
	];

	protected $fillable = [
		'id_asignacion_revision',
		'id_curso_semestre',
		'codigo_curso_semestre',
		'formato',
		'estado',
		'tipo',
		'fecha_creacion',
		'fecha_actualizacion'
	];

	public function a_s_i_g_n_a_c_i_o_n_r_e_v_i_s_i_o_n()
	{
		return $this->belongsTo(ASIGNACIONREVISION::class, 'id_asignacion_revision');
	}

	public function c_u_r_s_o_s_e_m_e_s_t_r_e()
	{
		return $this->belongsTo(CURSOSEMESTRE::class, 'id_curso_semestre');
	}

	public function e_v_a_l_u_a_c_i_o_n_practicos()
	{
		return $this->hasMany(EVALUACIONPractico::class, 'id_portafolio');
	}

	public function e_v_a_l_u_a_c_i_o_n_teoricos()
	{
		return $this->hasMany(EVALUACIONTeorico::class, 'id_portafolio_curso');
	}

	public function o_b_s_e_r_v_a_c_i_o_n_e_s()
	{
		return $this->hasMany(OBSERVACIONE::class, 'id_portafolio');
	}
}
