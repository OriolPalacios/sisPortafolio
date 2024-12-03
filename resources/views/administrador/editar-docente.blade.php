@extends('adminlte::page')

@section('title', 'Editar Docente')

@section('content_header')
    <h1>Editar Docente</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('docentes.update', $docente->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" id="nombres" name="nombres" class="form-control" value="{{ $docente->nombres }}" required>
        </div>
        <div class="mb-3">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" value="{{ $docente->apellido_paterno }}" required>
        </div>
        <div class="mb-3">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="{{ $docente->apellido_materno }}">
        </div>
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="{{ $docente->fecha_nacimiento ? $docente->fecha_nacimiento->format('Y-m-d') : '' }}">
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" id="correo" name="correo" class="form-control" value="{{ $docente->correo }}" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" value="{{ $docente->telefono }}">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-control">
                <option value="1" {{ $docente->activo ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$docente->activo ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select id="rol" name="rol[]" class="form-control" multiple>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $docente->roles->contains($rol->id) ? 'selected' : '' }}>
                        {{ ucfirst($rol->nombre_rol) }}
                    </option>
                @endforeach
            </select>
        </div>
        
        
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('admin.docentes') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>
@stop
