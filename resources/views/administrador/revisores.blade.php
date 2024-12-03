@extends('adminlte::page')

@section('title', 'Gestión de Revisores')

@section('content_header')
    <h1>Gestión de Revisores</h1>
@stop

@section('content')
<div class="container">
    <!-- Título de la tabla -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Tabla de Docentes con Rol de Revisor</h3>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-3">
        <form action="{{ route('admin.revisores') }}" method="GET">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre del revisor" value="{{ $buscar ?? '' }}">
        </form>
    </div>

    <!-- Tabla de revisores -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre del Revisor</th>
                <th>Docentes Asignados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($revisores as $revisor)
            <tr>
                <td>{{ $revisor->nombres }} {{ $revisor->apellido_paterno }} {{ $revisor->apellido_materno }}</td>
                <td>
                    <ul>
                        @php
                            $docentesUnicos = $revisor->asignacionesComoRevisor->unique('id_docente_usuario');
                        @endphp
                        @forelse ($docentesUnicos as $asignacion)
                            <li>{{ $asignacion->docente->nombres }} {{ $asignacion->docente->apellido_paterno }} {{ $asignacion->docente->apellido_materno }}</li>
                        @empty
                            <li>No hay docentes asignados</li>
                        @endforelse
                    </ul>
                </td>
                <td>
                    <a href="{{ route('revisores.editarAsignacion', $revisor->id) }}" class="btn btn-primary btn-sm">
                        Modificar Asignación
                    </a>
                </td>
                
                
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No hay revisores disponibles.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
     <!-- Paginación de la tabla -->
     <div class="d-flex justify-content-center">
        <nav>
            <ul class="pagination pagination-sm m-0">
                <li class="page-item {{ $revisores->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $revisores->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
    
                @for ($i = 1; $i <= $revisores->lastPage(); $i++)
                    <li class="page-item {{ $i == $revisores->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $revisores->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
    
                <li class="page-item {{ $revisores->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $revisores->nextPageUrl() }}" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@stop
