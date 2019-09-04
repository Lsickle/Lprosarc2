@component('mail::message')
# Contratos cercanos a vencerce

Los siguientes contratos estan apunto de ser vencidos.<br><br><br>

@component('mail::table')
    | Clientes | Fecha de Vencimiento |
    | ---------- | ---------- |
    @foreach ($contratos as $contrato)
        | {{$contrato->CliShortname}} | {{$contrato->ContraVigencia}} |
    @endforeach
@endcomponent
<br><br>
@lang('Si desea ver más detalles diríjase a aplicación de SiReS en el apartado de "Contratos".')

@endcomponent