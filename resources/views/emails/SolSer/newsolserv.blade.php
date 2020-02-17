@component('mail::message')
# Solicitud de Servicio N° {{$SolicitudServicio->ID_SolSer}}

El cliente {{$SolicitudServicio['cliente']->CliName}} ha creado una nueva Solicitud de Servicio para detalles adicionales comuniquese con la persona de contacto con los siguientes datos:<br>
<ul>
    <li>Nombre: {{$SolicitudServicio['personalcliente']->PersFirstName.' '.$SolicitudServicio['personalcliente']->PersLastName}} </li>
    <li>teléfono: {{$SolicitudServicio['personalcliente']->PersCellphone}}</li>
    <li>correo: {{$SolicitudServicio['personalcliente']->PersEmail}}</li>
</ul>

@component('mail::button', ['url' => '/solicitud-servicio', [$SolicitudServicio->SolSerSlug]])
Ver Servicio
@endcomponent

Saludos
@endcomponent