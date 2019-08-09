@extends('layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-6">
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
						@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PersInter1))
							@if(Route::currentRouteName() === 'cliente-show')
								<a href="/cliente/{{$cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
							@endif
							@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) && Route::currentRouteName() !== 'cliente-show')
								<a href="/clientes/{{$cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
							@endif
						@endif
					</div>
					<h3 class="profile-username text-center textolargo">{{$cliente->CliShortname}}</h3>
					<ul>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$cliente->CliName}}</p>">{{$cliente->CliName}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$cliente->CliShortname}}</p>">{{$cliente->CliShortname}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$cliente->CliNit}}</a>
						</li>
						<li class="list-group-item">
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
						</li>
					</ul>
				</div>
			</div>
		</div>
		{{-- sedes --}}
		<div class="col-md-6">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					{{-- Barra de navegación --}}
					<li class="active box-info"><a href="#sedes" data-toggle="tab">{{ trans('adminlte_lang::message.sclientsedes') }}</a></li>
					<li><a href="#requerimientos" data-toggle="tab">Requerimientos</a></li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="sedes" style='overflow-y:auto; max-height:485px;'>
						@if (Route::currentRouteName() === 'cliente-show')
							<a href="/sclientes/create" class="btn btn-primary pull-right"><b>{{ trans('adminlte_lang::message.create') }} Sede</b></a>
						@endif
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
								<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.address') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeAddress}} - {{$Sede->MunName}}, {{$Sede->DepartName}}</p>">{{$Sede->SedeAddress}} - {{$Sede->MunName}}, {{$Sede->DepartName}}</a>
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
					<div class="tab-pane" id="requerimientos">
						<h3 class="profile-username text-center textolargo">{{$Sede->SedeName}}</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
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
@endsection