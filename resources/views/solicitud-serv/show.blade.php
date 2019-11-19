@extends('layouts.app')
@section('htmlheader_title')
Solicitud de servicio N° {{$SolicitudServicio->ID_SolSer}}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	Servicios->Solicitudes
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
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
					<form action='/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}' method='POST'>
						@method('DELETE')
						@csrf
						<input type="submit" id="Eliminar{{$SolicitudServicio->SolSerSlug}}" style="display: none;">
					</form>
					<div class="col-md-12" id="titulo" style="font-size: 1.2em; text-align:center;">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						<div class="box box-info">
							<div class="col-md-12" style="text-align: center; margin-top: 20px; border-bottom:#f4f4f4 solid 2px;">
								<div class="col-md-4">
									<label>{{trans('adminlte_lang::message.solsershowdate')}}:</label>
									<span>{{date('Y-m-d',strtotime($SolicitudServicio->created_at))}}</span>
								</div>
								<div class="col-md-4">
									<label>{{trans('adminlte_lang::message.solserindexnumber')}}: {{$SolicitudServicio->ID_SolSer}}</label>
								</div>
								<div class="col-md-4">
									<label>{{trans('adminlte_lang::message.solsershowaudita')}}</label>
									<span>{{$SolicitudServicio->SolResAuditoriaTipo}}</span>
								</div>
								<hr>
							</div>
							@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
								<div class="col-md-12 border-gray">
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solsershowempre') }}</label><br>
										<a>{{$Cliente->CliName}}</a>
									</div>
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solsershowemprenit') }}</label><br>
										<a>{{$Cliente->CliNit}}</a>
									</div>
								</div>
								<div class="col-md-12 border-gray">
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solsershowempreaddress') }}</label><br>
										<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solsershowempreaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->SedeAddress}}</p>">{{$Cliente->SedeAddress}}</a>
									</div>
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solsershowemprecity') }}</label><br>
										<a>{{$Cliente->MunName}}</a>
									</div>
								</div>
							@endif
							<div class="col-md-12 border-gray">
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.solserpersonal') }}:</label><br>
									<a>{{$SolicitudServicio->PersFirstName.' '.$SolicitudServicio->PersLastName}}</a>
								</div>
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.emailaddress') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->PersEmail}}</p>">{{$SolicitudServicio->PersEmail}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.solsershowtransempre') }}</label><br>
									<a>{{$SolicitudServicio->SolSerNameTrans}}</a>
								</div>
								<div class="col-md-6">
									<button type="button" class="btn btn-box-tool boton" style="color: black; float: right;" data-toggle="collapse" data-target=".Transportadora" onclick="AnimationMenusForm('.Transportadora')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
									<label>{{ trans('adminlte_lang::message.solsertransnit') }}:</label><br>
									<a>{{$SolicitudServicio->SolSerNitTrans}}</a>
								</div>
							</div>
							<div class="col-md-16">
								<div class="col-md-12 border-gray collapse Transportadora">
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solsertransaddress') }}:</label><br>
										<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solsertransaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->SolSerAdressTrans}}</p>">{{$SolicitudServicio->SolSerAdressTrans}}</a>
									</div>
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solsershowtranscity') }}</label><br>
										<a>{{$Municipio}}</a>
									</div>
								</div>
								<div class="col-md-12 border-gray collapse Transportadora">
									@if($SolicitudServicio->SolSerTipo == 'Interno')
										<div class="col-md-6">
											<label>{{ trans('adminlte_lang::message.solserconduc') }}:</label><br>
											<a>{{$SolSerConductor == null ? trans('adminlte_lang::message.solsernullprogram') : $SolSerConductor->PersFirstName." ".$SolSerConductor->PersLastName}}</a>
										</div>
										<div class="col-md-6">
											<label>{{ trans('adminlte_lang::message.solservehic') }}:</label><br>
											<a>{{$SolicitudServicio->SolSerVehiculo == null ? trans('adminlte_lang::message.solsernullprogram') : $SolicitudServicio->SolSerVehiculo}}</a>
										</div>
									@else
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solserconduc') }}:</label><br>
										<a>{{$SolSerConductor == null ? 'N/A' : $SolSerConductor}}</a>
									</div>
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solservehic') }}:</label><br>
										<a>{{$SolicitudServicio->SolSerVehiculo == null ? 'N/A' : $SolicitudServicio->SolSerVehiculo}}</a>
									</div>
									@endif
								</div>
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-6" {{$SolicitudServicio->SolSerDescript == null ? 'hidden' : ''}}>
									<label>{{ trans('adminlte_lang::message.solserstatusdescrip') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solserstatusdescrip') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->SolSerDescript}}</p>">{{$SolicitudServicio->SolSerDescript}}</a>
								</div>
								<div class="col-md-6" {{$SolicitudServicio->SolSerTipo == "Externo" ? 'hidden' : ''}}>
									<label>{{ trans('adminlte_lang::message.solseraddrescollect') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solseraddrescollect') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolSerCollectAddress}}</p>">{{$SolSerCollectAddress}}</a>
								</div>
							</div>
							@if (in_array(Auth::user()->UsRol, Permisos::SolSer2) || in_array(Auth::user()->UsRol2, Permisos::SolSer2))
								<a style="margin: 10px 10px;" href='{{$SolicitudServicio->SolSerSlug}}/documentos/' class='btn btn-info pull-right'><i class="fas fa-file-pdf"></i> <b>Certificaciones/Manifiestos</b></a>
							@endif
							@if (in_array(Auth::user()->UsRol, Permisos::SolSer2) || in_array(Auth::user()->UsRol2, Permisos::SolSer2))
								<a style="margin: 10px 10px;" href='#' data-toggle='modal' data-target='#ModalRequerimientos' class='btn btn-info pull-right'><i class="fas fa-list-ol"></i> <b>Requerimientos de Residuos</b></a>
							@endif
							@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL))
								@if($SolicitudServicio->SolSerSupport <> null)
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>Soporte de Pago</b>" data-content="{{in_array(Auth::user()->UsRol, Permisos::CLIENTE) ? 'Haga click para visualizar el PDF del soporte de pago, que adjuntó, para esta solicitud de servicio' : 'Haga click para visualizar el PDF del soporte de pago, adjuntado por el cliente, para esta solicitud de servicio'}}"><a href="/img/SupportPay/{{$SolicitudServicio->SolSerSupport}}" class="btn btn-info pull-left" target="_blank" style="margin: 10px 30px;">Soporte <i class="fas fa-file-pdf fa-lg"></i></a></label>
									
								@else
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>Soporte de Pago</b>" data-content="{{in_array(Auth::user()->UsRol, Permisos::CLIENTE) ? 'Aun no ha adjuntado un soporte de pago para esta solicitud de servicio' : 'El cliente no ha adjuntado un soporte de pago para esta solicitud de servicio'}}"><a href="#" class="btn btn-default pull-left"  style="margin: 10px 30px;">Soporte <i class="fas fa-file-pdf fa-lg"></i></a></label>
								@endif
								@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
								<label class="pull-right" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>Repetir Solicitud de Servicio</b>" data-content="al hacer click en este botón podrá crear una nueva solicitud de servicio usando como base los datos de esta solicitud"><a href='#' data-toggle='modal' style="margin: 10px  30px;" data-target='#ModalRepeat' class="btn btn-info">Repetir <i class="fas fa-redo-alt"></i></a></label>
								@endif
							@endif
							<div class="col-md-12" style="margin: 10px 0;">
								<center>
									<label>Requerimientos de la solicitud</label>
									<button type="button" class="btn btn-box-tool boton" style="color: black;" data-toggle="collapse" data-target=".Requerimientos" onclick="AnimationMenusForm('.Requerimientos')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
								</center>
								<div class="col-md-12 collapse Requerimientos" style="border: 2px dashed #00c0ef">
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserticket') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserticketdescrit') }} </p>">
											<label for="SolSerBascula">{{ trans('adminlte_lang::message.solserticket') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerBascula" name="SolSerBascula" {{ $SolicitudServicio->SolSerBascula <> null ? 'checked' : '' }}>
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserperscapa') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserperscapadescrit') }} </p>">
											<label for="SolSerCapacitacion">{{ trans('adminlte_lang::message.solserperscapa') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerCapacitacion" name="SolSerCapacitacion" {{ $SolicitudServicio->SolSerCapacitacion <> null ? 'checked' : '' }}>
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsermaspers') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsermaspersdescrit') }} </p>">
											<label for="SolSerMasPerson">{{ trans('adminlte_lang::message.solsermaspers') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerMasPerson" name="SolSerMasPerson" {{ $SolicitudServicio->SolSerMasPerson <> null ? 'checked' : '' }}>
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicexclusi') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicexclusidescrit') }} </p>">
											<label for="SolSerVehicExclusive">{{ trans('adminlte_lang::message.solservehicexclusi') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerVehicExclusive" name="SolSerVehicExclusive" {{ $SolicitudServicio->SolSerVehicExclusive <> null ? 'checked' : '' }}>
											</div>
										</label>
									</div>
									<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicplata') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicplatadescrit') }} </p>">
											<label for="SolSerPlatform">{{ trans('adminlte_lang::message.solservehicplata') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerPlatform" name="SolSerPlatform" {{ $SolicitudServicio->SolSerPlatform <> null ? 'checked' : '' }}>
											</div>
										</label>
									</div>
								{{-- 	<div class="col-md-4" style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserdevelem') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserdevelemdescrit') }} </p>">
											<label for="SolSerDevolucion">{{ trans('adminlte_lang::message.solserdevelem') }}</label>
											<div style="width: 100%; height: 34px;">
												<input type="checkbox" class="testswitch" id="SolSerDevolucion" name="SolSerDevolucion" {{ $SolicitudServicio->SolSerDevolucion <> null ? 'checked' : '' }}>
											</div>
										</label>
									</div>
									<div class="form-group col-md-6 col-md-offset-3" {{ $SolicitudServicio->SolSerDevolucion == null ? 'hidden' : '' }} style="text-align: center;">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsernameelem') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsernameelemdescrit') }} </p>">
											<label for="SolSerDevolucionTipo">{{ trans('adminlte_lang::message.solsernameelem') }}</label>
											<input maxlength="128" type="text" maxlength="64" class="form-control" id="SolSerDevolucionTipo" name="SolSerDevolucionTipo" value="{{ $SolicitudServicio->SolSerDevolucionTipo}}" disabled="">
											<small class="help-block with-errors"></small>
										</label>
									</div> --}}
								</div>
							</div>
							<div class="col-md-12" style="border-top:#00a65a solid 3px; padding-top: 20px; margin-top: 20px;">
								<table id="SolserGenerTable" class="table table-compact table-bordered table-striped">
									@php 
										// $TotalEnv = 0;
										// $TotalRec = 0;
										// $TotalCons = 0;
										// $TotalTrat = 0;
									@endphp
									<thead>
										<tr>
											<th>{{trans('adminlte_lang::message.solserrespel')}}</th>
											<th>Tratamiento</th>
											<th>Pretratamientos</th>
											<th>{{trans('adminlte_lang::message.solserembaja')}}</th> 
											<th>{{trans('adminlte_lang::message.gener')}}</th>
											@if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))
												<th>Tarifa</th>
											@endif
											<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercantienv')}}</th>
											@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR))
												<th>{{trans('adminlte_lang::message.address')}}</th>
											@else
												<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercantiresi')}}</th>
												<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercanticonsi')}}</th>
												@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
													<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercantitrat')}}</th>
												@endif
												<th>{{trans('adminlte_lang::message.seedetails')}}</th>
											@endif
											@if(($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aceptado' || $SolicitudServicio->SolSerStatus == 'Aprobado') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
												<th>{{trans('adminlte_lang::message.delete')}}</th>
											@elseif(($SolicitudServicio->SolSerStatus == 'Certificacion') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
												<th>Certificado</th>
											@endif
											
										</tr>
									</thead>
									<tbody>
									@foreach($GenerResiduos as $GenerResiduo)
										@foreach($Residuos as $Residuo)
											@if($Residuo->FK_SGener == $GenerResiduo->FK_SGener)
												@php
													// $TotalEnv = $Residuo->SolResKgEnviado+$TotalEnv;
													// $TotalRec = $Residuo->SolResKgRecibido+$TotalRec;
													// $TotalCons = $Residuo->SolResKgConciliado+$TotalCons;
													// $TotalTrat = $Residuo->SolResKgTratado+$TotalTrat;
													switch ($Residuo->SolResTypeUnidad) {
														case 'Unidad':
															$TypeUnidad = 'Unidad(es)';
															break;
														case 'Litros':
															$TypeUnidad = 'Litro(s)';
															break;
														default:
															$TypeUnidad = 'Kilogramos';
															break;
													}
												@endphp
											<tr>
												<td><a title="Ver Residuo" href="/respels/{{$Residuo->RespelSlug}}" target="_blank" {{(in_array(Auth::user()->UsRol, Permisos::AREALOGISTICA))&&($Residuo->RespelStatus != "Revisado") ? 'style=color:red;' : ""}} ><i class="fas fa-external-link-alt"></i></a> {{$Residuo->RespelName}}</td>
												<td>{{$Residuo->TratName}} {{in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) ? '- '.$Residuo->CliName : ''}}</td>
												<td>
													<ul>
													@foreach($Residuo->pretratamientosSelected as $pretratamientoSelected)
													    <li>{{$pretratamientoSelected->PreTratName}}</li>
													@endforeach
													</ul>
												</td>
												<td>{{$Residuo->SolResEmbalaje}}</td>
												<td><a title="Ver Generador" href="/sgeneradores/{{$GenerResiduo->GSedeSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$GenerResiduo->GenerName.' ('.$GenerResiduo->GSedeName.')'}}</td>
												@if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))
													<td style="text-align: center;">
														@if($SolicitudServicio->SolSerStatus === 'Completado' || $SolicitudServicio->SolSerStatus === 'No Conciliado' || $SolicitudServicio->SolSerStatus === 'Conciliado' || $SolicitudServicio->SolSerStatus === 'Tratado')
														<a href="#" onclick="addprice(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResPrecio}}`)">
														@else
															<a style="color: black">
														@endif
														<i class="fas fa-marker"></i></a>
														{{$Residuo->SolResPrecio}}
														 Pesos
													</td>
												@endif
												<td style="text-align: center;">{{$Residuo->SolResKgEnviado}} Kilogramos</td>
												@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR))
													<td>{{$GenerResiduo->GSedeAddress}}</td>
												@else
													<td style="text-align: center;">
														@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
															@if($SolicitudServicio->SolSerStatus === 'Programado' && $Programacion->ProgVehEntrada !== Null)
																@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResCantiUnidadRecibida}}`, `{{$Residuo->SolResCantiUnidadConciliada}}`, `{{$TypeUnidad}}`, `{{$Residuo->SolResKgRecibido}}`)">
																@else
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResKgRecibido}}`, `{{$Residuo->SolResKgConciliado}}`, `{{$TypeUnidad}}`)"> 
																@endif
															@else
																<a style="color: black">
															@endif
															<i class="fas fa-marker"></i></a>
														@endif
														@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
															{{-- {{' '.$Residuo->SolResCantiUnidadRecibida}} --}}
															{{$Residuo->SolResCantiUnidadRecibida  === null ? 'N/A' : $Residuo->SolResCantiUnidadRecibida }}

														@else
															{{' '.$Residuo->SolResKgRecibido}}
														@endif
														 {{$TypeUnidad}}
													</td>
													<td style="text-align: center;">
														@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
															@if($SolicitudServicio->SolSerStatus === 'Completado' || $SolicitudServicio->SolSerStatus === 'No Conciliado')
																@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResCantiUnidadRecibida}}`, `{{$Residuo->SolResCantiUnidadConciliada}}`, `{{$TypeUnidad}}`, `{{$Residuo->SolResKgRecibido}}`)">
																@else
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResKgRecibido}}`, `{{$Residuo->SolResKgConciliado}}`, `{{$TypeUnidad}}`, null)"> 
																@endif
															@else
																<a style="color: black">
															@endif
															<i class="fas fa-marker"></i></a>
														@endif
														@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
															{{$Residuo->SolResCantiUnidadConciliada  === null ? 'N/A' : $Residuo->SolResCantiUnidadConciliada }}
														@else
															{{$Residuo->SolResKgConciliado  === null ? 'N/A' : $Residuo->SolResKgConciliado }}
														@endif
														 {{$TypeUnidad}}
													</td>
													@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
														<td style="text-align: center;">
															@if($SolicitudServicio->SolSerStatus === 'Conciliado')
																{{-- <a class="kg" onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResKgTratado}}`, `{{$Residuo->SolResKgConciliado}}`)">  --}}
																@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResCantiUnidadRecibida}}`, `{{$Residuo->SolResCantiUnidadConciliada}}`, `{{$TypeUnidad}}`, `{{$Residuo->SolResKgTratado}}`, `{{$Residuo->SolResKgConciliado}}`)">
																@else
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResKgTratado}}`, `{{$Residuo->SolResKgConciliado}}`, `{{$TypeUnidad}}`, {{$Residuo->SolResKgTratado}})"> 
																@endif
															@else
																<a style="color: black">
															@endif
															<i class="fas fa-marker"></i></a>
															{{$Residuo->SolResKgTratado  === null ? 'N/A' : $Residuo->SolResKgTratado }} 
															 {{$TypeUnidad}}
														</td>
													@endif
													<td style="text-align: center;"><a href='/recurso/{{$Residuo->SolResSlug}}' target="_blank" class='btn btn-info btn-block'> <i class="fas fa-search"></i> </a></td>
												@endif
												@if(($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aceptado' || $SolicitudServicio->SolSerStatus == 'Aprobado') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
													<td style="text-align: center;"><a href='#' onclick="ModalDeleteRespel(`{{$Residuo->SolResSlug}}`, `{{$Residuo->RespelName}}`, `{{$GenerResiduo->GenerName}}`)" class='btn btn-danger'><i class="fas fa-trash-alt"></i></a></td>
												@elseif(($SolicitudServicio->SolSerStatus == 'Certificacion') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
													<td style="text-align: center;"><a href="#" class="btn btn-info"> <i class="fas fa-file-pdf fa-lg"></i></a></td>
												@endif
											</tr>
											@endif
										@endforeach
									@endforeach
									</tbody>
									{{-- <tfoot>
										<tr>
											<th colspan="3">{{trans('adminlte_lang::message.solsershowcantitotal')}}</th>
											<th style="text-align: right;">{{$TotalEnv}} kg</th>
											<th style="text-align: right;">{{$TotalRec}} kg</th>
											<th style="text-align: right;">{{$TotalCons}} kg</th>
											@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
												<th style="text-align: right;">{{$TotalTrat}} kg</th>
											@endif
											@if($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aprobado' || $SolicitudServicio->SolSerStatus == 'Aceptado' || $SolicitudServicio->SolSerStatus == 'Certificacion')
												<th colspan="2"></th>
											@else
												<th></th>
											@endif
										</tr>
									</tfoot> --}}
								</table>
								<div id="ModalDeleteRespel"></div>
								<div id="ModalStatus"></div>
								{{--  Modal --}}
									<div class="modal modal-default fade in" id="ModalRepeat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-body">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
														<i class="fas fa-exclamation-triangle"></i>
														<span style="font-size: 0.3em; color: black;"><p>¿Seguro(a) desea repetir la solicitud <b>N° {{$SolicitudServicio->ID_SolSer}}</b>?</p></span>
													</div> 
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
													<form action="/solicitud-servicio/repeat/{{$SolicitudServicio->SolSerSlug}}" method="GET" id="SolSerRepeat">
														<button form="SolSerRepeat" type="submit" class="btn btn-success">Si, repetir</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								{{-- END Modal --}}
								 {{--  Modal --}}
									<div class="modal modal-default fade in" id="ModalRequerimientos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-body">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<span style="font-size: 1.5em;"><p>Requerimientos de los residuos</p></span>
													<div class="box box-info col-md-16" style="text-align: center;">
														@foreach($Residuos as $Residuo)
															<div class="col-md-12 col-xs-12" style="margin-top: 5px;">
																<label>{{$Residuo->RespelName.' - '.$Residuo->SolResEmbalaje}}</label>
															</div>
															<div class="col-md-12 col-xs-12">
																<div class="col-md-4 col-xs-4" style="border-bottom: 2px solid black; border-right: 1px solid black;">
																	<label style="text-align: center;"	>Descargue</label>
																	<div style="width: 100%;">
																		<input type="checkbox" class="fotoswitch" data-size="small" {{ $Residuo->SolResFotoDescargue_Pesaje == 1 ? 'checked' : '' }}/>
																		<input type="checkbox" class="videoswitch" data-size="small" {{ $Residuo->SolResVideoDescargue_Pesaje == 1 ? 'checked' : '' }}/>
																	</div>
																</div>
																<div class="col-md-4 col-xs-4" style="border-bottom: 2px solid black; border-left: 1px solid black;border-right: 1px solid black;">
																	<label style="text-align: center;">{{trans('adminlte_lang::message.requeretratamiento')}}</label>
																	<div style="width: 100%;">
																		<input type="checkbox" class="fotoswitch" data-size="small" {{ $Residuo->SolResFotoTratamiento == 1 ? 'checked' : '' }}/>
																		<input type="checkbox" class="videoswitch" data-size="small" {{ $Residuo->SolResVideoTratamiento == 1 ? 'checked' : '' }}/>
																	</div>
																</div>
																<div class="col-md-4 col-xs-4" style="border-bottom: 2px solid black; border-left: 1px solid black;">
																	<label style="text-align: center;">Devolución/Auditoria</label>
																	<div style="width: 100%;">
																		<input type="checkbox" class="embalajeswitch" data-size="small" {{ $Residuo->SolResDevolucion == 1 ? 'checked' : '' }} disabled/>
																		<input type="checkbox" class="auditoriaswitch" data-size="small" {{ $Residuo->SolResAuditoria == 1 ? 'checked' : '' }} disabled/>
																	</div>
																</div>
															</div>
														@endforeach 
													</div><br><br><br>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
												</div>
											</div>
										</div>
									</div>
								{{-- END Modal --}}
								{{-- Modal --}}
									<div id="addkgmodal"></div>
								{{-- END Modal --}}
								{{-- Modal --}}
									<div id="addprice"></div>
								{{-- END Modal --}}
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
{{-- funciones para el modal de precio --}}
@if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL) || in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))
	<script>
		function addprice(slug, precio){
			var inputprice =  '<label for="SolResPrice">Tarifa del Residuo</label><small class="help-block with-errors">*</small><input type="number" min="0" class="form-control numberKg" id="SolResPrice" name="SolResPrecio" value="'+precio+'" required>';
			$('#addprice').empty();
			$('#addprice').append(`
				<form role="form" action="/solicitud-residuo/`+slug+`/UpdatePrice" method="POST" enctype="multipart/form-data" data-toggle="validator" id="Formprice">
					@method('PUT')
					@csrf
					<div class="modal modal-default fade in" id="asignarPrecio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
										<i class="fas fa-plus-circle"></i>
										<span style="font-size: 0.3em; color: black;"><p>
											Precio
										</p></span>
									</div>
								</div>
								<div class="modal-header">
									@if ($errors->any())
										<div class="alert alert-danger" role="alert">
											<ul>
												@foreach ($errors->all() as $error)
													<p>{{$error}}</p>
												@endforeach
											</ul>
										</div>
									@endif
									<div class="form-group col-md-12">
										`+inputprice+`
									</div>
									<input type="text" hidden name="SolRes" value="`+slug+`">
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.save')}}</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			`);
			$('#asignarPrecio').modal();
			$('#Formprice').validator('update');
		};
	</script>
	@if ($errors->any())
		<script>
			$(document).ready(function() {
				$("#editkgResivido").modal("show");
			});
		</script>
	@endif
@endif

{{-- funciones para el modal de kg --}}
@if(in_array(Auth::user()->UsRol, Permisos::SolSer2) || in_array(Auth::user()->UsRol2, Permisos::SolSer2))
	<script>
		function addkg(slug, cantidad, cantidadmax, tipo, cantidadKG, KgConciliado){
			var inputUnid =  '<label for="SolResCantiUnidadRecibida">Cantidad Recibida'+tipo+'</label><small class="help-block with-errors">*</small><input type="text" class="form-control numberKg" id="SolResCantiUnidadRecibida" name="SolResCantiUnidadRecibida" maxlength="5" value="'+cantidad+'" required>';
			var inputKg =  '<label for="SolResCantiUnidadRecibida">Cantidad Recibida'+tipo+'</label><small class="help-block with-errors">*</small><input type="text" class="form-control numberKg" id="SolResCantiUnidadRecibida" name="SolResKg" maxlength="5" value="'+cantidad+'" required>';
			$('#addkgmodal').empty();
			$('#addkgmodal').append(`
				<form role="form" action="/solicitud-residuo/`+slug+`/Update" method="POST" enctype="multipart/form-data" data-toggle="validator" id="FormKg">
					@method('PUT')
					@csrf
					<div class="modal modal-default fade in" id="editkgResivido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
										<i class="fas fa-plus-circle"></i>
										<span style="font-size: 0.3em; color: black;"><p>
											Cantidad
											@switch($SolicitudServicio->SolSerStatus)
												@case('Programado')
													Recibida
													@break
												@case('No Conciliado')
												@case('Completado')
													Conciliada
													@break
												@case('Conciliado')
													Tratada
													@break
											@endswitch
										</p></span>
									</div>
								</div>
								<div class="modal-header">
									@if ($errors->any())
										<div class="alert alert-danger" role="alert">
											<ul>
												@foreach ($errors->all() as $error)
													<p>{{$error}}</p>
												@endforeach
											</ul>
										</div>
									@endif
										@switch($SolicitudServicio->SolSerStatus)
											@case('Programado')
											<div class="form-group col-md-12">
												<label for="SolResKgRecibido">Cantidad Recibida (kg)</label>
												<small class="help-block with-errors">*</small>
												<input type="number" class="form-control numberKg" id="SolResKgRecibido" name="SolResKg" maxlength="5" value="`+cantidadKG+`" required>
											</div>
											<div class="form-group col-md-12">	
												 `+(tipo != 'Kilogramos' ? '<label for="SolResCantiUnidadRecibida">Cantidad Recibida '+tipo+'</label><small class="help-block with-errors">*</small><input type="number" step=".1" min="0" class="form-control numberKg" id="SolResCantiUnidadRecibida" name="SolResCantiUnidadRecibida" maxlength="5" value="'+cantidad+'" required>' : '')+`
											</div>
												@break
											@case('No Conciliado')
											@case('Completado')
											<div class="form-group col-md-12">	
												<label for="SolResKgConciliado">Cantidad Conciliada (kg)</label><small class="help-block with-errors">*</small><input type="number" step=".1" min="0" class="form-control" id="SolResKgConciliado" name="SolResKg" maxlength="5" value="`+cantidadKG+`" required>
											</div>
											<div class="form-group col-md-12">	
													`+(tipo != 'Kilogramos' ? '<label for="SolResCantiUnidadConciliada">Cantidad Conciliada '+tipo+' </label><small class="help-block with-errors">*</small><input type="number" step=".1" min="0" class="form-control" id="SolResCantiUnidadConciliada" name="SolResCantiUnidadConciliada" maxlength="5" value="'+cantidad+'" required>' : '')+`
											</div>
												@break
											@case('Conciliado')
											<div class="form-group col-md-12">	
												<label for="SolResKgTratado">Cantidad Tratada (kg)</label>
												<small class="help-block with-errors">*</small>
												<div class="input-group">
													<input type="number" step=".1" min="0" class="form-control cantidadmax" id="SolResKgTratado" name="SolResKg" maxlength="5" value="`+cantidadKG+`" max="`+KgConciliado+`" required>
													<div class="input-group-btn">
														<a title="Lo conciliado ya esta tratado" id="btn-consiliado" class="btn btn-success" onclick="submit(`+cantidadmax+`)">Tratado</a>
														<div id="conciliadokg"></div>
													</div>
												</div>

											</div>
											<div class="form-group col-md-12">	
												`+(tipo != 'Kilogramos' ? '<label for="SolResCantiUnidadTratada">Cantidad Tratada '+tipo+' </label><small class="help-block with-errors">*</small><input type="number" step=".1" min="0" class="form-control" id="SolResCantiUnidadTratada" name="SolResCantiUnidadTratada" maxlength="5" max="'+cantidadmax+'" value="'+cantidad+'" required>' : '')+`
											</div>
												@break
										@endswitch
										<input type="text" hidden name="SolRes" value="`+slug+`">
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.save')}}</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			`);
			switch('{{$SolicitudServicio->SolSerStatus}}'){
				case('Programado'):
					numeroKg();
					break;
				case('Completado'):
				case('No Conciliado'):
						$('.cantidadmax').inputmask({ alias: 'numeric', max:cantidadmax, rightAlign:false});
					break;
				case('Conciliado'):
						$('.cantidadmax').inputmask({ alias: 'numeric', max:cantidadmax, rightAlign:false});
					break;
			};
			$('#editkgResivido').modal();
			$('#FormKg').validator('update');
		};

		function submit(cantidadmax){
			console.log(cantidadmax);
			$('#conciliadokg').append(`
				@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
					<input type="text" hidden name="ValorConciliado" id="ValorConciliado" value="{{$Residuo->SolResCantiUnidadConciliada}}">
				@else
					<input type="text" hidden name="ValorConciliado" id="ValorConciliado" value="`+cantidadmax+`">
				@endif
			`);
			$('#SolResKgTratado').val(cantidadmax);
			$('#FormKg').validator('update');
			$('#ValorConciliado').prop('type', "submit");
		}
	</script>
	@if ($errors->any())
		<script>
			$(document).ready(function() {
				$("#editkgResivido").modal("show");
			});
		</script>
	@endif
@endif
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
			</form>
		`);
		$('#myModal'+slug).modal();
	}
	function ModalStatus(slug, status){
		$('#ModalStatus').empty();
		$('#ModalStatus').append(`
			<div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
								<i class="fas fa-exclamation-triangle"></i>
								<span style="font-size: 0.3em; color: black;"><p>¿Acepta marcar la solicitud de servicio como <b>`+status+`</b>?</p></span>
							</div>
						</div>
						<form action="/solicitud-servicio/changestatus" method="POST" data-toggle="validator" id="SolSer">
							<div class="modal-header">
								@csrf
								<div class="form-group col-md-12">
									<label  color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserstatusdescrip') }}</b>" data-content="{{ trans('adminlte_lang::message.solserstatusdescripdetaill') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solserstatusdescrip')}}</label>
									<small class="help-block with-errors">`+(status == 'No Deacuerdo' ? '*' : '')+`</small>
									<input type="text" class="form-control col-xs-12" `+(status == 'No Deacuerdo' ? 'required' : '')+` name="solserdescript"/>
								</div>
								<input type="submit" id="Cambiar`+slug+`" style="display: none;">
								<input type="text" name="solserslug" value="`+slug+`" style="display: none;">
								<input type="text" name="solserstatus" value="`+status+`" style="display: none;">
							</div> 
							<div class="modal-footer">
								<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">No, salir</button>
								<label for="Cambiar`+slug+`" class='btn btn-success'>Si, acepto</label>
							</div>
						</form>
					</div>
				</div>
			</div>
		`);
		$('#SolSer').validator('update');
		popover();
		envsubmit();
		$('#myModal').modal();
	}
	$('.testswitch').bootstrapSwitch('disabled',true);
	$('.fotoswitch').bootstrapSwitch('disabled',true);
	$('.videoswitch').bootstrapSwitch('disabled',true);

	@switch($SolicitudServicio->SolSerStatus)
		@case('Pendiente')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolicitudServicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
				`);
			@endif
		@break
		@case('Aceptado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolicitudServicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
				`);
			@endif
			@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
				@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
					$('#titulo').append(`
						<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Aprobada')" class="btn btn-success pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusaprobado')}}</a>
					`);
				@endif
				@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Programador'))
					$('#titulo').append(`
						<h4><b>{{trans('adminlte_lang::message.solsertitle')}}</b></h4>
					`);
				@endif
			@endif
		@break
		@case('Aprobado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolicitudServicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
				`);
			@endif
			@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
				@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Programador'))
					$('#titulo').append(`
						<h4><b>{{trans('adminlte_lang::message.solsertitle')}}</b></h4>
					`);
				@endif
			@endif
		@break
		@case('Programado')
			$('#titulo').empty();
			@if((in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) && ($SolicitudServicio->SolSerTipo == 'Externo'))
				$('#titulo').append(`
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
				$('#titulo').append(`
					<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Notificar programacion de servicio</b>" data-content="<p style='width: 50%'>Este botón enviara una notificación al correo del cliente notificando la fecha de la programación de servicio... úselo únicamente cuando este seguro de los datos de la programación </p>" href="/email-solser/{{$SolicitudServicio->SolSerSlug}}" class="btn btn-primary pull-right"><i class="fas fa-bell"></i><b> Notificar</b></a>
				`);
			@endif
			@if((in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)) && ($ProgramacionesActivas <= 0))
				$('#titulo').append(`
					<a href='#' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Recibir Residuos</b>" data-content="<p style='width: 50%'>Asegúrese de haber marcado todas las cantidades correspondientes en cada uno de los residuos antes de dar click a este botón, ya que las cantidades especificadas serán enviadas automáticamente a proceso de conciliación <br>Para mas detalles comuniquese con el <b>Jefe de Operaciones</b> </p>" onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Recibida')" class="btn btn-success pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusrecibido')}}</a>
				`);
			@endif
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowprograma')}}</b><spam>{{$TextProgramacion}}</spam>
			`);
		@break
		@case('Completado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Conciliada')" style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusconciliado')}}</a>
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'No Deacuerdo')" class='btn btn-danger pull-left'> <i class="fas fa-calendar-times"></i> <b>{{trans('adminlte_lang::message.solserstatusnoconciliado')}}</b></a>
				`);
			@endif
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowcomple')}}</b>
			`);
		@break
		@case('No Conciliado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Conciliación')" style="float: right;" class="btn btn-success"><i class="fas fa-certificate"></i> {{trans('adminlte_lang::message.solserstatusconciliacion')}}</a>
				`);
			@endif
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowcomple')}}</b>
			`);
		@break
		@case('Conciliado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Tratada')" style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatustratado')}}</a>
				`);
			@endif
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowconciliado')}}</b>
			`);
		@break
		@case('Tratado')
			$('#titulo').empty();
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowtrata')}}</b>
			`);
		@break
		@case('Certificacion')
			$('#titulo').empty();
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowcertifica')}}</b>
			`);
		@break
	@endswitch
</script>
@endsection