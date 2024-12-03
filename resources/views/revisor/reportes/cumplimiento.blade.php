@extends('adminlte::page')

@section('title', 'Reporte de Cumplimiento')

@section('content_header')
    <h1>Reporte de Cumplimiento</h1>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-sm">
                        <b>Revisor</b>
                    </div>
                    <div class="col-sm">
                        <b>Correo</b>
                    </div>
                    <div class="col-sm">
                        <b>Nro. Docentes asignados</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        {{ $revisor_nombre }}
                    </div>
                    <div class="col-sm">
                        {{ $revisor_correo }}
                    </div>
                    <div class="col-sm">
                        {{ 'Docentes asignados: ' . $docentes_asignados->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h4 class="card-header">Estado Global de los Portafolios</h4>
            <div class="card-body text-center">
                <div class="row">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <th>Estado</th>
                            <th>Cantidad total</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Completo</td>
                                <td>{{ $portafolios_revisados }}</td>
                            </tr>
                            <tr>
                                <td>Observado</td>
                                <td>{{ $portafolios_observados }}</td>
                            </tr>
                            <tr>
                                <td>Pendiente</td>
                                <td>{{ $portafolios_pendientes }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <h4 class="card-header">Estado de los Portafolios por Docente</h4>
            <div class="card-body text-center">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <th>Docente</th>
                        <th>Pendiente</th>
                        <th>Observado</th>
                        <th>Completo</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        @foreach ($reportes as $reporte)
                            <tr>
                                <td>{{ $reporte['docente'] }}</td>
                                <td>{{ $reporte['pendientes'] }}</td>
                                <td>{{ $reporte['observados'] }}</td>
                                <td>{{ $reporte['completados'] }}</td>
                                <td class="table-warning">{{ $reporte['pendientes'] + $reporte['observados'] + $reporte['completados'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@stop
