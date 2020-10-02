<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\Personal;

class SolSerEmail extends Mailable implements ShouldQueue
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
        switch ($this->email->SolSerStatus) {
            case 'Notificado':
                $asuntoStatus = 'La Solicitud de Servicio #'.$this->email->ID_SolSer." ya cuenta con fecha PROGRAMADA";
                break;
            case 'Completado':
                $asuntoStatus = 'En la Solicitud de Servicio #'.$this->email->ID_SolSer." se ha COMPLETADO la recepción de los residuos";
                break;
            case 'Conciliado':
                $asuntoStatus = 'La Solicitud de Servicio #'.$this->email->ID_SolSer." ha sido CONCILIADA por el cliente";
                break;
            case 'No Conciliado':
                $asuntoStatus = 'La Solicitud de Servicio #'.$this->email->ID_SolSer." ha sido RECHAZADA por el cliente";
                break;
            case 'Certificacion':
                $asuntoStatus = 'La Solicitud de Servicio #'.$this->email->ID_SolSer." ha sido CERTIFICADA por Prosarc S.A. ESP";
                break;
            default:
                $asuntoStatus = "Solicitud de Servicio";
                break;
        }
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject($asuntoStatus)
                        ->markdown('emails.SolSer.email');
    }
}
