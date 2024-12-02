@extends('adminlte::page')

@section('title', 'Agregar Docente')

@section('content_header')
    <h1>Agregar Docente</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('docentes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" id="nombres" name="nombres" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" id="apellido_materno" name="apellido_materno" class="form-control">
        </div>
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select id="sexo" name="sexo" class="form-control" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" id="correo" name="correo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control">
        </div>
        <div class="mb-3">
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" id="departamento" name="departamento" class="form-control">
        </div>
        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad</label>
            <input type="text" id="especialidad" name="especialidad" class="form-control">
        </div>

        <div class="form-group">
            <label for="curso">Curso Asignado</label>
            <select name="curso" id="curso" class="form-control" required>
                <option value="" disabled selected>Seleccione un curso</option>
                @foreach ($cursosDisponibles as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre_curso }} - {{ ucfirst($curso->tipo) }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Agregar</button>
            <a href="{{ route('admin.docentes') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>
@stop
