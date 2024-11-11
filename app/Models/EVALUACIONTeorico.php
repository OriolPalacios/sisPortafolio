<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EVALUACIONTeorico
 * 
 * @property int $id
 * @property int|null $id_revisor_usuario
 * @property int|null $id_docente_usuario
 * @property int|null $id_portafolio_curso
 * @property string|null $caratula
 * @property string|null $carga_academica
 * @property string|null $filosofia
 * @property string|null $cv
 * @property string|null $silabo
 * @property string|null $avance_por_sesiones
 * @property string|null $registro_entrega_silabo
 * @property string|null $asistencia_alumnos
 * @property string|null $evidencia_actividades_ensenianza
 * @property string|null $evaluacion_entrada
 * @property string|null $informe_resultado_evaluacion_entrada
 * @property string|null $resolucion_evaluacion_entrada
 * @property string|null $enunciados_primera_parcial
 * @property string|null $resolucion_primera_parcial
 * @property string|null $enunciados_segunda_parcial
 * @property string|null $resolucion_segunda_parcial
 * @property string|null $enunciados_tercera_parcial
 * @property string|null $resolucion_tercera_parcial
 * @property string|null $asistencia_resolucion_primera_parcial
 * @property string|null $asistencia_resolucion_segunda_parcial
 * @property string|null $asistencia_resolucion_tercera_parcial
 * @property string|null $registro_ingreso_notas
 * @property string|null $rubrica_proyecto
 * @property string|null $asignacion_proyectos_individuales_o_grupales
 * @property string|null $informe_entrega_final_proyectos
 * @property string|null $otras_evaluaciones
 * @property string|null $cierre_portafolio
 * @property Carbon|null $fecha_de_revision
 * 
 * @property USUARIO|null $u_s_u_a_r_i_o
 * @property PORTAFOLIOCURSO|null $p_o_r_t_a_f_o_l_i_o_c_u_r_s_o
 *
 * @package App\Models
 */
class EVALUACIONTeorico extends Model
{
	protected $connection = 'mysql';
	protected $table = 'EVALUACION_Teorico';
	public $timestamps = false;

	protected $casts = [
		'id_revisor_usuario' => 'int',
		'id_docente_usuario' => 'int',
		'id_portafolio_curso' => 'int',
		'fecha_de_revision' => 'datetime'
	];

	protected $fillable = [
		'id_revisor_usuario',
		'id_docente_usuario',
		'id_portafolio_curso',
		'caratula',
		'carga_academica',
		'filosofia',
		'cv',
		'silabo',
		'avance_por_sesiones',
		'registro_entrega_silabo',
		'asistencia_alumnos',
		'evidencia_actividades_ensenianza',
		'evaluacion_entrada',
		'informe_resultado_evaluacion_entrada',
		'resolucion_evaluacion_entrada',
		'enunciados_primera_parcial',
		'resolucion_primera_parcial',
		'enunciados_segunda_parcial',
		'resolucion_segunda_parcial',
		'enunciados_tercera_parcial',
		'resolucion_tercera_parcial',
		'asistencia_resolucion_primera_parcial',
		'asistencia_resolucion_segunda_parcial',
		'asistencia_resolucion_tercera_parcial',
		'registro_ingreso_notas',
		'rubrica_proyecto',
		'asignacion_proyectos_individuales_o_grupales',
		'informe_entrega_final_proyectos',
		'otras_evaluaciones',
		'cierre_portafolio',
		'fecha_de_revision'
	];

	public function u_s_u_a_r_i_o()
	{
		return $this->belongsTo(USUARIO::class, 'id_docente_usuario');
	}

	public function p_o_r_t_a_f_o_l_i_o_c_u_r_s_o()
	{
		return $this->belongsTo(PORTAFOLIOCURSO::class, 'id_portafolio_curso');
	}
}
