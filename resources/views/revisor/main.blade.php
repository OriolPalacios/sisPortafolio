@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bienvenido {{ Auth::user()->nombres . ", " . Auth::user()->apellido_paterno. " " . Auth::user()->apellido_materno }}</h1>
@stop

@section('content')

@stop
