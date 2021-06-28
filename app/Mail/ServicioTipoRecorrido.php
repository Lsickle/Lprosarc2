<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\Personal;

class ServicioTipoRecorrido extends Mailable implements ShouldQueue
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
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName." ya cuenta con fecha PROGRAMADA";
                break;
            case 'Completado':
                $asuntoStatus = 'En el Servicio #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName." se ha COMPLETADO la recepción de los residuos";
                break;
            case 'Conciliado':
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName." ha sido CONCILIADO";
                break;
            case 'No Conciliado':
                $asuntoStatus = 'Algunos Peso(s) del Servicio #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName." han sido RECHAZADOS";
                break;
            case 'Certificacion':
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName." ha sido CERTIFICADO por Prosarc S.A. ESP";
                break;
            case 'Corregido':
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName." ha sido CORREGIDO en las cantidades conciliadas que corresponden";
                break;
            case 'Residuo Faltante':
                $asuntoStatus = 'El Servicio #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName." ha sido habilitado para añadir el RESIDUO FALTANTE";
                break;
            default:
                $asuntoStatus = "Solicitud de Servicio";
                break;
        }
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject($asuntoStatus)
                        ->markdown('emails.SolSer.recorrido');
    }
}
