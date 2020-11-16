<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    protected function index($id){
        
        $categorias = Productos::select('categoria')->where('local_id', $id)->get();

        $categoria = [];
        foreach($categorias as $cat){
            $categoria[] = $cat;
        }
        $categoria = array_unique($categoria);

        $productos = Productos::where('local_id', 1)->where('estado', 'activado')->get();

        $local = Local::find(1);

        return view('index1', compact('categoria', 'productos', 'local'));
    }
}
