@component('mail::message')
# Parafiscales

Se envian datos del personal para el ingreso a sus instalaciones 
<br>(ver documentos adjuntos)

@component('mail::button', ['url' => url('/solicitud-servicio', [$email->SolSerSlug])])
Ver Solicitud de servicio
@endcomponent

Saludos, <br>Prosarc S.A. ESP.
@endcomponent
