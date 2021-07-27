@component('mail::message')
# Comprobante de pago N° {{$recibo->ID_Recibo}}

Saludos Sres de <b>{{$cliente->CliName}}</b>

Hemos recibido su pago con referencia N° {{$recibo->referencia}} con éxito. en breve se realizará la programación de los servicios y se emitirá la factura correspondiente.

# Observaciones

<p style="background-color:#f0f3f8;"><i>{!!nl2br($recibo->SolSerDescript)!!}</i></p>

Para mas detalles favor comunicarse con el asesor:

<ul>
    <li>Nombre: {{$asesor->PersFirstName.' '.$asesor->PersLastName}} </li>
    <li>teléfono: {{$asesor->PersCellphone}}</li>
    <li>correo: {{$asesor->PersEmail}}</li>
</ul>

@component('mail::button', ['url' => url('https://api.whatsapp.com/send?phone=573194951356&text=hola,%20necesito%20informacion%20sobre%20los%20servicios%20express%20')])
Contactar
@endcomponent


@component('mail::subcopy')
La información de este mensaje es privilegiada y confidencial.

Este correo electrónico se envió desde una dirección que no acepta correos electrónicos entrantes. Por favor, no responda a este mensaje.

Si tiene alguna pregunta, inquietud o si recibió esta notificación por error comuníquese con: coordinadorse@prosarc.com.co
@endcomponent

@endcomponent
