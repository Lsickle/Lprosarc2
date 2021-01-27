<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SustanciaControladaProgramada extends Mailable
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
        return $this->from('notificaciones@prosarc.com.co', $this->SolicitudServicio['cliente']->CliName)
                    ->subject('Nueva Solicitud de Servicio '.'#'.$this->SolicitudServicio->ID_SolSer.' del cliente: '.$this->SolicitudServicio['cliente']->CliName)
                    ->markdown('emails.SolSer.sustanciaControladaProgramada');
    }
}
