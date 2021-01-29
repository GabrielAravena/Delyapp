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
        
        if($rutaImagenLocal = $this->guardarImagen($request->file('imagen_local'), $local->imagen)){
            $local->imagen = $rutaImagenLocal;
        }

        if($rutaLogoLocal = $this->guardarImagen($request->file('logo_local'), $local->logo)){
            $local->logo = $rutaLogoLocal;
        }
      
        if ($request->delivery) {
            $local->delivery = true;
            $local->valor_delivery = $request->valor_delivery;
            $local->distancia_delivery = $request->distancia_delivery;
        } else {
            $local->delivery = false;
            $local->valor_delivery = null;
            $local->distancia_delivery = null;
        }

        $local->save();

        return redirect()->route('inicioAdmin.index')->with('mensaje', 'Las configuraciones de tu local han sido modificadas correctamente');
    }

    protected function guardarImagen($imagen, $anterior)
    {
        if ($imagen) {
            if($anterior){
                $anterior = str_replace('/storage', '', $anterior);
                Storage::disk('public')->delete($anterior);
            }
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

    protected function indexAdmin(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $admin = $request->user();

        return view('configuracionAdmin', compact('admin'));
    }

    protected function guardarAdmin(Request $request){

        $admin = $request->user();
        $admin->name = $request->nombre;
        $admin->save();

        return redirect()->route('inicioAdmin.index')->with('mensaje', 'Se ha modificado la configuración correctamente.');
    }
}
