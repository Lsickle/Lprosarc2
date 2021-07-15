@component('mail::message')
# Prefactura emitida

@foreach ($prefacturas as $prefactura)
@if ($loop->first)
El Comercial {{$prefactura->comercial->PersFirstName}} {{$prefactura->comercial->PersLastName}} ha emitido {{$prefacturas->count()}} prefactura
@endif
@endforeach

{{-- @component('mail::table')

@foreach ($prefacturas as $prefactura)
|*Servicio*|*Certificado*|*RM*|*FECHA*|*EMPRESA*|*CANTIDAD*|*PROCESO*|*SUBTOTAL*|*OrdenCompra*|
|---|---|---|---|---|---|---|---|---|
@foreach ($prefactura->prefacTratamiento as $tratamiento)
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
|{{$prefactura->FK_Servicio}}|@foreach (array_unique($certificadosdeTratamiento) as $certnumber){{$certnumber}}<br>@endforeach|@foreach (json_decode($tratamiento->RMs) as $rm => $value){{$value}}<br>@endforeach|{{$prefactura->Fecha_Servicio}}|{{$prefactura->cliente->CliName}}|{{$tratamiento->cantidad_tratamiento}}|{{$tratamiento->tratamiento->TratName}}|{{$tratamiento->Total_prefactratamiento}}|{{$prefactura->orden_compra}}</tr>
@endforeach
|{{$prefactura->FK_Servicio}}| | | |{{$prefactura->Fecha_Servicio}}|{{$prefactura->cliente->CliName}}| |Transporte|{{$prefactura->Costo_transporte}}|</tr>
|{{$prefactura->FK_Servicio}}| | | |{{$prefactura->Fecha_Servicio}}|{{$prefactura->cliente->CliName}}| |Total|{{$prefactura->Total_prefactura}}|<a method='get' href='{{route('prefacturas.show', ['prefactura' => $prefactura])}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></tr>
@endforeach
@endcomponent --}}

<table class="table table-hover" style="word-wrap: break-word; margin-left: auto; margin-right: auto;">
    <thead style="background-color:#212529; color:#fff; font-weight: bold; text-align: center;">
        <tr>
            <td>Servicio</td>
            <td>Certificado</td>
            <td>RM</td>
            <td>FECHA</td>
            <td>EMPRESA</td>
            <td>CANTIDAD</td>
            <td>PROCESO</td>
            <td>SUBTOTAL</td>
            <td>OrdenCompra</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($prefacturas as $prefactura)
        @if (!$loop->first)
        <tr style="background-color:#212529; color:#fff; font-weight: bold; text-align: center;">
            <td>Servicio</td>
            <td>Certificado</td>
            <td>RM</td>
            <td>FECHA</td>
            <td>EMPRESA</td>
            <td>CANTIDAD</td>
            <td>PROCESO</td>
            <td>SUBTOTAL</td>
            <td>OrdenCompra</td>
        </tr>
        @endif
        @foreach ($prefactura->prefacTratamiento as $tratamiento)
        <tr>
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
            <td style="text-align: right;">{{$tratamiento->cantidad_tratamiento}}</td>
            <td>{{$tratamiento->tratamiento->TratName}}</td>
            <td style="text-align: right;">{{$tratamiento->Total_prefactratamiento}}</td>
            <td style="text-align: center;">{{$prefactura->orden_compra}}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Transporte</td>
            <td style="text-align: right;">{{$prefactura->Costo_transporte}}</td>
            <td></td>
        </tr>
        <tr style="background-color:#eaeaea;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
            <td style="text-align: right;">{{$prefactura->Total_prefactura}}</td>
            <td style="height: fit-content">
                <a href="{{route('prefacturas.show', ['prefactura' => $prefactura])}}" class="button button-primary" target="_blank" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #fff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3490dc; border-top: 10px solid #3490dc; border-right: 18px solid #3490dc; border-bottom: 10px solid #3490dc; border-left: 18px solid #3490dc;">Ver detalles</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

Para Cualquier detalle adicional comunicarse con el asesor comercial Correspondiente,<br>
{{ config('app.name') }}
@endcomponent
