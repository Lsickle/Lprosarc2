@extends('layouts.app')
@section('htmlheader_title')
Prefacturas
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	Prefacturas
	<div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Lista de Prefacturas</h3>
					
				</div>
				<div class="box box-info">
					<div class="box-body">
						{{-- <table id="PersonalsTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Cliente</th>
									<th>Servicio</th>
									<th>Recepción</th>
									<th>Comercial</th>
									<th>OrdenCompra</th>
									<th>Total</th>
									<th>Status</th>
									<th>Ver</th>
								</tr>
							</thead>
							<tbody id="prefacturasTable">
								@foreach($prefacturas as $prefactura)
								<tr style="{{$prefactura->deleted_at !== null ? 'color: red' : ''}}">
									<td>{{$prefactura->ID_Prefactura}}</td>
									<td>{{$prefactura->cliente->CliName}}</td>
									<td>{{$prefactura->FK_Servicio}}</td>
									<td>{{$prefactura->Fecha_Servicio}}</td>
									<td>{{$prefactura->comercial->PersFirstName.' '.$prefactura->comercial->PersLastName}}</td>
									<td>{{$prefactura->orden_compra}}</td>
									<td>{{$prefactura->Total_prefactura}}</td>
									<td>{{$prefactura->status_prefactura}}</td>
									<td><a method='get' href='{{route('prefacturas.show', ['prefactura' => $prefactura])}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table> --}}
						<table class="table table-hover">
							<thead style="background-color:#212529; color:#fff; font-weight: bold;">
								<tr>
									<td>Comercial</td>
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
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection