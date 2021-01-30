<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Local;
use App\User;
use App\Role;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\LocalCreado;
use Illuminate\Validation\Rule;

class RootController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ingresarLocal(Request $request)
    {
        $request->user()->authorizeRoles(['root']);

        return view('ingresarLocal');
    }

    protected function guardar(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', Rule::unique('users')],
        ]);

        $local = Local::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'estado' => 'desactivado',
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'ingreso_mensual' => $request->ingreso_mensual,
            'ganancia' => $request->ganancia,
        ]);

        if ($rutaImagenLocal = $this->guardarImagen($request->file('imagen_local'))) {
            $local->imagen = $rutaImagenLocal;
        }

        if ($rutaLogoLocal = $this->guardarImagen($request->file('logo_local'))) {
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

        $password = uniqid();

        $admin = User::create([
            'name' => 'Admin',
            'email' => $request->email,
            'password' => Hash::make($password),
            'local_id' => $local->id,
            'direccion' => $local->direccion,
            'latitud' => $local->latitud,
            'longitud' => $local->longitud,
            'telefono' => $local->telefono,
        ]);

        $admin->roles()->attach(Role::where('name', 'admin')->first());

        Mail::to($admin->email)->send(new LocalCreado($local, $admin, $password));

        return redirect()->route('root.index')->with('mensaje', 'El local se ha ingresado correctamente');
    }

    protected function listaLocales(Request $request){

        $request->user()->authorizeRoles(['root']);

        $locales = Local::paginate(10);

        return view('listaLocales', compact('locales'));

    }

    protected function buscador(Request $request)
    {
        $request->user()->authorizeRoles(['root']);

        $locales = Local::where('nombre', 'like', '%'.$request->texto.'%')
            ->orWhere('direccion', 'like', '%'.$request->texto.'%')
            ->orWhere('estado', 'like', $request->texto)
            ->get(); 

        return view('buscadorLocalesRoot', compact('locales'));
    }

    protected function modificar(Request $request, $local_id){

        $request->user()->authorizeRoles(['root']);

        $local = Local::find($local_id);

        return view('modificarLocal', compact('local'));
    }

    protected function guardarModificacion(Request $request, $local_id)
    {
        $request->user()->authorizeRoles(['root']);

        $local = Local::find($local_id);

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

        return redirect()->route('root.listaLocales')->with('mensaje', 'El local se ha modificado correctamente.');
    }

    protected function activarLocal(Request $request, $local_id){

        $request->user()->authorizeRoles(['root']);

        $local = Local::find($local_id);

        if($local->estado == 'activado'){
            $local->estado = 'desactivado';
        }else{
            $local->estado = 'activado';
        }

        $local->save();

        return redirect()->route('root.listaLocales')->with('mensaje', 'Estado modificado correctamente.');
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
