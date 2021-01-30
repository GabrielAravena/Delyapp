<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CambioEnPrecioSugerido extends Mailable
{
    use Queueable, SerializesModels;

    private $productos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productos)
    {
        $this->productos = $productos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $productos = $this->productos;

        return $this->view('emails.cambioEnPrecioSugerido', compact('productos'));
    }
}
