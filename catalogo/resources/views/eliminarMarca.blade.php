@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de una marca</h1>

        <div class="alert alert-danger col-6 mx-auto p-4">
            Se eliminará la marca:
            <span class="lead">
                {{ $marca->mkNombre }}
            </span>
            <form action="/eliminarMarca" method="post">
        @method('delete')
        @csrf
                <input type="hidden" name="idMarca"
                       value="{{ $marca->idMarca }}">
                <input type="hidden" name="mkNombre"
                       value="{{ $marca->mkNombre }}">

                <button class="btn btn-danger btn-block my-3">
                    Confirmar baja
                </button>
                <a href="/adminMarcas" class="btn btn-light btn-block">
                    Volver a panel
                </a>
            </form>

        </div>

        <script>
            Swal.fire(
                'Advertencia',
                'Si confirma baja, se eliminará la marca seleccionada',
                'warning'
            )
        </script>

    @endsection

