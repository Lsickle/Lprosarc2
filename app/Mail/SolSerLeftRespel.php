<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\Personal;

class SolSerLeftRespel extends Mailable implements ShouldQueue
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

        $asuntoStatus = "El cliente ". $this->SolicitudServicio['cliente']->CliName." ha añadido residuos adicionales en el servicio #".$this->SolicitudServicio->ID_SolSer;

        return $this->from('notificaciones@prosarc.com.co',  $this->SolicitudServicio['cliente']->CliName)
                        ->subject($asuntoStatus)
                        ->markdown('emails.SolSer.leftrespel');
    }
}
