@extends('adminlte::page')

@section('title', 'Agregar Semestre')

@section('content_header')
    <h1>Agregar Semestre</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.semestre.guardar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre del semestre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del semestre" required>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha de fin</label>
                <input type="date" name="fecha_fin" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="estado" name="estado" value="Activo">
                    <label class="form-check-label" for="estado">Activo/Inactivo</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('admin.semestre') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
</div>
@stop

