<?php

use App\Http\Controllers\InicioController;
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

Auth::routes();

Route::get('/register', function(){
    return view('auth/register');
})->name('register');

Route::get('/', 'InicioController@index')->name('inicio');
Route::get('/buscador', 'InicioController@buscador')->name('inicio.buscador');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/local/{id}', 'LocalController@index')->name('local.index');

Route::get('/carrito', 'CarritoController@index')->name('carrito.index');
Route::post('/carrito/{producto}', 'CarritoController@agregar')->name('carrito.agregar');
Route::get('/carrito/delete/{id}', 'CarritoController@delete')->name('carrito.delete');
Route::get('/producto/{producto}', 'CarritoController@producto')->name('carrito.producto');
Route::post('/carritoLogin', 'CarritoController@login')->name('carrito.login');
Route::post('/carritoPagar', 'CarritoController@pagar')->name('carrito.pagar');
Route::post('/carritoReturn', 'CarritoController@return')->name('carrito.return');
Route::post('/carritoFinal', 'CarritoController@final')->name('carrito.final');

Route::get('/inicioAdmin', 'InicioAdminController@index')->name('inicioAdmin.index');
Route::get('/inicioAdmin/activar/{local}', 'InicioAdminController@activar')->name('inicioAdmin.activar');

Route::get('/inventario', 'inventarioController@index')->name('inventario.index');
Route::get('/inventario/nuevoIngrediente/{local_id}', 'inventarioController@create')->name('inventario.create');
Route::post('/inventario/nuevoIngrediente', 'InventarioController@store')->name('inventario.store');
Route::get('/inventario/compraIngrediente/{inventario}', 'inventarioController@comprar')->name('inventario.comprar');
Route::get('/inventario/borrarIngrediente/{inventario}', 'inventarioController@delete')->name('inventario.delete');
Route::post('/inventario/compraIngrediente/{inventario}', 'InventarioController@compra')->name('inventario.compra');
Route::get('/inventario/realizarInventario', 'inventarioController@realizarInventario')->name('inventario.realizarInventario');
Route::post('/inventario/ingresarInventario', 'InventarioController@ingresarInventario')->name('inventario.ingresarInventario');
Route::get('/inventario/perdidas', 'inventarioController@perdidas')->name('inventario.perdidas');
Route::get('/inventario/perdidas/detallePerdida/{perdida}', 'inventarioController@detallePerdida')->name('inventario.detallePerdida');
Route::get('/inventario/perdidas/detallePerdida/descargar/{perdida}', 'inventarioController@descargarDetallePerdida')->name('inventario.descargarDetallePerdida');

Route::get('/gastosFijos', 'gastosFijosController@index')->name('gastosFijos.index');
Route::get('/gastosFijos/nuevoGasto', 'gastosFijosController@create')->name('gastosFijos.create');
Route::post('/gastosFijos/nuevoGasto', 'gastosFijosController@store')->name('gastosFijos.store');
Route::get('/gastosFijos/modificar/{gasto}', 'gastosFijosController@modificar')->name('gastosFijos.modificar');
Route::post('/gastosFijos/modificar', 'gastosFijosController@ingresarModificacion')->name('gastosFijos.ingresarModificacion');
Route::get('/gastosFijos/borrar/{gasto}', 'gastosFijosController@borrar')->name('gastosFijos.borrar');

Route::get('/menu', 'MenuController@index')->name('menu.index');
Route::get('/menu/nuevoProducto', 'MenuController@create')->name('menu.create');
Route::post('/menu/nuevoProducto', 'MenuController@store')->name('menu.store');
Route::post('/menu/nuevoProducto2', 'MenuController@store2')->name('menu.store2');
Route::get('/menu/modificarProducto/{producto}', 'MenuController@modificar')->name('menu.modificar');
Route::post('/menu/modificarProducto', 'MenuController@ingresarModificacion')->name('menu.ingresarModificacion');
Route::get('/menu/activar/{producto}', 'MenuController@activar')->name('menu.activar');
Route::get('/menu/borrarProducto/{producto}', 'MenuController@delete')->name('menu.delete');

Route::get('/vender', 'VenderController@index')->name('vender.index');
Route::post('/vender/store', 'VenderController@store')->name('vender.store');
Route::post('/vender/store2/{venta}', 'VenderController@store2')->name('vender.store2');

Route::get('/ventas', 'VentasController@index')->name('ventas.index');
Route::post('/ventas/{local}', 'VentasController@buscar')->name('ventas.buscar');
Route::get('/ventas/descargar/{desde}/{hasta}', 'VentasController@descargarDocumento')->name('ventas.descargarDocumento');