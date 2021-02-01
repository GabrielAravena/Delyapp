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

Auth::routes();

Route::get('/register', function(){
    return view('auth/register');
})->name('register');

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', 'InicioController@index')->name('inicio');
Route::get('/buscador', 'InicioController@buscador')->name('inicio.buscador');
Route::get('/registraLocal', 'InicioController@registrarLocal')->name('inicio.registrarLocal');
Route::post('/registraLocal', 'InicioController@enviarRegistroLocal')->name('inicio.enviarRegistroLocal');
Route::get('/contactateConNosotros', 'InicioController@contactateConNosotros')->name('inicio.contactateConNosotros');
Route::post('/contactateConNosotros', 'InicioController@enviarContacto')->name('inicio.enviarContacto');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/local/{id}', 'LocalController@index')->name('local.index');

Route::get('/root/ingresarLocal', 'RootController@ingresarLocal')->name('root.ingresarLocal');
Route::post('/root/ingresarLocal', 'RootController@guardar')->name('root.guardar');
Route::get('/root/listaLocales', 'RootController@listaLocales')->name('root.listaLocales');
Route::get('/root/buscadorLocales', 'RootController@buscador')->name('root.buscador');
Route::get('/root/modificar/{local}', 'RootController@modificar')->name('root.modificar');
Route::post('/root/modificar/{local}', 'RootController@guardarModificacion')->name('root.guardarModificacion');
Route::get('/root/activar/{local}', 'RootController@activarLocal')->name('root.activarLocal');


Route::get('/carrito', 'CarritoController@index')->name('carrito.index');
Route::post('/carrito/{producto}', 'CarritoController@agregar')->name('carrito.agregar');
Route::get('/carrito/delete/{id}', 'CarritoController@delete')->name('carrito.delete');
Route::get('/producto/{producto}', 'CarritoController@producto')->name('carrito.producto');
Route::post('/carritoLogin', 'CarritoController@login')->name('carrito.login');
Route::post('/carritoPagar', 'CarritoController@pagar')->name('carrito.pagar');
Route::post('/carritoReturn', 'CarritoController@return')->name('carrito.return');
Route::post('/carritoFinal', 'CarritoController@final')->name('carrito.final');
Route::get('/carrito/agregarDelivery', 'CarritoController@agregarDelivery')->name('carrito.agregarDelivery');
Route::get('/carrito/quitarDelivery', 'CarritoController@quitarDelivery')->name('carrito.quitarDelivery');

Route::get('/inicioAdmin', 'InicioAdminController@index')->name('inicioAdmin.index');
Route::get('/inicioAdmin/activar/{local}', 'InicioAdminController@activar')->name('inicioAdmin.activar');

Route::get('/pedidos', 'PedidosController@index')->name('pedidos.index');
Route::get('/pedidos/confirmar/{producto}', 'PedidosController@confirmar')->name('pedidos.confirmar');

Route::get('/inventario', 'InventarioController@index')->name('inventario.index');
Route::get('/inventario/nuevoIngrediente/{local_id}', 'InventarioController@create')->name('inventario.create');
Route::post('/inventario/nuevoIngrediente', 'InventarioController@store')->name('inventario.store');
Route::get('/inventario/compraIngrediente/{inventario}', 'InventarioController@comprar')->name('inventario.comprar');
Route::get('/inventario/borrarIngrediente/{inventario}', 'InventarioController@delete')->name('inventario.delete');
Route::post('/inventario/compraIngrediente/{inventario}', 'InventarioController@compra')->name('inventario.compra');
Route::get('/inventario/realizarInventario', 'InventarioController@realizarInventario')->name('inventario.realizarInventario');
Route::post('/inventario/ingresarInventario', 'InventarioController@ingresarInventario')->name('inventario.ingresarInventario');
Route::get('/inventario/perdidas', 'InventarioController@perdidas')->name('inventario.perdidas');
Route::get('/inventario/perdidas/detallePerdida/{perdida}', 'InventarioController@detallePerdida')->name('inventario.detallePerdida');
Route::get('/inventario/perdidas/detallePerdida/descargar/{perdida}', 'InventarioController@descargarDetallePerdida')->name('inventario.descargarDetallePerdida');
Route::get('/inventario/comprasIngredientes', 'InventarioController@comprasIngredientes')->name('inventario.comprasIngredientes');
Route::post('/inventario/comprasIngredientes/{local}', 'InventarioController@buscarComprasIngredientes')->name('inventario.buscarComprasIngredientes');
Route::get('/inventario/comprasIngredientes/descargar/{desde}/{hasta}', 'InventarioController@descargarComprasIngredientes')->name('inventario.descargarComprasIngredientes');

Route::get('/gastosFijos', 'GastosFijosController@index')->name('gastosFijos.index');
Route::get('/gastosFijos/nuevoGasto', 'GastosFijosController@create')->name('gastosFijos.create');
Route::post('/gastosFijos/nuevoGasto', 'GastosFijosController@store')->name('gastosFijos.store');
Route::get('/gastosFijos/modificar/{gasto}', 'GastosFijosController@modificar')->name('gastosFijos.modificar');
Route::post('/gastosFijos/modificar', 'GastosFijosController@ingresarModificacion')->name('gastosFijos.ingresarModificacion');
Route::get('/gastosFijos/borrar/{gasto}', 'GastosFijosController@borrar')->name('gastosFijos.borrar');

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

Route::get('/configuracion', 'ConfiguracionController@index')->name('configuracion.index');
Route::post('/configuracion/guardar', 'ConfiguracionController@guardar')->name('configuracion.guardar');
Route::get('/configuracionAdmin', 'ConfiguracionController@indexAdmin')->name('configuracion.indexAdmin');
Route::post('/configuracion/guardarAdmin', 'ConfiguracionController@guardarAdmin')->name('configuracion.guardarAdmin');

Route::get('/inicio/configuracion', 'InicioController@configuracion')->name('inicio.configuracion');
Route::post('/inicio/configuracion', 'InicioController@guardarConfiguracion')->name('inicio.guardarConfiguracion');
