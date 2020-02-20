@component('mail::message')
# Vehiculo recibido

Uno de los vehiculos programados para la solicitud de servicio N° {{$SolicitudServicio->ID_SolSer}} ha sido recibida en planta de procesos. 
El personal encargado de bodegaje debera comenzar a marcar las cantidades recibidas para cada residuo
<br>
tome en cuenta que si aun faltan vehiculos por recibir en planta correspondientes a este servicio el boton para marcar la solicitud como <i>recibida</i> aparecera de color naranja

@component('mail::button', ['url' => url('/solicitud-servicio', [$SolicitudServicio->SolSerSlug])])
ver solicitud de servicio
@endcomponent

Saludos, <br>Prosarc S.A. ESP.
@endcomponent
