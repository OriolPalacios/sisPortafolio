@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bienvenido {{ Auth::user()->nombres . ", " . Auth::user()->apellido_paterno. " " . Auth::user()->apellido_materno }}</h1>
@stop

@section('content')
<div class="container">
    <div class="row main-revisor-cards">
        <div class="col-sm">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title">X%</h5>
                    <p class="card-text">Portafolios Revisados</p>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title">Y%</h5>
                    <p class="card-text">Subsanaciones sin revisar</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5>Docentes Asignados</h5>
            <table class="table table-bordered">
                <thead class="bg-success">
                    <tr class="text-center ">
                        <th class="align-middle">Nombre</th>
                        <th class="align-middle">Apellido Paterno</th>
                        <th class="align-middle">Apellido Materno</th>
                        <th class="align-middle">Correo</th>
                        <th class="align-middle">Número de Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $docente)
                        <tr>
                            <td>{{$docente->nombres}}</td>
                            <td>{{$docente->apellido_paterno}}</td>
                            <td>{{$docente->apellido_materno}}</td>
                            <td>{{$docente->correo}}</td>
                            <td>{{$docente->telefono}}</td>
                        </tr>
                    @endforeach                    
                </tbody>
            </table>
        </div>
</div>
@stop

@section('css')
    <style>
        .main-revisor-cards .card-title{
            font-size: 3rem;
        }
    </style>
@stop
