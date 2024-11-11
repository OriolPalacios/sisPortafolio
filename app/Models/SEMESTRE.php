<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SEMESTRE
 * 
 * @property int $id
 * @property string $nombre_semestre
 * @property Carbon $inicio
 * @property Carbon $fin
 * @property bool|null $activo
 * 
 * @property Collection|ASIGNACIONREVISION[] $a_s_i_g_n_a_c_i_o_n_r_e_v_i_s_i_o_n_s
 * @property Collection|CURSO[] $c_u_r_s_o_s
 *
 * @package App\Models
 */
class SEMESTRE extends Model
{
	protected $connection = 'mysql';
	protected $table = 'SEMESTRE';
	public $timestamps = false;

	protected $casts = [
		'inicio' => 'datetime',
		'fin' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombre_semestre',
		'inicio',
		'fin',
		'activo'
	];

	public function a_s_i_g_n_a_c_i_o_n_r_e_v_i_s_i_o_n_s()
	{
		return $this->hasMany(ASIGNACIONREVISION::class, 'id_semestre');
	}

	public function c_u_r_s_o_s()
	{
		return $this->belongsToMany(CURSO::class, 'CURSO_SEMESTRE', 'id_semestre', 'id_curso')
					->withPivot('id', 'activo');
	}
}
