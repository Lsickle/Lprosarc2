@component('mail::message')

# Recordatorio de conciliación<br>

la Solicitud de Servicio N° {{$email->ID_SolSer}} esta lista para realizar una conciliación, el cliente {{$email->CliName}}, debe revisar los
pesos y/o cantidades conciliadas en cada uno de los residuos, y luego usar el botón (Conciliado) para dar inicio al
tratamiento de los residuos.

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i> <br> <h5 style="text-align: right">{{$Observacion->ObsUser}}</h5> </p>


@component('mail::button', ['url' => url('/solicitud-servicio', [$email->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@endcomponent
