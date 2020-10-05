<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResiduoNuevo extends Mailable implements ShouldQueue
{
    use Queueable;

    public $respel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($respel)
    {
        $this->respel = $respel;                    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@prosarc.com.co', $this->respel['cliente']->CliName)
                    ->subject('Se ha registrado el residuo '.$this->respel->RespelName)
                    ->markdown('emails.residuo.nuevo');
    }
}
