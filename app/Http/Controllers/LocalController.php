<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Local;

class LocalController extends Controller
{
    protected function index($id)
    {

        $categorias = Productos::select('categoria')->where('local_id', $id)->where('estado', 'activado')->get();

        $categoria = [];
        foreach ($categorias as $cat) {
            $categoria[] = $cat;
        }

        $categoria = array_unique($categoria);

        $productos = Productos::where('local_id', $id)->where('estado', 'activado')->get();

        $local = Local::find($id);

        $promociones = $this->promociones($categoria);

        $menu = $this->menu($categoria);

        return view('local', compact('categoria', 'productos', 'local', 'promociones', 'menu'));
    }

    private function promociones($categorias)
    {
        if (count($categorias) > 0) {
            foreach ($categorias as $categoria) {
                if ($categoria->categoria == 'promoción' || $categoria->categoria == 'combo') {
                    return true;
                }
            }
        }
        return false;
    }

    private function menu($categorias)
    {
        if (count($categorias) > 0) {
            foreach ($categorias as $categoria) {
                if ($categoria->categoria != 'promoción' && $categoria->categoria != 'combo') {
                    return true;
                }
            }
        }
        return false;
    }
}
