<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolSerEmailClient extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@prosarc.com.co', $this->email->CliName)
                        ->subject('Solicitud de Servicio')
                        ->markdown('emails.SolSer.email');
    }
}
