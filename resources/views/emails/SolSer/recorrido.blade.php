{{-- @php
    $url = url("/solicitud-servicio/{$email->SolSerSlug}");
    $nameButton = 'Ver Solicitud de Servicio';
@endphp --}}
@component('mail::message')
# Solicitud de Servicio N° {{$email->ID_SolSer}}

@switch($email->SolSerStatus)
    @case('Aprobado')
        @php
            $text = 'ha sido aprobada, ahora queda en espera para asignarle una programación';
        @endphp
        @break
    @case('Programado')
        @php
            setlocale(LC_ALL, "es_CO.UTF-8");
			if(date('H', strtotime($email->ProgVehSalida)) >= 12){
				$horas = " en el transcurso del día";
            }else{
				$horas = " en el transcurso del día";
            }
            $TextProgramacion = "el día ".strftime("%d", strtotime($email->ProgVehSalida))." del mes de ".strftime("%B", strtotime($email->ProgVehSalida)).$horas;
            $text = "ha sido Programada para $TextProgramacion";
        @endphp
        @break
    @case('Notificado')
        @php
            setlocale(LC_ALL, "es_CO.UTF-8");
            if(date('H', strtotime($email->ProgVehSalida)) >= 12){
                $horas = " en el transcurso del día";
            }else{
                $horas = " en el transcurso del día";
            }
            $TextProgramacion = "el día ".strftime("%d", strtotime($email->ProgVehSalida))." del mes de ".strftime("%B", strtotime($email->ProgVehSalida)).$horas;
            $text = "ha sido Programada para $TextProgramacion";
        @endphp
        @break
    @case('Cerrada')
        @php
            setlocale(LC_ALL, "es_CO.UTF-8");
            if(date('H', strtotime($email->ProgVehSalida)) >= 12){
                $horas = " en el transcurso del día";
            }else{
                $horas = " en el transcurso del día";
            }
            $TextProgramacion = "el día ".strftime("%d", strtotime($email->ProgVehSalida))." del mes de ".strftime("%B", strtotime($email->ProgVehSalida)).$horas;
            $text = "ha sido Programada para $TextProgramacion";
        @endphp
        @break
    @case('Completado')
        @php
            $text = "esta lista para realizar una conciliación, el cliente $email->CliName, debe revisar los pesos y/o cantidades conciliadas en cada uno de los residuos, y luego usar el botón (Conciliado) para dar inicio al tratamiento de los residuos";
        @endphp
        @break
    @case('No Conciliado')
        @php
            $text = " ha sido rechazada por el cliente $email->CliName, ya que no esta de acuerdo con algunas de las cantidades enviadas a conciliación... se deben verificar las cantidades y enviar de nuevo a conciliación";
        @endphp
        @break
    @case('Conciliado')
        @php
            $text = "ha sido Conciliada por Prosarc S.A. ESP, según las cantidades recibidas... esto permite dar inicio al proceso de tratamiento y certificación para cada residuo de la solicitud de servicio";
        @endphp
        @break
    @case('Corregido')
        @php
            $text = "ha sido corregida en las cantidades conciliadas de los residuos que correspondan según previa convesación con el cliente: $email->CliName. el cual deberá revisar los pesos y/o cantidades conciliadas en cada uno de los residuos y luego use el botón (Conciliado) para dar inicio al tratamiento y certificación del servicio";
        @endphp
        @break
    @case('Certificacion')
        @php
            $text = 'ha sido Certificada con éxito. esperamos que el proceso haya sido realizado a su entera satisfacción, ¡Gracias por su preferencia!';
        @endphp
        @break  
    @case('Residuo Faltante')
        @php
            $text = 'Se han recibido residuos que NO están declarados. Por favor ingrese a la solicitud y agregue los residuos, con sus respectivas cantidades, de acuerdo a las siguientes observaciones';
        @endphp
        @break
@endswitch

En estos momentos la Solicitud de Servicio N° {{$email->ID_SolSer}} {{$text}}.<br>

@switch($email->SolSerStatus)
@case('Aprobado')
# Observaciones del Cliente: 
@break

@case('Programado')
@case('Corregido')
@case('Notificado')
@case('Cerrada')
# Observaciones de Logistica
@break

@case('Completado')
@case('Residuo Faltante')
# Observaciones de RecepciónPDA
@break

@case('Conciliado')
# Observaciones Gerente Planta:
@break

@case('No Conciliado')
# Observaciones del Cliente: 
@break

@case('Certificacion')
# Observaciones de Prosarc S.A.ESP: 
@break

@default
# Observaciones
@endswitch

<p style="background-color:#f0f3f8;"><i>{!!nl2br($email->SolSerDescript)!!}</i></p>

@if ($email->SolSerStatus === 'No Conciliado')

@lang("Puede comunicarse con:")<br>

***@lang("Nombre: ")***{{$email->PersFirstName}} {{$email->PersLastName}}<br>

***@lang("E-mail: ")***{{$email->PersEmail}}<br>
@endif

@component('mail::button', ['url' => url('/solicitud-servicio', [$email->SolSerSlug])])
{{-- {{$nameButton}} --}}
Ver Solicitud
@endcomponent

@if ($email->SolSerStatus === 'Residuo Faltante')
@php
    $instruccion = 'En caso de NO tener el residuo registrado en la aplicación SisPRO, puede seguir los siguientes tutoriales para agregar el residuo y luego de la aprobación incluirlo en el servicio:';
    $end = 'Si tiene alguna duda no olvide comunicarse con su asesor comercial. Saludos, Prosarc S.A. ESP.';
@endphp
{{$instruccion}}

@component('mail::button', ['url' => url('https://www.youtube.com/watch?v=sZ5thp264nU')])
{{-- {{$nameButton}} --}}
Crear Residuo
@endcomponent

@component('mail::button', ['url' => url('https://www.youtube.com/watch?v=KNHrI2oM88A')])
{{-- {{$nameButton}} --}}
Relación Residuo/Generador
@endcomponent
@endif

@if ($email->SolSerStatus === 'Conciliado' || $email->SolSerStatus === 'No Conciliado')
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
