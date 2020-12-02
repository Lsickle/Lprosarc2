@component('mail::message')

# Nueva observación para la Solicitud de Servicio N° {{$email->ID_SolSer}}<br>

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i> <br> <h5 style="text-align: right">{{$Observacion->ObsUser}}</h5> </p>



@component('mail::button', ['url' => url('/solicitud-servicio', [$email->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@endcomponent
