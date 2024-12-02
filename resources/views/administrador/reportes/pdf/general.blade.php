<!DOCTYPE html>
<html>
<head>
    <title>Reporte General de Revisión</title>
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
        h1 {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
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
        <h1>Reporte General de Revisión de Portafolios</h1>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Semestre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Total</th>
                <th>Observados</th>
                <th>Completados</th>
                <th>Pendientes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semestres as $semestre)
            <tr>
                <td>{{ $semestre->nombre_semestre }}</td>
                <td>{{ \Carbon\Carbon::parse($semestre->inicio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($semestre->fin)->format('d/m/Y') }}</td>
                <td>{{ $semestre->portafolioCursos->count() }}</td>
                <td>{{ $semestre->portafolioCursos->where('estado', 'Observado')->count() }}</td>
                <td>{{ $semestre->portafolioCursos->where('estado', 'Completado')->count() }}</td>
                <td>{{ $semestre->portafolioCursos->where('estado', 'Pendiente')->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="fecha-generacion">
        Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html> 