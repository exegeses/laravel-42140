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
    /*
     DB::insert('INSERT INTO regiones
                    VALUES ( :regNombre )
                    , [ $regNombre ]'
        );
    */
    DB::table('regiones')->insert( [ 'regNombre'=>$regNombre ] );

    return redirect( '/adminRegiones')
                ->with('mensaje', 'Region: '.$regNombre.' agregada correctamente');
});
