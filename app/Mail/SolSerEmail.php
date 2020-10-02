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
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." ya cuenta con fecha PROGRAMADA";
                break;
            case 'Completado':
                $asuntoStatus = 'En el Servicio #'.$this->email->ID_SolSer." se ha COMPLETADO la recepción de los residuos";
                break;
            case 'Conciliado':
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." ha sido CONCILIADO por el cliente";
                break;
            case 'No Conciliado':
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." ha sido RECHAZADO por el cliente";
                break;
            case 'Certificacion':
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." ha sido CERTIFICADO por Prosarc S.A. ESP";
                break;
            case 'Corregido':
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." ha sido CORREGIDO en las cantidades conciliadas que corresponden";
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
