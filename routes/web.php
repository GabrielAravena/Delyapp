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
    return view('inicio');
})->name('inicio');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/local/{id}', 'LocalController@index')->name('local.index');

Route::get('/carrito', 'CarritoController@index')->name('carrito.index');
Route::post('/carrito/{producto}', 'CarritoController@agregar')->name('carrito.agregar');
Route::get('/carrito/delete/{id}', 'CarritoController@delete')->name('carrito.delete');
Route::get('/producto/{producto}', 'CarritoController@producto')->name('carrito.producto');

Route::get('/inicioAdmin', 'InicioAdminController@index')->name('inicioAdmin.index');
Route::post('/inicioAdmin', 'InicioAdminController@datosGrafico')->name('inicioAdmin.datos_grafico');

Route::get('/inventario', 'inventarioController@index')->name('inventario.index');
Route::get('/inventario/nuevoIngrediente', 'inventarioController@create')->name('inventario.create');
Route::post('/inventario/nuevoIngrediente', 'InventarioController@store')->name('inventario.store');
Route::get('/inventario/compraIngrediente/{inventario}', 'inventarioController@comprar')->name('inventario.comprar');
Route::get('/inventario/borrarIngrediente/{inventario}', 'inventarioController@delete')->name('inventario.delete');
Route::post('/inventario/compraIngrediente/{inventario}', 'InventarioController@compra')->name('inventario.compra');

Route::get('/menu', 'MenuController@index')->name('menu.index');
Route::get('/menu/nuevoProducto', 'MenuController@create')->name('menu.create');
Route::post('/menu/nuevoProducto', 'MenuController@store')->name('menu.store');
Route::post('/menu/nuevoProducto2', 'MenuController@store2')->name('menu.store2');
Route::get('/menu/activar/{producto}', 'MenuController@activar')->name('menu.activar');
Route::get('/menu/desactivar/{producto}', 'MenuController@desactivar')->name('menu.desactivar');
Route::get('/menu/borrarProducto/{producto}', 'MenuController@delete')->name('menu.delete');

Route::get('/vender', 'VenderController@index')->name('vender.index');
Route::post('/vender/store', 'VenderController@store')->name('vender.store');
Route::post('/vender/store2/{venta}', 'VenderController@store2')->name('vender.store2');