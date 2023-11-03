<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productosController;
use App\Http\Controllers\paquetesController;

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
    return view('productos');
})->name('producto');

Route::get('/productos', function () {
    return view('productos');
})->name('productos');

Route::get('/paquetes', function () {
    return view('paquetes');
})->name('paquetes');

Route::get('/Productos', [productosController::class, 'obtenerDatos'])->name('productos.cargarDatos');
Route::post('/redireccionproductos', [productosController::class, 'redireccion'])->name('redireccion.producto');

Route::get('/Paquetes', [paquetesController::class, 'obtenerDatos'])->name('paquete.cargarDatos');
Route::post('/redireccionpaquetes', [paquetesController::class, 'redireccion'])->name('redireccion.paquete');
