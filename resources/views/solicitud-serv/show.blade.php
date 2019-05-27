@extends('layouts.app')
@section('htmlheader_title')
Solicitud de Servicios
@endsection
@section('contentheader_title')
Servicio {{-- {{$Servicio->ID_SolSer}} --}}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
@foreach($SolicitudServicio as $Servicio)
@component('layouts.partials.modal')
	{{$Servicio->SolSerSlug}}
@endcomponent
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="text-aline-center">
					<div class="box-header with-border">
						<div class="col-md-12">
							@if($Servicio->SolSerDelete == 0)
								<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Servicio->SolSerSlug}}' class='btn btn-danger' style="float: right;">Eliminar</a>
								<form action='/solicitud-servicio/{{$Servicio->SolSerSlug}}' method='POST'>
									@method('DELETE')
									@csrf
									<input  type="submit" id="Eliminar{{$Servicio->SolSerSlug}}" style="display: none;">
								</form>
							@else
								<form action='/solicitud-servicio/{{$Servicio->SolSerSlug}}' method='POST' style="float: right;">
									@method('DELETE')
									@csrf
									<input type="submit" class='btn btn-success' value="Añadir">
								</form>
							@endif
							<a href="/solicitud-servicio/{{$Servicio->SolSerSlug}}/edit" class="btn btn-warning">Editar</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="col-md-12">
								</div>
								<div class="col-md-5">
									<label>Fecha: </label>
									<span>{{date('Y-m-d',strtotime($Servicio->created_at))}}</span>
								</div>
								<div class="col-md-3">
									<label>N° - {{$Servicio->ID_SolSer}}</label>
								</div>
								<div class="col-md-4">
									<label>Auditable: </label>
									@if($Servicio->SolSerAuditable == 0)
										<span>No</span>
									@else
										<span>Si</span>
									@endif
								</div>
								<div class="col-md-6">
									<label>Empresa: </label>
									<span>{{$Servicio->CliName}}</span>
								</div>
								<div class="col-md-6">
									<label>Dirección: </label>
									<span>{{$Servicio->SedeAddress}}</span>
								</div>
								<div class="col-md-6">
									<label>Nit: </label>
									<span>{{$Servicio->CliNit}}</span>
								</div>
								<div class="col-md-6">
									<label>Ciudad: </label>
									<span>{{$Servicio->MunName}}</span>
								</div>
								<div class="col-md-6">
									<label>Persona Acargo: </label>
									<span>{{$Servicio->PersFirstName.' '.$Servicio->PersLastName}}</span>
								</div>
								<div class="col-md-6">
									<label>Email: </label>
									<span>{{$Servicio->PersAddress}}</span>
								</div>
								<div class="col-md-6">
									<label>Empresa Transportadora: </label>
									<span>{{$Servicio->SolSerNameTrans}}</span>
								</div>
								<div class="col-md-6">
									<label>Dirreción: </label>
									<span>{{$Servicio->SolSerAdressTrans}}</span>
								</div>
								<div class="col-md-6">
									<label>Nit: </label>
									<span>{{$Servicio->SolSerNitTrans}}</span>
								</div>
								<div class="col-md-6">
									<label>Ciudad: </label>
									<span>{{$Servicio->SolSerCityTrans}}</span>
								</div>
								<div class="col-md-6">
									<label>Conductor: </label>
									<span>{{$Servicio->SolSerConductor}}</span>
								</div>
								<div class="col-md-6">
									<label>Vehiculo: </label>
									<span>{{$Servicio->SolSerVehiculo}}</span>
								</div>
								<table class="table table-compact table-bordered table-striped SolResTable">
									@foreach($GenerResiduos as $GenerResiduo)
												<?php $Total = 0;?>
										<thead>
											<tr>
												<th colspan="6"></th>
											</tr>
											<tr>
												<th colspan="3">Empresa: {{$GenerResiduo->GenerName}}</th>
												<th colspan="3">Dirección: {{$GenerResiduo->GSedeAddress}}</th>
											</tr>
											<tr>
												<th colspan="3">Nit: {{$GenerResiduo->GenerNit}}</th>
												<th colspan="3">Ciudad: {{$GenerResiduo->MunName}}</th>
											</tr>
											<tr>
												<th>Unidades</th>
												<th>Residuo</th>
												<th>Descripción</th>
												<th>Tipo de Cantidad</th>
												<th>Cantidad Enviada Kg</th>
												<th>Clasificación</th>
												<th>Ver Más</th>
											</tr>
										</thead>
										<tbody>
											@foreach($Residuos as $Residuo)
												@if($Residuo->FK_SGener == $GenerResiduo->FK_SGener)
													<?php $Total = $Residuo->SolResCateEnviado+$Total;?>
													<tr>
														<td>{{$Residuo->SolResUnidades}}</td>
														<td>{{$Residuo->RespelName}}</td>
														<td>{{$Residuo->RespelDescrip}}</td>
														<td>{{$Residuo->SolResTipoCate}}</td>
														<td>{{$Residuo->SolResCateEnviado}}</td>
														<td>{{$Residuo->YRespelClasf4741.'-'.$Residuo->ARespelClasf4741}}</td>
														<td><a href='/respels/{{$Residuo->RespelSlug}}' class='btn btn-block btn-success'>Ver Más</a></td>
													</tr>
												@endif
											@endforeach
										</tbody>
										<thead>
											<tr>
												<th colspan="4">Cantidad Total Enviada</th>
												<th>{{$Total.' '}}Kg</th>
												<th colspan="2"></th>
											</tr>
										</thead>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach
@endsection