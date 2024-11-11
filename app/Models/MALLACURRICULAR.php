<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MALLACURRICULAR
 * 
 * @property int $id
 * @property string $nombre_carrera
 * @property string $facultad
 * @property int $duracion_semestres
 * @property Carbon $anio_vigencia
 * @property bool|null $activo
 * 
 * @property Collection|CURSO[] $c_u_r_s_o_s
 *
 * @package App\Models
 */
class MALLACURRICULAR extends Model
{
	protected $connection = 'mysql';
	protected $table = 'MALLA_CURRICULAR';
	public $timestamps = false;

	protected $casts = [
		'duracion_semestres' => 'int',
		'anio_vigencia' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombre_carrera',
		'facultad',
		'duracion_semestres',
		'anio_vigencia',
		'activo'
	];

	public function c_u_r_s_o_s()
	{
		return $this->hasMany(CURSO::class, 'id_malla');
	}
}
