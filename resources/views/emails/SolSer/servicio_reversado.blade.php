@component('mail::message')
# Servicio N° {{$servicio->ID_SolSer}}
<b></b>
El status del servicio ha sido reversado de <b>{{$servicio['oldValue']}}</b> a <b>{{$servicio['newValue']}}</b>
<br>

<p style="background-color:#f0f3f8;"><i>{!!nl2br($servicio->SolSerDescript)!!}</i> <br>
<h5 style="text-align: right">{{$observacion->ObsUser}}</h5>
</p>

@component('mail::button', ['url' => url('/solicitud-servicio', [$servicio->SolSerSlug])])
Ver Solicitud
@endcomponent
<br>
<i>Durante los reversos hacia status anteriores a conciliado, los respectivos certificados, manifiestos y prefacturas son eliminados del sistema</i>
@endcomponent
