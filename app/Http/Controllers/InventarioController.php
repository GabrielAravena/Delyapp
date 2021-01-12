<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Compras_historicas;
use App\Productos;
use App\Ingredientes;
use App\Mermas;
use App\Local;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $inventarios = Inventario::where('local_id', $local_id)->get();

        return view('inventario', compact('inventarios', 'local_id'));
    }

    protected function create($local_id, Request $request)
    {   
        $request->user()->authorizeRoles(['admin']);

        if($local_id = $request->user()->local_id){

            $mermas = Mermas::all();
            return view('nuevoIngrediente', compact('mermas'));
        }
        return redirect()->route('inicioAdmin.index');
    }

    protected function store(Request $request)
    {

        $local_id = $request->user()->local_id;

        $valor = request('precio') * request('cantidad');

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

        return redirect()->route('inventario.index')->with('mensaje', ' El ingrediente se creó correctamente.');
    }

    protected function comprar($inventario_id, Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $inventario = Inventario::where('id', $inventario_id)->where('local_id', $request->user()->local_id)->get()->first();

        if ($inventario) {
            return view('compraIngrediente', compact('inventario'));
        } else {
            return redirect()->route('inventario.index');
        }
    }

    protected function compra(Inventario $inventario)
    {

        Compras_historicas::create([
            'nombre' => "{$inventario->nombre}",
            'cantidad' => request('cantidad'),
            'unidad_medida' => "{$inventario->unidad_medida}",
            'valor' => request('valor'),
            'inventario_id' => "{$inventario->id}",
        ]);

        $sumaValores = Compras_historicas::where('inventario_id', $inventario->id)->sum('valor');
        $cantidadinventario = $inventario->cantidad + request('cantidad');

        $precioMedioPonderado = $sumaValores / $cantidadinventario;


        $inventario = Inventario::find($inventario->id);

        $inventario->cantidad = $cantidadinventario;
        $inventario->valor = $precioMedioPonderado * $cantidadinventario;
        $inventario->pmp = $precioMedioPonderado;
        $inventario->ultimo_precio = (request('valor') / request('cantidad'));

        $inventario->save();

        return redirect()->route('inventario.index')->with('mensaje', ' Se registró la compra de ingrediente correctamente.');
    }

    protected function delete($inventario_id, Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $inventario = Inventario::where('id', $inventario_id)->where('local_id', $local_id)->get()->first();

        if ($inventario) {
            $compras_historicas = Compras_historicas::where('inventario_id', $inventario->id);
            $compras_historicas->delete();

            $ingredientes = Ingredientes::where('inventario_id', $inventario->id)->get();

            foreach ($ingredientes as $ingrediente) {
                $producto = Productos::find($ingrediente->producto_id);
                Productos::eliminar($producto);
            }

            $ingredientes = Ingredientes::where('inventario_id', $inventario->id);
            $ingredientes->delete();

            Inventario::destroy($inventario->id);

        }
        return redirect()->route('inventario.index')->with('mensaje', ' El ingrediente se eliminó correctamente.');
    }
}
