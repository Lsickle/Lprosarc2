@extends('layouts.app')
@section('htmlheader_title')
Prefactura {{$prefactura->ID_Prefactura}}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	Prefactura {{$prefactura->ID_Prefactura}}
	<div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<!-- Profile Image -->
				<div class="box box-info">
					<div class="box-body box-profile">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead style="background-color:#212529; color:#fff; font-weight: bold;">
									<tr>
										<td>Comercial</td>
										<td>Servicio</td>
										<td>Certificado</td>
										<td>RM</td>
										<td>EMPRESA</td>
										<td>PROCESO</td>
										<td>UNIDAD</td>
										<td>Residuo</td>
										<td>CANTIDAD</td>
										<td>tarifa</td>
										<td>Subtotal</td>
									</tr>
								</thead>
								<tbody>
									@foreach ($prefactura->prefacTratamiento as $prefactratamiento)
									@foreach ($prefactratamiento->prefacresiduo as $residuo)
									<tr>
										<td>{{$prefactura->comercial->PersFirstName}} {{$prefactura->comercial->PersLastName}}</td>
										<td>{{$prefactura->FK_Servicio}}</td>
										@if ($residuo->SolicitudResiduo->certdato->certificado->CertType == 0)
										<td>{{$residuo->SolicitudResiduo->certdato->certificado->CertNumero}}</td>
										@else
										<td>M {{$residuo->SolicitudResiduo->certdato->certificado->CertManifNumero}}</td>
										@endif
										<td>
											@foreach ($residuo->RMs as $rm => $value)
											{{$value}}<br>
											@endforeach
										</td>
										<td>{{$prefactura->cliente->CliName}}</td>
										<td>{{$prefactratamiento->tratamiento->TratName}}</td>
										<td>{{$residuo->unidad_respel}}</td>
										<td>{{$residuo->SolicitudResiduo->requerimiento->respel->RespelName}}</td>
										<td>{{$residuo->cantidad_respel}}</td>
										<td>{{$residuo->precio_tarifa}}</td>
										<td>{{$residuo->subtotal_respel}}</td>
									</tr>
									@endforeach
									@endforeach
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Transporte</td>
										<td>{{$prefactura->Costo_transporte}}</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Total</td>
										<td>{{$prefactura->Total_prefactura}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</div>
@endsection