<?php

namespace App\Mail;

use App\Local;
use App\Productos_user;
use App\Registro_ventas;
use App\Ventas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompraConfirmada extends Mailable
{
    use Queueable, SerializesModels;

    private $venta_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($buyOrder)
    {
        $this->venta_id = $buyOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $venta = Registro_ventas::where('venta_id', $this->venta_id)->get()->first();

        $productos_user = Productos_user::where('ventas_id', $this->venta_id)
        ->join('productos', 'productos_users.producto_id', 'productos.id')
        ->get();

        $local = Local::find($productos_user[0]->local_id);

        return $this->view('emails.compraConfirmada', compact('venta', 'productos_user', 'local'));
    }
}
