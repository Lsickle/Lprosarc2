<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\cliente;

class ContartoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contratos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contratos)
    {
        $this->contratos = $contratos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                    ->subject('Contratos cercanos a estar vencidos')
                    ->markdown('emails.Contrato.email');
    }
}
