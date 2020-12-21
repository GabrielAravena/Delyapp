<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\Productos;
use App\Ventas;
use App\Productos_user;
use App\Ingredientes;
use App\Registro_ventas;
use Illuminate\Http\Request;

class VenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(Request $request){

        $request->user()->authorizeRoles(['admin']);

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
                $inventario->cantidad -= ($ingrediente->cantidad * $producto->cantidad);
                $inventario->save();

                $local_id = $inventario->local_id;

            }
        }

        Registro_ventas::create([
            'local_id' => $local_id,
            'users_id' => null,
            'invitado' => null,
            'venta_id' => $venta->id,
            'tipo' => request('tipo_venta'),
            'valor' => request('precio_total'),
        ]);

        $venta->tipo = request('tipo_venta');
        $venta->precio = request('precio_total');
        $venta->estado = 'finalizado';
        $venta->save();

        return redirect()->route('inicioAdmin.index');
    }
}
