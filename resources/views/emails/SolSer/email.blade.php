{{-- @php
    $url = url("/solicitud-servicio/{$mail->SolSerSlug}");
    $nameButton = 'Ver Solicitud de Servicio';
@endphp --}}
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
            setlocale(LC_ALL, "es_CO.UTF-8");
			if(date('H', strtotime($mail->ProgVehSalida)) >= 12){
				$horas = " en las horas de la tarde";
            }else{
				$horas = " en las horas de la mañana";
            }
            $TextProgramacion = "el día ".strftime("%d", strtotime($mail->ProgVehSalida))." del mes de ".strftime("%B", strtotime($mail->ProgVehSalida)).$horas;
            $text = "ha sido Programada para $TextProgramacion";
        @endphp
        @break
    @case('Completado')
        @php
            $text = 'esta lista para realizar una conciliación... por favor revise los pesos y/o cantidades conciliadas en cada uno de los residuos, y luego use el boton (Conciliado) para dar inicio al tratamiento de los residuos';
        @endphp
        @break
    @case('No Conciliado')
        @php
            $text = " ha sido rechazada por el cliente $mail->CliName, ya que no esta de acuerdo con algunas de las cantidades enviadas a conciliación... se deben verificar las cantidades y enviar de nuevo a conciliación";
        @endphp
        @break
    @case('Conciliado')
        @php
            $text = "ha sido aceptada satisfactoriamente por el cliente $mail->CliName, según las cantidades enviadas a conciliación... esto permite dar inicio al registro de las cantidades tratadas para cada residuo de la solicitud de servicio";
        @endphp
        @break
    @case('Certificacion')
        @php
            $text = 'ha sido Certificada con éxito. esperamos que el proceso haya sido realizado a su entera satisfaccion, ¡Gracias por su preferencia!';
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

@component('mail::button', ['url' => url('/solicitud-servicio', [$mail->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@if ($mail->SolSerStatus === 'Conciliado' || $mail->SolSerStatus === 'No Conciliado')
    @php
        $end = 'Por favor dar click en el botón para ver más detalles.';
    @endphp
@else
    @php
        $end = 'Si tiene alguna duda no olvide comunicarse con su asesor comercial. Saludos, Prosarc S.A. ESP.';
    @endphp
@endif

{{$end}}

{{-- @component('mail::subcopy')
@lang(
    "Si tiene problemas para hacer clic en el botón \":actionText\", copie y pegue la siguiente URL \nen su navegador web: [:actionURL](:actionURL)",
    [
        'actionText' => $nameButton,
        'actionURL' => $url,
    ]
)
@endcomponent --}}
@endcomponent
