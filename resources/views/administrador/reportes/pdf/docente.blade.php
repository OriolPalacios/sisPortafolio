<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Desempeño Docente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 3cm 2cm 2cm 2cm;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h2 {
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section-title {
            background-color: #e9ecef;
            padding: 10px;
            margin: 20px 0;
            font-size: 14px;
            font-weight: bold;
        }
        .fecha-generacion {
            font-size: 10px;
            color: #666;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('vendor/adminlte/dist/img/o4e_hzo3-small.png') }}" class="logo">
        <h1>Reporte de Desempeño Docente</h1>
    </div>

    <div class="info-section">
        <h2>Información del Docente</h2>
        <table>
            <tr>
                <th>Nombre Completo</th>
                <td>{{ $docente->nombres }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}</td>
                <th>Correo</th>
                <td>{{ $docente->correo }}</td>
            </tr>
            <tr>
                <th>Especialidad</th>
                <td>{{ $docente->especialidad }}</td>
                <th>Estado</th>
                <td>{{ $docente->activo ? 'Activo' : 'Inactivo' }}</td>
            </tr>
        </table>
    </div>

    <div class="section-title">Desempeño como Revisor por Semestre</div>
    <table>
        <thead>
            <tr>
                <th>Semestre</th>
                <th>Período</th>
                <th>Docentes Asignados</th>
                <th>Portafolios Revisados</th>
                <th>Portafolios Pendientes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datosRevisor as $semestre => $datos)
            <tr>
                <td>{{ $semestre }}</td>
                <td>{{ \Carbon\Carbon::parse($datos['fecha_inicio'])->format('d/m/Y') }} - 
                    {{ \Carbon\Carbon::parse($datos['fecha_fin'])->format('d/m/Y') }}</td>
                <td>{{ $datos['docentes_asignados'] }}</td>
                <td>{{ $datos['portafolios_revisados'] }}</td>
                <td>{{ $datos['portafolios_pendientes'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Desempeño como Docente por Semestre</div>
    <table>
        <thead>
            <tr>
                <th>Semestre</th>
                <th>Período</th>
                <th>Cursos Asignados</th>
                <th>Portafolios Observados</th>
                <th>Portafolios Completados</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datosDocente as $semestre => $datos)
            <tr>
                <td>{{ $semestre }}</td>
                <td>{{ \Carbon\Carbon::parse($datos['fecha_inicio'])->format('d/m/Y') }} - 
                    {{ \Carbon\Carbon::parse($datos['fecha_fin'])->format('d/m/Y') }}</td>
                <td>{{ $datos['cursos_asignados'] }}</td>
                <td>{{ $datos['observaciones'] }}</td>
                <td>{{ $datos['completados'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="fecha-generacion">
        Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>
