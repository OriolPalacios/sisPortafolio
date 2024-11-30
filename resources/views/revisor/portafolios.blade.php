@extends('adminlte::page')

@section('title', 'Portafolios')

@section('content_header')
    <h1>Portafolios</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="card container-all-portafolios">
                <div class="card-header">
                    <h4> Portafolios Practicos</h4>
                </div>
                <div class="card-body container-portafolio">
                    @foreach ($portafolios_practico as $portafolio_practico)
                        <div class="card">
                            <div class="card-header">{{ $portafolio_practico->docente }}</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Curso</th>
                                            <th>Revision</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $portafolio_practico->curso }}</td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal{{ $portafolio_practico->id_portafolio_curso }}">Revisar</button>
                                                <div class="modal fade" id="modal{{ $portafolio_practico->id_portafolio_curso }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Revisión de
                                                                    Portafolio</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Contenido del modal -->
                                                                <p>Detalles del portafolio de
                                                                    {{ $portafolio_practico->docente }} en el curso
                                                                    {{ $portafolio_practico->curso }}</p>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Item</th>
                                                                            <th>Estado</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Caratula</td>
                                                                            <x-radio-input-portafolio name="caratula{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->caratula}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Carga Academica</td>
                                                                            <x-radio-input-portafolio name="carga_academica{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->carga_academica}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Filosofia</td>
                                                                            <x-radio-input-portafolio name="filosofia{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->filosofia}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>CV</td>
                                                                            <x-radio-input-portafolio name="cv{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->cv}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Plan de Sesiones</td>
                                                                            <x-radio-input-portafolio name="plan_sesiones{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->plan_sesiones}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Asistencia de Alumnos</td>
                                                                            <x-radio-input-portafolio name="asistencia_alumnos{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->asistencia_alumnos}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Evidencia de Actividades de Enseñanza</td>
                                                                            <x-radio-input-portafolio name="evidencia_actividades_ensenianza{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->evidencia_actividades_ensenianza}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Relación con Estudiantes</td>
                                                                            <x-radio-input-portafolio name="relacion_estudiantes{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->relacion_estudiantes}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Registro de Notas Prácticas Primera Parcial</td>
                                                                            <x-radio-input-portafolio name="registro_notas_practicas_primera_parcial{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->registro_notas_practicas_primera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Registro de Notas Prácticas Segunda Parcial</td>
                                                                            <x-radio-input-portafolio name="registro_notas_practicas_segunda_parcial{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->registro_notas_practicas_segunda_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Proyecto Individual o Grupal</td>
                                                                            <x-radio-input-portafolio name="proyecto_individual_grupal{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->proyecto_individual_grupal}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Fecha de Revisión</td>
                                                                            <x-radio-input-portafolio name="fecha_de_revision{{$portafolio_practico->id_portafolio_curso}}" value="{{$portafolio_practico->fecha_de_revision}}"/>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cerrar</button>
                                                                <button type="button" class="btn btn-primary">Guardar
                                                                    cambios</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card container-all-portafolios">
                <div class="card-header">
                    <h4>Portafolios Teoricos</h4>
                </div>
                <div class="card-body container-portafolio">
                    @foreach ($portafolios_teorico as $portafolio_teorico)
                        <div class="card">
                            <div class="card-header">{{ $portafolio_teorico->docente }}</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Curso</th>
                                            <th>Revision</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $portafolio_teorico->curso }}</td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal{{ $portafolio_teorico->id_portafolio_curso }}">Revisar</button>
                                                <div class="modal fade" id="modal{{ $portafolio_teorico->id_portafolio_curso }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Revisión de
                                                                    Portafolio</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Contenido del modal -->
                                                                <p>Detalles del portafolio de
                                                                    {{ $portafolio_teorico->docente }} en el curso
                                                                    {{ $portafolio_teorico->curso }}</p>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Item</th>
                                                                            <th>Estado</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Caratula</td>
                                                                            <x-radio-input-portafolio name="caratula{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->caratula}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Carga Academica</td>
                                                                            <x-radio-input-portafolio name="carga_academica{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->carga_academica}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Filosofia</td>
                                                                            <x-radio-input-portafolio name="filosofia{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->filosofia}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>CV</td>
                                                                            <x-radio-input-portafolio name="cv{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->cv}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Silabo</td>
                                                                            <x-radio-input-portafolio name="silabo{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->silabo}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Avance por Sesiones</td>
                                                                            <x-radio-input-portafolio name="avance_por_sesiones{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->avance_por_sesiones}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Registro Entrega Silabo</td>
                                                                            <x-radio-input-portafolio name="registro_entrega_silabo{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->registro_entrega_silabo}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Asistencia de Alumnos</td>
                                                                            <x-radio-input-portafolio name="asistencia_alumnos{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->asistencia_alumnos}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Evidencia de Actividades de Enseñanza</td>
                                                                            <x-radio-input-portafolio name="evidencia_actividades_ensenianza{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->evidencia_actividades_ensenianza}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Relación con Estudiantes</td>
                                                                            <x-radio-input-portafolio name="relacion_estudiantes{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->relacion_estudiantes}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Evaluación de Entrada</td>
                                                                            <x-radio-input-portafolio name="evaluacion_entrada{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->evaluacion_entrada}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Informe Resultado Evaluación de Entrada</td>
                                                                            <x-radio-input-portafolio name="informe_resultado_evaluacion_entrada{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->informe_resultado_evaluacion_entrada}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Resolución Evaluación de Entrada</td>
                                                                            <x-radio-input-portafolio name="resolucion_evaluacion_entrada{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->resolucion_evaluacion_entrada}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Resolución Primera Parcial</td>
                                                                            <x-radio-input-portafolio name="resolucion_primera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->resolucion_primera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Resolución Segunda Parcial</td>
                                                                            <x-radio-input-portafolio name="resolucion_segunda_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->resolucion_segunda_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Resolución Tercera Parcial</td>
                                                                            <x-radio-input-portafolio name="resolucion_tercera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->resolucion_tercera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Resolución Sustitutorio</td>
                                                                            <x-radio-input-portafolio name="resolucion_sustitutorio{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->resolucion_sustitutorio}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Enunciados Primera Parcial</td>
                                                                            <x-radio-input-portafolio name="enunciados_primera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->enunciados_primera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Enunciados Segunda Parcial</td>
                                                                            <x-radio-input-portafolio name="enunciados_segunda_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->enunciados_segunda_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Enunciados Tercera Parcial</td>
                                                                            <x-radio-input-portafolio name="enunciados_tercera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->enunciados_tercera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Enunciados Sustitutorio</td>
                                                                            <x-radio-input-portafolio name="enunciados_sustitutorio{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->enunciados_sustitutorio}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Asistencia Resolución Primera Parcial</td>
                                                                            <x-radio-input-portafolio name="asistencia_resolucion_primera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->asistencia_resolucion_primera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Asistencia Resolución Segunda Parcial</td>
                                                                            <x-radio-input-portafolio name="asistencia_resolucion_segunda_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->asistencia_resolucion_segunda_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Asistencia Resolución Tercera Parcial</td>
                                                                            <x-radio-input-portafolio name="asistencia_resolucion_tercera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->asistencia_resolucion_tercera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Registro Ingreso Notas Primera Parcial</td>
                                                                            <x-radio-input-portafolio name="registro_ingreso_notas_primera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->registro_ingreso_notas_primera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Registro Ingreso Notas Segunda Parcial</td>
                                                                            <x-radio-input-portafolio name="registro_ingreso_notas_segunda_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->registro_ingreso_notas_segunda_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Registro Ingreso Notas Tercera Parcial</td>
                                                                            <x-radio-input-portafolio name="registro_ingreso_notas_tercera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->registro_ingreso_notas_tercera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Registro Ingreso Notas Sustiturio</td>
                                                                            <x-radio-input-portafolio name="registro_ingreso_notas_sustiturio{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->registro_ingreso_notas_sustiturio}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Min Max Mean Notas Primera Parcial</td>
                                                                            <x-radio-input-portafolio name="min_max_mean_notas_primera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->min_max_mean_notas_primera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Min Max Mean Notas Segunda Parcial</td>
                                                                            <x-radio-input-portafolio name="min_max_mean_notas_segunda_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->min_max_mean_notas_segunda_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Min Max Mean Notas Tercera Parcial</td>
                                                                            <x-radio-input-portafolio name="min_max_mean_notas_tercera_parcial{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->min_max_mean_notas_tercera_parcial}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Rubrica Proyecto</td>
                                                                            <x-radio-input-portafolio name="rubrica_proyecto{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->rubrica_proyecto}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Asignación Proyectos Individuales o Grupales</td>
                                                                            <x-radio-input-portafolio name="asignacion_proyectos_individuales_o_grupales{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->asignacion_proyectos_individuales_o_grupales}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Informe Entrega Final Proyectos</td>
                                                                            <x-radio-input-portafolio name="informe_entrega_final_proyectos{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->informe_entrega_final_proyectos}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Otras Evaluaciones</td>
                                                                            <x-radio-input-portafolio name="otras_evaluaciones{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->otras_evaluaciones}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Cierre Portafolio</td>
                                                                            <x-radio-input-portafolio name="cierre_portafolio{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->cierre_portafolio}}"/>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Fecha de Revisión</td>
                                                                            <x-radio-input-portafolio name="fecha_de_revision{{$portafolio_teorico->id_portafolio_curso}}" value="{{$portafolio_teorico->fecha_de_revision}}"/>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cerrar</button>
                                                                <button type="button" class="btn btn-primary">Guardar
                                                                    cambios</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <style>
        .container-all-portafolios {
            width: 100%;
        }

        .container-portafolio {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            grid-gap: 1rem;
        }
    </style>
@stop
