<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Ventas;
use App\Productos_user;
use Illuminate\Http\Request;

class VenderController extends Controller
{
    protected function index(){

        $productos = Productos::where('estado', 'activado')->get();
        return view('vender', compact('productos'));
    }

    protected function store(Request $request){

        $venta = Ventas::create([
            'estado' => 'iniciado',
        ]);
        
        $productos = [];
        $precioTotal = 0;
        foreach ($request as $elemento) {
            foreach($elemento as $key => $val){
                for ($i = 1; $i < count($elemento); $i++) {
                    if ($key == 'producto'.$i) {
    
                        $productos_user = Productos_user::create([
                            'productos_id' => $val,
                            'cantidad' => request('cantidad'.$i),
                            'users_id' => '3',
                            'ventas_id' => $venta->id,
                        ]);

                        $producto = Productos::find($val); 
                        $precioTotal += ($producto->precio * $productos_user->cantidad);    
                        $productos[] = ['productos_user'=>$productos_user, 'producto'=>$producto];
                    }
                }
            }
        }
        return view('vender2', compact('venta', 'productos', 'precioTotal'));
    }

    protected function store2(Request $request){

        $venta = Ventas::find($request->venta_id);
        
        $venta-> tipo = $request->tipo_venta;
        $venta-> precio = $request->precio_total;
        $venta-> estado = 'finalizado';
        $venta->save();

        return redirect()->route('vender.index');
    }
}
