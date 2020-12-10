<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FechaErrada extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $Observacion;

    /**
     * Create a |new message instance.
     *
     * @return void
     */
    public function __construct($email, $Observacion)
    {   
        $this->email = $email;
        $this->Observacion = $Observacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $asuntoStatus = 'fecha de recepción errada para el Servicio #'.$this->email->ID_SolSer.' del cliente '.$this->email->CliName;

        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject($asuntoStatus)
                        ->markdown('emails.progvehiculo.errada');
    }
}
