<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CURSOSEMESTRE
 * 
 * @property int $id
 * @property int|null $id_curso
 * @property int|null $id_semestre
 * @property bool|null $activo
 * 
 * @property CURSO|null $c_u_r_s_o
 * @property SEMESTRE|null $s_e_m_e_s_t_r_e
 * @property Collection|PORTAFOLIOCURSO[] $p_o_r_t_a_f_o_l_i_o_c_u_r_s_o_s
 *
 * @package App\Models
 */
class CURSOSEMESTRE extends Model
{
	protected $connection = 'mysql';
	protected $table = 'CURSO_SEMESTRE';
	public $timestamps = false;

	protected $casts = [
		'id_curso' => 'int',
		'id_semestre' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'id_curso',
		'id_semestre',
		'activo'
	];

	public function c_u_r_s_o()
	{
		return $this->belongsTo(CURSO::class, 'id_curso');
	}

	public function s_e_m_e_s_t_r_e()
	{
		return $this->belongsTo(SEMESTRE::class, 'id_semestre');
	}

	public function p_o_r_t_a_f_o_l_i_o_c_u_r_s_o_s()
	{
		return $this->hasMany(PORTAFOLIOCURSO::class, 'id_curso_semestre');
	}
}
