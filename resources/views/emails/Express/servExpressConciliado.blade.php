@component('mail::message')
# Conciliacion del Servicio N° {{$email->ID_SolSer}}

La Solicitud de Servicio N° {{$email->ID_SolSer}} ha sido CONCILIADA con éxito<br>
Puede revisar la información del Servicio Express usando el botón "Ver Solicitud".

# Observaciones

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i></p>

@component('mail::button', ['url' => url('/serviciosexpress', [$email->SolSerSlug])])
Ver Solicitud
@endcomponent

@endcomponent
