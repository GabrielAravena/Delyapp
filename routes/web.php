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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inicio', function(){
    return view('inicio');
});

Route::get('/inventario', 'inventarioController@index')->name('inventario.index');
Route::get('/inventario/nuevoIngrediente', 'inventarioController@create')->name('inventario.create');
Route::post('/inventario/nuevoIngrediente', 'InventarioController@store')->name('inventario.store');
Route::get('/inventario/compraIngrediente/{inventario}', 'inventarioController@comprar')->name('inventario.comprar');
Route::get('/inventario/borrarIngrediente/{inventario}', 'inventarioController@delete')->name('inventario.delete');
Route::post('/inventario/compraIngrediente/{inventario}', 'InventarioController@compra')->name('inventario.compra');

Route::get('/menu', 'menuController@index')->name('menu.index');
Route::get('/menu/nuevoProducto', 'menuController@create')->name('menu.create');
Route::post('/menu/nuevoProducto', 'menuController@store')->name('menu.store');
Route::post('/menu/nuevoProducto2', 'menuController@store2')->name('menu.store2');
Route::get('/menu/activar/{producto}', 'menuController@activar')->name('menu.activar');
Route::get('/menu/desactivar/{producto}', 'menuController@desactivar')->name('menu.desactivar');
Route::get('/menu/borrarProducto/{producto}', 'menuController@delete')->name('menu.delete');
