@extends('adminlte::page')

@section('title', 'Reporte de Evaluación')

@section('content_header')
    <div class="row d-flex justify-content-between">
        <h1>Reporte de Evaluación</h1>
        <a href="{{ route('Revisor.reportes.evaluacion.export') }}" class="btn btn-success" target="_blank">
            <i class="fas fa-file-pdf"></i> Exportar PDF
        </a>
</div>@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Barra de filtrado por nombre docente</h3>
        </div>
        <div class="card-body">
            <!-- Filter Bar -->
            <form method="GET" action="{{ route('Revisor.reportes.evaluacion') }}">
                <div class="input-group mb-3">
                    <input type="text" name="filter" class="form-control" placeholder="Buscar por nombre docente"
                        value="{{ request('filter') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>

            <!-- Report Table -->
            @foreach ($reportes as $reporte)
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title">{{ $reporte['docente'] }}</h3>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="table-primary text-center    ">
                                <th>Número de formatos cumplidos</th>
                                <th>Número de formatos observados</th>
                                <th>Número de formatos pendientes</th>
                            </tr>
                            <tr class="text-center">
                                <td>{{ $reporte['completados'] }}</td>
                                <td>{{ $reporte['observados'] }}</td>
                                <td>{{ $reporte['pendientes'] }}</td>
                            </tr>
                            <tr class="table-warning text-center">
                                <th colspan="3">Observaciones hechas al docente</th>
                            </tr>
                            @if (count($reporte['observaciones']) == 0)
                                <tr>
                                    <td colspan="3">No hay observaciones</td>
                                </tr>
                            @else
                                @foreach ($reporte['observaciones'] as $observacion)
                                    <tr>
                                        <td colspan="3">{{ $observacion }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @endforeach
            <!-- Pagination -->
            <div class="d-flex flex-row justify-content-center mt-3">
                {{ $reportes->links('pagination::bootstrap-4') }}
            </div>
        </div>
        {{-- <div class="card-footer">
        <a href="{{ route('Revisor.reportes.cumplimiento.export') }}" class="btn btn-success">Exportar PDF</a>
    </div> --}}
    </div>
@stop
