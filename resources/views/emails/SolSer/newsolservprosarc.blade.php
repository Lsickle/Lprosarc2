@component('mail::message')
# Solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}}

Prosarc S.A. ESP ha creado una nueva Solicitud de Servicio del cliente {{$SolicitudServicio['cliente']->CliName}}, para detalles adicionales comuniquese con el area de Logística:<br>
<br>
# Observaciones de Logistica:

<p style="background-color:#f0f3f8;"><i>{!!nl2br($SolicitudServicio->SolSerDescript)!!}</i></p>

@component('mail::button', ['url' => url('/solicitud-servicio', [$SolicitudServicio->SolSerSlug])])
Ver Solicitud de Servicio
@endcomponent

Saludos
@endcomponent