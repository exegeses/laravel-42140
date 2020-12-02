@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de un producto</h1>

        <div class="row alert col-8 mx-auto bg-light border-danger">
            <div class="col">
                <img src="/productos/{{$producto->prdImagen}}" class="img-thumbnail">
            </div>
            <div class="col text-danger align-self-center">
                <h2>{{$producto->prdNombre}}</h2>
                Categoria: {{ $producto->relCategoria->catNombre }} <br>
                Marca: {{ $producto->relMarca->mkNombre }} <br>
                Precio: ${{ $producto->prdPrecio }}

                <form action="/eliminarProducto" method="post">
                @csrf
                @method('delete')
                    <input type="hidden" name="prdNombre"
                           value="{{ $producto->prdNombre }}">
                    <input type="hidden" name="idProducto"
                           value="{{ $producto->idProducto }}">
                    <button class="btn btn-danger btn-block my-2">
                        Confirmar Baja
                    </button>
                    <a href="/adminProductos" class="btn btn-secondary btn-block">
                        Volver a panel
                    </a>
                </form>
            </div>
        </div>

        <script>
            Swal.fire(
                'Advertencia',
                'Si confirma baja, se eliminará el producto seleccionado',
                'warning'
            )
        </script>

    @endsection

