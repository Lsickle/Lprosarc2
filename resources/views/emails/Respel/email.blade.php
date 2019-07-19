@php
    $url = url("/respels/{$respel->RespelSlug}");
    $nameButton = 'Ver Residuo';
@endphp
@component('mail::message')
# El residuo {{$respel->RespelName}} ha sido Aprobado

En estos momentos el residuo {{$respel->RespelName}} ha sido aprobado 
y ahora podra utilizarlo para sus Solicitudes de Servicios.

@component('mail::button', ['url' => $url])
{{$nameButton}}
@endcomponent

Si tiene alguna duda no olvide comunicarse con su asesor comercial.<br>
Saludos, Prosarc S.A. ESP.

@component('mail::subcopy')
@lang(
    "Si tiene problemas para hacer clic en el botón \":actionText\", copie y pegue la siguiente URL \nen su navegador web: [:actionURL](:actionURL)",
    [
        'actionText' => $nameButton,
        'actionURL' => $url,
    ]
)
@endcomponent
@endcomponent
