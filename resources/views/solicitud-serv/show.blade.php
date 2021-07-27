@extends('layouts.app')
@section('htmlheader_title')
Solicitud de servicio N° {{$SolicitudServicio->ID_SolSer}}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	Servicios-Solicitudes
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
									<label>Observaciones:</label><br>
									<a href="#" style="overflow: hidden;
									text-overflow: ellipsis;
									display: inline-block;
									white-space: nowrap;
									max-width: 100%;" title="Observaciones" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{!!nl2br($SolicitudServicio->SolSerDescript)!!}</p>">{{$SolicitudServicio->SolSerDescript}}</a>
								</div>
								<div class="col-md-6" {{$SolicitudServicio->SolSerTipo == "Externo" ? 'hidden' : ''}}>
									<label>{{ trans('adminlte_lang::message.solseraddrescollect') }}:</label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.solseraddrescollect') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolSerCollectAddress}}</p>">{{$SolSerCollectAddress}}</a>
								</div>
							</div>
							@if (in_array(Auth::user()->UsRol, Permisos::SolSer2) || in_array(Auth::user()->UsRol2, Permisos::SolSer2))
								@switch($SolicitudServicio->SolSerStatus)
								    @case('Pendiente')
								    @case('Aceptado')
								    @case('Aprobado')
								    @case('Programado')
								    @case('Notificado')
								    @case('Completado')
								    @case('Recibida')
								    @case('No Conciliado')
								        <a disabled data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Certificaciones/Manifiestos</b>" data-content="La página de certificados y manifiestos, de este servicio, estara disponible a partir de que el <b>Cliente</b> acepte la conciliación de pesos en la Solicitud de servicio" style="margin: 10px 10px;" class='btn btn-default pull-right'><i class="fas fa-file-pdf"></i> <b>Certificaciones/Manifiestos</b></a>
								        @break

								    @case('Conciliado')
								    @case('Certificacion')
								    @case('Tratado')
								    @case('Facturado')
								        <a style="margin: 10px 10px;" href='{{$SolicitudServicio->SolSerSlug}}/documentos/' class='btn btn-info pull-right'><i class="fas fa-file-pdf"></i> <b>Certificaciones/Manifiestos</b></a>
								        @break

								    @default
								        <a disabled data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Certificaciones/Manifiestos</b>" data-content="la documentación relativa a certificados y manifiestos estara disponible a partir de que el <b>Cliente</b> acepte la conciliacion de pesos en la Solicitud de servicio" style="margin: 10px 10px;" class='btn btn-default pull-right'><i class="fas fa-file-pdf"></i> <b>Certificaciones/Manifiestos</b></a>
								@endswitch
								
							@endif
							@if (in_array(Auth::user()->UsRol, Permisos::SolSer2) || in_array(Auth::user()->UsRol2, Permisos::SolSer2))
							@php
							$alertaRequerimientos = 0;
							foreach ($Residuos as $key => $Residuo) {
								if ($Residuo->SolResFotoDescargue_Pesaje == 1||$Residuo->SolResVideoDescargue_Pesaje == 1||$Residuo->SolResFotoTratamiento == 1||$Residuo->SolResVideoTratamiento == 1||$Residuo->SolResDevolucion == 1||$Residuo->SolResAuditoria == 1) {
									$alertaRequerimientos = $alertaRequerimientos + 1;
								}
							}
							@endphp
								<a style="margin: 10px 10px;" href='#' data-toggle='modal' data-target='#ModalRequerimientos' class='btn {{$alertaRequerimientos > 0 ? 'btn-warning' : 'btn-default'}} pull-right'><i class="fas fa-list-ol"></i> <b>Requerimientos de Residuos</b></a>
							@endif
							@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL))
								@if($SolicitudServicio->SolSerSupport <> null)
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Soporte de Pago</b>" data-content="{{in_array(Auth::user()->UsRol, Permisos::CLIENTE) ? 'Haga click para visualizar el PDF del soporte de pago, que adjuntó, para esta solicitud de servicio' : 'Haga click para visualizar el PDF del soporte de pago, adjuntado por el cliente, para esta solicitud de servicio'}}"><a href="/img/SupportPay/{{$SolicitudServicio->SolSerSupport}}" class="btn btn-info pull-left" target="_blank" style="margin: 10px 30px;">Soporte <i class="fas fa-file-pdf fa-lg"></i></a></label>
									
								@else
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Soporte de Pago</b>" data-content="{{in_array(Auth::user()->UsRol, Permisos::CLIENTE) ? 'Aun no ha adjuntado un soporte de pago para esta solicitud de servicio' : 'El cliente no ha adjuntado un soporte de pago para esta solicitud de servicio'}}"><a href="#" class="btn btn-default pull-left"  style="margin: 10px 30px;">Soporte <i class="fas fa-file-pdf fa-lg"></i></a></label>
								@endif
								
							@endif
							@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::ProgVehic1))
							@if ($SolicitudServicio->Repetible == 0)
							<label class="pull-right" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover"
								data-delay='{"show": 200}' title="<b>Repetir Solicitud de Servicio</b>"
								data-content="al hacer click en este botón podrá crear una nueva solicitud de servicio usando como base los datos de esta solicitud"><a
									href='#' data-toggle='modal' style="margin: 10px  30px;" data-target='#ModalRepeat' class="btn btn-info">Repetir
									<i class="fas fa-redo-alt"></i></a></label>
							@else
							<label class="pull-right" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover"
								data-delay='{"show": 200}' title="<b>Repetir Solicitud de Servicio</b>"
								data-content="alguno de los residuos de este servicio no tiene un tratamiento ofertado por lo cual no puede repetir esta solicitud"><a
									disabled href='#' data-toggle='' style="margin: 10px  30px;" data-target='' class="btn btn-default">Repetir <i
										class="fas fa-redo-alt"></i></a></label>
							@endif
							@switch($SolicitudServicio->SolSerStatus)
							@case('Completado')
							@case('Recibida')
							@case('Notificado')
							@case('Aceptado')
							@case('Aprobado')
							@case('Conciliado')
							@case('Pendiente')
							@case('Notificado')
							@case('Programado')
							@case('No Conciliado')
							@case('Tratado')
							@case('Facturado')
							<a disabled data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}'
								title="<b>Certificaciones/Manifiestos</b>"
								data-content="La documentación relativa a certificados y manifiestos estará disponible a partir de que <b>Prosarc S.A. ESP</b> cargue en el sistema la información necesaria"
								style="margin: 10px 10px;" class='btn btn-default pull-right'><i class="fas fa-file-pdf"></i>
								<b>Certificaciones/Manifiestos</b></a>
							@break
							
							@case('Certificacion')
							<a style="margin: 10px 10px;" href='{{$SolicitudServicio->SolSerSlug}}/documentos/' class='btn btn-info pull-right'><i
									class="fas fa-file-pdf"></i> <b>Certificaciones/Manifiestos</b></a>
							@break
							
							
							@default
							<a disabled data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}'
								title="<b>Certificaciones/Manifiestos</b>"
								data-content="La documentación relativa a certificados y manifiestos estará disponible a partir de que <b>Prosarc S.A. ESP</b> cargue en el sistema la información necesaria"
								style="margin: 10px 10px;" class='btn btn-default pull-right'><i class="fas fa-file-pdf"></i>
								<b>Certificaciones/Manifiestos</b></a>
							@endswitch
							@endif
							
							<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Cantidades Totales</b>" data-content="Haga click para visualizar los totales por tratamiento de la solicitud de servicio"><a style="margin: 10px 10px;" href='#' data-toggle='modal' data-target='#ModalTotales' class='btn btn-info pull-right'><i class="fas fa-list-ol"></i> <b>Totales</b></a></label>
							<label>
								<div class="btn-group pull-right" style="margin: 10px 10px;">
									<a type=button href='#' data-toggle='modal' data-target='#ModalObservaciones' class='btn btn-info'><i class="fas fa-comments fa-1x"></i> <b>Historial</b></a>
									<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" style="left:0">
										<li class="dropdown-header">Observaciones</li>
										<li role="separator" class="divider"></li>
										<li><a data-toggle='modal' data-target='#ModalNewObserv'>Añadir Observación</a></li>
										@if ($SolicitudServicio->SolSerStatus == 'Completado' && in_array(Auth::user()->UsRol, Permisos::ProgVehic2))
										<li>
											<a data-toggle='modal' data-target='#ModalSendRecordatorio'>Enviar Recordatorio {{$ultimoRecordatorio->ObsRepeat + 1 }} <br>Ultimo: {{date('d-m-Y',strtotime($ultimoRecordatorio->ObsDate))}}</a>										
										</li>
										@endif
										@if ($SolicitudServicio->SolSerStatus !== 'Aprobado' && in_array(Auth::user()->UsRol, Permisos::SolSer2))
										<li>
											<a data-toggle='modal' data-target='#ModalRecepcionErrada'>Recepcion Errada</a>										
										</li>
										@endif
									</ul>
								</div>
							</label>
							<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>RMs</b>" data-content="Haga click para visualizar los Números de Recibo de Materiales (<b>RM</b>) relacionados con esta Solicitud de Servicio"><a onclick="updateRMs(`{{$SolicitudServicio->SolSerSlug}}`)" style="margin: 10px 10px;" class='btn btn-info pull-right'><i class="fas fa-list-ol"></i><b> RMs</b></a></label>

							<div class="col-md-12" style="margin: 10px 0;">
								<center>
								<label {{($SolicitudServicio->SolSerBascula == 1 || $SolicitudServicio->SolSerCapacitacion == 1 || $SolicitudServicio->SolSerMasPerson == 1 || $SolicitudServicio->SolSerVehicExclusive == 1 || $SolicitudServicio->SolSerPlatform == 1) ? 'style=color:red;' : ''}}>Requerimientos de la solicitud</label>
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
											@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)||in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC))
												<th>#RM</th>
											@endif
											<th>{{trans('adminlte_lang::message.solserrespel')}}</th>
											<th>Tratamiento</th>
											{{-- <th>Pretratamientos</th> --}}
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
											@if(($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aceptado' || $SolicitudServicio->SolSerStatus == 'Aprobado'|| $SolicitudServicio->SolSerStatus == 'Residuo Faltante') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
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
												@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)||in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC))
													<td>
														@if ($Residuo->SolResRM2 !== null && is_Array($Residuo->SolResRM2))
															@foreach ($Residuo->SolResRM2 as $rm => $value)
																{{$value}}<br>
															@endforeach
														@else
															{{'RM Invalido -> '}} {{$Residuo->SolResRM}}
														@endif
													</td>
												@endif
												<td><a title="Ver Residuo" href="/respels/{{$Residuo->RespelSlug}}" target="_blank" {{(in_array(Auth::user()->UsRol, Permisos::AREALOGISTICA))&&($Residuo->RespelStatus != "Revisado") ? 'style=color:red;' : ""}} >
													<i class="fas fa-external-link-alt"></i>
													</a>
													@if((in_array(Auth::user()->UsRol, Permisos::AREALOGISTICA))&&($Residuo->SustanciaControladaTipo == 0)&&($Residuo->SustanciaControlada != Null))
														<a><i class="fas fa-flask" style="color: green"></i></a>
													@endif
													 {{$Residuo->RespelName}}</td>
												<td>
													@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
														@switch($SolicitudServicio->SolSerStatus)
															@case('Aprobado')
															@case('Aceptado')
															@case('Notificado')
															@case('Completado')
															@case('No Conciliado')
																<a onclick="changeTratamiento(`{{$Residuo->SolResSlug}}`, `{{$Residuo->ID_Trat}}`, `{{$Residuo->TratName}}`, `{{$Residuo->FK_SolResRequerimiento}}`, `{{$SolicitudServicio->SolSerSlug}}`)">
																@break
															@case('Conciliado')
															@case('Certificacion')
															@case('Certificado')
															@case('Tratado')
															@case('Facturado')
																<a style="color: black">
																@break
															@default
																<a style="color: black">
														@endswitch
														<i class="fas fa-marker"></i></a>
													@endif
													{{$Residuo->TratName}} {{in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) ? '- '.$Residuo->CliShortName : ''}}</td>
												{{-- <td>
													<ul>
													@foreach($Residuo->pretratamientosSelected as $pretratamientoSelected)
													    <li>{{$pretratamientoSelected->PreTratName}}</li>
													@endforeach
													</ul>
												</td> --}}
												<td>{{$Residuo->SolResEmbalaje}}</td>
												<td><a title="Ver Generador" href="/sgeneradores/{{$GenerResiduo->GSedeSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$GenerResiduo->GenerName.' ('.$GenerResiduo->GSedeName.')'}}</td>
												@if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))
													<td style="text-align: center;">
														@if($SolicitudServicio->SolSerStatus === 'Completado' || $SolicitudServicio->SolSerStatus === 'No Conciliado' || $SolicitudServicio->SolSerStatus === 'Conciliado' || $SolicitudServicio->SolSerStatus === 'Tratado' || $SolicitudServicio->SolSerStatus === 'Facturado' || $SolicitudServicio->SolSerStatus === 'Certificacion')
														<a href="#" onclick="addprice(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResPrecio}}`)">
														@else
															<a style="color: black">
														@endif
														<i class="fas fa-marker"></i></a>
														{{$Residuo->SolResPrecio}} <br> 

														@switch($Residuo->SolResTypePrecio)
															@case(1)
																<b style="color:blue">
																
																@break
															@case(2)
																<b style="color:green">
																
																@break

															@case(3)
																<b style="color:red">
																@break
															@default
																<b style="color:black">
														@endswitch
															
														@if ($Residuo->tarifa->TarifaSpecial === 1)
															(T_Residuo)</b>
														@else
															(T_Cliente)</b>
														@endif
													</td>
												@endif
												<td style="text-align: center;">{{number_format($Residuo->SolResKgEnviado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}} Kilogramos</td>
												@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR))
													<td>{{$GenerResiduo->GSedeAddress}}</td>
												@else
													<td style="text-align: center;">
														@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
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
														@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
															{{-- {{' '.$Residuo->SolResCantiUnidadRecibida}} --}}
															{{$Residuo->SolResCantiUnidadRecibida === null ? 'N/A' : $Residuo->SolResCantiUnidadRecibida }}

														@else
															{{' '.number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}
														@endif
														 {{$TypeUnidad}}
													</td>
													<td style="text-align: center;">
														@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
															@if($SolicitudServicio->SolSerStatus === 'Completado' || $SolicitudServicio->SolSerStatus === 'No Conciliado' || $SolicitudServicio->SolSerStatus === 'Corregido')
																@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResCantiUnidadRecibida}}`, `{{$Residuo->SolResCantiUnidadConciliada}}`, `{{$TypeUnidad}}`, `{{number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, null, `{!!json_encode($Residuo->SolResRM2, JSON_NUMERIC_CHECK)!!}`)">
																@else
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{number_format($Residuo->SolResKgConciliado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{$TypeUnidad}}`, null, null, `{!!json_encode($Residuo->SolResRM2, JSON_NUMERIC_CHECK)!!}`)"> 
																@endif
															@else
																<a style="color: black">
															@endif
															<i class="fas fa-marker"></i></a>
														@endif
														@if(in_array(Auth::user()->UsRol, Permisos::UpdateCantConciliada) || in_array(Auth::user()->UsRol2, Permisos::UpdateCantConciliada))
															@if($SolicitudServicio->SolSerStatus === 'Certificacion' || $SolicitudServicio->SolSerStatus === 'Conciliado' || $SolicitudServicio->SolSerStatus === 'Facturado')
																@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
																	<a onclick="editKgConciliado(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResCantiUnidadRecibida}}`, `{{$Residuo->SolResCantiUnidadConciliada}}`, `{{$TypeUnidad}}`, `{{number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, null, `{!!json_encode($Residuo->SolResRM2, JSON_NUMERIC_CHECK)!!}`)">
																@else
																	<a onclick="editKgConciliado(`{{$Residuo->SolResSlug}}`, `{{number_format($Residuo->SolResKgRecibido, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{number_format($Residuo->SolResKgConciliado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{$TypeUnidad}}`, null, null, `{!!json_encode($Residuo->SolResRM2, JSON_NUMERIC_CHECK)!!}`)"> 
																@endif
															@else
																<a style="color: black">
															@endif
															<i class="fas fa-marker"></i></a>
														@endif
														@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
															{{$Residuo->SolResCantiUnidadConciliada === null ? 'N/A' : $Residuo->SolResCantiUnidadConciliada }}
														@else
															{{$Residuo->SolResKgConciliado === null ? 'N/A' : number_format($Residuo->SolResKgConciliado, $decimals = 2, $dec_point = ',', $thousands_sep = '.') }}
														@endif
														 {{$TypeUnidad}}
													</td>
													@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
														<td style="text-align: center;">
															@if(($SolicitudServicio->SolSerStatus === 'Conciliado' || $SolicitudServicio->SolSerStatus === 'Certificacion' || $SolicitudServicio->SolSerStatus === 'Facturado') && $Residuo->SolResKgTratado != $Residuo->SolResKgConciliado)
																{{-- <a class="kg" onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{number_format($Residuo->SolResKgTratado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{number_format($Residuo->SolResKgConciliado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`)">  --}}
																@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResCantiUnidadRecibida}}`, `{{$Residuo->SolResCantiUnidadConciliada}}`, `{{$TypeUnidad}}`, `{{number_format($Residuo->SolResKgTratado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{number_format($Residuo->SolResKgConciliado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`)">
																@else
																	<a onclick="addkg(`{{$Residuo->SolResSlug}}`, `{{$Residuo->SolResCantiUnidadRecibida}}`, `{{$Residuo->SolResCantiUnidadConciliada}}`, `{{$TypeUnidad}}`, `{{number_format($Residuo->SolResKgTratado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`, `{{number_format($Residuo->SolResKgConciliado, $decimals = 2, $dec_point = ',', $thousands_sep = '.')}}`)"> 
																@endif
															@else
																<a style="color: black">
															@endif
															<i class="fas fa-marker"></i></a>
															@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
																{{$Residuo->SolResCantiUnidadTratada === null ? 'N/A' : $Residuo->SolResCantiUnidadTratada }}
															@else
																{{$Residuo->SolResKgTratado === null ? 'N/A' : number_format($Residuo->SolResKgTratado, $decimals = 2, $dec_point = ',', $thousands_sep = '.') }}
															@endif
															 {{$TypeUnidad}}
														</td>
													@endif
													<td style="text-align: center;"><a href='/recurso/{{$Residuo->SolResSlug}}' target="_blank" class='btn btn-info btn-block'> <i class="fas fa-search"></i> </a></td>
												@endif
												@if(($SolicitudServicio->SolSerStatus == 'Pendiente' || $SolicitudServicio->SolSerStatus == 'Aceptado' || $SolicitudServicio->SolSerStatus == 'Aprobado' || $SolicitudServicio->SolSerStatus == 'Residuo Faltante') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
													<td style="text-align: center;"><a href='#' onclick="ModalDeleteRespel(`{{$Residuo->SolResSlug}}`, `{{$Residuo->RespelName}}`, `{{$GenerResiduo->GenerName}}`)" class='btn btn-danger'><i class="fas fa-trash-alt"></i></a></td>
												@elseif(($SolicitudServicio->SolSerStatus == 'Certificacion') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
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
								<div class="modal modal-default fade in" id="ModalRepeat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<form action="/solicitud-servicio/repeat/{{$SolicitudServicio->SolSerSlug}}" method="POST" id="SolSerRepeat">
											@csrf
											@method('PUT')
											<div class="modal-body">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
													<i class="fas fa-exclamation-triangle"></i>
													<span style="font-size: 0.3em; color: black;"><p>¿Seguro(a) desea repetir la solicitud <b>N° {{$SolicitudServicio->ID_SolSer}}</b>?</p></span>
												</div> 
												<div class="form-group col-md-12">
													<label  color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="Observaciones <b>(Opcional)</b>" data-content="En este campo puede redactar sus observaciones con relación a esta solicitud de servicio"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones <b>Opcional</b></label>
													<small id="caracteresrestantesrepetir" class="help-block with-errors"></small>
													<textarea onchange="updatecaracteresrepetir()" id="textDescriptionrepetir" rows ="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" `+(status == 'No Deacuerdo' ? 'required' : '')+` name="solserdescript"></textarea>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
													<button form="SolSerRepeat" type="submit" class="btn btn-success">Si, repetir</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							{{-- END Modal --}}
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
							{{--  Modal --}}
							@if ($SolicitudServicio->SolSerStatus == 'Completado' && in_array(Auth::user()->UsRol, Permisos::ProgVehic2))
								<div class="modal modal-default fade in" id="ModalSendRecordatorio" tabindex="-1" role="dialog"
									aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<form action="/recordatorio" method="POST" id="SendRecordatorioForm">
												@csrf
												<input type='hidden' name='solserslug' value="{{$SolicitudServicio->SolSerSlug}}">
												<div class="modal-body">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
															aria-hidden="true">&times;</span></button>
													<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
														<i class="fas fa-exclamation-triangle"></i>
														<span style="font-size: 0.3em; color: black;">
															<p>Enviar recordatorio de conciliación para el servicio <b>N°
																	{{$SolicitudServicio->ID_SolSer}}</b>?</p>
														</span>
													</div>
													<div class="form-group col-md-12">
														<label style="color: black; text-align: left;" data-placement="auto" data-trigger="hover"
															data-html="true" data-toggle="popover" title="Observaciones"
															data-content="En este campo puede redactar sus observaciones con relación al recordatorio de conciliación para esta solicitud de servicio"><i
																style="font-size: 1.8rem; color: Dodgerblue;"
																class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones</label>
														<small id="caracteresrestantesrepetirSR" class="help-block with-errors"></small>
														<textarea onchange="updatecaracteresrepetirObs()" id="textDescriptionrepetirSR" rows="5"
															style="resize: vertical;" maxlength="4000" class="form-control col-xs-12"
															required name="solserdescript"></textarea>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
													<button form="SendRecordatorioForm" type="submit" class="btn btn-success">enviar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							@endif
							{{-- END Modal --}}
							{{--  Modal --}}
							@if ($SolicitudServicio->SolSerStatus !== 'Aprobado' && in_array(Auth::user()->UsRol, Permisos::SolSer2))
							<div class="modal modal-default fade in" id="ModalRecepcionErrada" tabindex="-1" role="dialog"
								aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="/recepcionerrada" method="POST" id="recepcionerradaForm">
											@csrf
											<input type='hidden' name='solserslug' value="{{$SolicitudServicio->SolSerSlug}}">
											<div class="modal-body">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
														aria-hidden="true">&times;</span></button>
												<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
													<i class="fas fa-exclamation-triangle"></i>
													<span style="font-size: 0.3em; color: black;">
														<p>Enviar notificación de fecha de recepción errada para el servicio <b>N°
																{{$SolicitudServicio->ID_SolSer}}</b>?</p>
													</span>
												</div>
												<div class="form-group col-md-12">
													<label style="color: black; text-align: left;" data-placement="auto" data-trigger="hover"
														data-html="true" data-toggle="popover" title="Observaciones"
														data-content="En este campo puede redactar sus observaciones con relación al recordatorio de conciliación para esta solicitud de servicio"><i
															style="font-size: 1.8rem; color: Dodgerblue;"
															class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones</label>
													<small id="caracteresrestantesrepetirSR" class="help-block with-errors"></small>
													<textarea onchange="updatecaracteresrepetirObs()" id="textDescriptionrepetirSR" rows="5"
														style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" required
														name="solserdescript"></textarea>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
												<button form="recepcionerradaForm" type="submit" class="btn btn-success">enviar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							@endif
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

{{-- funciones para el modal de RMs --}}
@if(in_array(Auth::user()->UsRol, Permisos::SolSer2) || in_array(Auth::user()->UsRol2, Permisos::SolSer2))
	<script>
		function updateRMs(slug){
			var arrayRMs = {!! json_encode($SolicitudServicio->SolSerRMs) !!};
			$('#addRMsmodal').empty();
			$('#addRMsmodal').append(`
				<form role="form" action="/solicitud-servicio/`+slug+`/updateRms" method="POST" data-toggle="validator" id="FormRMs">
					@method('PUT')
					@csrf
					<div class="modal modal-default fade in" id="editRMs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<div style="font-size: 5em; color: lightblue; text-align: center; margin: auto;">
										<i class="fas fa-clipboard-list"></i>
										<span style="font-size: 0.3em; color: black;"><p>
											Números de Recibo de material
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
										<div class="form-group col-md-3">
											<label for="SolResRM"># RM</label>
											<small class="help-block with-errors">*</small>
											<input type="number" class="form-control" id="SolResRM" name="SolServRM[]" min="9999" max="99999" value="`+arrayRMs[0]+`">
										</div>
										<div class="form-group col-md-3">
											<label for="SolResRM"># RM</label>
											<small class="help-block with-errors">*</small>
											<input type="number" class="form-control" id="SolResRM" name="SolServRM[]" min="9999" max="99999" value="`+arrayRMs[1]+`">
										</div>
										<div class="form-group col-md-3">
											<label for="SolResRM"># RM</label>
											<small class="help-block with-errors">*</small>
											<input type="number" class="form-control" id="SolResRM" name="SolServRM[]" min="9999" max="99999" value="`+arrayRMs[2]+`">
										</div>
										<div class="form-group col-md-3">
											<label for="SolResRM"># RM</label>
											<small class="help-block with-errors">*</small>
											<input type="number" class="form-control" id="SolResRM" name="SolServRM[]" min="9999" max="99999" value="`+arrayRMs[3]+`">
										</div>
										<div class="form-group col-md-3">
											<label for="SolResRM"># RM</label>
											<small class="help-block with-errors">*</small>
											<input type="number" class="form-control" id="SolResRM" name="SolServRM[]" min="9999" max="99999" value="`+arrayRMs[4]+`">
										</div>
										<div class="form-group col-md-3">
											<label for="SolResRM"># RM</label>
											<small class="help-block with-errors">*</small>
											<input type="number" class="form-control" id="SolResRM" name="SolServRM[]" min="9999" max="99999" value="`+arrayRMs[5]+`">
										</div>
										<div class="form-group col-md-3">
											<label for="SolResRM"># RM</label>
											<small class="help-block with-errors">*</small>
											<input type="number" class="form-control" id="SolResRM" name="SolServRM[]" min="9999" max="99999" value="`+arrayRMs[6]+`">
										</div>
										<div class="form-group col-md-3">
											<label for="SolResRM"># RM</label>
											<small class="help-block with-errors">*</small>
											<input type="number" class="form-control" id="SolResRM" name="SolServRM[]" min="9999" max="99999" value="`+arrayRMs[7]+`">
										</div>
										
										<input type="text" hidden name="SolServ" value="`+slug+`">
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.save')}}</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			`);
			$('#editRMs').modal();
			$('#FormRMs').validator('update');
		};
	</script>
@else
	<script>
		function updateRMs(slug){
			var arrayRMs = {!! json_encode($SolicitudServicio->SolSerRMs) !!};
			$('#addRMsmodal').empty();
			$('#addRMsmodal').append(`
				<div class="modal modal-default fade in" id="showRMs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: lightblue; text-align: center; margin: auto;">
									<i class="fas fa-clipboard-list"></i>
									<span style="font-size: 0.3em; color: black;"><p>
										Números de Recibo de material
									</p></span>
								</div>
							</div>
							<div class="modal-header">
									<table class="table table-bordered">
										<thead class="thead-dark">
											<tr id="listadeRM" ></tr>
										</thead>
									</table>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.save')}}</button>
							</div>
						</div>
					</div>
				</div>
			`);
			for (let index = 0; index < arrayRMs.length; index++) {
				if (arrayRMs[index] !== null) {
					$('#listadeRM').append(`<th class="text-center">`+`RM-`+arrayRMs[index]+`</th>`);
				}
			}
			$('#showRMs').modal();
			$('#FormRMs').validator('update');
		};
	</script>
@endif


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
				$("#Formprice").modal("show");
			});
		</script>
	@endif
@endif

{{-- funciones para el modal de cambio de trtamiento --}}
@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
	<script>
		function changeTratamiento(slug, idTrat, tratName, idReq, solServicio){
			$('#changetratmodal').empty();
			$('#changetratmodal').append(`
				<form role="form" action="../requerimientos/`+idReq+`/updateTrat/`+solServicio+`" method="POST" data-toggle="validator" id="FormChangeTrat">
					@method('PUT')
					@csrf
					<div class="modal modal-default fade in" id="ChangeTrat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<div style="font-size: 5em; color: orange; text-align: center; margin: auto;">
										<i class="fas fa-paste"></i>
										<span style="font-size: 0.3em; color: black;"><p>
											Tratamiento Aplicado
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
											@case('Pendiente')
											@case('Aprobado')
											@case('Programado')
											@case('Notificado')
											@case('No Conciliado')
											@case('Completado')
											@case('Conciliado')
											@case('Tratado')
											<div class="form-group col-md-12">	
												<label for="FK_ReqTrata">Tratamiento Aplicado</label><small class="help-block with-errors">*</small>
												<select id="selectTratamiento" name="FK_ReqTrata" class="form-control" required>
													<option value="">Seleccione un Tratamiento</option>
													@if($tratamientos == 'NoAutorizado')
														<option value="`+idTrat+`">`+tratName+`</option>
													@else
														@foreach ($tratamientos as $tratamiento)
															<option value="{{$tratamiento->ID_Trat}}">{{$tratamiento->TratName}}</option>
														@endforeach
													@endif
												</select>
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
			$('#ChangeTrat').modal();
			$('#FormChangeTrat').validator('update');
			// $('#selectTratamiento').select2();
		};
	</script>
	@if ($errors->any())
		<script>
			$(document).ready(function() {
				$("#FormChangeTrat").modal("show");
			});
		</script>
	@endif
@endif

{{-- funciones para el modal de kg --}}
@if(in_array(Auth::user()->UsRol, Permisos::SolSer2) || in_array(Auth::user()->UsRol2, Permisos::SolSer2))
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
											<div class="col-md-12 form-group has-feedback">
												<label for="SolResRM"># RM</label><small class="help-block with-errors">*</small>
												<select id="SolResRMselect" class="form-control select-multiple" name="SolResRM[]" multiple required>
												</select>
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
											<div class="col-md-12 form-group has-feedback">
												<label for="SolResRM"># RM</label><small class="help-block with-errors">*</small>
												<select id="SolResRMselect" class="form-control select-multiple" name="SolResRM[]" multiple required>
												</select>
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
											<div class="col-md-12 form-group has-feedback">
												<label for="SolResRM"># RM</label><small class="help-block with-errors">*</small>
												<select id="SolResRMselect" class="form-control select-multiple" name="SolResRM[]" multiple required>
												</select>
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
										<div class="col-md-12 form-group has-feedback">
											<label for="SolResRM"># RM</label><small class="help-block with-errors">*</small>
											<select id="SolResRMselect" class="form-control select-multiple" name="SolResRM[]" multiple required>
											</select>
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

		var arrayRMs = {!! json_encode($SolicitudServicio->SolSerRMs) !!};

		/*se verifica si todos los valores son nulos*/
		var nulos = 0;
		for (let indexnulos = 0; indexnulos < arrayRMs.length; indexnulos++) {
			if (arrayRMs[indexnulos] == null) {
				nulos++;
			}
		}

		if (nulos == 4) {
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
								<i class="fas fa-exclamation-triangle"></i>
								<span style="font-size: 0.3em; color: black;"><p>¿Acepta marcar la solicitud de servicio como <b>`+status+`</b>?</p></span>
							</div>
						</div>
						<form action="/solicitud-servicio/changestatus" method="POST" data-toggle="validator" id="SolSer">
							<div class="modal-header">
								@csrf
								<div class="form-group col-md-12">
									<label  color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserstatusdescrip') }}</b>" data-content="{{ trans('adminlte_lang::message.solserstatusdescripdetaill') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solserstatusdescrip')}}</label>
									<small id="caracteresrestantes" class="help-block with-errors">`+(status == 'No Deacuerdo' ? '*' : '')+`</small>
									<textarea onchange="updatecaracteres()" id="textDescription" rows ="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" `+(status == 'No Deacuerdo' ? 'required' : '')+` name="solserdescript"></textarea>
								</div>
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
		$('#SolSer').validator('update');
		popover();
		var area = document.getElementById("textDescription");
		var message = document.getElementById("caracteresrestantes");
		var maxLength = 4000;
		$('#textDescription').keyup(function () {
			message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
			observacion = area.value;
		});
		envsubmit();
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
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
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
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
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
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
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
			$('#titulo').empty();
			@if((in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) && ($SolicitudServicio->SolSerTipo !== 'Interno'))
				$('#titulo').append(`
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
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
			@if((in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) && ($SolicitudServicio->SolSerTipo !== 'Interno'))
				$('#titulo').append(`
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
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
					<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/add-respel" class="btn btn-primary pull-right"><i class="fas fa-plus"></i><b> Añadir Residuo</b></a>
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
					<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Enviar Certificados/Manifiestos</b>" data-content="<p style='width: 50%'>Asegúrese de haber cargado toda la documentación correspondiente a los certificados y/o manifiestos antes de usar este botón para enviarlos a facturación... úselo únicamente cuando este seguro de los datos de la haber completado todos los documentos </p>" href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/sendtobilling" class="btn btn-danger pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Enviar Certificados/Manifiestos</b></a>
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
					<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Enviar Certificados/Manifiestos</b>" data-content="<p style='width: 50%'>Asegúrese de haber cargado toda la documentación correspondiente a los certificados y/o manifiestos antes de usar este botón para enviarlos a facturación... úselo únicamente cuando este seguro de los datos de la haber completado todos los documentos </p>" href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/sendtobilling" class="btn btn-danger pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Enviar Certificados/Manifiestos</b></a>
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
						<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Enviar Certificados/Manifiestos</b>" data-content="<p style='width: 50%'>Asegúrese de haber cargado toda la documentación correspondiente a los certificados y/o manifiestos antes de usar este botón para enviarlos a facturación... úselo únicamente cuando este seguro de los datos de la haber completado todos los documentos </p>" href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/sendtobilling" class="btn btn-danger pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Enviar Certificados/Manifiestos</b></a>
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
						<a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Enviar Certificados/Manifiestos</b>" data-content="<p style='width: 50%'>Asegúrese de haber cargado toda la documentación correspondiente a los certificados y/o manifiestos antes de usar este botón para enviarlos a facturación... úselo únicamente cuando este seguro de los datos de la haber completado todos los documentos </p>" href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/sendtobilling" class="btn btn-danger pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Enviar Certificados/Manifiestos</b></a>
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
				<form action="/solicitud-servicio/reversarStatus" method="POST" data-toggle="validator" id="SolSerReversar">
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
				<form action="/solicitud-servicio/cancelarServicio" method="POST" data-toggle="validator" id="SolSerCancelar">
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