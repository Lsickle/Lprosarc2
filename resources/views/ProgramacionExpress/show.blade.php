@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
	{{'Manifiesto de carga'}}
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
							<div class="col-md-12 border-gray">
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solsershowempre') }}</label><br>
									<a>{{$Cliente->CliName}}</a>
								</div>
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solsershowemprenit') }}</label><br>
									<a>{{$Cliente->CliNit}}</a>
								</div>
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solsershowempreaddress') }}</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solsershowempreaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->SedeAddress}}</p>">{{$Cliente->SedeAddress}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solsershowemprecity') }}</label><br>
									<a>{{$Cliente->MunName}}</a>
								</div>
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solserpersonal') }}:</label><br>
									<a>{{$SolicitudServicio->PersFirstName.' '.$SolicitudServicio->PersLastName}}</a>
								</div>
								<div class="col-md-4">
									<label>Cargo/Area</label><br>
									<a>
										{{$SolicitudServicio->CargName}} / {{$SolicitudServicio->AreaName}}
									</a>
								</div>
							</div>
							{{-- <div class="col-md-12 border-gray">
								
								
							</div> --}}
							<div class="col-md-12 border-gray">
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.emailaddress') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->PersEmail}}</p>">{{$SolicitudServicio->PersEmail}}</a>
								</div>
								<div class="col-md-4">
									<label>Celular</label><br>
									<a>{{$SolicitudServicio->PersCellphone}}</a>
								</div>
								<div class="col-md-4">
									<button type="button" class="btn btn-box-tool boton" style="color: black; float: right;" data-toggle="collapse" data-target=".Transportadora" onclick="AnimationMenusForm('.Transportadora')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>	
								</div>
							</div>
							<div class="col-md-12 border-gray collapse Transportadora">
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solsershowtransempre') }}</label><br>
									<a>{{$SolicitudServicio->SolSerNameTrans}}</a>
								</div>
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solsertransnit') }}:</label><br>
									<a>{{$SolicitudServicio->SolSerNitTrans}}</a>
								</div>
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solsertransaddress') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solsertransaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->SolSerAdressTrans}}</p>">{{$SolicitudServicio->SolSerAdressTrans}}</a>
								</div>
								
							</div>
							<div class="col-md-12 border-gray collapse Transportadora">
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solsershowtranscity') }}</label><br>
									<a>{{$Municipio}}</a>
								</div>
								@if($SolicitudServicio->SolSerTipo == 'Interno')
									<div class="col-md-4">
										<label>{{ trans('adminlte_lang::message.solserconduc') }}:</label><br>
										<a>{{$SolicitudServicio->SolSerConductor == null ? trans('adminlte_lang::message.solsernullprogram') : $SolicitudServicio->SolSerConductor}}</a>
									</div>
									<div class="col-md-4">
										<label>{{ trans('adminlte_lang::message.solservehic') }}:</label><br>
										<a>{{$SolicitudServicio->SolSerVehiculo == null ? trans('adminlte_lang::message.solsernullprogram') : $SolicitudServicio->SolSerVehiculo}}</a>
									</div>
								@else
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solserconduc') }}:</label><br>
									<a>{{$SolSerConductor == null ? 'N/A' : $SolSerConductor}}</a>
								</div>
								<div class="col-md-4">
									<label>{{ trans('adminlte_lang::message.solservehic') }}:</label><br>
									<a>{{$SolicitudServicio->SolSerVehiculo == null ? 'N/A' : $SolicitudServicio->SolSerVehiculo}}</a>
								</div>
								@endif
							</div>
							<div class="col-md-12 border-gray">
								<div class="col-md-4" {{$SolicitudServicio->SolSerDescript == null ? 'hidden' : ''}}>
									<label>{{ trans('adminlte_lang::message.solserstatusdescrip') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solserstatusdescrip') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolicitudServicio->SolSerDescript}}</p>">{{$SolicitudServicio->SolSerDescript}}</a>
								</div>
								<div class="col-md-4" {{$SolicitudServicio->SolSerTipo == "Externo" ? 'hidden' : ''}}>
									<label>{{ trans('adminlte_lang::message.solseraddrescollect') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solseraddrescollect') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolSerCollectAddress}}</p>">{{$SolSerCollectAddress}}</a>
								</div>
								<div class="col-md-4">

								</div>
								<div class="col-md-4">
									@if (in_array(Auth::user()->UsRol, Permisos::SolSer2) || in_array(Auth::user()->UsRol2, Permisos::SolSer2))
										<a style="margin: 10px 10px;" href='#' data-toggle='modal' data-target='#ModalRequerimientos' class='btn btn-info pull-right'><i class="fas fa-list-ol"></i> <b>Requerimientos de Residuos</b></a>
									@endif
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
											<th>Clasificación <br>4741</th>
											<th>Estado Físico</th>
											<th>Peligrosidad</th>
											<th>{{trans('adminlte_lang::message.solserembaja')}}</th> 
											<th>{{trans('adminlte_lang::message.gener')}}</th>
											<th>{{trans('adminlte_lang::message.address')}}</th>
											<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercantienv')}}</th>
											
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
												<td>{{$Residuo->TratName}}</td>
												<td>
													@if($Residuo->YRespelClasf4741 == NULL)
													<p>
														{{$Residuo->ARespelClasf4741}}
													</p>
													@else
													<p>
														{{$Residuo->YRespelClasf4741}}
													</p>
													@endif
												</td>
												<td>
													{{$Residuo->RespelEstado}}
												</td>
												<td>
													{{$Residuo->RespelIgrosidad}}
												</td>
												<td>{{$Residuo->SolResEmbalaje}}</td>
												<td>{{$GenerResiduo->GenerName.' ('.$GenerResiduo->GSedeName.')'}}</td>
												<td>{{$GenerResiduo->GSedeAddress}} - Municipio:{{$GenerResiduo->MunName}}</td>
												<td style="text-align: center;">{{$Residuo->SolResKgEnviado}} Kilogramos</td>
												
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
<script>

	$('.testswitch').bootstrapSwitch('disabled',true);
	$('.fotoswitch').bootstrapSwitch('disabled',true);
	$('.videoswitch').bootstrapSwitch('disabled',true);

</script>
@endsection