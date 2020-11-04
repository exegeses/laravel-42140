@extends('layouts.testPlantilla')

    @section('contenido')

        <h1>listado de regiones</h1>

        <ul class="list-group col-6 mx-auto">
        @foreach( $regiones as $region )
            <li class="list-group-item">{{ $region->regNombre }}</li>
        @endforeach
        </ul>

    @endsection
