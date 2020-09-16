
@component('mail::message')

En estos momentos el residuo <b>{{$respel->RespelName}}</b> ha sido revisado por <b>Prosarc S.A.ESP</b>
y su status se ha cambiado a <b>Incompleto</b>. Con la siguiente información

<b>Observación:</b>{{$respel->RespelStatusDescription}}

Por favor revise la información del residuo usando el siguiente botón<br>

@component('mail::button', ['url' => url('/respels', [$respel->RespelSlug])])
Ver Residuo
@endcomponent

Si tiene alguna duda no olvide comunicarse con su asesor comercial.<br>
Saludos, Prosarc S.A. ESP.

@endcomponent
