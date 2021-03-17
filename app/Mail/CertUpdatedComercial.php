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

class CertUpdatedComercial extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $certificado;
    public $servicio;
    public $cliente;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($certificado, $servicio, $cliente)
    {
        $this->servicio = $servicio;
        $this->certificado = $certificado;
        $this->cliente = $cliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->certificado->CertType) {
            case 0:
                $asunto = 'Certificado #'.$this->certificado->CertNumero.' del cliente '.$this->cliente->CliName.' disponible para revisión';
                break;
            case 1:
                $asunto = 'Manifiesto #M'.$this->certificado->CertManifNumero.' del cliente '.$this->cliente->CliName.' disponible para revisión';
                break;
            case 2:
                $asunto = 'certificado externo #'.$this->certificado->CertNumeroExt.' del cliente '.$this->cliente->CliName.' disponible para revisión';
                break;
            default:
                $asunto = 'Documento #'.$this->certificado->ID_Cert.' del cliente '.$this->cliente->CliName.' disponible para revisión';
                break;
        }
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject($asunto)
                        ->markdown('emails.certupdated.certcomercial');
    }
}
