<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Local;

class InicioController extends Controller
{
    protected function index(){
        $locales = Local::where('estado', 'activado')->get();

        return view('inicio', compact('locales'));
    } 

    protected function buscador(Request $request){
 
        $locales = Local::where('estado', 'activado')
            ->where('nombre', 'like', $request->texto.'%')
            ->get();

        return view('buscadorLocales', compact('locales'));
    }
}
