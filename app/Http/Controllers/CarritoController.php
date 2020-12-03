<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Productos_user;
use App\Ventas;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    protected function index(Request $request)
    {
        $user_id = null;
        
        if($request->user() == null){

            $user_id = $request->session()->get('user_id');

            if(!$user_id){

                $id = hexdec(uniqid());
                $request->session()->put(['user_id' => $id]);
                $user_id = $request->session()->get('user_id');
                
            }
            
        }else{
            $user_id = $request->user()->id;
        }
        

        $productos = Productos_user::where('users_id', $user_id)
            ->join('ventas', 'productos_users.ventas_id', 'ventas.id')
            ->join('productos', 'productos_users.producto_id', 'productos.id')
            ->select('productos_users.*', 'ventas.estado', 'productos.nombre', 'productos.precio', 'productos.imagen', 'productos.local_id', 'ventas.precio as total')
            ->where('ventas.estado', 'carrito')
            ->orderBy('id')
            ->get()
            ->groupBy('ventas_id')
            ->last();

        return view('carrito', compact('productos'));
    }

    protected function agregar(Productos $producto, Request $request)
    {
        $user_id = null;
        
        if($request->user() == null){
            $user_id = $request->session()->get('user_id');
            if(!$user_id){
                $id = hexdec(uniqid());
                $request->session()->put(['user_id' => $id]);
                $user_id = $request->session()->get('user_id');
            }
        }else{
            $user_id = $request->user()->id;
        }

        $productos_user = Productos_user::where('users_id', $user_id)
            ->join('ventas', 'productos_users.ventas_id', 'ventas.id')
            ->join('productos', 'productos_users.producto_id', 'productos.id')
            ->select('productos_users.*', 'productos.local_id', 'ventas.estado', 'ventas.precio as total')
            ->where('ventas.estado', 'carrito')
            ->orderBy('id')
            ->get()
            ->last();

        if ($productos_user) {

            Productos_user::create([
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'users_id' => $user_id,
                'ventas_id' => $productos_user->ventas_id,
            ]);

            $venta = Ventas::find($productos_user->ventas_id);
            $venta->precio += $producto->precio * $request->cantidad;
            $venta->save();
        } else {

            $venta = Ventas::create([
                'estado' => 'carrito',
                'tipo' => 'online',
                'precio' => 0,
            ]);

            Productos_user::create([
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'users_id' => $user_id,
                'ventas_id' => $venta->id,
            ]);

            $venta->precio += $producto->precio * $request->cantidad;
            $venta->save();
        }

        return redirect()->route('carrito.index');
    }

    protected function delete($id)
    {

        $productos_user = Productos_user::where('productos_users.id', $id)
            ->join('productos', 'productos_users.producto_id', 'productos.id')
            ->select('productos_users.*', 'productos.precio')
            ->get()
            ->last();

        $venta = Ventas::find($productos_user->ventas_id);
        $venta->precio -= $productos_user->precio * $productos_user->cantidad;
        $venta->save();

        $productos_user->delete();

        return redirect()->route('carrito.index');
    }

    protected function producto(Productos $producto)
    {
        return view('producto', compact('producto'));
    }
}
