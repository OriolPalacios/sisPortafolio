@extends('adminlte::page')

@section('title', 'Portafolios')

@section('content_header')
    <h1>Portafolios</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="card container-all-portafolios">
                <div class="card-header">
                    <h4> Portafolios Practicos</h4>
                </div>
                <div class="card-body container-portafolio">
                    @foreach ($portafolios_practico as $portafolio_practico)
                        <x-portafolio-practico-card :portafolioPractico="$portafolio_practico"/>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card container-all-portafolios">
                <div class="card-header">
                    <h4>Portafolios Teoricos</h4>
                </div>
                <div class="card-body container-portafolio">
                    @foreach ($portafolios_teorico as $portafolio_teorico)
                        <x-portafolio-teorico-card :portafolioTeorico="$portafolio_teorico"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <style>
        .container-all-portafolios {
            width: 100%;
        }

        .container-portafolio {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            grid-gap: 1rem;
        }
    </style>
@stop
