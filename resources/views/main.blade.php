@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="p-6 text-gray-900 dark:text-gray-100">
    Hola!
    <p>{{ __('Nombre: ') . Auth::user()->nombres . " " . Auth::user()->apellido_paterno . " " . Auth::user()->apellido_materno }}</p>
    <p>{{ __('Correo: ') . Auth::user()->correo }}</p>
    <p>{{ __('Rol: ') . Auth::user()->role }}</p>
</div>
@stop
