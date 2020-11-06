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
        $sumaPreciosIngredientes = 0;  
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
                                'merma' => $inventario->merma,
                                'inventario_id' => request('ingrediente'.$i),
                                ]);

                        $unidadMedidaInv = $inventario->unidad_medida;
                        $unidadMedidaIng = $ingrediente->unidad_medida;

                        if($unidadMedidaInv == $unidadMedidaIng){
                            $ingrediente-> valor = ($inventario->pmp * $ingrediente->cantidad);
                            $ingrediente->save();
                        }elseif(($unidadMedidaInv == 'Kilogramo' && $unidadMedidaIng == 'Gramo') || ($unidadMedidaInv == 'Litro' && $unidadMedidaIng == 'Ml')){
                            $ingrediente-> valor = (($inventario->pmp/1000) * $ingrediente->cantidad);
                            $ingrediente->save();
                        }elseif(($unidadMedidaInv == 'Gramo' && $unidadMedidaIng == 'Kilogramo') || ($unidadMedidaInv == 'Ml' && $unidadMedidaIng == 'Litro')){
                            $ingrediente-> valor = (($inventario->pmp * 1000) * $ingrediente->cantidad);
                            $ingrediente->save();
                        }else{
                            $ingrediente->delete();
                            return "Error: No es posible ingresar estos ingredientes, ya que la unidad de medida de ".$inventario->nombre." en el inventario es ".$unidadMedidaInv.", pero en los ingredientes es ". $unidadMedidaIng;
                        }

                        $sumaPreciosIngredientes += $ingrediente->valor * (100/(100 - $ingrediente->merma));

                        array_push($ingredientes, $ingrediente);
                    }
                }
            }
        }
        

        $precioSugerido = number_format(($sumaPreciosIngredientes/(1 - 0.3)), -2, ",", ".");

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
