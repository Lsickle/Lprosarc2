<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewObservation extends Mailable implements ShouldQueue
{
    use Queueable;

    public $email;
    public $remitente;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $remitente)
    {   
        $this->email = $email;
        $this->remitente = $remitente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $asuntoStatus = 'Nueva OBSERVACIÓN de Prosarc S.A. ESP. en el Servicio #'.$this->email->ID_SolSer.' del cliente '.$this->email->CliName;

        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject($asuntoStatus)
                        ->markdown('emails.SolSer.newObs');
    }
}
