@component('mail::message')
# Solicitud de Servicio N° {{$email->ID_SolSer}}

En estos momentos la Solicitud de Servicio N° {{$email->ID_SolSer}} {{'ha sido Certificada con éxito. esperamos que el proceso haya sido realizado a su entera satisfacción, ¡Gracias por su preferencia!'}}.<br>


# Observaciones

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i></p>

{{'Si tiene alguna duda no olvide comunicarse con su asesor comercial. Saludos, Prosarc S.A. ESP.'}}

@endcomponent
