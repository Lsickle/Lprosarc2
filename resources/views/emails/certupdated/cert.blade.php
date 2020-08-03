@component('mail::message')
# Certificado N° {{$certificado->ID_Cert}}

El personal de logistica ha cargado un nuevo certificado en la aplicacion <b>SisPRO</b> correspondiente al servicio N° {{$certificado->FK_CertSolser}}<br> <br>

@component('mail::button', ['url' => url('img/Certificados/'.$certificado->CertSlug.'.pdf')])
Ver Certificado
@endcomponent

Luego de revisar el documento puede utilizar el botón a continuación para autorizarlo

@component('mail::button', ['url' => url('/certificados'.'/'.$certificado->CertSlug.'/firmar'.'/'.$servicio->SolSerSlug)])
Firmar Certificado
@endcomponent

Saludos
@endcomponent