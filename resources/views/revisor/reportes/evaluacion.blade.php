@extends('adminlte::page')

@section('title', 'Reporte de Evaluación')

@section('content_header')
    <h1>Reporte de Evaluación</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Barra de filtrado por nombre docente</h3>
    </div>
    <div class="card-body">
        <!-- Filter Bar -->
        <form method="GET" action="{{ route('Revisor.reportes.evaluacion') }}">
            <div class="input-group mb-3">
                <input type="text" name="filter" class="form-control" placeholder="Buscar por nombre docente" value="{{ request('filter') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Report Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre del docente</th>
                    <th>Número de formatos cumplidos</th>
                    <th>Número de formatos observados</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Static Row -->
                <tr>
                    <td>Docente 1</td>
                    <td>5</td>
                    <td>2</td>
                </tr>
                <!-- Dynamic Rows -->
                {{-- @foreach ($reportes as $reporte)
                <tr>
                    <td>{{ $reporte->nombre }}</td>
                    <td>{{ $reporte->formatos_cumplidos }}</td>
                    <td>{{ $reporte->formatos_observados }}</td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $reportes->links() }}
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('Revisor.reportes.cumplimiento.export') }}" class="btn btn-success">Exportar PDF</a>
    </div>
</div>
@stop
