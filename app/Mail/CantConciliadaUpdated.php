<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\Certificado;
use App\SolicitudServicio;
use App\Personal;

class CantConciliadaUpdated extends Mailable implements ShouldQueue
{
    use Queueable;

    public $SolRes;
    public $SolicitudServicio;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($SolRes, $SolicitudServicio)
    {
        $this->SolicitudServicio = $SolicitudServicio;
        $this->SolRes = $SolRes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $asunto = 'La cantidad Conciliada del residuo '.$this->SolRes['RespelName'].' en la Solicitud de Servicio #'.$this->SolicitudServicio->ID_SolSer.' ha sido modificada';

        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject($asunto)
                        ->markdown('emails.SolSer.conciliadaupdat');
    }
}
