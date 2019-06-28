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
            $text = 'esta lista para realizar una conciliación, por favor revise los pesos y/o cantidades de los residuos, para poder tratarlos';
        @endphp
        @break
    @case('No Conciliado')
        @php
            $text = "la ha rechazado el cliente $mail->CliName";
        @endphp
        @break
    @case('Conciliado')
        @php
            $text = "ha aceptado la conciliación satisfactoriamente el cliente $mail->CliName ";
        @endphp
        @break
    @case('Certificacion')
        @php
            $text = 'ha sido Certificada con éxito. Gracias por escogernos y esperamos que vuelva';
        @endphp
        @break
@endswitch

En estos momentos la Solicitud de Servicio N° {{$mail->ID_SolSer}} {{$text}}.<br>

@if ($mail->SolSerStatus === 'No Conciliado')
## @lang('¿Por qué?')

*@lang($mail->SolSerDescript)*<br><br>

@lang("Puede comunicarse con:")<br>

***@lang("Nombre: ")***{{$mail->PersFirstName}} {{$mail->PersLastName}}<br>

***@lang("E-mail: ")***{{$mail->PersEmail}}<br>
@endif

@component('mail::button', ['url' => $url])
{{$nameButton}}
@endcomponent

@if ($mail->SolSerStatus === 'Conciliado' || $mail->SolSerStatus === 'No Conciliado')
    @php
        $end = 'Por favor dar clic en el botón "'.$nameButton.'" para ver más detalles.';
    @endphp
@else
    @php
        $end = 'Si tiene alguna duda no olvide comunicarse con su asesor comercial. Saludos, Prosarc S.A. ESP.';
    @endphp
@endif

{{$end}}

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
