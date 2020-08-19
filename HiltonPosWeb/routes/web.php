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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('TipoCambio', 'TipoCambioController');
Route::resource('PerfumeEspeciales', 'IndexController');
Route::resource('PerfumeCaballero', 'CaballeroController');
Route::resource('PerfumeDama', 'DamaController');
Route::resource('PerfumeLoNuevo', 'LoNuevoController');
Route::resource('PerfumeNina', 'NinaController');
Route::resource('PerfumeNino', 'NinoController');
Route::resource('PerfumeDiversos', 'DiversosController');
Route::resource('ContactoHilton', 'ContactoController');
Route::post('MembresiasSolicitud', 'MembresiaController@solicitud');
Route::resource('PedidosPerfume', 'PedidoPController');
/********** Rutas de Administracion **********/
Route::resource('AdmonAgentes', 'AgentesController');
Route::resource('AdmonArticulos', 'ArticulosController');
Route::resource('AdmonDesigners', 'DesignerController');
Route::resource('AdmonMembresias', 'MembresiaController');
Route::resource('AdmonComentarios', 'ContactoController');
Route::resource('AdmonEspeciales', 'IndexController');
Route::resource('AdmonGastos', 'GastosController');

Route::resource('AdmonCompras', 'ComprasController');
Route::resource('AdmonVentasCanceladas', 'CanceladasController');
Route::resource('AdmonVentas', 'VentasController');
Route::resource('AdmonVentasDetalle', 'VentasDetalleController');
Route::resource('AdmonInventario', 'InventarioController');