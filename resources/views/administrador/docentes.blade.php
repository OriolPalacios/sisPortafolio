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
        <button class="btn btn-primary">Agregar docente</button>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-3">
        <form action="{{ route('admin.docentes') }}" method="GET">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por apellido paterno" value="{{ $buscar ?? '' }}">
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
                    @if ($docente->estado == FALSE)
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

    <!-- Sección para el formulario de edición (oculta inicialmente) -->
    <div id="form-edicion" class="d-none">
        <h4>Editar docente</h4>
        <form>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" class="form-control" placeholder="Nombre del docente">
            </div>
            <div class="mb-3">
                <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                <input type="text" id="apellido_paterno" class="form-control" placeholder="Apellido paterno">
            </div>
            <div class="mb-3">
                <label for="apellido_materno" class="form-label">Apellido Materno</label>
                <input type="text" id="apellido_materno" class="form-control" placeholder="Apellido materno">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" id="correo" class="form-control" placeholder="Correo electrónico">
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-secondary">Regresar</button>
            </div>
        </form>
    </div>
</div>

@stop
