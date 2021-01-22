@component('mail::message')
# Residuo Actualizado

El residuo <b>{{$respel->RespelName}}</b> ha sido ACTUALIZADO por el Cliente <b>{{$respel['cliente']->CliName}} -> {{$respel['cliente']->SedeName}}</b> y debe ser revisado por el área de Operaciones para válidar la información modificada.<br><br>

Por favor revise la información del residuo, usando el siguiente botón<br><br>

@component('mail::button', ['url' => url('/respels', [$respel->RespelSlug])])
Ver Residuo
@endcomponent

Si tiene alguna duda comuníquese con el asesor comercial {{$respel['comercial']->PersFirstName.' '.$respel['comercial']->PersLastName}}. al teléfono {{$respel['comercial']->PersCellphone}} o con el personal del cliente usando los siguientes datos:<br>
<ul>
    <li>Nombre: {{$respel['personalcliente']->PersFirstName.' '.$respel['personalcliente']->PersLastName}} </li>
    <li>teléfono: {{$respel['personalcliente']->PersCellphone}}</li>
    <li>correo: {{$respel['personalcliente']->PersEmail}}</li>
</ul>
Saludos, Prosarc S.A. ESP.

@endcomponent
