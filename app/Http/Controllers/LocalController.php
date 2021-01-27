<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Local;

class LocalController extends Controller
{
    protected function index($id){

        $categorias = Productos::select('categoria')->where('local_id', $id)->where('estado', 'activado')->get();

        $categoria = [];
        foreach($categorias as $cat){
            $categoria[] = $cat;
        }
        $categoria = array_unique($categoria);

        $productos = Productos::where('local_id', $id)->where('estado', 'activado')->get();

        $local = Local::find($id);

        return view('local', compact('categoria', 'productos', 'local'));
    }
}
