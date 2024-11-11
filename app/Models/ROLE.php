<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ROLE
 * 
 * @property int $id
 * @property string $nombre_rol
 * 
 * @property Collection|USUARIOROL[] $u_s_u_a_r_i_o_r_o_l_s
 *
 * @package App\Models
 */
class ROLE extends Model
{
	protected $connection = 'mysql';
	protected $table = 'ROLES';
	public $timestamps = false;

	protected $fillable = [
		'nombre_rol'
	];

	public function u_s_u_a_r_i_o_r_o_l_s()
	{
		return $this->hasMany(USUARIOROL::class, 'id_rol');
	}
}
