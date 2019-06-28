<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\Personal;

class SolSerEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->mail = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if((Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')) && ($this->mail->SolSerStatus === 'No Conciliado' || $this->mail->SolSerStatus === 'Conciliado')){
            return $this->from(Auth::user()->email, $this->mail->CliName)
                        ->subject('Solicitud de Servicio')
                        ->markdown('emails.SolSer.email');
        }else{
            return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                        ->subject('Solicitud de Servicio')
                        ->markdown('emails.SolSer.email');
        }
        
    }
}
