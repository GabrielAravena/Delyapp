<?php

namespace App\Mail;

use App\Invitado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Local;
use App\User;
use Google\Auth\AccessToken;

class PedidoListo extends Mailable
{
    use Queueable, SerializesModels;

    private $registro_venta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registro_venta)
    {
        $this->registro_venta = $registro_venta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mapbox_token = "pk.eyJ1IjoiZ2Fib2J1ZG8iLCJhIjoiY2trNHM1enR4MW9kczJ4cGV6NHlrdTA1bSJ9.H8tB-u1v17oj7NclhK3iBA";

        $base_url = "https://api.mapbox.com/directions/v5/mapbox/driving-traffic/";

        $registro_venta = $this->registro_venta;
        
        $local = Local::find($registro_venta->local_id);

        if($registro_venta->users_id != null){
            $usuario = User::find($registro_venta->users_id);
        }else{
            $usuario = Invitado::find($registro_venta->invitado);
        }

        $url = $base_url.$local->longitud.','.$local->latitud.';'.$usuario->longitud.','.$usuario->latitud.'?'.'access_token='.$mapbox_token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $respuesta = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($respuesta , true );

        $duracion = number_format($data['routes'][0]['duration']/60, 0, ".", ",");

        return $this->view('emails.pedidoListo', compact('registro_venta', 'local', 'usuario', 'duracion'));
    }
}
