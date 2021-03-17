<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProgramacionParafiscales extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $Observacion;
    public $programacion;
    public $Parafiscales;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $Observacion, $programacion, $Parafiscales)
    {
        $this->email = $email;
        $this->Observacion = $Observacion;
        $this->programacion = $programacion;
        $this->Parafiscales = $Parafiscales;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $asuntoStatus = 'Documentos del personal programado para el Servicio #'.$this->email->ID_SolSer.' del cliente '.$this->email->CliName;

        $correo = $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject($asuntoStatus)
                        ->markdown('emails.programacion.parafiscales');

        foreach($this->Parafiscales as $key => $value){
            $correo  = $this->attachFromStorage($value);
        }

        return $correo;


    }
}
