@component('mail::message')
# Introduction

The body of your message.

|Comercial|Servicio|Certificado|RM|FECHA|EMPRESA|CANTIDAD|PROCESO|SUBTOTAL|OrdenCompra|
|---|---|---|---|---|---|---|---|---|---|---|---|
| | | | | | | | | | | | |
| | | | | | | | | | | | |
| | | | | | | | | | | | |
{{-- <table class="table table-hover">
    <thead style="background-color:#212529; color:#fff; font-weight: bold;">
        <tr>
            </tr>
    </thead>
    <tbody>
        @foreach ($prefacturas as $prefactura)
        <tr style="background-color:#212529; color:#fff">
            <td>{{$prefactura->comercial->PersFirstName}} {{$prefactura->comercial->PersLastName}}</td>
            <td>{{$prefactura->FK_Servicio}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($prefactura->prefacTratamiento as $tratamiento)
        <tr>
            <td>{{$prefactura->comercial->PersFirstName}} {{$prefactura->comercial->PersLastName}}</td>
            <td>{{$prefactura->FK_Servicio}}</td>
            <td>
                @php
                $certificadosdeTratamiento = [];
                @endphp
                @foreach ($tratamiento->prefacresiduo as $residuo)
                @if ($residuo->SolicitudResiduo->certdato->certificado->CertType == 0)
                @php
                array_push($certificadosdeTratamiento, $residuo->SolicitudResiduo->certdato->certificado->CertNumero);
                @endphp
                @else
                @php
                array_push($certificadosdeTratamiento, "M-".$residuo->SolicitudResiduo->certdato->certificado->CertManifNumero);
                @endphp
                @endif
                @endforeach
                @foreach (array_unique($certificadosdeTratamiento) as $certnumber)
                {{$certnumber}}
                <br>
                @endforeach
            </td>
            <td>
                @foreach (json_decode($tratamiento->RMs) as $rm => $value)
                {{$value}}<br>
                @endforeach
            </td>
            <td>{{$prefactura->Fecha_Servicio}}</td>
            <td>{{$prefactura->cliente->CliName}}</td>
            <td>{{$tratamiento->cantidad_tratamiento}}</td>
            <td>{{$tratamiento->tratamiento->TratName}}</td>
            <td>{{$tratamiento->Total_prefactratamiento}}</td>
            <td>{{$prefactura->orden_compra}}</td>
        </tr>
        @endforeach
        <tr>
            <td>{{$prefactura->comercial->PersFirstName}} {{$prefactura->comercial->PersLastName}}</td>
            <td>{{$prefactura->FK_Servicio}}</td>
            <td></td>
            <td></td>
            <td>{{$prefactura->Fecha_Servicio}}</td>
            <td>{{$prefactura->cliente->CliName}}</td>
            <td></td>
            <td>Transporte</td>
            <td>{{$prefactura->Costo_transporte}}</td>
            <td></td>
        </tr>
        <tr style="background-color:#eaeaea;">
            <td>{{$prefactura->comercial->PersFirstName}} {{$prefactura->comercial->PersLastName}}</td>
            <td>{{$prefactura->FK_Servicio}}</td>
            <td></td>
            <td></td>
            <td>{{$prefactura->Fecha_Servicio}}</td>
            <td>{{$prefactura->cliente->CliName}}</td>
            <td></td>
            <td>Total</td>
            <td>{{$prefactura->Total_prefactura}}</td>
            <td><a method='get' href='{{route('prefacturas.show', ['prefactura' => $prefactura])}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table> --}}
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
