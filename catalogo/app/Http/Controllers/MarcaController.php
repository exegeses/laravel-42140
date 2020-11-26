<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtener listado de marcas
        $marcas = Marca::paginate(7);
        //pasar listado a la vista adminMarcas
        return view('adminMarcas', ['marcas'=>$marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
    }

    /**
     * @param Request $request
     */
    private function validar(Request $request): void
    {
        $request->validate(
            [
                'mkNombre' => 'required|min:2|max:50'
            ],
            [
                'mkNombre.required' => 'El campo Nombre es obligatorio.',
                'mkNombre.min' => 'El campo Nombre debe tener al menos 2 caractéres.',
                'mkNombre.max' => 'El campo Nombre debe 50 caractéres como máximo.'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //capturamos dato enviado por el form
        //$mkNombre = $_POST['mkNombre'];
        $mkNombre = $request->input('mkNombre');

        //validacion
        $this->validar($request);

        //gardar en BDD
        $Marca = new Marca;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //redirección + mensaje ok
        return redirect('/adminMarcas')
                        ->with('mensaje', 'La marca: '.$mkNombre.' se agregó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idMarca)
    {
        //obtenemos datos de la marca por su id
        $Marca = Marca::find($idMarca);
        //retornamos vista pasandole datos
        return view('modificarMarca', [ 'marca'=>$Marca ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //capturar datos enviados por el form
        $idMarca = $request->input('idMarca');
        $mkNombre = $request->input('mkNombre');
        //validacion
        $this->validar($request);
        //modificar y guardar
        $Marca = Marca::find($idMarca);
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //redirigir con mensaje ok
        return redirect('/adminMarcas')
            ->with('mensaje', 'La marca: '.$mkNombre.' se modificó correctamente');

    }

    public function confirmar($idMarca)
    {
        //obtenemos datos de marca por su id
        $Marca = Marca::find($idMarca);
        //retornamos vista para confirmar baja
        return view('eliminarMarca', [ 'marca'=>$Marca ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $idMarca = $request->idMarca;
        $mkNombre = $request->mkNombre;

        // borramos
        Marca::destroy($idMarca);

        //redirigir con mensaje ok
        return redirect('/adminMarcas')
            ->with('mensaje', 'La marca: '.$mkNombre.' se eliminó correctamente');
    }

}
