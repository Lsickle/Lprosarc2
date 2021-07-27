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

class CertExpressSinSaldoEmail extends Mailable
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
        $asuntoStatus = 'El total del Servicio Express #'.$this->email->ID_SolSer." Excede la cantida de 5Kg";

        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                    ->subject($asuntoStatus)
                    ->attachData($this->pdf->output(), 'E-'.sprintf("%07s", $this->certificado->ID_Cert).'.pdf', ['mime' => 'application/pdf'])
                    ->markdown('emails.Express.certificadoRetenido');
    }
}
