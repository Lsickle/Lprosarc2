@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.solsertitle')}}
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
						<div class="col-md-12" id="titulo" style="font-size: 1.2em;">
						</div>
					</div>
				<div class="row">
					<div class="col-md-12 ">
						<div class="box box-info">
							<div class="col-md-12" style="text-align: center; margin-top: 20px; border-bottom:#f4f4f4 solid 2px;">
								<div class="col-md-4">
									<label>{{trans('adminlte_lang::message.solsershowdate')}}</label>
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
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->PersAddress}}</p>">{{$SolicitudServicio->PersAddress}}</a>
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
										<a>{{$SolicitudServicio->SolSerCityTrans}}</a>
									</div>
								</div>
								<div class="col-md-12 border-gray collapse Transportadora">
									<div class="col-md-6">
										<label>{{ trans('adminlte_lang::message.solserconduc') }}:</label><br>
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
										<label>{{ trans('adminlte_lang::message.solservehic') }}:</label><br>
										<a>{{$SolicitudServicio->SolSerVehiculo == null ? trans('adminlte_lang::message.solsernullprogram') : $SolicitudServicio->SolSerVehiculo}}</a>
									</div>
								</div>
							</div>
							<div class="col-md-12 border-gray" {{$SolicitudServicio->SolSerTipo == "Externo" ? 'hidden' : ''}}>
								<div class="col-md-12">
									<label>{{ trans('adminlte_lang::message.solseraddrescollect') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solseraddrescollect') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolSerCollectAddress}}</p>">{{$SolSerCollectAddress}}</a>
									<a href='#' data-toggle='modal' data-target='#ModalRequerimientos' class='btn btn-info pull-right'><i class="fas fa-list-ol"></i> <b>Residuos Requerimientos</b></a>
								</div>
							</div>
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
									<div class="col-md-4" style="text-align: center;">
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
										$TotalTrat = 0;
									@endphp
									<thead>
										<tr>
											<th>{{trans('adminlte_lang::message.solserrespel')}}</th>
											<th>{{trans('adminlte_lang::message.solserembaja')}}</th> 
											<th>{{trans('adminlte_lang::message.gener')}}</th>
											<th>{{trans('adminlte_lang::message.solsercantidadkg')}} <br> {{trans('adminlte_lang::message.solsercantienv')}}</th>
											<th>{{trans('adminlte_lang::message.solsercantidadkg')}} <br> {{trans('adminlte_lang::message.solsercantiresi')}}</th>
											<th>{{trans('adminlte_lang::message.solsercantidadkg')}} <br> {{trans('adminlte_lang::message.solsercanticonsi')}}</th>
											@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
												<th>{{trans('adminlte_lang::message.solsercantidadkg')}} <br> {{trans('adminlte_lang::message.solsercantitrat')}}</th>
											@endif
											<th>{{trans('adminlte_lang::message.seedetails')}}</th>
											@if($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aprobado')
												<th>{{trans('adminlte_lang::message.delete')}}</th>
											@elseif($SolicitudServicio->SolSerStatus == 'Certificacion')
												<th>Certificado</th>
											@endif
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
													$TotalTrat = $Residuo->SolResKgTratado+$TotalTrat;
												@endphp
											<tr>
												<td><a title="Ver Residuo" href="/respels/{{$Residuo->RespelSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$Residuo->RespelName}}</td>
												<td>{{$Residuo->SolResEmbalaje}}</td>
												<td><a title="Ver Generador" href="/sgeneradores/{{$GenerResiduo->GSedeSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$GenerResiduo->GenerShortname.' ('.$GenerResiduo->GSedeName.')'}}</td>
												<td style="text-align: center;">{{$Residuo->SolResKgEnviado}}</td>
												<td style="text-align: center;">
													@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
														@if($SolicitudServicio->SolSerStatus == 'Completado')
															<a href="#" onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResKgRecibido}}`, `{{$Residuo->SolResKgConciliado}}`)"><i class="fas fa-marker"></i></a>
														@else
															<a style="color: black"><i class="fas fa-marker"></i></a>
														@endif
													@endif
													{{$Residuo->SolResKgRecibido}}
												</td>
												<td style="text-align: center;">{{$Residuo->SolResKgConciliado}}</td>
												@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
													@if($SolicitudServicio->SolSerStatus == 'Conciliado')
														<td style="text-align: center;"><a href="#" class="kg" onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResKgTratado}}`, `{{$Residuo->SolResKgConciliado}}`)"><i class="fas fa-marker"></i></a>{{$Residuo->SolResKgTratado}}</td>
													@else
														<td style="text-align: center;"><a style="color: black"><i class="fas fa-marker"></i></a>{{$Residuo->SolResKgTratado}}</td>
													@endif
												@endif
												<td style="text-align: center;"><a href='/recurso/{{$Residuo->SolResSlug}}' target="_blank" class='btn btn-primary'> <i class="fas fa-biohazard"></i> </a></td>
												@if($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aprobado')
													<td style="text-align: center;"><a href='#' onclick="ModalDeleteRespel(`{{$Residuo->SolResSlug}}`, `{{$Residuo->RespelName}}`, `{{$GenerResiduo->GenerShortname}}`)" class='btn btn-danger'><i class="fas fa-trash-alt"></i></a></td>
												@elseif($SolicitudServicio->SolSerStatus == 'Certificacion')
													<td style="text-align: center;"><a href="#" class="btn btn-info"> <i class="fas fa-file-pdf fa-lg"></i></a></td>
												@endif
											</tr>
											@endif
										@endforeach
									@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th colspan="3">{{trans('adminlte_lang::message.solsershowcantitotal')}}</th>
											<th style="text-align: right;">{{$TotalEnv}} kg</th>
											<th style="text-align: right;">{{$TotalRec}} kg</th>
											<th style="text-align: right;">{{$TotalCons}} kg</th>
											@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
												<th style="text-align: right;">{{$TotalTrat}} kg</th>
											@endif
											@if($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aprobado' || $SolicitudServicio->SolSerStatus == 'Certificacion')
												<th colspan="2"></th>
											@else
												<th></th>
											@endif
										</tr>
									</tfoot>
								</table>
								<div id="ModalDeleteRespel"></div>
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
																<div class="col-md-6 col-xs-6" style="border-bottom: 2px solid black; border-right: 1px solid black;">
																	<label>{{trans('adminlte_lang::message.requeredescargue')}}</label>
																	<div style="width: 100%;">
																		<input type="checkbox" class="fotoswitch" data-size="small" {{ $Residuo->SolResFotoDescargue_Pesaje == 1 ? 'checked' : '' }}/>
																		<input type="checkbox" class="videoswitch" data-size="small" {{ $Residuo->SolResVideoDescargue_Pesaje == 1 ? 'checked' : '' }}/>
																	</div>
																</div>
																<div class="col-md-6 col-xs-6" style="border-bottom: 2px solid black; border-left: 1px solid black;">
																	<label style="text-align: center;">{{trans('adminlte_lang::message.requeretratamiento')}}</label>
																	<div style="width: 100%;">
																		<input type="checkbox" class="fotoswitch" data-size="small" {{ $Residuo->SolResFotoTratamiento == 1 ? 'checked' : '' }}/>
																		<input type="checkbox" class="videoswitch" data-size="small" {{ $Residuo->SolResVideoTratamiento == 1 ? 'checked' : '' }}/>
																	</div>
																</div>
															</div>
														@endforeach 
													</div><br><br><br>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-primary" data-dismiss="modal">salir</button>
												</div>
											</div>
										</div>
									</div>
								{{-- END Modal --}}
								{{-- Modal --}}
								  	<div id="addkgmodal"></div>
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
@if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno'))
	<script>
		function addkg(slug, cantidad, conciliado){
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
											@if($SolicitudServicio->SolSerStatus === 'Completado')
												Resivida
											@else
												Tratada
											@endif
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
										@if($SolicitudServicio->SolSerStatus === 'Completado')
											<label for="SolResKg">Cantidad Resivida</label>
											<small class="help-block with-errors">*</small>
											<input type="text" class="form-control" id="SolResKg" name="SolResKg" maxlength="11" value="`+cantidad+`" required>
										@else
											<label for="SolResKg">Cantidad Tratada</label>
											<small class="help-block with-errors">*</small>
											<div class="input-group">
												<input type="text" class="form-control" id="SolResKg" name="SolResKg" maxlength="11" value="`+cantidad+`" required>
												<div class="input-group-btn">
													<label for="ValorConciliado"><a title="Lo consiliado ya esta tratado" id="btn-consiliado" class="btn btn-success" onclick="submit(`+conciliado+`)">Tratado</a><label>
													<div id="conciliadokg"></div>
												</div>
											</div>
										@endif
										<input type="text" hidden name="SolRes" value="`+slug+`">
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.save')}}</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			`);
			if('{{$SolicitudServicio->SolSerStatus === "Conciliado"}}'){
				$('#SolResKg').inputmask({ alias: 'numeric', max:conciliado, rightAlign:false});
			}else{
				$('#SolResKg').inputmask({ alias: 'numeric', max:'99999999999', rightAlign:false});
			}
			$('#editkgResivido').modal();
			$('#FormKg').validator('update');
		};

		function submit(conciliado){
			$('#conciliadokg').append(`
				<input type="text" hidden name="ValorConciliado" id="ValorConciliado" value="`+conciliado+`">
			`);
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
	$('.testswitch').bootstrapSwitch('disabled',true);
	$('.fotoswitch').bootstrapSwitch('disabled',true);
	$('.videoswitch').bootstrapSwitch('disabled',true);

	var title = `<h4><b>{{trans('adminlte_lang::message.solsertitle')}}</b></h4>`;
	var edit = `<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>`;
	var deletesolser = `<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolicitudServicio->SolSerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>`;
	var aprobar = `<a href='/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/changestatus' class="btn btn-success pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusaprobado')}}</a>`;
	var programado = `<b>{{trans('adminlte_lang::message.solsershowprograma')}}</b><spam>{{$TextProgramacion}}</spam>`;
	var recibir = `<a href='/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/changestatus' class="btn btn-success pull-right"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusrecibido')}}</a>`;
	var recibido = `<b>{{trans('adminlte_lang::message.solsershowcomple')}}</b>`;
	var conciliar = `<a href='/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/changestatus' style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatusconciliado')}}</a>`;
	var conciliado = `<b>{{trans('adminlte_lang::message.solsershowconciliado')}}</b>`;
	var tratar = `<a href='/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/changestatus' style="float: right;" class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{trans('adminlte_lang::message.solserstatustratado')}}</a>`;
	var certificar = `<a href='/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/changestatus' style="float: right;" class="btn btn-success"><i class="fas fa-certificate"></i> {{trans('adminlte_lang::message.solserstatuscertifi')}}</a></div>`;
	var certificado = `<b>{{trans('adminlte_lang::message.solsershowcertifica')}}</b>`;
	@switch($SolicitudServicio->SolSerStatus)
		@case('Pendiente')
			$('#titulo').empty();
			@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
				$('#titulo').append(edit);
				$('#titulo').append(deletesolser);
			@endif
			@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
				@if(Auth::user()->UsRol === trans('adminlte_lang::message.AuxiliarLogistica') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
					$('#titulo').append(aprobar);
				@endif
				@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Programador'))
					$('#titulo').append(title);
				@endif
			@endif
		@break
		@case('Aprobado')
			$('#titulo').empty();
			@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
				$('#titulo').append(edit);
				$('#titulo').append(deletesolser);
			@endif
			@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
				@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Programador'))
					$('#titulo').append(title);
				@endif
			@endif
		@break
		@case('Programado')
			$('#titulo').empty();
			@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') && $SolicitudServicio->SolSerTipo == 'Externo')
				$('#titulo').append(edit);
			@endif
			@if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') && $ProgramacionesActivas <= 0)
				$('#titulo').append(recibir);
			@endif
			$('#titulo').append(programado);
		@break
		@case('Completado')
			$('#titulo').empty();
			@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
				$('#titulo').append(conciliar);
			@endif
			$('#titulo').append(recibido);
		@break
		@case('Conciliado')
			$('#titulo').empty();
			@if(Auth::user()->UsRol === trans('adminlte_lang::message.JefeOperacion') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
				$('#titulo').append(tratar);
			@endif
			@if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
				$('#titulo').append(certificar);
			@endif
			$('#titulo').append(conciliado);
		@break
		@case('Tratado')
			$('#titulo').empty();
			@if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
				$('#titulo').append(certificar);
			@endif
			$('#titulo').append(conciliado);
		@break
		@case('Certificacion')
			$('#titulo').empty();
			$('#titulo').append(certificado);
		@break
	@endswitch
</script>
@endsection