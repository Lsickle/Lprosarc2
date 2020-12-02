@component('mail::message')

# Nueva observacion para la Solicitud de Servicio N° {{$email->ID_SolSer}}<br>

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i></p>

# {{$Observacion->ObsUser}}

@component('mail::button', ['url' => url('/solicitud-servicio', [$email->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@endcomponent
