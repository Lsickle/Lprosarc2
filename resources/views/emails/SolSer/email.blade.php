@php
    $url = url("/solicitud-servicio/{$mail->SolSerSlug}");
    $nameButton = 'Ver Solicitud de Servicio';   
@endphp
@component('mail::message')
# Solicitud de Servicio N° {{$mail->ID_SolSer}}

@switch($mail->SolSerStatus)
    @case('Aprobado')
        @php
            $text = 'ha sido aprobada, ahora queda en espera para realizarle una programación';
        @endphp
        @break
    @case('Programado')
        @php
            setlocale(LC_TIME, "Spanish_Colombia");
			if(date('H', strtotime($mail->ProgVehFecha)) >= 12){
				$horas = " en las horas de la tarde";
            }else{
				$horas = " en las horas de la mañana";
            }
            $TextProgramacion = "el día ".strftime("%d", strtotime($mail->ProgVehFecha))." del mes de ".strftime("%B", strtotime($mail->ProgVehFecha)).$horas;
            $text = "ha sido Programada para $TextProgramacion";
        @endphp
        @break
    @case('Completado')
        @php
            $text = 'ha llegado a Prosarc S.A ESP, porfavor revise los pesos que han llegado a planta para poder tratar sus residuos';
        @endphp
        @break
    @case('No Conciliado')
        @php
            $text = "la ha rechazado el cliente $mail->CliName por desacuerdo en en los pesos de la solicitud";
        @endphp
        @break
    {{-- @case('Conciliado')
        @php
            $text = 'ha sido conciliada y ahora sus residuos estan listos para ser tratados';
        @endphp
        @break --}}
    {{-- @case('Tratado')
        @php
            $text ='ha sido tratada con exito solo falta la aprobacion para poder entregar su certificado';
        @endphp
        @break --}}
    @case('Certificacion')
        @php
            $text = 'ha sido Certificada con exíto, ahora podra ver su certificado en el botón de abajo. Gracias por escojernos y esperamos que vuelva';
        @endphp
        @break
@endswitch

En estos momentos la Solicitud de Servicio N° {{$mail->ID_SolSer}} {{$text}}

@component('mail::button', ['url' => $url])
{{$nameButton}}
@endcomponent
{{-- @if($mail->SolSerStatus <> 'No Conciliado')
    @php
        $end = 'Si tiene alguna duda no olvide comunicarse con su asesor comercial.Saludos, Prosarc S.A. ESP';
    @endphp
@else
    @php
        $end = 'Por favor dar clic en el botón "'.$nameButton.'" para ver más detalles';
    @endphp
@endif
{{$end}} --}}
Si tiene alguna duda no olvide comunicarse con su asesor comercial.Saludos, Prosarc S.A. ESP
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
