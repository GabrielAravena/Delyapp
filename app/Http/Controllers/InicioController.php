<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Local;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    protected function index(){
        $locales = Local::where('estado', 'activado')->get();

        return view('inicio', compact('locales'));
    } 
}
