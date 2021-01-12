<?php

namespace App\Http\Controllers;

use App\Gastos_fijos;
use App\Local;
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

        return redirect()->route('gastosFijos.index')->with('mensaje', ' Gasto fijo modificado correctamente.');
    }

    protected function borrar($gasto_id, Request $request){

        $request->user()->authorizeRoles(['admin']);

        Gastos_fijos::where('id', $gasto_id)->where('local_id', $request->user()->local_id)->get()->first()->delete();

        return redirect()->route('gastosFijos.index')->with('mensaje', ' Gasto fijo eliminado correctamente.');

    }
}
