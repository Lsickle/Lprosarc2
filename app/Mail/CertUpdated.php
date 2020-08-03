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
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject('Certificado disponible para firma')
                        ->markdown('emails.certupdated.cert');
    }
}
