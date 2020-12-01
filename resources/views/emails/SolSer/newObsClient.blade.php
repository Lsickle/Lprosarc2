@component('mail::message')

# Nueva observacion del cliente para la Solicitud de Servicio N° {{$email->ID_SolSer}}<br>

# Observaciones de /*validacion del emisor*/RecepciónPDA

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i></p>

@component('mail::button', ['url' => url('/solicitud-servicio', [$email->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@endcomponent
