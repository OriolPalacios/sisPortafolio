@extends('adminlte::page')

@section('title', 'Editar Semestre')

@section('content_header')
    <h1>Editar Semestre</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.semestre.update', $semestre->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre del semestre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $semestre->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ $semestre->fecha_inicio }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha de fin</label>
                <input type="date" name="fecha_fin" class="form-control" value="{{ $semestre->fecha_fin }}" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="estado" name="estado" value="Activo" 
                           {{ $semestre->estado == 'Activo' ? 'checked' : '' }}>
                    <label class="form-check-label" for="estado">Activo/Inactivo</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('admin.semestre.formulario') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
</div>
@stop
