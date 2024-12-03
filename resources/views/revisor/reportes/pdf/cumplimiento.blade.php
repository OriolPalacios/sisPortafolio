<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Cumplimiento</title>
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
        <img src="{{ asset('/image/escudoEscuela.svg') }}" class="logo">
        <h1>Reporte de Cumplimiento</h1>
    </div>

    <div class="info-section">
        <h2>Información del Revisor</h2>
        <table>
            <tr>
                <th>Revisor</th>
                <td>{{ $revisor_nombre }}</td>
                <th>Correo</th>
                <td>{{ $revisor_correo }}</td>
                <th>Nro. Docentes asignados</th>
                <td>{{ $docentes_asignados->count() }}</td>
            </tr>
        </table>
    </div>

    <div class="section-title">Estado Global de los Portafolios</div>
    <table>
        <thead>
            <tr>
                <th>Estado</th>
                <th>Cantidad total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Completo</td>
                <td>{{ $portafolios_revisados }}</td>
            </tr>
            <tr>
                <td>Observado</td>
                <td>{{ $portafolios_observados }}</td>
            </tr>
            <tr>
                <td>Pendiente</td>
                <td>{{ $portafolios_pendientes }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Estado de los Portafolios por Docente</div>
    <table>
        <thead>
            <tr>
                <th>Docente</th>
                <th>Pendiente</th>
                <th>Observado</th>
                <th>Completo</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportes as $reporte)
            <tr>
                <td>{{ $reporte['docente'] }}</td>
                <td>{{ $reporte['pendientes'] }}</td>
                <td>{{ $reporte['observados'] }}</td>
                <td>{{ $reporte['completados'] }}</td>
                <td class="table-warning">{{ $reporte['pendientes'] + $reporte['observados'] + $reporte['completados'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="fecha-generacion">
        Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>