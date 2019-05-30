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
		@slot('slug')
			{{$SolicitudServicio->SolSerSlug}}
		@endslot
		@slot('textModal')
			la solicitud <b>N° {{$SolicitudServicio->ID_SolSer}}</b>
		@endslot
	@endcomponent
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-12">
						<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
						@if($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aprobado')
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
						@elseif($SolicitudServicio->SolSerStatus == 'Programada')
							<label>Su Solicitud ha sido programada para:</label>
							<small>{{$TextProgramacion}}</small>
						@else
							<label>Su Solicitud ha sido completada</label>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						<div class="box box-info">
							<div class="col-md-12" style="text-align: center; margin-top: 20px; border-bottom:#f4f4f4 solid 2px;">
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
									<button type="button" class="btn btn-box-tool boton" style="color: black; float: right;" data-toggle="collapse" data-target=".Transportadora" onclick="AnimationMenusForm('.Transportadora')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
									<label>Nit Transportadora: </label><br>
									<a>{{$SolicitudServicio->SolSerNitTrans}}</a>
								</div>
							</div>
							<div class="col-md-16">
								<div class="col-md-12 border-gray collapse Transportadora">
									<div class="col-md-6">
										<label>Dirreción Transportadora:</label><br>
										<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->SolSerAdressTrans}}</p>">{{$SolicitudServicio->SolSerAdressTrans}}</a>
									</div>
									<div class="col-md-6">
										<label>Ciudad Transportadora: </label><br>
										<a>{{$SolicitudServicio->SolSerCityTrans}}</a>
									</div>
								</div>
								<div class="col-md-12 border-gray collapse Transportadora">
									<div class="col-md-6">
										<label>Conductor: </label><br>
										@if($SolicitudServicio->SolSerTipo == 'Interno')
											@if($SolSerConductor == null)
												<a>{{trans('adminlte_lang::message.solsernullprogram')}}</a>
											@else
												<a>{{$SolSerConductor->PersFirstName.' '.$SolSerConductor->PersLastName}}</a> <a title="Ver Personal" href="/personalInterno/{{$SolSerConductor->PersSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
											@endif
										@else
											<a>{{$SolSerConductor}}</a>
										@endif
									</div>
									<div class="col-md-6">
										<label>Vehiculo: </label><br>
										<a>{{$SolicitudServicio->SolSerVehiculo == null ? trans('adminlte_lang::message.solsernullprogram') : $SolicitudServicio->SolSerVehiculo}}</a>
									</div>
								</div>
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-12">
									<label>Dirreción de Recolección:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolSerCollectAddress}}</p>">{{$SolSerCollectAddress}}</a>
								</div>
							</div>
							<div class="col-md-12" style="margin: 10px 0;">
								<center>
									<label>{{ trans('adminlte_lang::message.requirements') }}</label>
									<button type="button" class="btn btn-box-tool boton" style="color: black;" data-toggle="collapse" data-target=".Requerimientos" onclick="AnimationMenusForm('.Requerimientos')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
								</center>
								<div class="col-md-12 collapse Requerimientos" style="border: 2px dashed #00c0ef">
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserticket') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserticketdescrit') }} </p>">
											<label for="SolSerBascula">{{ trans('adminlte_lang::message.solserticket') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerBascula" name="SolSerBascula" {{ $SolicitudServicio->SolSerBascula <> null ? 'checked' : '' }} disabled="">
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserperscapa') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserperscapadescrit') }} </p>">
											<label for="SolSerCapacitacion">{{ trans('adminlte_lang::message.solserperscapa') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerCapacitacion" name="SolSerCapacitacion" {{ $SolicitudServicio->SolSerCapacitacion <> null ? 'checked' : '' }} disabled="">
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsermaspers') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsermaspersdescrit') }} </p>">
											<label for="SolSerMasPerson">{{ trans('adminlte_lang::message.solsermaspers') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerMasPerson" name="SolSerMasPerson" {{ $SolicitudServicio->SolSerMasPerson <> null ? 'checked' : '' }} disabled="">
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicexclusi') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicexclusidescrit') }} </p>">
											<label for="SolSerVehicExclusive">{{ trans('adminlte_lang::message.solservehicexclusi') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" disabled="" class="testswitch" id="SolSerVehicExclusive" name="SolSerVehicExclusive" {{ $SolicitudServicio->SolSerVehicExclusive <> null ? 'checked' : '' }} disabled="">
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicplata') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicplatadescrit') }} </p>">
											<label for="SolSerPlatform">{{ trans('adminlte_lang::message.solservehicplata') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerPlatform" name="SolSerPlatform" {{ $SolicitudServicio->SolSerPlatform <> null ? 'checked' : '' }} disabled="">
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserdevelem') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserdevelemdescrit') }} </p>">
											<label for="SolSerDevolucion">{{ trans('adminlte_lang::message.solserdevelem') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerDevolucion" name="SolSerDevolucion" {{ $SolicitudServicio->SolSerDevolucion <> null ? 'checked' : '' }} disabled="">
											</div>
										</label>
									</div>
									<div class="form-group col-md-6 col-md-offset-3" {{ $SolicitudServicio->SolSerDevolucion == null ? 'hidden' : '' }} style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsernameelem') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsernameelemdescrit') }} </p>">
											<label for="SolSerDevolucionTipo">{{ trans('adminlte_lang::message.solsernameelem') }}</label>
											<input maxlength="128" type="text" maxlength="64" class="form-control" id="SolSerDevolucionTipo" name="SolSerDevolucionTipo" value="{{ $SolicitudServicio->SolSerDevolucionTipo}}" disabled="">
											<small class="help-block with-errors"></small>
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="border-top:#00a65a solid 3px; padding-top: 20px; margin-top: 20px;">
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
												<td>{{$GenerResiduo->GenerShortname.' ('.$GenerResiduo->GSedeName.')'}} <a title="Ver Generador" href="/sgeneradores/{{$GenerResiduo->GSedeSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
												<td>{{$Residuo->RespelName}} <a title="Ver Residuo" href="/respels/{{$Residuo->RespelSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
												<td>{{$Residuo->SolResEmbalaje}}</td>
												<td>{{$Residuo->SolResKgEnviado}}</td>
												<td>{{$Residuo->SolResKgRecibido}}</td>
												<td>{{$Residuo->SolResKgConciliado}}</td>
												<td style="text-align: center;"><a href='/recurso/{{$Residuo->SolResSlug}}' target="_blank" class='btn btn-primary'> <i class="fas fa-biohazard"></i> </a></td>
												<td style="text-align: center;"><a href='#' onclick="ModalDeleteRespel(`{{$Residuo->SolResSlug}}`, `{{$Residuo->RespelName}}`, `{{$GenerResiduo->GenerShortname}}`)" class='btn btn-danger'><i class="fas fa-trash-alt"></i></a></td>
											</tr>
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
								<div id="ModalDeleteRespel"></div>
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
		function ModalDeleteRespel(slug, respel, generador){
			$('#ModalDeleteRespel').empty();
			$('#ModalDeleteRespel').append(`
			@component('layouts.partials.modal')
				@slot('slug')
					`+slug+`
				@endslot
				@slot('textModal')
					el residuo <b>`+respel+`</b> del generador <b>`+generador+`</b> de esta solicitud
				@endslot
			@endcomponent
			<form action="/solicitud-residuo/`+slug+`" method="POST">
				@method('DELETE')
				@csrf
				<input type="submit" id="Eliminar`+slug+`" style="display: none;">
			</form>`);
			$('#myModal'+slug).modal();
		}
	</script>
@endsection