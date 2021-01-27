<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LocalCreado extends Mailable
{
    use Queueable, SerializesModels;

    private $local;
    private $admin;
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($local, $admin, $password)
    {
        $this->local = $local;
        $this->admin = $admin;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $local = $this->local;
        $admin = $this->admin;
        $password = $this->password;

        return $this->view('emails.localCreado', compact('local', 'admin', 'password'));
    }
}
