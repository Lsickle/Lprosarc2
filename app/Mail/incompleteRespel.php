<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class incompleteRespel extends Mailable
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
        return $this->from('notificaciones@prosarc.com.co', 'Prosarc S.A. ESP')
                    ->subject('El residuo '.$this->respel->RespelName.' está Incompleto')
                    ->markdown('emails.Respel.incomplete');
    }
}
