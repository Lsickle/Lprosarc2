@component('mail::message')
# Vehículo recibido

Uno de los vehículos programados para la solicitud de servicio N° {{$SolicitudServicio->ID_SolSer}} ha sido recibida en planta de procesos. 
El personal encargado de bodegaje deberá comenzar a marcar las cantidades recibidas para cada residuo
<br>
tenga en cuenta que, si aun faltan vehículos por recibir en planta correspondientes a este servicio, el botón para marcar la solicitud como <i>recibida</i> aparecerá de color naranja

@component('mail::button', ['url' => url('/solicitud-servicio', [$SolicitudServicio->SolSerSlug])])
ver solicitud de servicio
@endcomponent

Saludos, <br>Prosarc S.A. ESP.
@endcomponent
