<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewObservationClient extends Mailable implements ShouldQueue
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
        
        $asuntoStatus = 'Nueva OBSERVACIÓN en el Servicio #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName;
        
        return $this->from('notificaciones@prosarc.com.co', $this->email->CliName)
                        ->subject($asuntoStatus)
                        ->markdown('emails.SolSer.newObsClient');
    }
}
