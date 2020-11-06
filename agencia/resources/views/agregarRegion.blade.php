@extends('layouts.plantilla')

    @section('contenido')

        <h1>Alta de una nueva región</h1>

        <div class="alert bg-light shadow-sm col-8 mx-auto p-4">
            <form action="/agregarRegion" method="post">
                @csrf
                <label for="regNombre">Nombre de la región</label>
                <input type="text"
                       name="regNombre" id="regNombre"
                       class="form-control"> <br>
                <button class="btn btn-dark">
                    Agregar región
                </button>
                <a href="/adminRegiones" class="btn btn-outline-secondary ml-3">
                    volver a panel
                </a>
            </form>
        </div>

    @endsection
