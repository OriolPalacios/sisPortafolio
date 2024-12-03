@extends('adminlte::page')

@section('title', 'Modificar Asignación')

@section('content_header')
    <h1>Modificar Asignación</h1>
@stop

@section('content')
<div class="container">
    <h3>Revisor: {{ $revisor->nombres }} {{ $revisor->apellido_paterno }} {{ $revisor->apellido_materno }}</h3>
    
    <form action="{{ route('revisores.updateAsignacion', $revisor->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="docentes" class="form-label">Docentes Disponibles</label>
            <div class="list-group">
                @foreach ($docentesDisponibles as $docente)
                    <label class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ $docente->nombres }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
                        </span>
                        <input 
                            type="checkbox" 
                            name="docentes[]" 
                            value="{{ $docente->id }}"
                            {{ $docente->asignado ? 'checked' : '' }}
                            {{ $docente->bloqueado ? 'disabled' : '' }}
                        >
                    </label>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('admin.revisores') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>
@stop
