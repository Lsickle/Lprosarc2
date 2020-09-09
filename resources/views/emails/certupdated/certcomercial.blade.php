@switch($certificado->CertType)
    @case(0)
        @php
            $text1 = '# Certificado N° '.$certificado->CertNumero;
        
            $text2 = 'El personal de logistica ha cargado un nuevo certificado en la aplicacion SisPRO correspondiente al servicio N°'.$certificado->FK_CertSolser;
            
            $url = 'img/Certificados/'.$certificado->CertSlug.'.pdf';

            $text3 = 'Ver Certificado';
        @endphp
        @break
    @case(1)
        @php
            $text1 = '# Manifiesto N° '.$certificado->CertManifNumero;
        
            $text2 = 'El personal de logistica ha cargado un nuevo manifiesto en la aplicacion SisPRO correspondiente al servicio N°'.$certificado->FK_CertSolser;
            
            $url = 'img/Manifiestos/'.$certificado->CertSlug.'.pdf';

            $text3 = 'Ver Manifiesto';
        @endphp
        @break
    @case(2)
        @php
            $text1 = '# Manifiesto N° '.$certificado->CertNumeroExt;
        
            $text2 = 'El personal de logistica ha cargado un nuevo certificado externo en la aplicacion SisPRO correspondiente al servicio N°'.$certificado->FK_CertSolser;
            
            $url = 'img/CertificadosEXT/'.$certificado->CertSlug.'.pdf';

            $text3 = 'Ver Certificado Externo';
        @endphp
        @break
    @default

@endswitch

@component('mail::message')

{{$text1}}

{{$text2}}


@component('mail::button', ['url' => url($url)])
{{$text3}}
@endcomponent

{{-- Luego de revisar el documento puede utilizar el botón a continuación para autorizarlo

@component('mail::button', ['url' => url('/certificados'.'/'.$certificado->CertSlug.'/firmar'.'/'.$servicio->SolSerSlug)])
Firmar Certificado
@endcomponent --}}

Saludos
@endcomponent