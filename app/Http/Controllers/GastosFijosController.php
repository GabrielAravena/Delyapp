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

        $local_id = Local::find($request->user()->local_id)->id;

        $gastosFijos = Gastos_fijos::where('local_id', $local_id)->get();

        return view('gastosFijos', compact('gastosFijos'));
    }

    protected function create(Request $request){

        $request->user()->authorizeRoles(['admin']);

        $local_id = Local::find($request->user()->local_id)->id;

        return view('nuevoGasto', compact('local_id'));
    }

    protected function store(Request $request){
       
        Gastos_fijos::create([
            'nombre' => $request->nombre,
            'monto' => $request->monto,
            'local_id' => $request->local_id,
        ]);

        return redirect()->route('gastosFijos.index');
    }
}
