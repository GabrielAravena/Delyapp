<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Productos_user;
use App\Ventas;
use App\Invitado;
use App\Ingredientes;
use App\Inventario;
use App\Registro_ventas;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

class CarritoController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;

    protected function index(Request $request)
    {
        $productos = null;
        $user_id = null;
        $codigoInvitado = null;
        $monto = 1;
        $sessionId = 0;
        $buyOrder = 0;

        if ($request->user() == null) {

            $codigoInvitado = $request->session()->get('codigoInvitado');

            if (!$codigoInvitado) {

                $codigoInvitado = hexdec(uniqid());
                $request->session()->put(['codigoInvitado' => $codigoInvitado]);
            }

            $productos = Productos_user::where('invitado', $codigoInvitado)
                ->join('ventas', 'productos_users.ventas_id', 'ventas.id')
                ->join('productos', 'productos_users.producto_id', 'productos.id')
                ->select('productos_users.*', 'ventas.estado', 'productos.nombre', 'productos.precio', 'productos.imagen', 'productos.local_id', 'ventas.precio as total')
                ->where('ventas.estado', 'carrito')
                ->orderBy('id')
                ->get()
                ->groupBy('ventas_id')
                ->last();
        } else {

            $user_id = $request->user()->id;

            $productos = Productos_user::where('users_id', $user_id)
                ->join('ventas', 'productos_users.ventas_id', 'ventas.id')
                ->join('productos', 'productos_users.producto_id', 'productos.id')
                ->select('productos_users.*', 'ventas.estado', 'productos.nombre', 'productos.precio', 'productos.imagen', 'productos.local_id', 'ventas.precio as total')
                ->where('ventas.estado', 'carrito')
                ->orderBy('id')
                ->get()
                ->groupBy('ventas_id')
                ->last();
        }

        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))->getNormalTransaction();

        if ($productos != null) {

            $buyOrder = $productos[0]->ventas_id;

            if ($user_id) {
                $sessionId = $user_id;
            } else {
                $sessionId = $codigoInvitado;
            }
            $monto = $productos[0]->total;
        }

        $returnUrl = route('carrito.return');
        $finalUrl = route('carrito.final');

        $initResult = $transaction->initTransaction(
            $monto,
            $buyOrder,
            $sessionId,
            $returnUrl,
            $finalUrl
        );

        $token_ws = $initResult->token;
        $url = $initResult->url;

        return view('carrito', compact('productos', 'token_ws', 'url'));
    }

    protected function agregar(Productos $producto, Request $request)
    {
        $user_id = null;
        $productos_user = null;
        $codigoInvitado = null;

        if ($request->user() == null) {

            $codigoInvitado = $request->session()->get('codigoInvitado');

            if (!$codigoInvitado) {

                $codigoInvitado = hexdec(uniqid());
                $request->session()->put(['codigoInvitado' => $codigoInvitado]);
            }

            $productos_user = Productos_user::where('invitado', $codigoInvitado)
                ->join('ventas', 'productos_users.ventas_id', 'ventas.id')
                ->join('productos', 'productos_users.producto_id', 'productos.id')
                ->select('productos_users.*', 'ventas.estado', 'productos.nombre', 'productos.precio', 'productos.imagen', 'productos.local_id', 'ventas.precio as total')
                ->where('ventas.estado', 'carrito')
                ->orderBy('id')
                ->get()
                ->last();
        } else {

            $user_id = $request->user()->id;

            $productos_user = Productos_user::where('users_id', $user_id)
                ->join('ventas', 'productos_users.ventas_id', 'ventas.id')
                ->join('productos', 'productos_users.producto_id', 'productos.id')
                ->select('productos_users.*', 'ventas.estado', 'productos.nombre', 'productos.precio', 'productos.imagen', 'productos.local_id', 'ventas.precio as total')
                ->where('ventas.estado', 'carrito')
                ->orderBy('id')
                ->get()
                ->last();
        }

        if ($productos_user) {

            if ($user_id) {

                Productos_user::create([
                    'producto_id' => $producto->id,
                    'cantidad' => $request->cantidad,
                    'users_id' => $user_id,
                    'ventas_id' => $productos_user->ventas_id,
                ]);
            } else {

                Productos_user::create([
                    'producto_id' => $producto->id,
                    'cantidad' => $request->cantidad,
                    'users_id' => 1,
                    'ventas_id' => $productos_user->ventas_id,
                    'invitado' => $codigoInvitado,
                ]);
            }

            $venta = Ventas::find($productos_user->ventas_id);
            $venta->precio += $producto->precio * $request->cantidad;
            $venta->save();
        } else {

            $venta = Ventas::create([
                'estado' => 'carrito',
                'tipo' => 'online',
                'precio' => 0,
            ]);

            if ($user_id) {
                Productos_user::create([
                    'producto_id' => $producto->id,
                    'cantidad' => $request->cantidad,
                    'users_id' => $user_id,
                    'ventas_id' => $venta->id,
                ]);
            } else {
                Productos_user::create([
                    'producto_id' => $producto->id,
                    'cantidad' => $request->cantidad,
                    'users_id' => 1,
                    'ventas_id' => $venta->id,
                    'invitado' => $codigoInvitado,
                ]);
            }


            $venta->precio += $producto->precio * $request->cantidad;
            $venta->save();
        }

        return redirect()->route('carrito.index');
    }

    protected function delete(Request $request, $id)
    {
        if($request->user()){
            $user_id = $request->user()->id;

            $productos_user = Productos_user::where('productos_users.id', $id)
            ->where('user_id', $user_id)
            ->join('productos', 'productos_users.producto_id', 'productos.id')
            ->select('productos_users.*', 'productos.precio')
            ->get()
            ->last();

        }else{
            $invitado = $request->session()->get('codigoInvitado');

            $productos_user = Productos_user::where('productos_users.id', $id)
            ->where('invitado', $invitado)
            ->join('productos', 'productos_users.producto_id', 'productos.id')
            ->select('productos_users.*', 'productos.precio')
            ->get()
            ->last();
        }

        if($productos_user){
            $venta = Ventas::find($productos_user->ventas_id);
            $venta->precio -= $productos_user->precio * $productos_user->cantidad;
            $venta->save();
    
            $productos_user->delete();
        }

        return redirect()->route('carrito.index');
    }

    protected function producto(Productos $producto)
    {
        return view('producto', compact('producto'));
    }

    protected function pagar(Request $request)
    {

        $token_ws = $request->token_ws;
        $url = $request->url;

        if ($request->user() == null) {
            Invitado::create([
                'id' => $request->session()->get('codigoInvitado'),
                'nombre' => $request->name,
                'email' => $request->email,
                'direccion' => $request->direccion,
            ]);
        }

        return view('carrito_pagar', compact('token_ws', 'url'));
    }

    protected function return(Request $request)
    {

        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))->getNormalTransaction();

        $token_ws = $request->token_ws;
        $result = $transaction->getTransactionResult($token_ws);
        $output = $result->detailOutput;
        $urlRedirection = $result->urlRedirection;

        $buyOrder = $output->buyOrder;
        $codigoAutorizacion = $output->authorizationCode;
        $monto = $output->amount;

        if ($output->responseCode == 0) {

            $productos = Productos_user::where('ventas_id', $buyOrder)->get();

            foreach ($productos as $producto) {

                if ($producto->user_id != 1) {
                    $user_id = $producto->users_id;
                    $invitado = null;
                } else {
                    $invitado = $producto->invitado;
                    $user_id = null;
                }

                $ingredientes = Ingredientes::where('producto_id', $producto->producto_id)->get();

                foreach ($ingredientes as $ingrediente) {

                    $inventario = Inventario::find($ingrediente->inventario_id);
                    $inventario->cantidad -= ($ingrediente->cantidad * $producto->cantidad);
                    $inventario->save();

                    $local_id = $inventario->local_id;
                }
            }

            Registro_ventas::create([
                'local_id' => $local_id,
                'users_id' => $user_id,
                'invitado' => $invitado,
                'venta_id' => $buyOrder,
                'tipo' => 'online',
                'valor' => $monto,
            ]);

            $venta = Ventas::find($buyOrder);
            $venta->estado = 'finalizado';
            $venta->save();

            return view('carrito_redirect', compact('token_ws', 'urlRedirection', 'codigoAutorizacion', 'monto'));
        } else {

            return view('carrito_error');
        }
    }

    protected function final()
    {
        return view('carrito_final');
    }






    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath($request));
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function redirectPath(Request $request)
    {
        $codigoInvitado = $request->session()->get('codigoInvitado');
        $productos_user = Productos_user::where('invitado', $codigoInvitado)->get();

        foreach ($productos_user as $producto) {
            $producto->users_id = auth()->user()->id;
            $producto->save();
        }
        return route('carrito.index');
    }
}
