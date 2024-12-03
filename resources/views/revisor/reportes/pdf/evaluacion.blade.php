<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Evaluación</title>
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
        <h1>Reporte de Evaluación</h1>
    </div>

    @foreach ($reportes as $reporte)
        <div class="section-title">{{ $reporte['docente'] }}</div>
        <table>
            <thead>
                <tr>
                    <th>Número de formatos cumplidos</th>
                    <th>Número de formatos observados</th>
                    <th>Número de formatos pendientes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $reporte['completados'] }}</td>
                    <td>{{ $reporte['observados'] }}</td>
                    <td>{{ $reporte['pendientes'] }}</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">Observaciones hechas al docente</div>
        <table>
            <tbody>
                @if (count($reporte['observaciones']) == 0)
                    <tr>
                        <td>No hay observaciones</td>
                    </tr>
                @else
                    @foreach ($reporte['observaciones'] as $observacion)
                        <tr>
                            <td>{{ $observacion }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    @endforeach

    <div class="fecha-generacion">
        Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>