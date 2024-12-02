@extends('adminlte::page')

@section('title', 'Gestión de Docentes')

@section('content_header')
    <h1>Gestión de Docentes</h1>
@stop

@section('content')
<div class="container">
    <!-- Título y botón agregar -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Tabla de docentes</h3>
        <a href="{{ route('docentes.create') }}" class="btn btn-primary">Agregar docente</a>

    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-3">
        <form action="{{ route('admin.docentes') }}" method="GET">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre del docente" value="{{ $buscar ?? '' }}">
        </form>
    </div>

    <!-- Tabla de docentes -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Estado</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($docentes as $docente)
            <tr>
                <td>{{ $docente->nombres }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}</td>
                <td>
                    @if ($docente->activo)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </td>
                
                <td>
                    @foreach ($docente->roles as $role)
                        <span class="badge bg-primary">{{ ucfirst($role->nombre_rol) }}</span>
                    @endforeach
                </td>

                
                <td>
                    <a href="{{ route('docentes.edit', $docente->id) }}" class="btn btn-info btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación de la tabla -->
    <div class="d-flex justify-content-center">
        <nav>
            <ul class="pagination pagination-sm m-0">
                <li class="page-item {{ $docentes->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $docentes->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
    
                @for ($i = 1; $i <= $docentes->lastPage(); $i++)
                    <li class="page-item {{ $i == $docentes->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $docentes->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
    
                <li class="page-item {{ $docentes->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $docentes->nextPageUrl() }}" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

@stop
