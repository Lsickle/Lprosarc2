@component('mail::message')
# Certificado del Servicio N° {{$email->ID_SolSer}}

La Solicitud de Servicio N° {{$email->ID_SolSer}} ha sido Certificada con éxito, sin embargo, <b>el total de la cantidad conciliada es menor o igual a cero (0 Kg).</b> <br>
Puede revisar la información en el certificado adjunto o usando el botón "Ver Solicitud".

# Observaciones

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i></p>

@component('mail::button', ['url' => url('/serviciosexpress', [$email->SolSerSlug])])
Ver Solicitud
@endcomponent

@endcomponent