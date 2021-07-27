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

class SolSerExpressRecibo extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $recibo;
    public $asesor;
    public $cliente;
    public $sede;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf, $recibo, $asesor, $cliente, $sede)
    {
        $this->pdf = $pdf;
        $this->recibo = $recibo;
        $this->asesor = $asesor;
        $this->cliente = $cliente;
        $this->sede = $sede;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                    ->subject('Comprobante de pago #'.$this->recibo->ID_Recibo." del cliente ".$this->cliente->CliName." para solicitud de Servicios Express")
                    ->attachData($this->pdf->output(), 'RP-'.sprintf("%07s", $this->recibo->ID_Recibo).'.pdf', ['mime' => 'application/pdf'])
                    ->markdown('emails.Express.sendReciboExpress');
    }
}
