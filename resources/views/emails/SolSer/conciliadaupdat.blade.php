@component('mail::message')
# Solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}}


la cantidad conciliada del residuo {{$SolRes['RespelName']}} ha sido modificada desde {{$SolRes['oldValue']}} a {{$SolRes['newValue']}}
<br>
En caso de que sea necesario os certificados que correspondan serán actualizados y se le enviara la respectiva notificación

@component('mail::button', ['url' => url('/solicitud-servicio', [$SolicitudServicio->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent


@endcomponent
