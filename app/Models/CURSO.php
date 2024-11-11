<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CURSO
 * 
 * @property int $id
 * @property int|null $id_malla
 * @property string $codigo_curso
 * @property string|null $area_curricular
 * @property string $nombre_curso
 * @property string|null $tipo
 * 
 * @property MALLACURRICULAR|null $m_a_l_l_a_c_u_r_r_i_c_u_l_a_r
 * @property Collection|SEMESTRE[] $s_e_m_e_s_t_r_e_s
 *
 * @package App\Models
 */
class CURSO extends Model
{
	protected $connection = 'mysql';
	protected $table = 'CURSO';
	public $timestamps = false;

	protected $casts = [
		'id_malla' => 'int'
	];

	protected $fillable = [
		'id_malla',
		'codigo_curso',
		'area_curricular',
		'nombre_curso',
		'tipo'
	];

	public function m_a_l_l_a_c_u_r_r_i_c_u_l_a_r()
	{
		return $this->belongsTo(MALLACURRICULAR::class, 'id_malla');
	}

	public function s_e_m_e_s_t_r_e_s()
	{
		return $this->belongsToMany(SEMESTRE::class, 'CURSO_SEMESTRE', 'id_curso', 'id_semestre')
					->withPivot('id', 'activo');
	}
}
