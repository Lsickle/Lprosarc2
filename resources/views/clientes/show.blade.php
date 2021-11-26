@extends('layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('contentheader_title')
@if(Route::currentRouteName()=='clientes.show')
<span style="background-image: linear-gradient(40deg, rgb(255, 216, 111), rgb(252, 98, 98)); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.clientmenu') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@else
<span style="background-image: linear-gradient(40deg, #FFFFFF, #A3A2AE); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.clientcliente') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endif
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-4">
			<div class="box box-info">
				<div class="box-body box-profile">
					<div class="col-md-12 col-xs-12">
						{{-- @if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) && Route::currentRouteName() !== 'cliente-show')
							<div class="modal modal-default fade in" id="myModalCliente{{$cliente->CliSlug}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-body">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<div style="font-size: 5em; color: red; text-align: center; margin: auto;">
												<i class="fas fa-exclamation-triangle"></i>
												<span style="font-size: 0.3em; color: black;"><p>¿Seguro quiere eliminar el cliente <b>{{$cliente->CliShortname}}</b>?</p></span>
												<small><h5>NOTA: Los datos dependientes a este registro seran eliminados</h5></small>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-success pull-left" data-dismiss="modal">No, salir</button>
											<label for="Eliminar{{$cliente->CliSlug}}" class='btn btn-danger'>Si, eliminar</label>
										</div>
									</div>
								</div>
							</div>
							<form action='/clientes/{{$cliente->CliSlug}}' method='POST'>
								@method('DELETE')
								@csrf
								<input type="submit" id="Eliminar{{$cliente->CliSlug}}" style="display: none;">
							</form>
							@if($cliente->CliDelete == 0 )
								<a method='get' href='#' data-toggle='modal' data-target='#myModalCliente{{$cliente->CliSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{ trans('adminlte_lang::message.delete') }}</b></a>
							@else
								<form action='/clientes/{{$cliente->CliSlug}}' method='POST' class="pull-left">
									@method('DELETE')
									@csrf
									<button type="submit" class='btn btn-success btn-block' title="{{ trans('adminlte_lang::message.add') }}">
										<i class="fas fa-plus-square"></i>
									</button>
								</form>
							@endif
						@endif --}}
						@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || Auth::user()->email == 'sistemas@prosarc.com.co')
							<a href="/cliente/{{$cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
						@endif
                        @if ($cliente->CliCategoria == 'ClientePrepago')
                            @switch(true)
                                @case(Auth::user()->email == 'asesorse2@prosarc.com.co')
                                @case(Auth::user()->email == 'asesorse1@prosarc.com.co')
                                @case(Auth::user()->email == 'coordinadorse@prosarc.com.co')
                                @case(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                    <a href="/clientesexpress/{{$cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
                                    @break
                                @default

                            @endswitch
                        @endif
						{{-- <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.respeldescriptittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.respeldescriptinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.descripcion') }}</label> --}}
						@if(in_array(Auth::user()->UsRol, Permisos::SOLSERACEPTADO))
							@if($cliente->CliStatus=='Autorizado')
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>Bloquear Solicitudes de Servicio</b>" data-content="Al presionar el boton el cliente quedara <b>Bloqueado</b> para realizar nuevas solicitudes de servicio"><a href="/cliente/{{$cliente->CliSlug}}/negarCliStatus" class="btn btn-danger pull-right"><i class="fas fa-ban"></i><b> Bloquear</b></a></label>
							@else
							<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>Autorizar Solicitudes de Servicio</b>" data-content="Al presionar el boton el cliente quedara <b>Autorizado</b> para realizar nuevas solicitudes de servicio"><a href="/cliente/{{$cliente->CliSlug}}/updateCliStatus" class="btn btn-success pull-right"><i class="fas fa-thumbs-up"></i><b> Autorizar</b></a></label>
							@endif
							@if($cliente->TipoFacturacion=='Credito')
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>Tipo de facturación</b>" data-content="Al presionar el boton el tipo de facturación del cliente cambiara a <b>Contado</b> y el cliente, obligatoriamente, tendra  que adjuntar el PDF del <b>Soporte de Pago</b> cuando crea nuevas solicitudes de servicio"><a href="/cliente/{{$cliente->CliSlug}}/TipoFacturacionContado" class="btn btn-danger pull-right"><i class="fas fa-wallet"></i><b> Cobrar de Contado</b></a></label>
							@else
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>Tipo de facturación</b>" data-content="Al presionar el boton el tipo de facturación del cliente cambiara a <b>Credito</b> y el cliente no tendra que adjuntar los <b>Soportes de Pago</b> cuando crea nuevas solicitudes de servicio"><a href="/cliente/{{$cliente->CliSlug}}/TipoFacturacionCredito" class="btn btn-success pull-right"><i class="fas fa-file-invoice-dollar"></i><b> Cobrar a Credito</b></a></label>
							@endif
						@endif
					</div>
					@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
						<h3 class="profile-username text-center textolargo">{{$cliente->CliShortname}}</h3>
					@else
						<h3 class="profile-username text-center textolargo">{{$cliente->CliName}}</h3>
					@endif
					<ul>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b>
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$cliente->CliName}}</p>">{{$cliente->CliName}}</a>
						</li>
						@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b>
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$cliente->CliShortname}}</p>">{{$cliente->CliShortname}}</a>
						</li>
						@endif
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$cliente->CliNit}}</a>
						</li>
						{{-- <li class="list-group-item">
							<div class="col-sm-16">
								<div class="row">
									<div class="col-sm-6">
										<b>{{ trans('adminlte_lang::message.clientcamaracomercio') }}</b>
									</div>
									<div class="col-sm-6">
										<div class="input-group">
											<input type="text" value="{{$cliente->CliCamaraComercio === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliCamaraComercio === null ? '#' : "/img/DatosClientes/$cliente->CliCamaraComercio"}}" class="{{$cliente->CliCamaraComercio === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliCamaraComercio === null ? '' : 'target="_blank"'}}>
													<i class='{{$cliente->CliCamaraComercio === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="col-sm-16">
								<div class="row">
									<div class="col-sm-6">
										<b>{{ trans('adminlte_lang::message.clientrut') }}</b>
									</div>
									<div class="col-sm-6">
										<div class="input-group">
											<input type="text" value="{{$cliente->CliRut === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliRut === null ? '#' : "/img/DatosClientes/$cliente->CliRut"}}" class="{{$cliente->CliRut === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliRut === null ? '' : 'target="_blank"'}}>
													<i class='{{$cliente->CliRut === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="col-sm-16">
								<div class="row">
									<div class="col-sm-6">
										<b>{{ trans('adminlte_lang::message.clientlegalrepresentative') }}</b>
									</div>
									<div class="col-sm-6">
										<div class="input-group">
											<input type="text" value="{{$cliente->CliRepresentanteLegal === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliRepresentanteLegal === null ? '#' : "/img/DatosClientes/$cliente->CliRepresentanteLegal"}}" class="{{$cliente->CliRepresentanteLegal === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliRepresentanteLegal === null ? '' : 'target="_blank"'}}>
													<i class='{{$cliente->CliRepresentanteLegal === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="col-sm-16">
								<div class="row">
									<div class="col-sm-6">
										<b>{{ trans('adminlte_lang::message.clientbankcertification') }}</b>
									</div>
									<div class="col-sm-6">
										<div class="input-group">
											<input type="text" value="{{$cliente->CliCertificaionBancaria === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliCertificaionBancaria === null ? '#' : "/img/DatosClientes/$cliente->CliCertificaionBancaria"}}" class="{{$cliente->CliCertificaionBancaria === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliCertificaionBancaria === null ? '' : 'target="_blank"'}}>
													<i class='{{$cliente->CliCertificaionBancaria === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="col-sm-16">
								<div class="row">
									<div class="col-sm-6">
										<b>{{ trans('adminlte_lang::message.clientcommercialcertification') }}</b>
									</div>
									<div class="col-sm-6">
										<div class="input-group">
											<input type="text" value="{{$cliente->CliCertificaionComercial === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliCertificaionComercial === null ? '#' : "/img/DatosClientes/$cliente->CliCertificaionComercial"}}" class="{{$cliente->CliCertificaionComercial === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliCertificaionComercial === null ? '' : 'target="_blank"'}}>
													<i class='{{$cliente->CliCertificaionComercial === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="col-sm-16">
								<div class="row">
									<div class="col-sm-6">
										<b>{{ trans('adminlte_lang::message.clientcommercialcertification') }} 2</b>
									</div>
									<div class="col-sm-6">
										<div class="input-group">
											<input type="text" value="{{$cliente->CliCertificaionComercial2 === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliCertificaionComercial2 === null ? '#' : "/img/DatosClientes/$cliente->CliCertificaionComercial2"}}" class="{{$cliente->CliCertificaionComercial2 === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliCertificaionComercial2 === null ? '' : 'target="_blank"'}}>
													<i class='{{$cliente->CliCertificaionComercial2 === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li> --}}
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					{{-- Barra de navegación --}}
					<li class="active box-info"><a href="#sedes" data-toggle="tab">{{ trans('adminlte_lang::message.sclientsedes') }}</a></li>
					@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
						<li><a href="#requerimientos" data-toggle="tab">Requerimientos</a></li>
					@endif
					<li><a href="#tarifas_cliente" data-toggle="tab">Tarifa</a></li>
					@if ((Route::currentRouteName() === 'cliente-show')&&(in_array(Auth::user()->UsRol, Permisos::CLIENTE)))
						<a href="/sclientes/create" class="btn btn-primary pull-right" style="margin-top: 0.5em; margin-right: 0.5em;"><b>{{ trans('adminlte_lang::message.create') }} Sede</b></a>
					@endif
                    @if ($cliente->CliCategoria == 'ClientePrepago')
                            @switch(true)
                                @case(Auth::user()->email == 'asesorse2@prosarc.com.co')
                                @case(Auth::user()->email == 'asesorse1@prosarc.com.co')
                                @case(Auth::user()->email == 'coordinadorse@prosarc.com.co')
                                @case(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                    <li class="navbar-right">
                                        <button><a href="{{route('cliente.createSedeExpress', ['cliente' => $cliente->CliSlug])}}" class="btn btn-success" target="_blank" rel="noopener noreferrer"><b><i class="fas fa-plus"></i> Sede</b></a></button>
                                    </li>
                                    @break
                                @default

                            @endswitch
                        @endif
					<li class="navbar-right">
						<button><a href="{{route('clientetarifas.create', ['cliente' => $cliente->CliSlug])}}" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><b><i class="fas fa-plus"></i> Tarifa</b></a></button>
					</li>
				</ul>
				<div class="tab-content">
					{{-- sedes --}}
					<div class="active tab-pane" id="sedes" style='overflow-y:auto; max-height:305px;'>

						@foreach ($Sedes as $Sede)
						<div style="margin-bottom:30px;">
							<div class="col-md-12 col-xs-12">
								@if(Route::currentRouteName() === 'cliente-show' || (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) && Route::currentRouteName() === 'clientes.show'))
									@if($Sede->SedeDelete == 0 )
										{{-- Boton de edit --}}
										<a href="{{Route::currentRouteName() === 'cliente-show' ? '/sede' : '/sclientes'}}/{{$Sede->SedeSlug}}/edit" class="btn btn-warning pull-right" title="{{ trans('adminlte_lang::message.edit') }}"><i class="fas fa-edit"></i></a>
										@if($SedeSlug !== $Sede->SedeSlug)
											<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Sede->SedeSlug}}' class='btn btn-danger pull-left' title="{{ trans('adminlte_lang::message.delete') }}" onclick="DeleteSede(`{{$Sede->SedeSlug}}`, `{{$Sede->SedeName}}`)"><i class="fas fa-trash-alt"></i></a>
											<div id="deleteSede"></div>
										@endif
									@else
										<form action='{{Route::currentRouteName() === 'cliente-show' ? "/sedes/$Sede->SedeSlug/destroy" : "/sclientes/$Sede->SedeSlug"}}' method='POST' class="pull-left">
											@method('DELETE')
											@csrf
											<button type="submit" class='btn btn-success btn-block' title="{{ trans('adminlte_lang::message.add') }}">
												<i class="fas fa-plus-square"></i>
											</button>
										</form>
									@endif
								@endif
							</div>
							<h3 class="profile-username text-center textolargo">{{$Sede->SedeName}}</h3>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.address') }}</b>
								<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.address') }}')"><i class="far fa-copy"></i></a>
								<p href="#" class="pull-right textpopoveraddress" id="{{ trans('adminlte_lang::message.address') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeAddress}} - {{$Sede->MunName}}, {{$Sede->DepartName}}</p>">{{$Sede->SedeAddress}} - {{$Sede->MunName}}, {{$Sede->DepartName}}</p>
							</li>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$Sede->SedeCelular}}</a>
							</li>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$Sede->SedePhone1}} - {{$Sede->SedeExt1}}</a>
							</li>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$Sede->SedePhone2}} - {{$Sede->SedeExt2}}</a>
							</li>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.emailaddress') }}</b>
								<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
								<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeEmail}}</p>">{{$Sede->SedeEmail}}</a>
							</li>
						</div>
						@endforeach
					</div>
					@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
					{{-- requerimientos --}}
						<div class="tab-pane" id="requerimientos">
							@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
								<a href='#' data-toggle='modal' data-target='#editReque' class="btn btn-warning pull-right"><i class="fas fa-edit"></i></a>
							@endif
							<h3 class="profile-username text-center textolargo">Requerimientos permitidos</h3>
							<div style='overflow-y:auto; max-height:503px;'>
								@if(isset($Requerimientos))
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserticket') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserticketdescrit') }} </p>">
										<label for="main_RequeCliBascula">{{ trans('adminlte_lang::message.solserticket') }}</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="mainswitch" disabled {{$Requerimientos->RequeCliBascula == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
										<label for="auto_RequeCliBascula">Activación</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="autoswitch" disabled {{$Requerimientos->auto_RequeCliBascula == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserperscapa') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserperscapadescrit') }} </p>">
										<label for="RequeCliCapacitacion">{{ trans('adminlte_lang::message.solserperscapa') }}</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="mainswitch" disabled {{$Requerimientos->RequeCliCapacitacion == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
										<label for="auto_RequeCliBascula">Activación</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="autoswitch" disabled {{$Requerimientos->auto_RequeCliCapacitacion == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsermaspers') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsermaspersdescrit') }} </p>">
										<label for="RequeCliMasPerson">{{ trans('adminlte_lang::message.solsermaspers') }}</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="mainswitch" disabled {{$Requerimientos->RequeCliMasPerson == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
										<label for="auto_RequeCliBascula">Activación</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="autoswitch" disabled {{$Requerimientos->auto_RequeCliMasPerson == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicexclusi') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicexclusidescrit') }} </p>">
										<label for="RequeCliVehicExclusive">{{ trans('adminlte_lang::message.solservehicexclusi') }}</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="mainswitch" disabled {{$Requerimientos->RequeCliVehicExclusive == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
										<label for="auto_RequeCliBascula">Activación</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="autoswitch" disabled {{$Requerimientos->auto_RequeCliVehicExclusive == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicplata') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicplatadescrit') }} </p>">
										<label for="RequeCliPlatform">{{ trans('adminlte_lang::message.solservehicplata') }}</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="mainswitch" disabled {{$Requerimientos->RequeCliPlatform == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								<div class="col-md-6" style="text-align: center;">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
										<label for="auto_RequeCliBascula">Activación</label>
										<div style="width: 100%; height: 34px;">
											<input type="checkbox" class="autoswitch" disabled {{$Requerimientos->auto_RequeCliPlatform == 1 ? 'checked' : ''}}>
										</div>
									</label>
								</div>
								@else
									<center><a href='#' data-toggle='modal' data-target='#createReque' class="btn btn-success"><i class="fas fa-plus"></i> Agregar Requerimientos</a></center>
								@endif
							</div>
						</div>
					@endif
					<div class="tab-pane" id="tarifas_cliente" style='overflow-y:auto; max-height:305px;'>
						<table id="TarifasClienteTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Tratamiento</th>
									<th>Rango</th>
									<th>Frecuencia</th>
									<th>Precio</th>
									{{-- <th>Cliente</th> --}}
									<th>Vence</th>
								</tr>
							</thead>
							<tbody>
                                @if ($cliente->clientetarifa)
                                @foreach ($cliente->clientetarifa as $tarifa)
									@foreach ($tarifa->rangos as $rango)
									<tr>
										<td>{{$tarifa->ID_CTarifa}}</td>
										<td>{{$tarifa->tratamiento->TratName}}</td>
										<td>desde {{$rango->CTarifaDesde}} <b style="color: {{($tarifa->Tarifatipo == 'Kg' ? 'Black' : 'Green')}}">{{$tarifa->Tarifatipo}}</b></td>
										<td>{{$tarifa->TarifaFrecuencia}}</td>
										<td>{{$rango->CTarifaPrecio}}</td>
										{{-- <td>{{$tarifa->cliente->CliShortname}}</td> --}}
										<td>{{$tarifa->TarifaVencimiento}}</td>
									</tr>
									@endforeach
								@endforeach
                                @endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
	@if(!isset($Requerimientos))
	{{-- Start Modal Create Requerimientos--}}
		<div class="modal modal-default fade in create" id="createReque" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
							<i class="fas fa-plus-circle"></i>
							<span style="font-size: 0.3em; color: black;"><p>Requerimientos a solicitar</p></span>
						</div>
					</div>
					<form action="/requeri-client" method="POST">
						@csrf
						<div class="modal-header">
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserticket') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserticketdescrit') }} </p>">
									<label for="main_RequeCliBascula">{{ trans('adminlte_lang::message.solserticket') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliBascula" name="RequeCliBascula">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliBascula" name="auto_RequeCliBascula">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserperscapa') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserperscapadescrit') }} </p>">
									<label for="RequeCliCapacitacion">{{ trans('adminlte_lang::message.solserperscapa') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliCapacitacion" name="RequeCliCapacitacion">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliCapacitacion" name="auto_RequeCliCapacitacion">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsermaspers') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsermaspersdescrit') }} </p>">
									<label for="RequeCliMasPerson">{{ trans('adminlte_lang::message.solsermaspers') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliMasPerson" name="RequeCliMasPerson">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliMasPerson" name="auto_RequeCliMasPerson">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicexclusi') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicexclusidescrit') }} </p>">
									<label for="RequeCliVehicExclusive">{{ trans('adminlte_lang::message.solservehicexclusi') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliVehicExclusive" name="RequeCliVehicExclusive">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliVehicExclusive" name="auto_RequeCliVehicExclusive">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicplata') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicplatadescrit') }} </p>">
									<label for="RequeCliPlatform">{{ trans('adminlte_lang::message.solservehicplata') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliPlatform" name="RequeCliPlatform">
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliPlatform" name="auto_RequeCliPlatform">
									</div>
								</label>
							</div>
						</div>
						<input type="text" hidden value="{{$cliente->ID_Cli}}" name="FK_RequeClient">
						<div class="modal-footer">
							<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.add') }}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	{{-- End Modal Create Requerimientos--}}
	@else
	{{-- Start Modal Edit Requerimientos--}}
		<div class="modal modal-default fade in create" id="editReque" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
							<i class="fas fa-exclamation-triangle"></i>
							<span style="font-size: 0.3em; color: black;"><p>Requerimientos a solicitar</p></span>
						</div>
					</div>
					@if(isset($Requerimientos))
					<form action="/requeri-client/{{$Requerimientos->ID_RequeCli}}" method="POST">
						@csrf
						@method('PUT')
						<div class="modal-header">
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserticket') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserticketdescrit') }} </p>">
									<label for="main_RequeCliBascula">{{ trans('adminlte_lang::message.solserticket') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliBascula" name="RequeCliBascula" {{$Requerimientos->RequeCliBascula == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliBascula" name="auto_RequeCliBascula" {{$Requerimientos->auto_RequeCliBascula == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserperscapa') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserperscapadescrit') }} </p>">
									<label for="RequeCliCapacitacion">{{ trans('adminlte_lang::message.solserperscapa') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliCapacitacion" name="RequeCliCapacitacion" {{$Requerimientos->RequeCliCapacitacion == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliCapacitacion" name="auto_RequeCliCapacitacion" {{$Requerimientos->auto_RequeCliCapacitacion == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsermaspers') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsermaspersdescrit') }} </p>">
									<label for="RequeCliMasPerson">{{ trans('adminlte_lang::message.solsermaspers') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliMasPerson" name="RequeCliMasPerson" {{$Requerimientos->RequeCliMasPerson == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliMasPerson" name="auto_RequeCliMasPerson" {{$Requerimientos->auto_RequeCliMasPerson == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicexclusi') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicexclusidescrit') }} </p>">
									<label for="RequeCliVehicExclusive">{{ trans('adminlte_lang::message.solservehicexclusi') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliVehicExclusive" name="RequeCliVehicExclusive" {{$Requerimientos->RequeCliVehicExclusive == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliVehicExclusive" name="auto_RequeCliVehicExclusive" {{$Requerimientos->auto_RequeCliVehicExclusive == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicplata') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicplatadescrit') }} </p>">
									<label for="RequeCliPlatform">{{ trans('adminlte_lang::message.solservehicplata') }}</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="mainswitch" id="main_RequeCliPlatform" name="RequeCliPlatform" {{$Requerimientos->RequeCliPlatform == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de activación</b>" data-content="<p style='width: 50%'> Seleccione automático para que el requerimiento se active automáticamente en las nuevas solicitudes de servicio o manual para que el cliente sea quien deba activarlo cuando lo requiera <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
									<label for="auto_RequeCliBascula">Activación</label>
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" class="autoswitch" id="RequeCliPlatform" name="auto_RequeCliPlatform" {{$Requerimientos->auto_RequeCliPlatform == 1 ? 'checked' : ''}}>
									</div>
								</label>
							</div>
						</div>
						<input type="text" hidden value="{{$cliente->ID_Cli}}" name="FK_RequeClient">
						<div class="modal-footer">
							<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.add') }}</button>
						</div>
					</form>
					@endif
				</div>
			</div>
		</div>
	{{-- End Modal Edit Requerimientos--}}
	@endif
@endif
@endsection
@section('NewScript')
	<script>
		$('.disabled').bootstrapSwitch('disabled',true);
		popover();
	</script>
	@if(count($Sedes) > 1)
		<script>
			function DeleteSede(slug, name){
				$('#deleteSede').empty();
				$('#deleteSede').append(`
					@component('layouts.partials.modal')
						@slot('slug')
							`+slug+`
						@endslot
						@slot('textModal')
							la sede <b>`+name+`</b>
						@endslot
					@endcomponent

					<form action='{{Route::currentRouteName() === 'cliente-show' ? '/sedes/`+slug+`/destroy' : '/sclientes/`+slug+`'}}' method='POST'>
						@method('DELETE')
						@csrf
						<input type="submit" id="Eliminar`+slug+`" style="display: none;">
					</form>
				`);
			}
		</script>
	@endif
	<script type="text/javascript">
		function SwitchAuto() {
			$(".autoswitch").bootstrapSwitch({
				animate: true,
				labelText: '<i class="fas fa-power-off"></i>',
				onText: 'Automatico',
				offText: 'Manual',
				onColor: 'success',
				offColor: 'danger',
				onSwitchChange: function () {
					updateMain(this.id);
				}
			});
		}
		function updateMain(id) {
			var main = $('#main_'+id);
			var auto = $('#'+id);
			if (auto.prop("checked")) {
				if (!main.prop("checked")) {
					main.bootstrapSwitch('state', true);
				}
			}
		}
		function SwitchMain() {
			$(".mainswitch").bootstrapSwitch({
				animate: true,
				labelText: '<i class="fas fa-arrows-alt-h"></i>',
				onText: 'Habilitado',
				offText: 'Bloqueado',
				onSwitchChange: function () {
					updateAuto(this.name);
				}
			});
		}
		function updateAuto(name) {
			var main = $('#main_'+name);
			var auto = $('#'+name);
			if (!main.prop("checked")) {
				if (auto.prop("checked")) {
					auto.bootstrapSwitch('state', false);
				}
			}
		}
		$(document).ready(SwitchAuto());
		$(document).ready(SwitchMain());
	</script>
@endsection
