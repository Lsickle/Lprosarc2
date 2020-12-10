@component('mail::message')

# Fecha de recepción Errada para la Solicitud de Servicio N° {{$email->ID_SolSer}}<br>

debe corregir la fecha de las programaciones de vehiculos relacionadas con este servicio, para que coincida con la fecha indicada

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i> <br>
    <h5 style="text-align: right">{{$Observacion->ObsUser}}</h5>
</p>


@component('mail::button', ['url' => url('/solicitud-servicio', [$email->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@endcomponent
