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
								<a href="/solicitud-servicio/{{$Servicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
								@if($Servicio->SolSerDelete == 0)
									<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Servicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
									<form action='/solicitud-servicio/{{$Servicio->SolSerSlug}}' method='POST'>
										@method('DELETE')
										@csrf
										<input type="submit" id="Eliminar{{$Servicio->SolSerSlug}}" style="display: none;">
									</form>
								@else
									<form action='/solicitud-servicio/{{$Servicio->SolSerSlug}}' method='POST' style="float: left;">
										@method('DELETE')
										@csrf
										<input type="submit" class='btn btn-success' value="Añadir">
									</form>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 ">
								<div class="box box-info">
									<div class="col-md-12" style="margin-top: 20px; border-bottom:#f4f4f4 solid 2px;">
										<div class="col-md-4">
											<label>Fecha: </label>
											<span>{{date('Y-m-d',strtotime($Servicio->created_at))}}</span>
										</div>
										<div class="col-md-4">
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
										<hr>													
									</div>	
									<div class="col-md-12 border-gray">
										<div class="col-md-6">
											<label>Empresa: </label><br>
											<a href="#" class="textpopover popover-left" style="text-align: left !important; width:100%" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Servicio->CliName}}</p>">{{$Servicio->CliName}}</a>

											{{-- <a>{{$Servicio->CliName}}</a> --}}
										</div>
										<div class="col-md-6">
											<label>Nit: </label><br>
											<a >{{$Servicio->CliNit}}</a>
										</div>
										
									</div>
									<div class="col-md-12 border-gray">
										<div class="col-md-6">
											<label>Dirección: </label><br>
											<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Servicio->SedeAddress}}</p>">{{$Servicio->SedeAddress}}</a>
										</div>
										<div class="col-md-6">
											<label>Ciudad: </label><br>
											<a>{{$Servicio->MunName}}</a>
										</div>
									</div>
									<div class="col-md-12 border-gray">
										<div class="col-md-6">
											<label>Persona Acargo: </label><br>
											<a>{{$Servicio->PersFirstName.' '.$Servicio->PersLastName}}</a>
										</div>
										<div class="col-md-6">
											<label>Email: </label><br>
											<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Servicio->PersAddress}}</p>">{{$Servicio->PersAddress}}</a>
										</div>
									</div>
									<div class="col-md-12 border-gray">
										<div class="col-md-6">
											<label>Empresa Transportadora: </label><br>
											<a href="#" class="textpopover popover-left" style="text-align: left;" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Servicio->SolSerNameTrans}}</p>">{{$Servicio->SolSerNameTrans}}</a>

											<a>{{$Servicio->SolSerNameTrans}}</a>
										</div>
										<div class="col-md-6">
											<label>Nit: </label><br>
											<a>{{$Servicio->SolSerNitTrans}}</a>
										</div>
									</div>
									<div class="col-md-12 border-gray">
										<div class="col-md-6">
											<label>Dirreción:</label><br>
											<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Servicio->SolSerAdressTrans}}</p>">{{$Servicio->SolSerAdressTrans}}</a>
										</div>
										<div class="col-md-6">
											<label>Ciudad: </label><br>
											<a>{{$Servicio->SolSerCityTrans}}</a>
										</div>
									</div>
									<div class="col-md-12 border-gray">
										<div class="col-md-6">
											<label>Conductor: </label><br>
											<a>{{$Servicio->SolSerConductor}}</a>
										</div>
										<div class="col-md-6">
											<label>Vehiculo: </label><br>
											<a>{{$Servicio->SolSerVehiculo}}</a>
										</div>
									</div>
									<div class="col-md-12" style="border-top:#00c0ef solid 3px; padding-top: 20px;">
										<table class="table table-compact table-bordered table-striped SolResTable">
											@foreach($GenerResiduos as $GenerResiduo)
														<?php $Total = 0;?>
												<thead>
													<tr>
														<th colspan="8"></th>
													</tr>
													<tr>
														<th colspan="4">Empresa: {{$GenerResiduo->GenerName}}</th>
														<th colspan="4">Dirección: {{$GenerResiduo->GSedeAddress}}</th>
													</tr>
													<tr>
														<th colspan="4">Nit: {{$GenerResiduo->GenerNit}}</th>
														<th colspan="4">Ciudad: {{$GenerResiduo->MunName}}</th>
													</tr>
													<tr>
														<th>Unidades</th>
														<th>Residuo</th>
														<th>Descripción</th>
														<th>Tipo de Cantidad</th>
														<th>Cantidad Enviada Kg</th>
														<th>Clasificación</th>
														<th>Ver Residuo</th>
														<th>Ver Recursos</th>
													</tr>
												</thead>
												<tbody>
													@foreach($Residuos as $Residuo)
														@if($Residuo->FK_SGener == $GenerResiduo->FK_SGener)
														@php
															$Total = $Residuo->SolResKgEnviado+$Total;
														@endphp
															<tr>
																<td>{{$Residuo->SolResCantiUnidad}}</td>
																<td>{{$Residuo->RespelName}}</td>
																<td>{{$Residuo->RespelDescrip}}</td>
																<td>{{$Residuo->SolResTypeUnidad}}</td>
																<td>{{$Residuo->SolResKgEnviado}}</td>
																<td>{{$Residuo->YRespelClasf4741.' - '.$Residuo->ARespelClasf4741}}</td>
																<td><a href='/respels/{{$Residuo->RespelSlug}}' class='btn btn-block btn-primary'><i class="fas fa-biohazard"></i></a></td>
																<td><a href='/respels/{{$Residuo->RespelSlug}}' class='btn btn-block btn-primary'><i class="fas fa-video"></i></a></td>
															</tr>
														@endif
													@endforeach
												</tbody>
												<tfoot>
													<tr>
														<th colspan="4">Cantidad Total Enviada</th>
														<th class="text-center">{{$Total}} Kg</th>
														<th colspan="3"></th>
													</tr>
												</tfoot>
											@endforeach
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
@endsection