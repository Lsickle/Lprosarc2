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

class CertUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $certificado;
    public $servicio;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($certificado, $servicio)
    {
        $this->servicio = $servicio;
        $this->certificado = $certificado;
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
                $asunto = 'Certificado #'.$this->certificado->CertNumero.' disponible para aprobación';
                break;
            case 1:
                $asunto = 'Manifiesto #M'.$this->certificado->CertManifNumero.' disponible para aprobación';
                break;
            case 2:
                $asunto = 'certificado externo #'.$this->certificado->CertNumeroExt.' disponible para verificación';
                break;
            default:
                $asunto = 'Documento #'.$this->certificado->ID_Cert.' disponible para aprobación';
                break;
        }
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject($asunto)
                        ->markdown('emails.certupdated.cert');
    }
}
