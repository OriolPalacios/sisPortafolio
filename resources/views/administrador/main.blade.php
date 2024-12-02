@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bienvenido {{ Auth::user()->nombres . ", " . Auth::user()->apellido_paterno. " " . Auth::user()->apellido_materno }}</h1>
@stop

@section('content')
<div class="container d-flex justify-content-center align-items-center main-revisor-cards">
    <div class="custom-card-wrapper">
        <div class="card custom-card">
            <div class="card-body d-flex flex-column align-items-center">
                <h5 class="card-title">
                    {{ $semestreActivo ? $semestreActivo->nombre_semestre : 'No hay semestre activo' }}
                </h5>
                <p class="card-text">Semestre activo</p>
            </div>
        </div>
    </div>
    <div class="custom-card-wrapper">
        <div class="card custom-card">
            <div class="card-body d-flex flex-column align-items-center">
                <h5 class="card-title">{{ $usuariosActivos }}</h5>
                <p class="card-text">Usuarios activos</p>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        /* Contenedor principal: centrado horizontal */
        .main-revisor-cards {
            display: flex;               /* Flexbox para alinear elementos */
            justify-content: center;     /* Centrar horizontalmente */
            gap: 20px;                   /* Espaciado entre las tarjetas */
            margin-top: 20px;            /* Separación superior */
        }

        /* Clase personalizada para las tarjetas */
        .custom-card {
            height: 250px;               /* Alto de las tarjetas */
            width: 300px;                /* Ancho de las tarjetas */
            background-color: #D9D9D9;   /* Color personalizado (verde claro) */
            color: black;                /* Texto en color blanco */
            border: none;                /* Eliminar bordes predeterminados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        /* Estilo del contenido dentro de las tarjetas */
        .custom-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;              
        }

        /* Clase envolvente para cada tarjeta */
        .custom-card-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Cambiar el tamaño del texto del título */
        .custom-card .card-title {
            font-size: 3rem;
        }
    </style>
@stop
