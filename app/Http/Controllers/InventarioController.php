<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Compras_historicas;
use App\Mermas;
use App\Local;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(Request $request){

        $request->user()->authorizeRoles(['admin']);

        $local_id = Local::find($request->user()->local_id);

        $inventarios = Inventario::where('local_id', $local_id)->get();

        return view('inventario', compact('inventarios'));
    }

    protected function create(){

        $mermas = Mermas::all();

        return view('nuevoIngrediente', compact('mermas'));
    }

    protected function store(Request $request){

        $local_id = Local::find($request->user()->local_id);

        $valor = request('precio')*request('cantidad');

        $merma = Mermas::find(request('mermaId'));
        
        $inventario =   Inventario::create([
                        'nombre' => $merma->nombre,
                        'cantidad' => request('cantidad'),
                        'unidad_medida' => request('unidad_medida'),
                        'valor' => $valor,
                        'pmp' => (request('precio')),
                        'ultimo_precio' => (request('precio')),
                        'merma' => $merma->porcentaje,
                        'local_id' => $local_id,

        ]);

        Compras_historicas::create([
            'nombre' => $inventario->nombre,
            'cantidad' => $inventario->cantidad,
            'unidad_medida' => $inventario->unidad_medida,
            'valor' => $inventario->valor,
            'inventario_id' => $inventario->id,
        ]);

        return redirect()->route('inventario.index');
    }

    protected function comprar(Inventario $inventario){

        return view('compraIngrediente', [
            'inventario' => $inventario
        ]);
    }

    protected function compra(Inventario $inventario){

        Compras_historicas::create([
            'nombre' => "{$inventario->nombre}",
            'cantidad' => request('cantidad'),
            'unidad_medida' => "{$inventario->unidad_medida}",
            'valor' => request('valor'),
            'inventario_id' => "{$inventario->id}",
        ]);

        $sumaValores = Compras_historicas::where('inventario_id', $inventario->id)->sum('valor');
        $cantidadinventario = $inventario->cantidad + request('cantidad');

        $precioMedioPonderado = $sumaValores/$cantidadinventario;


        $inventario = Inventario::find($inventario->id);

        $inventario->cantidad = $cantidadinventario;
        $inventario->valor = $precioMedioPonderado * $cantidadinventario;
        $inventario->pmp = $precioMedioPonderado;
        $inventario->ultimo_precio = (request('valor')/request('cantidad'));

        $inventario->save();

        return redirect()->route('inventario.index');
    }

    protected function delete(Inventario $inventario){

        $compras_historicas = Compras_historicas::where('inventario_id', $inventario->id);
        $compras_historicas->delete();

        Inventario::destroy($inventario->id);
        
        return redirect()->route('inventario.index');
    }
}