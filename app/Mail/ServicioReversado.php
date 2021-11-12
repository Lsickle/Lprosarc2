<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServicioReversado extends Mailable implements ShouldQueue
{
    use Queueable;

    public $servicio;
    public $observacion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($servicio, $observacion)
    {
        $this->servicio = $servicio;
        $this->observacion = $observacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                    ->subject('El status del servicio #'.$this->servicio->ID_SolSer.' ha sido reversado')
                    ->markdown('emails.SolSer.servicio_reversado');
    }
}
