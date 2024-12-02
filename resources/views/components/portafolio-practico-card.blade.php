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
                        <div class="modal fade"
                            id="modal{{ $portafolio_practico->id_portafolio_curso }}" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Revisión de
                                            Portafolio</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form
                                        action="{{ route('evaluacionPractico.update', $portafolio_practico->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
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
                                                        <x-radio-input-portafolio
                                                            name="caratula{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->caratula }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Carga Academica</td>
                                                        <x-radio-input-portafolio
                                                            name="carga_academica{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->carga_academica }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Filosofia</td>
                                                        <x-radio-input-portafolio
                                                            name="filosofia{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->filosofia }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>CV</td>
                                                        <x-radio-input-portafolio
                                                            name="cv{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->cv }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Plan de Sesiones</td>
                                                        <x-radio-input-portafolio
                                                            name="plan_sesiones{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->plan_sesiones }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Asistencia de Alumnos</td>
                                                        <x-radio-input-portafolio
                                                            name="asistencia_alumnos{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->asistencia_alumnos }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Evidencia de Actividades de Enseñanza
                                                        </td>
                                                        <x-radio-input-portafolio
                                                            name="evidencia_actividades_ensenianza{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->evidencia_actividades_ensenianza }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Relación con Estudiantes</td>
                                                        <x-radio-input-portafolio
                                                            name="relacion_estudiantes{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->relacion_estudiantes }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Registro de Notas Prácticas Primera
                                                            Parcial</td>
                                                        <x-radio-input-portafolio
                                                            name="registro_notas_practicas_primera_parcial{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->registro_notas_practicas_primera_parcial }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Registro de Notas Prácticas Segunda
                                                            Parcial</td>
                                                        <x-radio-input-portafolio
                                                            name="registro_notas_practicas_segunda_parcial{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->registro_notas_practicas_segunda_parcial }}" />
                                                    </tr>
                                                    <tr>
                                                        <td>Proyecto Individual o Grupal</td>
                                                        <x-radio-input-portafolio
                                                            name="proyecto_individual_grupal{{ $portafolio_practico->id_portafolio_curso }}"
                                                            value="{{ $portafolio_practico->proyecto_individual_grupal }}" />
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar
                                                cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>