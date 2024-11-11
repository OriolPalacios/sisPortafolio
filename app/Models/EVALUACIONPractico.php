<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EVALUACIONPractico
 * 
 * @property int $id
 * @property int|null $id_revisor_usuario
 * @property int|null $id_docente_usuario
 * @property int|null $id_portafolio
 * @property string|null $caratula
 * @property string|null $carga_academica
 * @property string|null $filosofia
 * @property string|null $cv
 * @property string|null $plan_sesiones
 * @property string|null $asistencia_alumnos
 * @property string|null $evidencia_actividades_ensenianza
 * @property string|null $registro_notas_practicas
 * @property string|null $proyecto_individual_grupal
 * @property Carbon|null $fecha_de_revision
 * 
 * @property USUARIO|null $u_s_u_a_r_i_o
 * @property PORTAFOLIOCURSO|null $p_o_r_t_a_f_o_l_i_o_c_u_r_s_o
 *
 * @package App\Models
 */
class EVALUACIONPractico extends Model
{
	protected $connection = 'mysql';
	protected $table = 'EVALUACION_Practico';
	public $timestamps = false;

	protected $casts = [
		'id_revisor_usuario' => 'int',
		'id_docente_usuario' => 'int',
		'id_portafolio' => 'int',
		'fecha_de_revision' => 'datetime'
	];

	protected $fillable = [
		'id_revisor_usuario',
		'id_docente_usuario',
		'id_portafolio',
		'caratula',
		'carga_academica',
		'filosofia',
		'cv',
		'plan_sesiones',
		'asistencia_alumnos',
		'evidencia_actividades_ensenianza',
		'registro_notas_practicas',
		'proyecto_individual_grupal',
		'fecha_de_revision'
	];

	public function u_s_u_a_r_i_o()
	{
		return $this->belongsTo(USUARIO::class, 'id_docente_usuario');
	}

	public function p_o_r_t_a_f_o_l_i_o_c_u_r_s_o()
	{
		return $this->belongsTo(PORTAFOLIOCURSO::class, 'id_portafolio');
	}
}
