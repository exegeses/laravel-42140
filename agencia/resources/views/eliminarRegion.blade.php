@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de una región</h1>

        <div class="alert bg-light border-danger col-6 shadow-sm p-4 mx-auto">
            <form action="/eliminarRegion" method="post">
                Región: <span class="lead">Nombre </span>

                <button class="btn btn-danger btn-block my-2">
                    Confirmar baja
                </button>
                <a href="/adminRegiones" class="btn btn-outline-secondary btn-block my-2">
                    Volver a panel
                </a>
            </form>
        </div>

    @endsection
