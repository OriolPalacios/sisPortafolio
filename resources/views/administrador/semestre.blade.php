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
                <h4 class="text-muted">Sin semestre activo</h4>
                <p>No hay un semestre activo actualmente</p>
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
                <th>Semestre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semestres as $semestre)
            <tr>
                <td>{{ $semestre->nombre_semestre }}</td>
                <td>{{ $semestre->inicio->format('d/m/Y') }}</td>
                <td>{{ $semestre->fin->format('d/m/Y') }}</td>
                <td>
                    <div class="form-check form-switch d-flex justify-content-center">
                        <input 
                            class="form-check-input toggle-estado" 
                            type="checkbox" 
                            data-id="{{ $semestre->id }}" 
                            {{ $semestre->activo ? 'checked' : '' }}
                        >
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Botón Actualizar -->
    <div class="d-flex justify-content-end mt-3">
        <button id="btn-actualizar" class="btn btn-primary">Actualizar</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.toggle-estado');
            const btnActualizar = document.getElementById('btn-actualizar');
    
            // Objeto para guardar los estados actualizados
            const estadosActualizados = {};
    
            // Capturar cambios en los toggles
            toggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const semestreId = this.getAttribute('data-id');
                    estadosActualizados[semestreId] = this.checked;
                });
            });
    
            // Botón Actualizar
            btnActualizar.addEventListener('click', function() {
                // Validar si hay más de un semestre activo
                const activos = Object.values(estadosActualizados).filter(estado => estado).length;
                if (activos > 1) {
                    alert('No puede haber más de un semestre activo a la vez.');
                    return;
                }
    
                // Enviar los datos al servidor con fetch
                fetch('{{ route("admin.semestre.actualizarEstados") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ estados: estadosActualizados })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Estados actualizados correctamente.');
                        location.reload(); // Recargar la página para reflejar cambios
                    } else {
                        alert('Error al actualizar los estados.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
    
</div>

@stop
