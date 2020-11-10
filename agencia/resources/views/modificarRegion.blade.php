@extends('layouts.plantilla')

    @section('contenido')

        <h1>Modificación de una región</h1>

        <div class="alert bg-light border shadow-sm rounded p-4">

            <form action="/modificarRegion" method="post">
                @csrf
                Región: <br>
                <input type="text" name="regNombre"
                       value="{{ $region->regNombre }}"
                       class="form-control">
                <br>
                <input type="hidden" name="regID"
                       value="{{ $region->regID }}">
                <button class="btn btn-dark">Modificar</button>
                <a href="/adminRegiones" class="btn btn-outline-secondary ml-3">
                    Volver a panel
                </a>
            </form>

        </div>

    @endsection
