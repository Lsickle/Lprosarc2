<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\Personal;
use App\Certificado;

class SolSerExpressEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $pdf;
    public $certificado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $pdf, $certificado)
    {
        $this->email = $email;
        $this->pdf = $pdf;
        $this->certificado = $certificado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mensaje = $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP');

        if ($this->certificado->CertType == 0) {
            $mensaje->attachData($this->pdf->output(), 'E-'.sprintf("%07s", $this->certificado->ID_Cert).'.pdf', ['mime' => 'application/pdf'])
            ->markdown('emails.Express.sendCertificadoExpress')
            ->subject('CERTIFICADO '.'E-'.sprintf("%07s", $this->certificado->ID_Cert).' generado para el Servicio Express #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName);
        }else{
            $mensaje->attachData($this->pdf->output(), 'ME-'.sprintf("%07s", $this->certificado->CertManifNumero).'.pdf', ['mime' => 'application/pdf'])
            ->markdown('emails.Express.sendManifiestoExpress')
            ->subject('MANIFIESTO '.'ME-'.sprintf("%07s", $this->certificado->CertManifNumero).' generado para el Servicio Express #'.$this->email->ID_SolSer." del cliente ".$this->email->CliName);
        }

        return $mensaje;
    }
}
