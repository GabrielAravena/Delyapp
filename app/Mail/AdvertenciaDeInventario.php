<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdvertenciaDeInventario extends Mailable
{
    private $ingredientes;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ingredientes)
    {
        $this->ingredientes = $ingredientes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $ingredientes = $this->ingredientes;
        return $this->view('emails.advertenciaDeInventario', compact('ingredientes'));
    }
}
