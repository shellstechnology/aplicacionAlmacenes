<?php
namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productosController;
use App\Http\Controllers\paquetesController;
use App\Http\Controllers\lotesController;
use App\Http\Controllers\lotesCamionController;
use App\Http\Controllers\parqueteContieneLoteController;

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

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'iniciarSesion'])->name('login');

Route::get('/', function () {
    return view('productos');
})->name('producto');

Route::get('/productos', function () {
    return view('productos');
})->name('productos');

Route::get('/paquetes', function () {
    return view('paquetes');
})->name('paquetes');

Route::get('/paquetesEnLote', function () {
    return view('paquetesEnLote');
})->name('paquetesEnLote');

Route::get('/lotes', function () {
    return view('lotes');
})->name('lotes');

Route::get('/lotesCamion', function () {
    return view('lotesCamion');
})->name('lotesCamion');


Route::middleware(Autenticacion::class)->group(function () {
Route::get('/Productos', [productosController::class, 'obtenerDatos'])->name('productos.cargarDatos')->middleware(Autenticacion::class);
Route::post('/redireccionproductos', [productosController::class, 'redireccion'])->name('redireccion.producto')->middleware(Autenticacion::class);

Route::get('/Paquetes', [paquetesController::class, 'obtenerDatos'])->name('paquete.cargarDatos');
Route::post('/redireccionpaquetes', [paquetesController::class, 'redireccion'])->name('redireccion.paquete');

Route::get('/Lotes', [lotesController::class, 'obtenerDatos'])->name('lote.cargarDatos');
Route::post('/redireccionlotes', [lotesController::class, 'redireccion'])->name('redireccion.lote');

Route::get('/LotesCamion', [lotesCamionController::class, 'obtenerDatos'])->name('loteCamion.cargarDatos')->middleware(Autenticacion::class);
Route::post('/redireccionlotescamion', [lotesCamionController::class, 'redireccion'])->name('redireccion.loteCamion')->middleware(Autenticacion::class);



Route::get('/PaquetesEnLote', [parqueteContieneLoteController::class, 'obtenerDatos'])->name('paqueteLote.cargarDatos');
Route::post('/paquetesEnLote', [parqueteContieneLoteController::class, 'redireccion'])->name('redireccion.paqueteLote');
});