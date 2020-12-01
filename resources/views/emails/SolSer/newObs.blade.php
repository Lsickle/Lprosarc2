@component('mail::message')

# Nueva observacion para la Solicitud de Servicio N° {{$email->ID_SolSer}}<br>

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i></p>
<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i></p>

@component('mail::button', ['url' => url('/solicitud-servicio', [$email->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@endcomponent
