@component('mail::message')
@php
setlocale(LC_ALL, "es_CO.UTF-8");
if(date('H', strtotime($email->ProgVehSalida)) >= 12){
$horas = " en las horas de la tarde";
}else{
$horas = " en las horas de la mañana";
}
$TextProgramacion = "el día ".strftime("%d", strtotime($email->ProgVehSalida))." del mes de ".strftime("%B", strtotime($email->ProgVehSalida)).$horas;
$text = "ha sido Programada para $TextProgramacion";
@endphp
# La solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}} programada para {{$TextProgramacion}} contiene las siguientes sustancias controladas

@component('mail::table')
| Residuo | Tipo | Nombre |
| :------------- | :------------: | --------: |
@foreach ($SolicitudServicio->SolicitudResiduo as $value)
@if ($value->requerimiento->respel->SustanciaControlada == 1)
| {{$value->requerimiento->respel->RespelName}} | {{$value->requerimiento->respel->SustanciaControladaNombre == 1 ? 'Uso Masivo' : 'Controlada'}} | {{$value->requerimiento->respel->SustanciaControladaNombre}} |
@endif
@endforeach
@endcomponent


Para detalles adicionales comuniquese con la persona de contacto con los siguientes datos:<br>
<ul>
    <li>Nombre: {{$email->PersFirstName.' '.$email->PersLastName}} </li>
    <li>teléfono: {{$email->PersCellphone}}</li>
    <li>correo: {{$email->PersEmail}}</li>
</ul>
<br>
# Observaciones:

<p style="background-color:#f0f3f8;"><i>{!!nl2br($SolicitudServicio->SolSerDescript)!!}</i></p>



@component('mail::button', ['url' => url('/solicitud-servicio', [$SolicitudServicio->SolSerSlug])])
Ver Solicitud de Servicio
@endcomponent

Saludos
@endcomponent