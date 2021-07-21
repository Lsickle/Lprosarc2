<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolSerExpressConciliado extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->emailData->SolSerStatus) {
            case 'Notificado':
                $asuntoStatus = 'El Servicio Express #'.$this->emailData->ID_SolSer." del cliente ".$this->emailData->CliName." ya cuenta con fecha PROGRAMADA";
                break;
            case 'Completado':
                $asuntoStatus = 'En el Servicio Express #'.$this->emailData->ID_SolSer." del cliente ".$this->emailData->CliName." se ha COMPLETADO la recepción de los residuos";
                break;
            case 'Conciliado':
                $asuntoStatus = 'El Servicio Express #'.$this->emailData->ID_SolSer." del cliente ".$this->emailData->CliName." ha sido CONCILIADO";
                break;
            case 'No Conciliado':
                $asuntoStatus = 'Algunos Peso(s) del Servicio Express #'.$this->emailData->ID_SolSer." del cliente ".$this->emailData->CliName." han sido RECHAZADOS";
                break;
            case 'Certificacion':
                $asuntoStatus = 'El Servicio Express #'.$this->emailData->ID_SolSer." del cliente ".$this->emailData->CliName." ha sido CERTIFICADO por Prosarc S.A. ESP";
                break;
            case 'Corregido':
                $asuntoStatus = 'El Servicio Express #'.$this->emailData->ID_SolSer." del cliente ".$this->emailData->CliName." ha sido CORREGIDO en las cantidades conciliadas que corresponden";
                break;
            case 'Residuo Faltante':
                $asuntoStatus = 'El Servicio Express #'.$this->emailData->ID_SolSer." del cliente ".$this->emailData->CliName." ha sido habilitado para añadir el RESIDUO FALTANTE";
                break;
            default:
                $asuntoStatus = "Solicitud de Servicio Express";
                break;
        }
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                    ->subject($asuntoStatus)
                    ->markdown('emails.Express.servExpressConciliado');
    }
}
