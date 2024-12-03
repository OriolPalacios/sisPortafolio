@extends('adminlte::page')

@section('title', 'Reporte de Desempeño Histórico de Docente')

@section('content_header')
    <h1>Reporte de Desempeño Histórico de Docente</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Búsqueda de Docentes</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('Administrador.reportes.docente') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar docente..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>

                    @foreach($docentes as $docente)
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>{{ $docente->nombres }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}</h4>
                                <a href="{{ route('Administrador.reportes.docente.export', $docente->id) }}" class="btn btn-success" target="_blank">
                                    <i class="fas fa-file-pdf"></i> Exportar PDF
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Información Personal</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Correo:</strong> {{ $docente->correo }}</li>
                                        <li><strong>Especialidad:</strong> {{ $docente->especialidad }}</li>
                                        <li><strong>Estado:</strong> {{ $docente->activo ? 'Activo' : 'Inactivo' }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>Desempeño como Revisor</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Docentes Asignados:</strong> {{ $docente->docentes_asignados }}</li>
                                        <li><strong>Portafolios Revisados:</strong> {{ $docente->portafolios_revisados }}</li>
                                        <li><strong>Portafolios Pendientes:</strong> {{ $docente->portafolios_pendientes }}</li>
                                    </ul>
                                    <h5>Desempeño como Docente</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Cursos Asignados:</strong> {{ $docente->cursos_asignados }}</li>
                                        <li><strong>Observaciones:</strong> {{ $docente->observaciones }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-center">
                        {{ $docentes->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop 