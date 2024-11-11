<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OBSERVACIONE
 * 
 * @property int $id
 * @property int|null $id_portafolio
 * @property string|null $observacion
 * @property Carbon|null $fecha_observacion
 * 
 * @property PORTAFOLIOCURSO|null $p_o_r_t_a_f_o_l_i_o_c_u_r_s_o
 *
 * @package App\Models
 */
class OBSERVACIONE extends Model
{
	protected $connection = 'mysql';
	protected $table = 'OBSERVACIONES';
	public $timestamps = false;

	protected $casts = [
		'id_portafolio' => 'int',
		'fecha_observacion' => 'datetime'
	];

	protected $fillable = [
		'id_portafolio',
		'observacion',
		'fecha_observacion'
	];

	public function p_o_r_t_a_f_o_l_i_o_c_u_r_s_o()
	{
		return $this->belongsTo(PORTAFOLIOCURSO::class, 'id_portafolio');
	}
}
