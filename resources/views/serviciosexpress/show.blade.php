@extends('layouts.app')
@section('htmlheader_title')
Solicitud de servicio N° {{$SolicitudServicio->ID_SolSer}}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
	Express-Solicitudes
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
					<form action='/serviciosexpress/{{$SolicitudServicio->SolSerSlug}}' method='POST'>
						@method('DELETE')
						@csrf
						<input type="submit" id="Eliminar{{$SolicitudServicio->SolSerSlug}}" style="display: none;">
					</form>
					<div class="col-md-12" id="titulo" style="font-size: 1.2em; text-align:center;">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						@if ($errors->any())
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->all() as $error)
										<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="box box-info">
							<div class="col-md-12 collapse Transportadora" style="text-align: center; margin-top: 20px; border-bottom:#f4f4f4 solid 2px;">
								<div class="col-md-2">
									<label>{{trans('adminlte_lang::message.solsershowdate')}}:</label>
									<span>{{date('Y-m-d',strtotime($SolicitudServicio->created_at))}}</span>
								</div>
								<div class="col-md-2">
									<label>{{trans('adminlte_lang::message.solserindexnumber')}}: {{$SolicitudServicio->ID_SolSer}}</label>
								</div>
								<div class="col-md-2">
									<label>{{trans('adminlte_lang::message.solsershowaudita')}}</label>
									@if($SolicitudServicio->SolResAuditoriaTipo == null)
									<span>No</span>
									@else
									<span>{{$SolicitudServicio->SolResAuditoriaTipo}}</span>
									@endif
								</div>
								<div class="col-md-2">
									<label>Status</label>
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
									<span>{{$SolicitudServicio->SolSerStatus}}</span>
									@else
									@switch($SolicitudServicio->SolSerStatus)

									    @case('Programado')
											<td style="text-align: center;">Aprobado</td>
									        @break

									    @default
											<td style="text-align: center;">{{$SolicitudServicio->SolSerStatus}}</td>
									@endswitch
									@endif
								</div>
								<div class="col-md-2">
									<label>{{'Vehiculos'}}: </label>
									<span>{{$Programaciones->Count()}}</span>
								</div>
								<div class="col-md-2">
									<label>Fecha de Recepción:</label>
									@if ($SolicitudServicio->recepcion !== null)
										<span>{{date('Y-m-d',strtotime($SolicitudServicio->recepcion))}}</span>
									@else
									 	<br><span>{{'No Programado'}}</span>
									@endif
								</div>
								<hr>
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.solsershowempre') }}</label><br>
									<a>{{$Cliente->CliName}}</a>
								</div>
								<div class="col-md-6">
									<button type="button" class="btn btn-box-tool boton" style="color: black; float: right; padding:0px; margin:0px;" data-toggle="collapse" data-target=".Transportadora" onclick="AnimationMenusForm('.Transportadora')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
									<label>
										{{ trans('adminlte_lang::message.solsershowempreaddress') }}
									</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solsershowempreaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->SedeAddress}}</p>">{{$Cliente->SedeAddress}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray collapse Transportadora">
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.solsershowemprenit') }}</label><br>
									<a>{{$Cliente->CliNit}}</a>
								</div>
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.solsershowemprecity') }}</label><br>
									<a>{{$Cliente->MunName}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray collapse Transportadora">
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.solserpersonal') }}:</label><br>
									<a>{{$SolicitudServicio->PersFirstName.' '.$SolicitudServicio->PersLastName}}</a>
								</div>
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.emailaddress') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->PersEmail}}</p>">{{$SolicitudServicio->PersEmail}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray collapse Transportadora">
								<div class="col-md-6">
									<label>{{ trans('adminlte_lang::message.solsershowtransempre') }}</label><br>
									<a>{{$SolicitudServicio->SolSerNameTrans}}</a>
								</div>
								<div class="col-md-6">
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
							<div class="col-md-12 border-gray collapse Transportadora">
								<div class="col-md-6" {{$SolicitudServicio->SolSerDescript == null ? 'hidden' : ''}}>
									<label>Observaciones:</label><br>
									<a href="#" style="overflow: hidden;
									text-overflow: ellipsis;
									display: inline-block;
									white-space: nowrap;
									max-width: 100%;" title="Observaciones" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{!!nl2br($SolicitudServicio->SolSerDescript)!!}</p>">{{$SolicitudServicio->SolSerDescript}}</a>
								</div>
								<div class="col-md-6">
									<label>Tlf de contacto</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solseraddrescollect') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->PersCellphone}}</p>">{{$SolicitudServicio->PersCellphone}}</a>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<label style="margin-left: 10px; margin-right:10px; margin-top:10px;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Cantidades Totales</b>" data-content="Haga click para visualizar los totales por tratamiento de la solicitud de servicio"><a href='#' data-toggle='modal' data-target='#ModalTotales' class='btn btn-info pull-right'><i class="fas fa-list-ol"></i> <b>Totales</b></a></label>
								</div>
								<div class="col-xs-6">
									<label class="pull-right" style="margin-left: 10px; margin-right:10px; margin-top:10px;">
										<div class="btn-group">
											<a type=button href='#' data-toggle='modal' data-target='#ModalObservaciones' class='btn btn-info'><i class="fas fa-comments fa-1x"></i> <b>Historial</b></a>
											<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<ul class="dropdown-menu" style="left:0">
												<li class="dropdown-header">Observaciones</li>
												<li role="separator" class="divider"></li>
												<li><a data-toggle='modal' data-target='#ModalNewObserv'>Añadir Observación</a></li>
											</ul>
										</div>
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									@if(in_array(Auth::user()->UsRol, Permisos::COMERCIALEXPRESS) || in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL))
										@if($SolicitudServicio->SolSerSupport <> null)
											<label style="margin-left: 10px; margin-right:10px" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Soporte de Pago</b>" data-content="{{in_array(Auth::user()->UsRol, Permisos::CLIENTE) ? 'Haga click para visualizar el PDF del soporte de pago, que adjuntó, para esta solicitud de servicio' : 'Haga click para visualizar el PDF del soporte de pago, adjuntado por el cliente, para esta solicitud de servicio'}}" class="pull-left"><a href="/img/SupportPay/{{$SolicitudServicio->SolSerSupport}}" class="btn btn-info" target="_blank"><i class="fas fa-file-pdf fa-lg"></i> Soporte</a></label>
										@else
											<label style="margin-left: 10px; margin-right:10px" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Soporte de Pago</b>" data-content="{{in_array(Auth::user()->UsRol, Permisos::CLIENTE) ? 'Aun no ha adjuntado un soporte de pago para esta solicitud de servicio' : 'El cliente no ha adjuntado un soporte de pago para esta solicitud de servicio'}}" class="pull-left"><a href="#" class="btn btn-default"><i class="fas fa-file-pdf fa-lg"></i> Soporte</a></label>
										@endif
									@endif
								</div>
								<div class="col-xs-6">

								</div>
							</div>




							<div class="col-md-12" style="border-top:#00a65a solid 3px; padding-top: 10px; margin-top: 0px;">
								<table id="SolserGenerTableExpress" class="table-express table-compact table-bordered table-striped" style="margin-bottom:10px; padding-bottom: 10px; position: relative !important; width: 100% !important;">
									<thead>
										<tr>
											<th>{{trans('adminlte_lang::message.solserrespel')}}</th>
											<th>{{trans('adminlte_lang::message.solsercantidad')}}</th>
											<th>Tratamiento</th>
											<th>{{trans('adminlte_lang::message.solserembaja')}}</th>
											@if(($SolicitudServicio->SolSerStatus == 'Notificado' || $SolicitudServicio->SolSerStatus == 'Programado' || $SolicitudServicio->SolSerStatus == 'Aprobado'|| $SolicitudServicio->SolSerStatus == 'Residuo Faltante') && (in_array(Auth::user()->UsRol, Permisos::COMERCIALEXPRESS) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALEXPRESS)))
												<th>{{trans('adminlte_lang::message.delete')}}</th>
											@endif
											@if($SolicitudServicio->SolSerStatus == 'Certificacion')
												<th>Certificado</th>
											@endif

										</tr>
									</thead>
									<tbody>
									@foreach($GenerResiduos as $GenerResiduo)
										@foreach($Residuos as $Residuo)
											@if($Residuo->FK_SGener == $GenerResiduo->FK_SGener)
												@php
													switch ($Residuo->SolResTypeUnidad) {
														case 'Unidad':
															$TypeUnidad = 'Unidades';
															break;
														case 'Litros':
															$TypeUnidad = 'Litros';
															break;
														default:
															$TypeUnidad = 'Kilogramos';
															break;
													}
												@endphp
											<tr>
												<td>{{$Residuo->RespelName}}</td>
												<td style="text-align: center;">
													@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR) || in_array(Auth::user()->UsRol2, Permisos::CONDUCTOR))
														@if(($SolicitudServicio->SolSerStatus === 'Programado'||$SolicitudServicio->SolSerStatus === 'Notificado') && (count($Programaciones)>$ProgramacionesActivas))
															@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
																<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResCantiUnidadRecibida}}`, `{{$Residuo->SolResCantiUnidadConciliada}}`, `{{$TypeUnidad}}`, `{{$Residuo->SolResKgRecibido == 0 ? '' : number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, null, `{!!json_encode($Residuo->SolResRM2, JSON_NUMERIC_CHECK)!!}`)">
															@else
																<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{number_format($Residuo->SolResKgConciliado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{$TypeUnidad}}`, `{{$Residuo->SolResKgRecibido == 0 ? '' : number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, null, `{!!json_encode($Residuo->SolResRM2, JSON_NUMERIC_CHECK)!!}`)">
															@endif
														@else
															<a style="color: black">
														@endif
														<i class="fas fa-marker"></i></a>
													@endif
													{{-- @if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
														{{$Residuo->SolResCantiUnidadRecibida === null ? 'N/A' : $Residuo->SolResCantiUnidadRecibida }}
													@else
													@endif --}}
                                                    @if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
                                                        {{' '.number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}
                                                        {{'Kg.'}}
                                                        <br>
                                                        {{' '.number_format($Residuo->SolResCantiUnidadRecibida, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}
                                                        {{$TypeUnidad}}
                                                    @else
                                                        {{' '.number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}
                                                        {{'Kg.'}}
                                                    @endif

												</td>
												<td>{{$Residuo->TratName}}</td>
												<td>{{$Residuo->SolResEmbalaje}}</td>

												@if(($SolicitudServicio->SolSerStatus == 'Notificado' || $SolicitudServicio->SolSerStatus == 'Programado' || $SolicitudServicio->SolSerStatus == 'Aprobado'|| $SolicitudServicio->SolSerStatus == 'Residuo Faltante') && (in_array(Auth::user()->UsRol, Permisos::COMERCIALEXPRESS) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALEXPRESS)))
													<td style="text-align: center;"><a href='#' onclick="ModalDeleteRespel(`{{$Residuo->SolResSlug}}`, `{{$Residuo->RespelName}}`, `{{$GenerResiduo->GenerName}}`)" class='btn btn-danger'><i class="fas fa-trash-alt"></i></a></td>
												@endif
												@if($SolicitudServicio->SolSerStatus == 'Certificacion')
													<td style="text-align: center;"><a href="#" class="btn btn-info"> <i class="fas fa-file-pdf fa-lg"></i></a></td>
												@endif
											</tr>
											@endif
										@endforeach
									@endforeach
									</tbody>
								</table>

								<div id="ModalDeleteRespel"></div>
								<div id="ModalStatus"></div>
								<div id="ModalReversar"></div>
								<div id="ModalCancelar"></div>
							{{--  Modal --}}
							<div class="modal modal-default fade in" id="ModalNewObserv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="/observacion" method="POST" id="NewObservForm">
											@csrf
											<input type='hidden' name='solserslug' value="{{$SolicitudServicio->SolSerSlug}}">
											<div class="modal-body">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
														aria-hidden="true">&times;</span></button>
												<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
													<i class="fas fa-exclamation-triangle"></i>
													<span style="font-size: 0.3em; color: black;">
														<p>escriba la observación que desea añadir a la solicitud <b>N° {{$SolicitudServicio->ID_SolSer}}</b>?</p>
													</span>
												</div>
												<div class="form-group col-md-12">
													<label color: black; text-align: left;" data-placement="auto" data-trigger="hover"
														data-html="true" data-toggle="popover" title="Observaciones"
														data-content="En este campo puede redactar sus observaciones con relación a esta solicitud de servicio"><i
															style="font-size: 1.8rem; color: Dodgerblue;"
															class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones</label>
													<small id="caracteresrestantesrepetirObs" class="help-block with-errors"></small>
													<textarea onchange="updatecaracteresrepetirObs()" id="textDescriptionrepetirObs" rows="5"
														style="resize: vertical;" maxlength="4000" class="form-control col-xs-12"
														required name="solserdescript"></textarea>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
												<button form="NewObservForm" type="submit" class="btn btn-success">enviar</button>
											</div>
										</form>
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
								{{-- Modal --}}
								<div id="changetratmodal"></div>
							{{-- END Modal --}}
							{{--  Modal --}}
								<div class="modal modal-default fade in" id="ModalTotales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<span style="font-size: 1.5em;"><p>Totales por Tratamiento</p></span>
												<div class="row">
													<div class="box box-info col-md-16" style="text-align: right;">
														<table id="totalesTable">
															<thead>
																<tr>
																	<th>Tratamiento</th>
																	<th>estimado</th>
																	<th>recibido</th>
																	<th>conciliado</th>
																	<th>tratado</th>
																	<th>pendiente</th>
																</tr>
															</thead>
															<tbody>
																@foreach ($cantidadesXtratamiento as $key => $value)
																<tr>
																	<th>{{$key}}</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($value['estimado'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($value['recibido'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($value['conciliado'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($value['tratado'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($value['conciliado'] - $value['tratado'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																</tr>
																@endforeach
															</tbody>
															<tfoot>
																<tr>
																	<th>{{trans('adminlte_lang::message.solsershowcantitotal')}}</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($total['estimado'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($total['recibido'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($total['conciliado'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($total['tratado'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																	<th style="text-align: right; white-space: nowrap; padding: 10px;">{{number_format($total['conciliado'] - $total['tratado'], $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} kg</th>
																</tr>
															</tfoot>
														</table>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
											</div>
										</div>
									</div>
								</div>
							{{-- END Modal --}}
							{{--  Modal --}}
							<div id="addRMsmodal"></div>
							{{-- END Modal --}}
							{{--  Modal --}}
							<div class="modal modal-default fade in" id="ModalObservaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-body">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
													aria-hidden="true">&times;</span></button>
											<span style="font-size: 1.5em;">
												<p>Historial de Observaciones</p>
											</span>
											<table id="observacionesTable">
												<thead>
													<tr>
														<th></th>
													</tr>
												</thead>
												<tbody>
													@foreach ($Observaciones as $key => $value)
													<tr>
														<td>
															<div class="panel panel-{{ ($value->ObsTipo == 'prosarc') ? 'info' : 'success'}} ">
																<div class="panel-heading" style="color: black;"><b>{{$value->ObsStatus}}</b> - {{$value->ObsDate}}</div>
																<div class="panel-body">
																	<p>
																		{!!nl2br($value->ObsMensaje)!!}
																	</p>
																	<br>
																	<p class="pull-right text-{{ ($value->ObsTipo == 'prosarc') ? 'primary' : 'success'}}"><b style="margin-right:1em">{{$value->ObsUser}}</b></p>
																</div>
															</div>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
										</div>
									</div>
								</div>
							</div>
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
<script>
	function updatecaracteresObs() {
		var area = document.getElementById("textDescriptionObs");
		var message = document.getElementById("caracteresrestantesObs");
		var maxLength = 4000;
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
		observacion = area.value;

	}

	$(document).ready(function(){
		var area = document.getElementById("textDescriptionrepetirObs");
		var message = document.getElementById("caracteresrestantesrepetirObs");
		var maxLength = 4000;
		$('#textDescriptionrepetirObs').keyup(function updatecaracteresrepetirObs() {
			message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
		});
	})

	function updatecaracteresSR() {
		var area = document.getElementById("textDescriptionSR");
		var message = document.getElementById("caracteresrestantesSR");
		var maxLength = 4000;
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
		observacion = area.value;

	}

	$(document).ready(function(){
		var area = document.getElementById("textDescriptionrepetirSR");
		var message = document.getElementById("caracteresrestantesrepetirSR");
		var maxLength = 4000;
		$('#textDescriptionrepetirSR').keyup(function updatecaracteresrepetirObs() {
			message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
		});
	})
</script>

{{-- funciones para el modal de kg --}}
@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR) || in_array(Auth::user()->UsRol2, Permisos::CONDUCTOR))
	<script>
		function addkg(slug, cantidad, cantidadmax, tipo, cantidadKG, KgConciliado, SolResRM){
			console.log('solresRM = '+SolResRM);
			var rmSelected = JSON.parse(SolResRM);
			var inputUnid =  '<label for="SolResCantiUnidadRecibida">Cantidad Recibida'+tipo+'</label><small class="help-block with-errors">*</small><input type="text" class="form-control numberKg" id="SolResCantiUnidadRecibida" name="SolResCantiUnidadRecibida" maxlength="5" value="'+cantidad+'" required>';
			var inputKg =  '<label for="SolResCantiUnidadRecibida">Cantidad Recibida'+tipo+'</label><small class="help-block with-errors">*</small><input type="text" class="form-control numberKg" id="SolResCantiUnidadRecibida" name="SolResKg" maxlength="5" value="'+cantidad+'" required>';
			// var arrayRMs = {!! json_encode($SolicitudServicio->SolSerRMs) !!};
			$('#addkgmodal').empty();
			$('#addkgmodal').append(`
				<form role="form" action="/solicitud-residuo/`+slug+`/Update" method="POST" enctype="multipart/form-data" data-toggle="validator" id="FormKg">
					@method('PUT')
					@csrf
					<div class="modal modal-default fade in" id="editkgRecibido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
												@case('Notificado')
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
											@case('Notificado')
											<div class="form-group col-md-12">
												<label for="SolResKgRecibido">Cantidad Recibida (kg)</label>
												<small class="help-block with-errors">*</small>
												<input type="number" step=".01" class="form-control numberKg" id="SolResKgRecibido" name="SolResKg" maxlength="5" value="`+cantidadKG+`" required>
											</div>
											<div class="form-group col-md-12">
												 `+(tipo != 'Kilogramos' ? '<label for="SolResCantiUnidadRecibida">Cantidad Recibida '+tipo+'</label><small class="help-block with-errors">*</small><input type="number" step=".1" min="0" class="form-control numberKg" id="SolResCantiUnidadRecibida" name="SolResCantiUnidadRecibida" maxlength="5" value="'+cantidad+'" required>' : '')+`
											</div>
												@break
											@case('No Conciliado')
											@case('Completado')
											<div class="form-group col-md-12">
												<label for="SolResKgConciliado">Cantidad Conciliada (kg)</label><small class="help-block with-errors">*</small><input type="number" step=".01" min="0" class="form-control" id="SolResKgConciliado" name="SolResKg" maxlength="5" value="`+cantidadKG+`" required>
											</div>
											<div class="form-group col-md-12">
													`+(tipo != 'Kilogramos' ? '<label for="SolResCantiUnidadConciliada">Cantidad Conciliada '+tipo+' </label><small class="help-block with-errors">*</small><input type="number" step=".1" min="0" class="form-control" id="SolResCantiUnidadConciliada" name="SolResCantiUnidadConciliada" maxlength="5" value="'+cantidad+'" required>' : '')+`
											</div>
												@break
											@case('Conciliado')
											@case('Certificacion')
											@case('Facturado')
											<div class="form-group col-md-12">
												<label for="SolResKgTratado">Cantidad Tratada (kg)</label>
												<small class="help-block with-errors">*</small>
												<div class="input-group">
													<input type="number" step=".01" min="0" class="form-control cantidadmax" id="SolResKgTratado" name="SolResKg" maxlength="5" value="`+cantidadKG+`" max="`+KgConciliado+`" required>
													<div class="input-group-btn">
														<a title="Lo conciliado ya esta tratado" id="btn-consiliado" class="btn btn-success" `+(tipo != 'Kilogramos' ? 'onclick="submit('+cantidadmax+','+KgConciliado+',\''+tipo+'\')"' : 'onclick="submit('+null+','+KgConciliado+',\''+tipo+'\')"')+`>Tratado</a>
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
				case('Notificado'):
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
			$('#editkgRecibido').modal();

			var arrayRMs = {!! json_encode($SolicitudServicio->SolSerRMs) !!};

			/*se verifica si todos los valores son nulos*/
			var nulos = 0;
			for (let indexnulos = 0; indexnulos < arrayRMs.length; indexnulos++) {
				if (arrayRMs[indexnulos] == null) {
					nulos++;
				}
			}

			if (nulos == 8) {
				$('#SolResRMselect').empty();
				$('#SolResRMselect').append(`<option disabled value="">debe cargar un numero de RM en el boton azul "RMs" para poder luego elegirlo en este formulario...</option>`);
			}else{
				$('#SolResRMselect').append(`<option disabled value="">seleccione un número de recibo de materiales...</option>`);
				for (let index = 0; index < arrayRMs.length; index++) {
					if (arrayRMs[index] !== null) {
						let estaono = false;
						if (rmSelected !== null) {
							for (let indexselected = 0; indexselected < rmSelected.length; indexselected++) {
								if (rmSelected[indexselected] == arrayRMs[index]) {
									estaono = true;
								}
							}
						}

						if(estaono==true){
							console.log('Key is exist in Object!');
							$('#SolResRMselect').append(`<option selected value="`+arrayRMs[index]+`">`+arrayRMs[index]+`</option>`);
						}else{
							$('#SolResRMselect').append(`<option value="`+arrayRMs[index]+`">`+arrayRMs[index]+`</option>`);
						}
					}
				}
			}
			SelectsMultiple();
			$('#FormKg').validator('update');
		};


		function submit(cantidadmax, kgConciliado){
			// console.log(cantidadmax);
			// console.log(kgConciliado);
			// console.log(tipo);
			var ValorConciliadokg = `<input type="text" hidden name="ValorConciliado" id="ValorConciliado" value="`+kgConciliado+`">`;
			var ValorConciliadounid = `<input type="text" hidden name="ValorConciliado" id="ValorConciliado" value="`+cantidadmax+`">`;
			// if (tipopeso != 'Kilogramos') {
			// 	$('#conciliadokg').append(ValorConciliadounid);
			// }else{
			// 	$('#conciliadokg').append(ValorConciliadokg);
			// }
			$('#conciliadokg').append(ValorConciliadokg);
			$('#SolResCantiUnidadTratada').val(cantidadmax);
			$('#SolResKgTratado').val(kgConciliado);
			$('#FormKg').validator('update');
			$('#ValorConciliado').prop('type', "submit");

		}
	</script>
	@if ($errors->any())
		<script>
			$(document).ready(function() {
				$("#editkgRecibido").modal("show");
			});
		</script>
	@endif
@endif

@if(in_array(Auth::user()->UsRol, Permisos::UpdateCantConciliada) || in_array(Auth::user()->UsRol2, Permisos::UpdateCantConciliada))
<script>
	function editKgConciliado(slug, cantidad, cantidadmax, tipo, cantidadKG, KgConciliado, SolResRM){
		console.log('solresRM = '+SolResRM);
		var rmSelected = JSON.parse(SolResRM);
		var inputUnid =  '<label for="SolResCantiUnidadRecibida">Cantidad Recibida'+tipo+'</label><small class="help-block with-errors">*</small><input type="text" class="form-control numberKg" id="SolResCantiUnidadRecibida" name="SolResCantiUnidadRecibida" maxlength="5" value="'+cantidad+'" required>';
		var inputKg =  '<label for="SolResCantiUnidadRecibida">Cantidad Recibida'+tipo+'</label><small class="help-block with-errors">*</small><input type="text" class="form-control numberKg" id="SolResCantiUnidadRecibida" name="SolResKg" maxlength="5" value="'+cantidad+'" required>';
		// var arrayRMs = {!! json_encode($SolicitudServicio->SolSerRMs) !!};
		$('#addkgmodal').empty();
		$('#addkgmodal').append(`
			<form role="form" action="/solicitud-residuo/`+slug+`/corregirSolRes" method="POST" enctype="multipart/form-data" data-toggle="validator" id="FormKg">
				@method('PUT')
				@csrf
				<div class="modal modal-default fade in" id="editkgRecibido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
									<i class="fas fa-plus-circle"></i>
									<span style="font-size: 0.3em; color: black;"><p>
										Cantidad
										@switch($SolicitudServicio->SolSerStatus)
											@case('Conciliado')
											@case('Certificacion')
												Conciliada
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
										@case('Certificacion')
										@case('Conciliado')
										@case('Facturado')
										<div class="form-group col-md-12">
											<label for="SolResKgConciliado">Cantidad Conciliada (kg)</label><small class="help-block with-errors">*</small><input type="number" step=".01" min="0" class="form-control" id="SolResKgConciliado" name="SolResKg" maxlength="5" value="`+cantidadKG+`" required>
										</div>
										<div class="form-group col-md-12">
												`+(tipo != 'Kilogramos' ? '<label for="SolResCantiUnidadConciliada">Cantidad Conciliada '+tipo+' </label><small class="help-block with-errors">*</small><input type="number" step=".1" min="0" class="form-control" id="SolResCantiUnidadConciliada" name="SolResCantiUnidadConciliada" maxlength="5" value="'+cantidad+'" required>' : '')+`
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
			case('Conciliado'):
			case('Certificacion'):
			case('Facturado'):
					$('.cantidadmax').inputmask({ alias: 'numeric', max:cantidadmax, rightAlign:false});
				break;
		};
		$('#editkgRecibido').modal();
		$('#FormKg').validator('update');
	};


	function submit(cantidadmax, kgConciliado){
		// console.log(cantidadmax);
		// console.log(kgConciliado);
		// console.log(tipo);
		var ValorConciliadokg = `<input type="text" hidden name="ValorConciliado" id="ValorConciliado" value="`+kgConciliado+`">`;
		var ValorConciliadounid = `<input type="text" hidden name="ValorConciliado" id="ValorConciliado" value="`+cantidadmax+`">`;
		// if (tipopeso != 'Kilogramos') {
		// 	$('#conciliadokg').append(ValorConciliadounid);
		// }else{
		// 	$('#conciliadokg').append(ValorConciliadokg);
		// }
		$('#conciliadokg').append(ValorConciliadokg);
		$('#SolResCantiUnidadTratada').val(cantidadmax);
		$('#SolResKgTratado').val(kgConciliado);
		$('#FormKg').validator('update');
		$('#ValorConciliado').prop('type', "submit");

	}
</script>
@if ($errors->any())
	<script>
		$(document).ready(function() {
			$("#editkgRecibido").modal("show");
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
	var observacion = `{!!$SolicitudServicio->SolSerDescript!!}`;
	function updatecaracteres() {
		var area = document.getElementById("textDescription");
		var message = document.getElementById("caracteresrestantes");
		var maxLength = 4000;
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
		observacion = area.value;

	}

	$(document).ready(function(){
		var area = document.getElementById("textDescriptionrepetir");
		var message = document.getElementById("caracteresrestantesrepetir");
		var maxLength = 4000;
		$('#textDescriptionrepetir').keyup(function updatecaracteresrepetir() {
			message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
		});
	})

	function ModalStatus(slug, status){
		$('#ModalStatus').empty();
		$('#ModalStatus').append(`
			<div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
								<span style="font-size: 0.3em; color: black;"><p>¿Acepta marcar la solicitud de servicio como <b>`+status+`</b>?</p></span>
							</div>
						</div>
						<form action="/serviciosexpress/certificarExpress" method="POST" enctype="multipart/form-data" data-toggle="validator" id="SolSer">
							<div class="modal-header">
								@csrf
								<div class="form-group col-md-12">
									<label  color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserstatusdescrip') }}</b>" data-content="{{ trans('adminlte_lang::message.solserstatusdescripdetaill') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solserstatusdescrip')}}</label>
									<small id="caracteresrestantes" class="help-block with-errors">`+(status == 'No Deacuerdo' ? '*' : '')+`</small>
									<textarea onchange="updatecaracteres()" id="textDescription" rows ="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" `+(status == 'No Deacuerdo' ? 'required' : '')+` name="solserdescript"></textarea>
								</div>
								<div class="signature-container col-md-12">
									<div id="signature-pad" class="signature-pad">
										<div class="signature-pad--body">
											<canvas width="540" height="180"></canvas>
										</div>
										<div class="signature-pad--footer">
											<div class="description">Firma del Cliente</div>

											<div class="signature-pad--actions">
												<div>
													<button type="button" class="button clear" data-action="clear">Nuevo</button>
													<button type="button" class="button" data-action="undo">Borrar</button>
												</div>
												<div>
													<button type="button" class="button save" data-action="save-png">PNG</button>
													<button type="button" class="button save" data-action="save-svg">SVG</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" id="signature-data" name="solserFirma" />
								<input type="submit" id="Cambiar`+slug+`" style="display: none;">
								<input type="text" name="solserslug" value="`+slug+`" style="display: none;">
								<input type="text" name="solserstatus" value="`+status+`" style="display: none;">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Cancelar</button>
								<label for="Cambiar`+slug+`" class='btn btn-success'>Enviar</label>
							</div>
						</form>
					</div>
				</div>
			</div>
		`);
		var wrapper = document.getElementById("signature-pad");
		var clearButton = wrapper.querySelector("[data-action=clear]");
		var undoButton = wrapper.querySelector("[data-action=undo]");
		var savePNGButton = wrapper.querySelector("[data-action=save-png]");
		var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
		var canvas = wrapper.querySelector("canvas");
		var signaturePad = new SignaturePad(canvas, {
			minWidth: 2,
			maxWidth: 2,
			penColor: "rgb(0, 0, 0)",
		});
		function resizeCanvas() {
			var ratio = Math.max(window.devicePixelRatio || 1, 1);
			canvas.width = canvas.offsetWidth * ratio;
			canvas.height = canvas.offsetHeight * ratio;
			canvas.getContext("2d").scale(ratio, ratio);
			signaturePad.clear();
		}
		window.onresize = resizeCanvas;
		resizeCanvas();

		function download(dataURL, filename) {
			if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
				window.open(dataURL);
			} else {
				var blob = dataURLToBlob(dataURL);
				var url = window.URL.createObjectURL(blob);

				var a = document.createElement("a");
				a.style = "display: none";
				a.href = url;
				a.download = filename;

				document.body.appendChild(a);
				a.click();

				window.URL.revokeObjectURL(url);
			}
		}
		function dataURLToBlob(dataURL) {
			var parts = dataURL.split(';base64,');
			var contentType = parts[0].split(":")[1];
			var raw = window.atob(parts[1]);
			var rawLength = raw.length;
			var uInt8Array = new Uint8Array(rawLength);
			for (var i = 0; i < rawLength; ++i) {
				uInt8Array[i] = raw.charCodeAt(i);
			}
			return new Blob([uInt8Array], { type: contentType });
		}

		clearButton.addEventListener("click", function (event) {
			resizeCanvas();
		});

		undoButton.addEventListener("click", function (event) {
			var data = signaturePad.toData();

			if (data) {
				data.pop(); // remove the last dot or line
				signaturePad.fromData(data);
			}
		});

		savePNGButton.addEventListener("click", function (event) {
			if (signaturePad.isEmpty()) {
				alert("Please provide a signature first.");
			} else {
				var dataURL = signaturePad.toDataURL();
				download(dataURL, "signature.png");
			}
		});

		saveSVGButton.addEventListener("click", function (event) {
			if (signaturePad.isEmpty()) {
				alert("Please provide a signature first.");
			} else {
				var dataURL = signaturePad.toDataURL('image/svg+xml');
				download(dataURL, "signature.svg");
			}
		});

		$('#SolSer').validator('update');
		popover();
		var area = document.getElementById("textDescription");
		var message = document.getElementById("caracteresrestantes");
		var maxLength = 4000;
		$('#textDescription').keyup(function () {
			message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
			observacion = area.value;
		});

		function envsubmitcertificarExpress(){
			$('form').on('submit', function(){
				var data = signaturePad.toDataURL('image/png');
  				var input = document.getElementById('signature-data');
  				input.value = data;

				var buttonsubmit = $(this).find('[type="submit"]');
				var idbutton = buttonsubmit[0].id;
				if(buttonsubmit.hasClass('disabled')){
					return false;
				}
				else{
					if(idbutton != ''){
						var label = $('label[for="'+idbutton+'"]');
						$(label).empty();
						$(label).append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
						$(label).attr('disabled', true);
					}
					buttonsubmit.prop('disabled', true);
					buttonsubmit.empty();
					buttonsubmit.append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
					$(this).submit(function(){
						return false;
					});
					return true;
				}
			});
		}
		envsubmitcertificarExpress();
		$('#myModal').modal();
	}
	$('.testswitch').bootstrapSwitch('disabled',true);
	$('.fotoswitch').bootstrapSwitch('disabled',true);
	$('.videoswitch').bootstrapSwitch('disabled',true);

	@switch($SolicitudServicio->SolSerStatus)
		@case('Cancelado')
			$('#titulo').empty();
			$('#titulo').append(`
				<h4><b>{{'Solicitud de Servicio Cancelada'}}</b></h4>
			`);
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
				<div class="btn-group" style="float: left;">
					<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Reactivar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a onclick="ModalCancelar('{{$SolicitudServicio->SolSerSlug}}', 'Aprobado')" href="#">Reactivar Solicitud de Servicio</a></li>
					</ul>
				</div>
				`);
			@endif
		@break
		@case('Pendiente')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolicitudServicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
				<div class="btn-group" style="float: left;">
					<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Cancelar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a onclick="ModalCancelar('{{$SolicitudServicio->SolSerSlug}}', 'Cancelado')" href="#">Cancelar Servicio</a></li>
					</ul>
				</div>
				`);
			@endif
			@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
				@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
					$('#titulo').append(`
						<a href='#' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'>La Solicitud de servicio no podra ser gestionada hasta que sea aprobada por Tesoreria, sin embargo, puede adelantar la revisión de la información<br>Para mas detalles comuníquese con <b>Tesoreria</b> </p>" disabled class="btn btn-default pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusaprobado')}}</a>
					`);
				@endif
				@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Programador'))
					$('#titulo').append(`
						<h4><b>{{trans('adminlte_lang::message.solsertitle')}}</b></h4>
					`);
				@endif
			@endif
		@break
		@case('Aceptado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolicitudServicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
				<div class="btn-group" style="float: left;">
					<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Cancelar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a onclick="ModalCancelar('{{$SolicitudServicio->SolSerSlug}}', 'Cancelado')" href="#">Cancelar Servicio</a></li>
					</ul>
				</div>
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
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolicitudServicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
				<div class="btn-group" style="float: left;">
					<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Cancelar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a onclick="ModalCancelar('{{$SolicitudServicio->SolSerSlug}}', 'Cancelado')" href="#">Cancelar Servicio</a></li>
					</ul>
				</div>
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
		@case('Certificacion')
			$('#titulo').empty();
			@if((in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) && ($SolicitudServicio->SolSerTipo == 'Externo'))
				$('#titulo').append(`

				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
						<h4><b>{{trans('adminlte_lang::message.solsertitle')}}</b></h4>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
				<div class="btn-group" style="float: left;">
					<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Cancelar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a onclick="ModalCancelar('{{$SolicitudServicio->SolSerSlug}}', 'Cancelado')" href="#">Cancelar Servicio</a></li>
					</ul>
				</div>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
				/*$('#titulo').append(`
					<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Notificar programacion de servicio</b>" data-content="<p style='width: 50%'>Este botón enviara una notificación al correo del cliente notificando la fecha de la programación de servicio... úselo únicamente cuando este seguro de los datos de la programación </p>" href="/email-solser/" class="btn btn-primary pull-right"><i class="fas fa-bell"></i><b> Notificar</b></a>
				`);*/
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOREXPRESS) || in_array(Auth::user()->UsRol, Permisos::CONDUCTOREXPRESS))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Conciliada')" style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusconciliado')}}</a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
				@if($ProgramacionesActivas == count($Programaciones))

				@elseif($ProgramacionesActivas == 0)
					$('#titulo').append(`
						<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Recibida')" class="btn btn-success pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusrecibido')}}</a>
					`);
					$('#titulo').append(`
						<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" style="margin-right:1em;" class="btn btn-warning pull-right"><i class="fas fa-exclamation-triangle"></i> Residuo Faltante</a>
					`);
				@else
					$('#titulo').append(`
						<a href='#' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Faltan Vehiculos por Recibir</b>" data-content="<p style='width: 50%'>Asegúrese de que todos los vehículos correspondientes a la solicitud de servicio <b>#{{$SolicitudServicio->ID_SolSer}}</b> hayan sido recibidos por el área de Logística antes de marcar solicitud de servicio como <b>recibida</b><br>Para mas detalles comuníquese con el <b>Jefe de Logística</b> </p>" onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Recibida')" class="btn btn-warning pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusrecibido')}}-Faltan Vehiculos</a>
					`);
					$('#titulo').append(`
						<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" style="margin-right:1em;" class="btn btn-warning pull-right"><i class="fas fa-exclamation-triangle"></i> Residuo Faltante</a>
					`);
				@endif
			@endif
		@break
		@case('Notificado')
			$('#titulo').empty();
			@if((in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) && ($SolicitudServicio->SolSerTipo == 'Externo'))
				$('#titulo').append(`

				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
				<div class="btn-group" style="float: left;">
					<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Cancelar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a onclick="ModalCancelar('{{$SolicitudServicio->SolSerSlug}}', 'Cancelado')" href="#">Cancelar Servicio</a></li>
					</ul>
				</div>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOREXPRESS) || in_array(Auth::user()->UsRol, Permisos::CONDUCTOREXPRESS))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Conciliada')" style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusconciliado')}}</a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
				@if($ProgramacionesActivas == count($Programaciones))

				@elseif($ProgramacionesActivas == 0)
					$('#titulo').append(`
						<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Recibida')" class="btn btn-success pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusrecibido')}}</a>
					`);
					$('#titulo').append(`
						<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" style="margin-right:1em;" class="btn btn-warning pull-right"><i class="fas fa-exclamation-triangle"></i> Residuo Faltante</a>
					`);
				@else
					$('#titulo').append(`
						<a href='#' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Faltan Vehiculos por Recibir</b>" data-content="<p style='width: 50%'>Asegúrese de que todos los vehículos correspondientes a la solicitud de servicio <b>#{{$SolicitudServicio->ID_SolSer}}</b> hayan sido recibidos por el área de Logística antes de marcar solicitud de servicio como <b>recibida</b><br>Para mas detalles comuníquese con el <b>Jefe de Logística</b> </p>" onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Recibida')" class="btn btn-warning pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusrecibido')}}-Faltan Vehiculos</a>
					`);
					$('#titulo').append(`
						<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" style="margin-right:1em;" class="btn btn-warning pull-right"><i class="fas fa-exclamation-triangle"></i> Residuo Faltante</a>
					`);
				@endif
			@endif

			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowprograma')}}</b><span>{{$TextProgramacion}}</span>
			`);
		@break
		@case('Residuo Faltante')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
					<a href="/serviciosexpress/{{$SolicitudServicio->SolSerSlug}}/add-respel" class="btn btn-primary pull-right"><i class="fas fa-plus"></i><b> Añadir Residuo</b></a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
					<div class="btn-group" style="float: left;">
						<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Reversar <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Notificado')" href="#">Notificado</a></li>
						</ul>
					</div>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
				@if($ProgramacionesActivas == count($Programaciones))

				@elseif($ProgramacionesActivas == 0)
					$('#titulo').append(`
						<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Recibida')" class="btn btn-success pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusrecibido')}}</a>
					`);
				@else
					$('#titulo').append(`
						<a href='#' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Faltan Vehiculos por Recibir</b>" data-content="<p style='width: 50%'>Asegúrese de que todos los vehículos correspondientes a la solicitud de servicio <b>#{{$SolicitudServicio->ID_SolSer}}</b> hayan sido recibidos por el área de Logística antes de marcar solicitud de servicio como <b>recibida</b><br>Para mas detalles comuníquese con el <b>Jefe de Logística</b> </p>" onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Recibida')" class="btn btn-warning pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusrecibido')}}-Faltan Vehiculos</a>
					`);
				@endif
			@endif

			$('#titulo').append(`
				<b>Faltan residuos por incluir en esta solicitud de servicio</b><span>{{$TextProgramacion}}</span>
			`);
		@break
		@case('Corregido')
		@case('Completado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
			$('#titulo').append(`
				<div class="btn-group" style="float: left;">
					<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Reversar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Notificado')" href="#">Notificado</a></li>
					</ul>
				</div>
			`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Conciliada')" style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusconciliado')}}</a>
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'No Deacuerdo')" class='btn btn-danger pull-left'> <i class="fas fa-calendar-times"></i> <b>{{trans('adminlte_lang::message.solserstatusnoconciliado')}}</b></a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::ADMINPLANTA) && $ultimoRecordatorio->ObsRepeat > 3)
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Conciliada')" style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusconciliado')}}</a>
				`);
			@endif

			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowcomple')}}</b>
			`);
		@break
		@case('No Conciliado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
					<div class="btn-group" style="float: left;">
						<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Reversar <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Notificado')" href="#">Notificado</a></li>
						</ul>
					</div>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Conciliación')" style="float: right;" class="btn btn-success"><i class="fas fa-certificate"></i> {{trans('adminlte_lang::message.solserstatusconciliacion')}}</a>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" style="margin-right:1em;" class="btn btn-warning pull-right"><i class="fas fa-exclamation-triangle"></i> Residuo Faltante</a>
				`);
			@endif
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowcomple')}}</b>
			`);
		@break
		@case('Conciliado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
				$('#titulo').append(`
					<div class="btn-group" style="float: left;">
						<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Reversar <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Notificado')" href="#">Notificado</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Completado')" href="#">Completado</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" href="#">Residuo Faltante</a></li>
						</ul>
					</div>
				`);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
				$('#titulo').append(`
					<a href='#' onclick="ModalStatus('{{$SolicitudServicio->SolSerSlug}}', 'Tratada')" style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatustratado')}}</a>
				`);
			@endif
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowconciliado')}}</b>
			`);
			@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				@if(in_array(Auth::user()->UsRol, Permisos::JEFELOGISTICA))
				@else
				@if ($SolicitudServicio->SolServCertStatus == 0)
				$('#titulo').append(`
					<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Enviar Certificados/Manifiestos</b>" data-content="<p style='width: 50%'>Asegúrese de haber cargado toda la documentación correspondiente a los certificados y/o manifiestos antes de usar este botón para enviarlos a facturación... úselo únicamente cuando este seguro de los datos de la haber completado todos los documentos </p>" href="/serviciosexpress/{{$SolicitudServicio->SolSerSlug}}/sendtobilling" class="btn btn-danger pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Enviar Certificados/Manifiestos</b></a>
				`);
				@else
				$('#titulo').append(`
					<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Certificados/Manifiestos Enviados</b>" data-content="<p style='width: 50%'>Toda la documentación correspondiente a los certificados y/o manifiestos ya esta disponible para facturación... Aun puede modificar los archivos cargados en el sistema, sin ambargo, es conveniente que notifique los cambios al área encargada de facturación</p>" class="btn btn-default pull-right"><i class="fas fa-file-invoice-dollar"></i><b>Certificados/Manifiestos Enviados</b></a>
				`);
				@endif
				@endif
			@endif
		@break
		@case('Tratado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || Auth::user()->email == 'logistica@prosarc.com.co')
			$('#titulo').append(`
			<div class="btn-group" style="float: left;">
				<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Reversar <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Notificado')" href="#">Notificado</a></li>
					<li role="separator" class="divider"></li>
					<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Completado')" href="#">Completado</a></li>
					<li role="separator" class="divider"></li>
					<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" href="#">Residuo Faltante</a></li>
					<li role="separator" class="divider"></li>
					<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Conciliado')" href="#">Conciliado</a></li>
				</ul>
			</div>
			`);
			@endif
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowtrata')}}</b>
			`);
			@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				@if(in_array(Auth::user()->UsRol, Permisos::JEFELOGISTICA))
				@else
				@if ($SolicitudServicio->SolServCertStatus == 0)
				$('#titulo').append(`
					<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Enviar Certificados/Manifiestos</b>" data-content="<p style='width: 50%'>Asegúrese de haber cargado toda la documentación correspondiente a los certificados y/o manifiestos antes de usar este botón para enviarlos a facturación... úselo únicamente cuando este seguro de los datos de la haber completado todos los documentos </p>" href="/serviciosexpress/{{$SolicitudServicio->SolSerSlug}}/sendtobilling" class="btn btn-danger pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Enviar Certificados/Manifiestos</b></a>
				`);
				@else
				$('#titulo').append(`
					<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Certificados/Manifiestos Enviados</b>" data-content="<p style='width: 50%'>Toda la documentación correspondiente a los certificados y/o manifiestos ya esta disponible para facturación... Aun puede modificar los archivos cargados en el sistema, sin ambargo, es conveniente que notifique los cambios al área encargada de facturación</p>" class="btn btn-default pull-right"><i class="fas fa-file-invoice-dollar"></i><b>Certificados/Manifiestos Enviados</b></a>
				`);
				@endif
				@endif
			@endif
		@break
		@case('Certificacion')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::REVERSARADMIN) || in_array(Auth::user()->UsRol2, Permisos::REVERSARADMIN))
				$('#titulo').append(`
					<div class="btn-group" style="float: left;">
						<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Reversar <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Notificado')" href="#">Notificado</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Completado')" href="#">Completado</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" href="#">Residuo Faltante</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Conciliado')" href="#">Conciliado</a></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Facturado')" href="#">Facturado</a></li>
						</ul>
					</div>
				`);
			@endif
			$('#titulo').append(`
				<b>{{trans('adminlte_lang::message.solsershowcertifica')}}</b>
			`);
			@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				@if(in_array(Auth::user()->UsRol, Permisos::JEFELOGISTICA))
				@else
					@if ($SolicitudServicio->SolServCertStatus == 0)
					$('#titulo').append(`
						<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Enviar Certificados/Manifiestos</b>" data-content="<p style='width: 50%'>Asegúrese de haber cargado toda la documentación correspondiente a los certificados y/o manifiestos antes de usar este botón para enviarlos a facturación... úselo únicamente cuando este seguro de los datos de la haber completado todos los documentos </p>" href="/serviciosexpress/{{$SolicitudServicio->SolSerSlug}}/sendtobilling" class="btn btn-danger pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Enviar Certificados/Manifiestos</b></a>
					`);
					@else
					$('#titulo').append(`
						<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Certificados/Manifiestos Enviados</b>" data-content="<p style='width: 50%'>Toda la documentación correspondiente a los certificados y/o manifiestos ya esta disponible para facturación... Aun puede modificar los archivos cargados en el sistema, sin ambargo, es conveniente que notifique los cambios al área encargada de facturación</p>" class="btn btn-default pull-right"><i class="fas fa-file-invoice-dollar"></i><b>Certificados/Manifiestos Enviados</b></a>
					`);
					@endif
				@endif
			@endif
		@break
		@case('Facturado')
			$('#titulo').empty();
			@if(in_array(Auth::user()->UsRol, Permisos::REVERSARADMIN) || in_array(Auth::user()->UsRol2, Permisos::REVERSARADMIN))
				$('#titulo').append(`
					<div class="btn-group" style="float: left;">
						<button type="button" style="margin-right:1em;" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Reversar <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Notificado')" href="#">Notificado</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Completado')" href="#">Completado</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Residuo Faltante')" href="#">Residuo Faltante</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="ModalReversar('{{$SolicitudServicio->SolSerSlug}}', 'Conciliado')" href="#">Conciliado</a></li>
						</ul>
					</div>
				`);
			@endif
			$('#titulo').append(`
				<b>{{'Se han emitido los facturas correspondientes de la solicitud'}}</b>
			`);
			@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				@if(in_array(Auth::user()->UsRol, Permisos::JEFELOGISTICA))
				@else
					@if ($SolicitudServicio->SolServCertStatus == 0)
					$('#titulo').append(`
						<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Enviar Certificados/Manifiestos</b>" data-content="<p style='width: 50%'>Asegúrese de haber cargado toda la documentación correspondiente a los certificados y/o manifiestos antes de usar este botón para enviarlos a facturación... úselo únicamente cuando este seguro de los datos de la haber completado todos los documentos </p>" href="/serviciosexpress/{{$SolicitudServicio->SolSerSlug}}/sendtobilling" class="btn btn-danger pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Enviar Certificados/Manifiestos</b></a>
					`);
					@else
					$('#titulo').append(`
						<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Certificados/Manifiestos Enviados</b>" data-content="<p style='width: 50%'>Toda la documentación correspondiente a los certificados y/o manifiestos ya esta disponible para facturación... Aun puede modificar los archivos cargados en el sistema, sin ambargo, es conveniente que notifique los cambios al área encargada de facturación</p>" class="btn btn-default pull-right"><i class="fas fa-file-invoice-dollar"></i><b>Certificados/Manifiestos Enviados</b></a>
					`);
					@endif
				@endif
			@endif
		@break
	@endswitch

	function ModalReversar(slug, status){
	$('#ModalReversar').empty();
	$('#ModalReversar').append(`
	<div class="modal modal-default fade in" id="myModalreversar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
						<i class="fas fa-exclamation-triangle"></i>
						<span style="font-size: 0.3em; color: black;">
							<p>Desea devolver la solicitud de servicio al status <b>`+status+`</b>?</p>
						</span>
					</div>
				</div>
				<form action="/serviciosexpress/reversarStatus" method="POST" data-toggle="validator" id="SolSerReversar">
					<div class="modal-header">
						@csrf
						<div class="form-group col-md-12">
							<label color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserstatusdescrip') }}</b>" data-content="{{ trans('adminlte_lang::message.solserstatusdescripdetaill') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solserstatusdescrip')}}</label>
							<small id="caracteresrestantesReversar" class="help-block with-errors">`+(status == 'No Deacuerdo' ? '*' : '')+`</small>
							<textarea onchange="updatecaracteres()" id="textDescriptionReversar" rows="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" `+(status=='No Deacuerdo' ? 'required' : '' )+` name="solserdescript"></textarea>
						</div>
						<input type="submit" id="Reversar`+slug+`" style="display: none;">
						<input type="text" name="solserslug" value="`+slug+`" style="display: none;">
						<input type="text" name="solserstatus" value="`+status+`" style="display: none;">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Cancelar</button>
						<label for="Reversar`+slug+`" class='btn btn-success'>Enviar</label>
					</div>
				</form>
			</div>
		</div>
	</div>
	`);
	$('#SolSerReversar').validator('update');
	popover();
	var area = document.getElementById("textDescriptionReversar");
	var message = document.getElementById("caracteresrestantesReversar");
	var maxLength = 4000;
	$('#textDescriptionReversar').keyup(function () {
	message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
	observacion = area.value;
	});
	envsubmit();
	$('#myModalreversar').modal();
	}

	function ModalCancelar(slug, status){
	$('#ModalCancelar').empty();
	$('#ModalCancelar').append(`
	<div class="modal modal-default fade in" id="myModalCancelar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
						<i class="fas fa-exclamation-triangle"></i>
						<span style="font-size: 0.3em; color: black;">
							<p>Desea Cambiar la solicitud de servicio al status <b>`+status+`</b>?</p>
							<ul class="list-group" style="font-size: 0.8em; font-style: oblique;">
								<li class="list-group-item">Serán eliminadas las programaciones de vehículos</li>
								<li class="list-group-item">No se genera notificación por correo</li>
								<li class="list-group-item">debe especificar las razones de la cancelación</li>
							</ul>
						</span>
					</div>
				</div>
				<form action="/serviciosexpress/cancelarServicio" method="POST" data-toggle="validator" id="SolSerCancelar">
					<div class="modal-header">
						@csrf
						<div class="form-group col-md-12">
							<label color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserstatusdescrip') }}</b>" data-content="{{ trans('adminlte_lang::message.solserstatusdescripdetaill') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solserstatusdescrip')}}</label>
							<small id="caracteresrestantesCancelar" class="help-block with-errors">`+(status == 'No Deacuerdo' ? '*' : '')+`</small>
							<textarea onchange="updatecaracteres()" id="textDescriptionCancelar" rows="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" required name="solserdescript"></textarea>
						</div>
						<input type="submit" id="Cancelar`+slug+`" style="display: none;">
						<input type="text" name="solserslug" value="`+slug+`" style="display: none;">
						<input type="text" name="solserstatus" value="`+status+`" style="display: none;">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Cancelar</button>
						<label for="Cancelar`+slug+`" class='btn btn-success'>Enviar</label>
					</div>
				</form>
			</div>
		</div>
	</div>
	`);
	$('#SolSerCancelar').validator('update');
	popover();
	var area = document.getElementById("textDescriptionCancelar");
	var message = document.getElementById("caracteresrestantesCancelar");
	var maxLength = 4000;
	$('#textDescriptionCancelar').keyup(function () {
	message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
	observacion = area.value;
	});
	envsubmit();
	$('#myModalCancelar').modal();
	}
</script>

@endsection
