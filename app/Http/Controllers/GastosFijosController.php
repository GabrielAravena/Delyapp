<?php

namespace App\Http\Controllers;

use App\Gastos_fijos;
use App\Local;
use App\Ingredientes;
use App\Productos;
use Illuminate\Support\Facades\Mail;
use App\Mail\CambioEnPrecioSugerido;
use Illuminate\Http\Request;

class GastosFijosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(Request $request){

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $gastosFijos = Gastos_fijos::where('local_id', $local_id)->get();

        return view('gastosFijos', compact('gastosFijos'));
    }

    protected function create(Request $request){

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        return view('nuevoGasto', compact('local_id'));
    }

    protected function store(Request $request){
       
        Gastos_fijos::create([
            'nombre' => $request->nombre,
            'monto' => $request->monto,
            'local_id' => $request->local_id,
        ]);

        $this->recalcularPreciosSugeridos($request, $request->user()->local_id);

        return redirect()->route('gastosFijos.index')->with('mensaje', ' Gasto fijo creado correctamente.');
    }

    protected function modificar($gasto_id, Request $request){

        $request->user()->authorizeRoles(['admin']);

        $gasto = Gastos_fijos::where('id', $gasto_id)->where('local_id', $request->user()->local_id)->get()->first();

        if ($gasto) {

            return view('modificarGasto', compact('gasto'));
        } 

        return redirect()->route('gastosFijos.index');
    }

    protected function ingresarModificacion(Request $request){

        $gastoFijo = Gastos_fijos::find($request->gasto_id); 

        $gastoFijo->monto = $request->monto;
        $gastoFijo->save();

        $this->recalcularPreciosSugeridos($request, $request->user()->local_id);

        return redirect()->route('gastosFijos.index')->with('mensaje', ' Gasto fijo modificado correctamente.');
    }

    protected function borrar($gasto_id, Request $request){

        $request->user()->authorizeRoles(['admin']);

        Gastos_fijos::where('id', $gasto_id)->where('local_id', $request->user()->local_id)->get()->first()->delete();

        $this->recalcularPreciosSugeridos($request, $request->user()->local_id);

        return redirect()->route('gastosFijos.index')->with('mensaje', ' Gasto fijo eliminado correctamente.');

    }

    protected function recalcularPreciosSugeridos($request, $local_id){

        $local = Local::find($local_id);

        $productos = Productos::where('local_id', $local_id)->get();

        $productosCambioPrecio = [];
        foreach($productos as $producto){

            $ingredientesProducto = Ingredientes::where('producto_id', $producto->id)->get();

            $sumaPreciosIngredientes = 0;
            foreach ($ingredientesProducto as $ingredienteProducto) {
                $sumaPreciosIngredientes += $ingredienteProducto->valor * (100 / (100 - $ingredienteProducto->merma));
            }

            $gastosFijos = Gastos_fijos::where('local_id', $local_id)->sum('monto');

            $porcentajeGasto = ($gastosFijos / $local->ingreso_mensual);

            $precioSugerido = round((($sumaPreciosIngredientes / (1 - ($local->ganancia / 100))) * (1 + $porcentajeGasto)) * 1.19, -2);

            $producto->precio_sugerido = $precioSugerido;
            $producto->save();

            $diferencia = $precioSugerido - $producto->precio;

            if ($diferencia > $producto->precio * 0.2 || $diferencia < -1 * ($producto->precio * 0.2)) {
                $productosCambioPrecio[] = $producto;
            }

            if (count($productosCambioPrecio) > 0) {

                Mail::to($request->user()->email)->send(new CambioEnPrecioSugerido($productosCambioPrecio));
            }
        }
    }
}
