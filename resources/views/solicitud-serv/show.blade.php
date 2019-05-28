@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	@component('layouts.partials.modal')
	{{$SolicitudServicio->SolSerSlug}}
	@endcomponent
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-12">
						<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
						@if($SolicitudServicio->SolSerDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolicitudServicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
						<form action='/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<input type="submit" id="Eliminar{{$SolicitudServicio->SolSerSlug}}" style="display: none;">
						</form>
						@else
						<form action='/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}' method='POST' style="float: left;">
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
									<span>{{date('Y-m-d',strtotime($SolicitudServicio->created_at))}}</span>
								</div>
								<div class="col-md-4">
									<label>N° - {{$SolicitudServicio->ID_SolSer}}</label>
								</div>
								<div class="col-md-4">
									<label>Auditable: </label>
									<span>{{$SolicitudServicio->SolResAuditoriaTipo}}</span>
								</div>
								<hr>
							</div>
							@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
								<div class="col-md-12 border-gray">
									<div class="col-md-6">
										<label>Empresa: </label><br>
										<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->CliName}}</p>">{{$Cliente->CliName}}</a>
									</div>
									<div class="col-md-6">
										<label>Nit: </label><br>
										<a>{{$Cliente->CliNit}}</a>
									</div>
								</div>
								<div class="col-md-12 border-gray">
									<div class="col-md-6">
										<label>Dirección: </label><br>
										<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->SedeAddress}}</p>">{{$Cliente->SedeAddress}}</a>
									</div>
									<div class="col-md-6">
										<label>Ciudad: </label><br>
										<a>{{$Cliente->MunName}}</a>
									</div>
								</div>
							@endif
							<div class="col-md-12 border-gray">
								<div class="col-md-6">
									<label>Persona Acargo: </label><br>
									<a>{{$SolicitudServicio->PersFirstName.' '.$SolicitudServicio->PersLastName}}</a>
								</div>
								<div class="col-md-6">
									<label>Email: </label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->PersAddress}}</p>">{{$SolicitudServicio->PersAddress}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-6">
									<label>Empresa Transportadora: </label><br>
									<a href="#" class="textpopover popover-left" style="text-align: left;" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->SolSerNameTrans}}</p>">{{$SolicitudServicio->SolSerNameTrans}}</a>
								</div>
								<div class="col-md-6">
									<label>Nit Transportadora: </label><br>
									<a>{{$SolicitudServicio->SolSerNitTrans}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-6">
									<label>Dirreción Transportadora:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->SolSerAdressTrans}}</p>">{{$SolicitudServicio->SolSerAdressTrans}}</a>
								</div>
								<div class="col-md-6">
									<label>Ciudad Transportadora: </label><br>
									<a>{{$SolicitudServicio->SolSerCityTrans}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-6">
									<label>Conductor: </label><br>
									<a>{{$SolicitudServicio->SolSerConductor}}</a>
								</div>
								<div class="col-md-6">
									<label>Vehiculo: </label><br>
									<a>{{$SolicitudServicio->SolSerVehiculo}}</a>
								</div>
							</div>
							<div class="col-md-12" style="border-top:#00c0ef solid 3px; padding-top: 20px; margin-top: 20px;">
								<div id="ModalDeleteRespel"></div>
								<table id="SolserGenerTable" class="table table-compact table-bordered table-striped">
									@php 
										$Contador = 1;
										$TotalEnv = 0;
										$TotalRec = 0;
										$TotalCons = 0;
									@endphp
									<thead>
										<tr>
											<th>Generador</th>
											<th>Residuo</th>
											<th>Embalaje</th>
											<th>Cantidad <br> Enviada Kg</th>
											<th>Cantidad <br> Recibida Kg</th>
											<th>Cantidad <br> Conciliada Kg</th>
											<th>Ver Detalles</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody>
									@foreach($GenerResiduos as $GenerResiduo)
										@foreach($Residuos as $Residuo)
											@if($Residuo->FK_SGener == $GenerResiduo->FK_SGener)
												@php
													$Contador++;
													$TotalEnv = $Residuo->SolResKgEnviado+$TotalEnv;
													$TotalRec = $Residuo->SolResKgRecibido+$TotalRec;
													$TotalCons = $Residuo->SolResKgConciliado+$TotalCons;
												@endphp
											<tr>
												<td>{{$GenerResiduo->GenerShortname}} <a title="Ver Generador" href="/generadores/{{$GenerResiduo->GenerSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
												<td>{{$Residuo->RespelName}} <a title="Ver Residuo" href="/respels/{{$Residuo->RespelSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
												<td>{{$Residuo->SolResEmbalaje}}</td>
												<td>{{$Residuo->SolResKgEnviado}}</td>
												<td>{{$Residuo->SolResKgRecibido}}</td>
												<td>{{$Residuo->SolResKgConciliado}}</td>
												<td style="text-align: center;"><a href='/recurso/{{$Residuo->SolResSlug}}' target="_blank" class='btn btn-primary'> <i class="fas fa-biohazard"></i> </a></td>
												<td style="text-align: center;"><a href='#' onclick="ModalDeleteRespel('{{$Residuo->SolResSlug}}')" class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i></a></td>
											</tr>
												<form action="/solicitud-residuo/{{$Residuo->SolResSlug}}" method="POST">
													@method('DELETE')
													@csrf
													<input type="submit" id="Eliminar{{$Residuo->SolResSlug}}" style="display: none;">
												</form>
											@endif
										@endforeach
									@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th colspan="3">Cantidad Total</th>
											<th style="text-align: right;">{{$TotalEnv}} Kg</th>
											<th style="text-align: right;">{{$TotalRec}} Kg</th>
											<th style="text-align: right;">{{$TotalCons}} Kg</th>
											<th colspan="2"></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
	<script>
		function ModalDeleteRespel(slug){
			$('#ModalDeleteRespel').empty();
			$('#ModalDeleteRespel').append(`
			@component('layouts.partials.modal')
				`+slug+`
			@endcomponent`);
			$('#myModal'+slug).modal();
		}
	</script>
@endsection