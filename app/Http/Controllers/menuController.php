<?php

namespace App\Http\Controllers;

use App\Gastos_fijos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Productos;
use App\Ingredientes;
use App\Inventario;
use App\Local;
use Illuminate\Support\Facades\Storage;

class menuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $inventario = Inventario::where('local_id', $local_id)->first();

        $gastos_fijos = Gastos_fijos::where('local_id', $local_id)->first();
        
        if(!$inventario){
            return redirect()->route('inventario.index')->with('primeraVez', 'Aún no has agregado ingredientes. El primer paso para utilizar la aplicación, es agregar los ingredientes que tienes en bodega, luego debes ingresar los gastos fijos de tu local y finalmente, puedes crear productos y comenzar a vender.');
        }

        if(!$gastos_fijos){
            return redirect()->route('inventario.index')->with('sinGastosFijos', 'Antes de crear productos, debes ingresar los gastos fijos de tu local, de esta forma podremos sugerirte un precio correcto para tus productos.');

        }

        $productos = Productos::where('local_id', $local_id)->get();

        return view('menu', compact('productos'));
    }

    protected function create(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = Local::find($request->user()->local_id)->id;

        $inventarios = Inventario::where('local_id', $local_id)->get();

        return view('nuevoProducto', compact('inventarios'));
    }

    protected function store(Request $request)
    {

        $local_id = $request->user()->local_id;

        $gastos_fijos = Gastos_fijos::where('local_id', $local_id)->get()->sum('monto');
        
        $ingresoMensual = Local::find($local_id)->ingreso_mensual;

        $porcentajeGasto = ($gastos_fijos/$ingresoMensual);

        $producto = Productos::create([
            'nombre' => request('nombre_ingrediente'),
            'estado' => 'desactivado',
            'local_id' => $local_id,
        ]);

        $ingredientes = [];
        $sumaPreciosIngredientes = 0;
        foreach ($request as $elemento) {
            foreach ($elemento as $key => $val) {
                for ($i = 1; $i < count($elemento); $i++) {
                    if ($key == 'ingrediente' . $i) {

                        $inventario = Inventario::find(request('ingrediente' . $i));

                        $ingrediente = Ingredientes::create([
                            'nombre' => $inventario->nombre,
                            'cantidad' => request('cantidad' . $i),
                            'unidad_medida' => request('unidad_medida' . $i),
                            'producto_id' => $producto->id,
                            'valor' => ($inventario->pmp * request('cantidad' . $i)),
                            'merma' => $inventario->merma,
                            'inventario_id' => request('ingrediente' . $i),
                        ]);

                        $unidadMedidaInv = $inventario->unidad_medida;
                        $unidadMedidaIng = $ingrediente->unidad_medida;

                        if ($unidadMedidaInv == $unidadMedidaIng) {
                            $ingrediente->valor = ($inventario->pmp * $ingrediente->cantidad);
                            $ingrediente->save();
                        } elseif (($unidadMedidaInv == 'Kilogramo' && $unidadMedidaIng == 'Gramo') || ($unidadMedidaInv == 'Litro' && $unidadMedidaIng == 'Ml')) {
                            $ingrediente->valor = (($inventario->pmp / 1000) * $ingrediente->cantidad);
                            $ingrediente->save();
                        } elseif (($unidadMedidaInv == 'Gramo' && $unidadMedidaIng == 'Kilogramo') || ($unidadMedidaInv == 'Ml' && $unidadMedidaIng == 'Litro')) {
                            $ingrediente->valor = (($inventario->pmp * 1000) * $ingrediente->cantidad);
                            $ingrediente->save();
                        } else {
                            $ingrediente->delete();

                            $producto->delete();

                            return redirect()->route('menu.create')->with('error', ' No es posible ingresar estos ingredientes, ya que la unidad de medida de "' . $inventario->nombre . '" en el inventario es "' . $unidadMedidaInv . '", pero en los ingredientes es "' . $unidadMedidaIng . '".');
                        }

                        $sumaPreciosIngredientes += $ingrediente->valor * (100 / (100 - $ingrediente->merma));

                        array_push($ingredientes, $ingrediente);
                    }
                }
            }
        }


        $precioSugerido = round((($sumaPreciosIngredientes / (1 - 0.3))*(1 + $porcentajeGasto)), -2) * 1.19;

        $producto->precio_sugerido = $precioSugerido;
        $producto->save();

        return view('nuevoProducto2', compact('producto', 'ingredientes', 'precioSugerido'));
    }

    protected function store2(Request $request)
    {

        $rutaImagen = $this->guardarImagen($request->file('imagen'));

        $local_id = $request->user()->local_id;

        $producto = Productos::where('local_id', $local_id)->get()->last();

        $producto->tiempo_preparacion = request('tiempo_preparacion');
        $producto->descripcion = request('descripcion');
        $producto->categoria = request('categoria');
        $producto->estado = 'activado';
        $producto->imagen = $rutaImagen;

        if ($request->radio == 'sugerido') {
            $producto->precio = $producto->precio_sugerido;
        } else {
            $producto->precio = request('precio');
        }

        $producto->save();

        return redirect()->route('menu.index')->with('mensaje', ' El producto se creó correctamente.');
    }

    protected function activar(Productos $producto, Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        if ($producto->local_id == $request->user()->local_id) {

            if ($producto->estado == 'activado') {
                $producto->estado = 'desactivado';
                $producto->save();
            } else {
                $producto->estado = 'activado';
                $producto->save();
            }
        }

        return redirect()->route('menu.index');
    }

    protected function delete(Productos $producto, Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        if ($producto->local_id == $request->user()->local_id) {
            Productos::eliminar($producto);
        }

        return redirect()->route('menu.index')->with('mensaje', ' El producto se eliminó correctamente.');
    }

    protected function guardarImagen($imagen)
    {

        if ($imagen) {
            $nombre = Str::random(20) . '.jpg';
            $img = Image::make($imagen)->encode('jpg', 75);
            $img->resize(530, 470, function ($constraint) {
                $constraint->upsize();
            });

            Storage::disk('public')->put("imagenes/productos/$nombre", $img->stream());

            return Storage::url("imagenes/productos/$nombre");
        } else {

            return null;
        }
    }

    protected function modificar(Request $request, $producto_id)
    {

        $request->user()->authorizeRoles(['admin']);

        $producto = Productos::where('id', $producto_id)->where('local_id', $request->user()->local_id)->get()->first();
        $ingredientes = Ingredientes::where('producto_id', $producto_id)->get();

        if ($producto) {
            return view('modificarProducto', compact('producto', 'ingredientes'));
        }

        return redirect()->route('menu.index');
    }

    protected function ingresarModificacion(Request $request)
    {

        $producto = Productos::find($request->producto_id);

        $producto->tiempo_preparacion = $request->tiempo_preparacion;
        $producto->descripcion = $request->descripcion;
        $producto->categoria = $request->categoria;

        if ($request->radio == 'sugerido') {
            $producto->precio = $producto->precio_sugerido;
        } else {
            $producto->precio = $request->precio;
        }

        if ($request->file('imagen')) {
            $rutaImagen = $this->guardarImagen($request->file('imagen'));
            $producto->imagen = $rutaImagen;
        }

        $producto->save();

        return redirect()->route('menu.index')->with('mensaje', ' El producto se modificó correctamente.');
    }
}
