<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelSolServEmail extends Mailable implements ShouldQueue
{
    use Queueable;

    public $SolicitudServicio;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($SolicitudServicio)
    {
        $this->SolicitudServicio = $SolicitudServicio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                    ->subject('Nueva Solicitud de Servicio')
                    ->markdown('emails.SolSer.cancelsolserv');
    }
}
