@component('mail::message')
# Solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}}
<b></b>
la cantidad conciliada del residuo <b>{{$SolRes['RespelName']}}</b> ha sido modificada de <b>{{$SolRes['oldValue']}}</b> a <b>{{$SolRes['newValue']}}</b>
<br>
@component('mail::button', ['url' => url('/solicitud-servicio', [$SolicitudServicio->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent
<br>
En caso de que sea necesario los certificados o manifiestos que correspondan serán actualizados y se le enviara la respectiva notificación

@endcomponent
