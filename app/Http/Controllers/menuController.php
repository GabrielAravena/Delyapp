<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Ingredientes;
use App\Inventario;
use App\Productos_user;

class menuController extends Controller

{   
    protected function index(){

        $productos = Productos::where('local_id', 1)->get();

        return view('menu', compact('productos'));
    }

    protected function create(){

        $inventarios = Inventario::where('local_id', 1)->get();

        return view('nuevoProducto', compact('inventarios'));
    }

    protected function store(Request $request){

        $producto = Productos::create([
                    'nombre' => request('nombre_ingrediente'),
                    'estado' => 'desactivado',
                    'local_id' => '1',
                    ]);
        
        $ingredientes = [];  
        foreach($request as $elemento){
            foreach($elemento as $key => $val ){
                for($i=1; $i < count($elemento); $i++ ){
                    if($key == 'ingrediente'.$i){

                        $inventario = Inventario::find(request('ingrediente'.$i));

                        $ingrediente = Ingredientes::create([
                                'nombre' => $inventario->nombre,
                                'cantidad' => request('cantidad'.$i),
                                'unidad_medida' => request('unidad_medida'.$i),
                                'producto_id' => $producto->id,
                                'valor' => ($inventario->pmp * request('cantidad'.$i)),
                                ]);

                                array_push($ingredientes, $ingrediente);
                    }
                }
            }
        }

        $sumaPreciosIngredientes = 0;
        foreach($ingredientes as $ingrediente){
            $sumaPreciosIngredientes += $ingrediente->valor;
        }

        $precioSugerido = round(($sumaPreciosIngredientes/(1 - 0.3)), -2);

        return view('nuevoProducto2', compact('producto', 'ingredientes', 'precioSugerido'));
    }

    protected function store2(Request $request){
        $producto = Productos::where('local_id', 1)->get()->last();
        $producto->tiempo_preparacion = request('tiempo_preparacion');
        $producto->descripcion = request('descripcion');
        $producto->estado = 'activado';

        if($request->radio == 'sugerido'){
            $producto->precio = request('precioSugerido');
        }else{
            $producto->precio = request('precio');
        }

        $producto->save();

        return redirect()->route('menu.index');
    }

    protected function activar(Productos $producto){
        $producto->estado = 'activado';
        $producto->save();

        return redirect()->route('menu.index');
    }

    protected function desactivar(Productos $producto){
        $producto->estado = 'desactivado';
        $producto->save();

        return redirect()->route('menu.index');
    }

    protected function delete(Productos $producto){
        $ingredientes = Ingredientes::where('producto_id', $producto->id);
        $ingredientes->delete();

        $productos_user = Productos_user::where('productos_id', $producto->id);
        $productos_user->delete();

        Productos::destroy($producto->id);

        return redirect()->route('menu.index');
    }
}
