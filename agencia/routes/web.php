<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

## Route::get('peticion', acción)
Route::get('/perilla', function () {
    return 'Pera Frutilla';
});
Route::get('/inicio', function() {
    return view('welcome');
});
Route::get('/prueba', function () {
    return view('prueba');
});

// usando un formulario
Route::get('/formulario', function () {
    return view('formulario');
});
Route::post('/proceso', function () {
    //capturamos dato desde el form
    $frase = $_POST['frase'];
    //pasamos datos a la vista
    // como array asociativo
    return view('proceso', [ 'frase' => $frase ]);
});

// implementando el motor de plantillas blade
/*
Route::get('/incio2', function(){
    return view('inicio');
});
*/
Route::view('/inicio2', 'inicio');

// trayendo datos desde BDD
Route::get('/regiones', function (){
    $regiones = DB::table('regiones')->get();
    //pasamos datos a la vista
    return view('regiones', ['regiones'=>$regiones]);
});

##################################
#### CRUD regiones
/** ## Métodos Raw SQL
 *
 *  DB::select();
 *  DB::insert();
 *  DB::update();
 *  DB::delete();
 *
 */
/** ## Métodos Fluent Query Builder
 *
 *  DB::table('nTable')->get();
 *  DB::table('nTable)->select('campo')->get();
 *  DB::table('nTable')->where(condicion)->get();
 *  DB::table('nTable)->insert( [ ... ] );
 *
 */
Route::get('/adminRegiones', function () {
    // traemos listado de regiones
    //$regiones = DB::select('SELECT regID, regNombre FROM regiones');

    $regiones = DB::table('regiones')->get();
    return view('adminRegiones', [ 'regiones'=>$regiones ]);
});

Route::get('/agregarRegion', function(){
    return view('agregarRegion');
});
Route::post('/agregarRegion', function (){
    $regNombre = $_POST['regNombre'];
    /**
     DB::insert('INSERT INTO regiones
                    VALUES ( :regNombre )
                    , [ $regNombre ]'
        );
    */
    DB::table('regiones')->insert( [ 'regNombre'=>$regNombre ] );

    return redirect( '/adminRegiones')
                ->with('mensaje', 'Region: '.$regNombre.' agregada correctamente');
});

Route::get('/modificarRegion/{regID}', function ($regID) {
    //obtener datos de la región según su ID
    /**
    $region = DB::select('SELECT regID, regNombre
                            FROM regiones
                            WHERE regID = ?
                              AND x = ?', [$regID, $x]);

    $region = DB::select('SELECT regID, regNombre
                            FROM regiones
                            WHERE regID = :regID
                            AND x = :x', [ ':regID'=>$regID, ':x'=>$x]);
    */
    $region = DB::table('regiones')
                    ->where('regID', $regID)
                    ->first(); //fetch()
    // retornmar la vista del form
    // que debe tener los datos ya cargados
    return view('modificarRegion', [ 'region'=>$region ]);
});

Route::post('/modificarRegion', function() {
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];
    /**
    DB::update('UPDATE regiones
                    SET regNombre = :regNombre
                    WHERE regID = :regID', [':regNombre'=>$regNombre, ':regID'=>$regID]);
    */
    DB::table('regiones')
            ->where('regID', $regID)
            ->update([ 'regNombre'=>$regNombre ]);
    return redirect('/adminRegiones')
                ->with('mensaje', 'Region: '.$regNombre.' modificada correctamente');
});

Route::get('/eliminarRegion/{regID}', function ($regID) {
    $region = DB::table('regiones')
                ->where('regID', $regID)
                ->first(); //fetch()
    // retornmar la vista informativa para confirmar
    // que debe tener los datos ya cargados
    return view('eliminarRegion', [ 'region'=>$region ]);
});
Route::post('/eliminarRegion', function () {
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];
    DB::table('regiones')
            ->where('regID', $regID)
            ->delete();
    return redirect('/adminRegiones')
        ->with('mensaje', 'Region: '.$regNombre.' eliminada correctamente');
});

##################################
#### CRUD destinos
Route::get('/adminDestinos', function () {
    //obtener el listado de destinos
    /**
    $destinos = DB::select('SELECT
                                    destID, destNombre, destPrecio,
                                    d.regID, r.regNombre
                                FROM  destinos d, regiones r
                                WHERE d.regID = r.regID');

    $destinos = DB::select('SELECT
                                    destID, destNombre, destPrecio,
                                    d.regID, r.regNombre
                                FROM  destinos as d
                                INNER JOIN regiones as r
                                ON d.regID = r.regID');
     */
    $destinos = DB::table('destinos as d')
                        ->join('regiones as r', 'd.regID','=', 'r.regID')
                        ->get();
    return view('adminDestinos', ['destinos'=>$destinos]);
});

Route::get('/agregarDestino',function (){
    $regiones = DB::table('regiones')->get();
    return view('agregarDestino', ['regiones'=>$regiones]);
});

Route::post('/agregarDestino', function () {
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];

    //insertar en tabla destinos
    DB::table('destinos')
            ->insert(
                [
                    'destNombre' => $destNombre,
                    'regID' => $regID,
                    'destPrecio' => $destPrecio,
                    'destAsientos' => $destAsientos,
                    'destDisponibles' => $destDisponibles
                ]
            );

    // redirección a admin con mensaje de ok
    return redirect('/adminDestinos')
                ->with('mensaje', 'Destino: '.$destNombre.' agregado correctamente');
});

Route::get('/modificarDestino/{destID}', function ($destID) {
    // obtenemos datos de un destino por su id
    $destino = DB::table('destinos as d')
                ->join('regiones as r', 'd.regID', '=', 'r.regID')
                ->where('destID', $destID)
                ->first();
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();

    //retornar vista de form pasando los datos
    return view('modificarDestino',
                    [
                        'destino'=>$destino,
                        'regiones'=>$regiones
                    ]
            );
});
