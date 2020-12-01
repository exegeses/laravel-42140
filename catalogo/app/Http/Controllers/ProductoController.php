<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos lista de productos
        $productos = Producto::with('relMarca', 'relCategoria')
                                ->simplePaginate(8);

        //retornamos vista pasandole los datos
        return view('adminProductos', ['productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtenemos listado de marcas y categorias
        $marcas = Marca::all();
        $categorias = Categoria::all();

        //retornamos vista pasando datos
        return  view('/agregarProducto',
                    [
                        'marcas'=>$marcas,
                        'categorias'=>$categorias
                    ]
                );
    }

    private function validar(Request $request)
    {
        $request->validate(
            [
                'prdNombre'=>'required|min:3|max:70',
                'prdPrecio'=>'required|numeric|min:0',
                'prdPresentacion'=>'required|min:3|max:150',
                'prdStock'=>'required|integer|min:1',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required'=>'Complete el campo Nombre',
                'prdNombre.min'=>'Complete el campo Nombre con al menos 3 caractéres',
                'prdNombre.max'=>'Complete el campo Nombre con 70 caractéres como máxino',
                'prdPrecio.required'=>'Complete el campo Precio',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número',
                'prdPrecio.min'=>'Complete el campo Precio con un número positivo',
                'prdPresentacion.required'=>'Complete el campo Presentación',
                'prdPresentacion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                'prdPresentacion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino',
                'prdStock.required'=>'Complete el campo Stock',
                'prdStock.integer'=>'Complete el campo Stock con un número entero',
                'prdStock.min'=>'Complete el campo Stock con un número positivo',
                'prdImagen.mimes'=>'Debe ser una imagen',
                'prdImagen.max'=>'Debe ser una imagen de 2MB como máximo'
            ]
        );
    }

    private function subirImagen(Request $request)
    {
        //si no enviaron imagen en agregar
        $prdImagen = 'noDisponible.jpg';

        //si no enviaron imagen en modificar
            // método has() : si un dato existe y no es nulo
        if( $request->has('prdImagenOriginal') ){
            $prdImagen = $request->prdImagenOriginal;
        }

        //subir imagen si fue enviada
            //si enviaron archivo
        if( $request->file('prdImagen') ){
            //renombrar time() + extension
            $prdImagen = time().'.'.$request->file('prdImagen')->clientExtension();
            //subir
            $request->file('prdImagen')->move( public_path('productos/'), $prdImagen);
        }

        return $prdImagen;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validación
        $this->validar($request);
        //subir imagen
        $prdImagen = $this->subirImagen($request);
        //instanciar, asignar y guardar
        $Producto = new Producto;
            //asignames
        $Producto->prdNombre = $request->prdNombre;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        $Producto->prdImagen = $prdImagen;
            //guardar
        $Producto->save();
        //return
        return redirect('/adminProductos')
                    ->with('mensaje', 'Producto: '.$request->prdNombre.' agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($idProducto)
    {
        //obtener datos de un producto con relaciones
        $Producto = Producto::with('relMarca', 'relCategoria')
                                    ->find($idProducto);

        //obtenemos listados de marcas y categorías
        $marcas = Marca::all();
        $categorias = Categoria::all();
        //retornar vista pasando datos
        return view('modificarProducto',
                        [
                            'producto'=>$Producto,
                            'marcas'=>$marcas,
                            'categorias'=>$categorias
                        ]
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validar
        $this->validar($request);
        //subir imagen *
        $prdImagen = $this->subirImagen($request);
        //obtener datos de producto
        $Producto = Producto::find( $request->idProducto );
         //asignar atributos
        $Producto->prdNombre = $request->prdNombre;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        $Producto->prdImagen = $prdImagen;
            //guardar
        $Producto->save();
        //redirección con mensaje
        return redirect('/adminProductos')
            ->with('mensaje', 'Producto: '.$request->prdNombre.' modificado correctamente.');
    }

    public function confirmar($idProducto)
    {
        $Producto = Producto::with('relMarca', 'relCategoria')
                        ->find($idProducto);
        return view('eliminarProducto', [ 'producto'=>$Producto ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $prdNombre = $request->prdNombre;
        $idProducto = $request->idProducto;
        //borramos
        Producto::destroy($idProducto);
        //redirección con mensaje
        return redirect('/adminProductos')
            ->with('mensaje', 'Producto: '.$prdNombre.' eliminado correctamente.');

    }
}
