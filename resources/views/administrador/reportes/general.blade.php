@extends('adminlte::page')

@section('title', 'Reporte General de Revisión')

@section('content_header')
    <h1>Reporte General de Revisión</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Reporte de Revisiones por Semestre</h3>
                        <a href="{{ route('Administrador.reportes.general.export') }}" class="btn btn-success" target="_blank">
                            <i class="fas fa-file-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="semestre">Filtrar por Semestre:</label>
                        <select class="form-control" id="semestre">
                            <option value="">Todos los semestres</option>
                            @foreach($semestres as $semestre)
                                <option value="{{ $semestre['semestre'] }}">{{ $semestre['semestre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Semestre</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Total Revisiones</th>
                                <th>Observados</th>
                                <th>Completados</th>
                                <th>Pendientes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($semestres as $semestre)
                            <tr>
                                <td>{{ $semestre['semestre'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($semestre['inicio'])->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($semestre['fin'])->format('d/m/Y') }}</td>
                                <td>{{ $semestre['total'] }}</td>
                                <td>{{ $semestre['observados'] }}</td>
                                <td>{{ $semestre['completados'] }}</td>
                                <td>{{ $semestre['pendientes'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#semestre').on('change', function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@stop 