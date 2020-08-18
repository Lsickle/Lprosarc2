@component('mail::message')
# Solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}}

Todas las programaciones de vehículos relativas a la Solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}} han sido canceladas por el área de Logistica... dado que la solicitud de servicio vuelve al status de <b>Aprobado</b>, el cliente puede nuevamente eliminar o editar la solicitud de servicio según necesite.<br>


@component('mail::button', ['url' => url('/solicitud-servicio', [$SolicitudServicio->SolSerSlug])])
Ver Solicitud de Servicio
@endcomponent

Saludos
@endcomponent