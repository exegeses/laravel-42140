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
Route::get('/proceso', function () {
    //capturamos dato desde el form
    $frase = $_GET['frase'];
    //pasamos datos a la vista
    // como array asociativo
    return view('proceso', [ 'frase' => $frase ]);
});


