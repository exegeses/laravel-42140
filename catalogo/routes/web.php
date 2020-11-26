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

##########################
#### CRUD de marcas
use App\Http\Controllers\MarcaController;

Route::get('/adminMarcas', [ MarcaController::class, 'index' ] );
Route::get('/agregarMarca', [ MarcaController::class, 'create' ] );
Route::post('/agregarMarca', [ MarcaController::class, 'store' ] );
Route::get('/modificarMarca/{idMarca}',[ MarcaController::class, 'edit' ] );
Route::put('/modificarMarca', [ MarcaController::class, 'update' ] );
Route::get('/eliminarMarca/{idMarca}', [ MarcaController::class, 'confirmar' ]);
Route::delete('/eliminarMarca', [ MarcaController::class, 'destroy' ]);
##########################
#### CRUD de categorías
use App\Http\Controllers\CategoriaController;

Route::get('/adminCategorias', [ CategoriaController::class, 'index' ]);

##########################
#### CRUD de productos
use App\Http\Controllers\ProductoController;

Route::get('/adminProductos', [ ProductoController::class, 'index' ] );
Route::get('/agregarProducto', [ ProductoController::class, 'create' ] );

