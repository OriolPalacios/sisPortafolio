@extends('adminlte::page')

@section('title', 'Gestión de Semestre')

@section('content_header')
    <h1>Gestión de Semestre</h1>
@stop

@section('content')
<div class="container">
    <!-- Card Superior -->
    <div class="card text-center mb-4">
        <div class="card-body">
            @if ($semestreActivo)
                <h4 class="text-muted">{{ $semestreActivo->nombre_semestre }}</h4>
                <p>Semestre activo</p>
            @else
                <h4 class="text-muted"></h4>
                <p>No hay semestre activo</p>
            @endif
        </div>
    </div>

    <!-- Botón Agregar Semestre -->
    <div class="text-end mb-3">
        <a href="{{ route('admin.semestre.formulario') }}" class="btn btn-success">Agregar semestre</a>
    </div>

    <!-- Tabla -->
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semestres as $semestre)
            <tr>
                <td>{{ $semestre->id }}</td>
                <td>{{ $semestre->nombre_semestre }}</td>
                <td>{{ $semestre->inicio->format('d/m/Y') }}</td>
                <td>{{ $semestre->fin->format('d/m/Y') }}</td>
                <td>{{ $semestre->activo ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('admin.semestre.edit', $semestre->id) }}" class="btn btn-info">Editar Semestre</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
