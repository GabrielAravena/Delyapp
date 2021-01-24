<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Local;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ConfiguracionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $local = Local::find($local_id);

        return view('configuracion', compact('local'));
    }

    protected function guardar(Request $request)
    {
  
        $local = Local::find($request->user()->local_id);

        $local->nombre = $request->nombre;
        $local->direccion = $request->direccion;
        $local->telefono = $request->telefono;
        $local->latitud = $request->latitud;
        $local->longitud = $request->longitud;
        $local->ingreso_mensual = $request->ingreso_mensual;
        $local->ganancia = $request->ganancia;
        
        if($rutaImagenLocal = $this->guardarImagen($request->file('imagen_local'))){
            $local->imagen = $rutaImagenLocal;
        }

        if($rutaLogoLocal = $this->guardarImagen($request->file('logo_local'))){
            $local->logo = $rutaLogoLocal;
        }
      
        if ($request->delivery) {
            $local->delivery = true;
            $local->valor_delivery = $request->valor_delivery;
        } else {
            $local->delivery = false;
            $local->valor_delivery = null;
        }

        $local->save();

        return redirect()->route('inicioAdmin.index')->with('mensaje', 'Las configuraciones de tu local han sido modificadas correctamente');
    }

    protected function guardarImagen($imagen)
    {

        if ($imagen) {
            $nombre = Str::random(20) . '.jpg';
            $img = Image::make($imagen)->encode('jpg', 75);
            $img->resize(530, 470, function ($constraint) {
                $constraint->upsize();
            });

            Storage::disk('public')->put("imagenes/locales/$nombre", $img->stream());

            return Storage::url("imagenes/locales/$nombre");
        } else {

            return null;
        }
    }
}
