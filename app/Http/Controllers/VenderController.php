<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\Productos;
use App\Ventas;
use App\Productos_user;
use App\Ingredientes;
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
                            'producto_id' => $val,
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

    protected function store2(Ventas $venta){

        $productos = Productos_user::where('ventas_id', $venta->id)->get();

        foreach($productos as $producto){

            $ingredientes = Ingredientes::where('producto_id', $producto->producto_id)->get();

            foreach($ingredientes as $ingrediente){
                
                $inventario = Inventario::find($ingrediente->inventario_id);
                $inventario-> cantidad -= ($ingrediente->cantidad * $producto->cantidad);
                $inventario->save();

            }
           

        }

        $venta-> tipo = request('tipo_venta');
        $venta-> precio = request('precio_total');
        $venta-> estado = 'finalizado';
        $venta->save();

        return redirect()->route('inicioAdmin.index');
    }
}
