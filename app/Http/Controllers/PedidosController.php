<?php

namespace App\Http\Controllers;

use App\Invitado;
use App\Productos_user;
use App\Registro_ventas;
use App\User;
use App\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoListo;

class PedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        
        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $inventario = Inventario::where('local_id', $local_id)->first();
        
        if(!$inventario){
            return redirect()->route('inventario.index')->with('primeraVez', 'Aún no has agregado ingredientes. El primer paso para utilizar la aplicación, es agregar los ingredientes que tienes en bodega, luego debes ingresar los gastos fijos de tu local y finalmente, puedes crear productos y comenzar a vender.');
        }

        $local_id = $request->user()->local_id;

        $productos = Productos_user::where('registro_ventas.local_id', $local_id)
            ->join('registro_ventas', 'productos_users.ventas_id', 'registro_ventas.venta_id')
            ->join('productos', 'productos_users.producto_id', 'productos.id')
            ->leftJoin('users', 'productos_users.users_id', 'users.id')
            ->leftJoin('invitados', 'productos_users.invitado', 'invitados.id')
            ->where('entregado', false)
            ->select('users.id as user_id', 'users.name as user_nombre', 'users.email as user_email', 'users.direccion as user_direccion', 
                    'users.telefono as user_telefono', 'invitados.id as invitado_id', 'invitados.nombre as invitado_nombre', 'invitados.email as invitado_email', 
                    'invitados.telefono as invitado_telefono', 'invitados.direccion as invitado_direccion', 'registro_ventas.delivery', 'registro_ventas.valor', 
                    'productos_users.ventas_id', 'productos_users.cantidad', 'productos.nombre as producto_nombre')

            ->orderByDesc('ventas_id')
            ->get()
            ->groupBy('ventas_id');
      
        return view('pedidos', compact('productos'));

    }

    protected function confirmar(Request $request, $venta){

        $local_id = $request->user()->local_id;

        $registro_venta = Registro_ventas::where('local_id', $local_id)
            ->where('venta_id', $venta)
            ->get()
            ->first();
        
        $registro_venta->entregado = true;
        $registro_venta->save();

        if($registro_venta->users_id == null){
            $invitado = Invitado::find($registro_venta->invitado);
            Mail::to($invitado->email)->send(new PedidoListo($registro_venta));
        }else{
            $user = User::find($registro_venta->users_id);
            Mail::to($user->email)->send(new PedidoListo($registro_venta));
        }

        return redirect()->route('pedidos.index');
    }
}
