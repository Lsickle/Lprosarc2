{{-- @php
    $url = url("/solicitud-servicio/{$SolicitudServicio->SolSerSlug}");
    $nameButton = 'Ver Solicitud de Servicio';
@endphp --}}
@component('mail::message')
# Solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}}

@php
$text = "ha sido modificada por el cliente ".$SolicitudServicio['cliente']->CliName." para añadir los residuos faltantes, nuestra área logística estará revisando las cantidades correspondiente para ingresarlas como recibidas en la aplicación SisPRO";
@endphp

En estos momentos la Solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}} {{$text}}.<br>

# Observaciones del Cliente:

<p style="background-color:#f0f3f8;"><i>{!!nl2br($SolicitudServicio->SolSerDescript)!!}</i></p>

@lang("Puede comunicarse con:")<br>

***@lang("Nombre: ")***{{$SolicitudServicio['personalcliente']->PersFirstName}} {{$SolicitudServicio['personalcliente']->PersLastName}}<br>

***@lang("E-mail: ")***{{$SolicitudServicio['personalcliente']->PersEmail}}<br>

***@lang("N° Celular: ")***{{$SolicitudServicio['personalcliente']->PersCellphone}}<br>

@component('mail::button', ['url' => url('/solicitud-servicio', [$SolicitudServicio->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@php
$end = 'Click en el botón para más detalles.';
@endphp

{{$end}}

@endcomponent