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

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['root']);

        return view('root');
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
