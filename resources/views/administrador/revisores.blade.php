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
        <input type="text" class="form-control" placeholder="Buscar por nombre del revisor">
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
            <!-- Fila 1 -->
            <tr>
                <td>Juan Pérez Gómez</td>
                <td>
                    <ul>
                        <li>Docente 1</li>
                        <li>Docente 2</li>
                        <li>Docente 3</li>
                    </ul>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm">Modificar Asignación</button>
                </td>
            </tr>
            <!-- Fila 2 -->
            <tr>
                <td>María López Fernández</td>
                <td>
                    <ul>
                        <li>Docente A</li>
                        <li>Docente B</li>
                    </ul>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm">Modificar Asignación</button>
                </td>
            </tr>
            <!-- Fila 3 -->
            <tr>
                <td>Carlos Torres Ramírez</td>
                <td>
                    <ul>
                        <li>Docente X</li>
                    </ul>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm">Modificar Asignación</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Paginación de la tabla -->
    <div class="d-flex justify-content-center">
        <nav>
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
            </ul>
        </nav>
    </div>

    <!-- Sección para el formulario de edición (oculta inicialmente) -->
    <div id="form-edicion" class="d-none">
        <h4>Editar Asignación de Revisor</h4>
        <form>
            <div class="mb-3">
                <label for="nombre_revisor" class="form-label">Nombre del Revisor</label>
                <input type="text" id="nombre_revisor" class="form-control" placeholder="Nombre del revisor" readonly>
            </div>
            <div class="mb-3">
                <label for="docentes_asignados" class="form-label">Docentes Asignados</label>
                <textarea id="docentes_asignados" class="form-control" placeholder="Escriba los nombres de los docentes asignados separados por comas"></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-secondary">Regresar</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Script para alternar entre tabla y formulario
    document.querySelectorAll('.btn-primary').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelector('table').classList.add('d-none');
            document.getElementById('form-edicion').classList.remove('d-none');
        });
    });

    // Regresar a la tabla desde el formulario
    document.querySelectorAll('.btn-secondary').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelector('table').classList.remove('d-none');
            document.getElementById('form-edicion').classList.add('d-none');
        });
    });
</script>
@stop
