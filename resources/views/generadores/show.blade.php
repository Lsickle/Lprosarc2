@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.gener') }}
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::message.gener') }}
@endsection	
@section('main-content')
<div class="container-fluid spark-screen">
		{{-- seccion de prueba --}}
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-body box-profile">
						<div class="col-md-12 col-xs-12">
							@if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
								<a href="/generadores/{{$Generador->GenerSlug}}/edit" class="btn btn-warning pull-right"> <i class="fas fa-edit"></i> <b>{{ trans('adminlte_lang::message.edit') }}</b></a>
							@endif
							@component('layouts.partials.modal')
								@slot('slug')
									{{$Generador->ID_Gener}}
								@endslot
								@slot('textModal')
									el generador <b>{{$Generador->GenerShortname}}</b>
								@endslot
							@endcomponent
							@if($Generador->GenerDelete == 0)
								@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
									<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Generador->ID_Gener}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
									<form action='/generadores/{{$Generador->GenerSlug}}' method='POST'  class="col-12 pull-right">
										@method('DELETE')
										@csrf
										<input type="submit" id="Eliminar{{$Generador->ID_Gener}}" style="display: none;">
									</form>
								@endif
							@else
								@if (Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
									<form action='/generadores/{{$Generador->GenerSlug}}' method='POST' class="pull-left">
										@method('DELETE')
										@csrf
										<button type="submit" class='btn btn-success btn-block'>
											<i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.add') }}</b>
										</button>
									</form>
								@endif
							@endif
						</div>
						<h3 class="profile-username text-center textolargo col-12">{{$Generador->GenerShortname}}</h3>
						<ul class="list-group list-group-unbordered">
							@if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.clientcliente') }}</b> 
									<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->CliShortname}}</p>">{{$Cliente->CliShortname}}</a>
								</li>
							@endif
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.sclientsede') }}</b> 
								<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.sclientsede') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeName}}</p>">{{$Sede->SedeName}}</a>
							</li>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> 
								<a href="#" class="pull-right">{{$Generador->GenerNit}}</a>
							</li>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> 
								<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Generador->GenerName}}</p>">{{$Generador->GenerName}}</a>
							</li>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> 
								<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientnombrecorto') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Generador->GenerShortname}}</p>">{{$Generador->GenerShortname}}</a>
							</li>
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.genercode') }}</b> 
								<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.genercode') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Generador->GenerCode}}</p>">{{$Generador->GenerCode}}</a>
							</li>
							@if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
								<h4 class="text-center"><i>{{ trans('adminlte_lang::message.sedesgener') }}</i></h4>
								<div style='overflow-y:auto; max-height:200px;'>
									@php
											$i = 0;
									@endphp
									@foreach ($GenerSedes as $GenerSede)
										<li class="list-group-item col-md-12 col-xs-12">
											<div class="col-md-6 col-xs-6">
												<b class="textolargo">{{$GenerSede->GSedeName}}</b> 
												<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('SGeneraddress{{$i}}')"><i class="far fa-copy"></i></a>
											</div>
											<div>
												<a href="#" class="pull-right textpopover" id="SGeneraddress{{$i}}" title="{{ trans('adminlte_lang::message.genercode') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$GenerSede->GSedeAddress}}</p>">{{$GenerSede->GSedeAddress}}</a>
											</div>
										</li>
										@php
											$i++;
										@endphp
									@endforeach
								</div>
							@endif
						</ul>
					</div>
				</div>
			</div>
			@if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
			 {{--  Modal Agregar un Residuo a una SedeGener--}}
			<form role="form" action="/respelGener" method="POST" enctype="multipart/form-data" data-toggle="validator">
				@csrf
				<div class="modal modal-default fade in" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
									<i class="fas fa-plus-circle"></i>
									<span style="font-size: 0.3em; color: black;"><p>{{ trans('adminlte_lang::message.assignrrespelssedegener') }}</p></span>
								</div>
							</div>
							@if ($errors->any())
								<div class="alert alert-danger" role="alert">
									<ul>
										@foreach ($errors->all() as $error)
											<p>{{$error}}</p>
										@endforeach
									</ul>
								</div>
							@endif
							<div class="modal-header">
								<div class="col-md-12 form-group">
									<label for="FK_SGener">{{ trans('adminlte_lang::message.sedesgener') }}</label><small class="help-block with-errors">*</small>
									<select class="form-control select" id="FK_SGener" name="FK_SGener" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach ($GenerSedes as $GenerSede)	
											<option value="{{$GenerSede->ID_GSede}}" {{ old('FK_SGener') == $GenerSede->ID_GSede ? 'selected' : '' }}>{{$GenerSede->GSedeName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-12 form-group">
									<label for="FK_Respel">{{ trans('adminlte_lang::message.MenuRespel') }} </label><small class="help-block with-errors">*</small>
									<select class="form-control select-multiple" id="FK_Respel" name="FK_Respel[]" multiple required>
										@if(isset($Residuos))
										{{-- @foreach ($Residuos as $Key => $Residuo) --}}
											@foreach ($Residuos as $Residuo)
										 {{-- @foreach (array_combine($Residuos, $old) $Residuo => $ID_Res) --}}
													{{-- @foreach ($old as $ID_Res) --}}
													{{-- @if ($old[$Key] <> $Residuo[$key]) --}}
													<option value="{{$Residuo->ID_Respel}}" {{ $old == $Residuo->ID_Respel ? 'selected' : '' }}>{{$Residuo->RespelName}}</option>
													{{-- <option value="{{$Residuo->ID_Respel}}" {{ $ID_Res == $Residuo->ID_Respel ? 'selected' : '' }}>{{$Residuo->RespelName}}</option> --}}
													{{-- <option value="{{$Residuo->ID_Respel}}" {{ $old[$Key] == $Residuo->ID_Respel ? 'selected' : '' }}>{{$Residuo->RespelName}}</option> --}}
													{{-- @endif --}}
													{{-- @continue --}}
													{{-- @endforeach  --}}
													{{-- @break --}}
													@endforeach 
												{{-- @for ($a = 0; $a < count($old); $a++)
														@for ($i = 0; $i < count($Residuos); $i++)
																<option value="{{$Residuos[$i]->ID_Respel}}" {{ $old[$a] == $Residuos[$i]->ID_Respel ? 'selected' : '' }}>{{$Residuos[$i]->RespelName}}</option>
																@break
														@endfor
												@endfor --}}
										@endif 
									</select>
								</div>
							</div>
							<div class="modal-footer">
									<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.add') }}</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			@endif
		{{-- END Modal --}}
			<div class="col-md-6">
					<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
									{{-- Barra de navegacion --}}
									<li class="active box-info" ><a href="#residuos" data-toggle="tab">{{ trans('adminlte_lang::message.MenuRespel') }}</a></li>
									<li><a href="#sedes" data-toggle="tab">{{ trans('adminlte_lang::message.sclientsedes') }}</a></li>
							</ul>
							<div class="tab-content">
									<div class="active tab-pane" id="residuos">
											@if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
											{{-- BOTONES DE CREAR RESIDUOS Y ASIGNARLOS --}}
													<a href="/respels/create" class="btn btn-primary mx-auto"><b>{{ trans('adminlte_lang::message.respelscreate') }}</b></a>
													<a method='get' href='#' data-toggle='modal' data-target='#add'  class="btn btn-success mx-auto pull-right"><i class="fas fa-plus-circle"></i><b> {{ trans('adminlte_lang::message.assignrespels') }}</b></a>
											@endif
											<div style='overflow-y:auto; max-height:503px;'>
													@foreach ($Respels as $Respel)
															<ul class="list-group" style="list-style:none; margin-top:10px;">
																	<li class="col-md-11 col-xs-12 col-12">
																			@if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
																					{{-- Boton de eliminar residuo del generador --}}
																					<a method='get' href='#' data-toggle='modal' data-target='#eliminar{{$Respel->ID_SGenerRes}}' style="font-size: 1.5em; color: red; margin-bottom:-2px;" class="pull-right" ><i class="fas fa-times-circle"></i></a>
																			@endif
																			<h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light textolargo col-md-offset-1" style="display:flex; justify-content:center;" target="_blank">{{$Respel->RespelName}}</a></h4>
																	</li>
																	<li class="col-md-12 col-xs-12 col-12">
																			{{--  Modal Eliminar un Residuo de una SedeGener--}}
																			@if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') && $Generador->GenerDelete == 0)
																			<form action='/respelGener/{{$Respel->SlugSGenerRes}}' method='POST' role="form">
																					@method('DELETE')
																					@csrf
																					<div class="modal modal-default fade in" id="eliminar{{$Respel->ID_SGenerRes}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																							<div class="modal-dialog" role="document">
																									<div class="modal-content">
																											<div class="modal-body">
																													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																													<div style="font-size: 5em; color: red; text-align: center; margin: auto;">
																															<i class="fas fa-exclamation-triangle"></i>
																															<span style="font-size: 0.3em; color: black;">
																																	<p>{{ trans('adminlte_lang::message.modaldeletegener') }} <b><i>{{$Respel->RespelName}}</i></b> {{ trans('adminlte_lang::message.modalgener') }} <b><i> {{$Generador->GenerShortname}}</i></b>{{ trans('adminlte_lang::message.?') }} </p>
																															</span>
																													</div> 
																											</div>
																											<div class="modal-footer">
																													<button type="button" class="btn btn-success pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.modalexit') }}</button>
																													<label for="delete{{$Respel->ID_SGenerRes}}" class='btn btn-danger'>{{ trans('adminlte_lang::message.modaldelete') }}</label>
																											</div>
																									</div>
																							</div>
																					</div>
																					<input type="submit" id="delete{{$Respel->ID_SGenerRes}}" style="display: none;">
																			</form>
																			@endif
																			{{-- END Modal --}}
																	</li>
															</ul>
													@endforeach
											</div>
									</div>
									<div class="tab-pane" id="sedes">
											<div class="text-center">
													@if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
															<a href="/sgeneradores/create" class="btn btn-success"><i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.addsedegener') }}</b></a>
													@endif
											</div>
											<div style='overflow-y:auto; max-height:503px;'>
													@foreach ($GenerSedes as $GenerSede)
													<ul class="list-group" style="list-style:none; margin-top:10px;">
															<li class="col-md-11 col-xs-12 col-12">
																	<h4><a href="/sgeneradores/{{$GenerSede->GSedeSlug}}" class="list-group-item list-group-item-action list-group-item-light textolargo col-md-offset-1" style="display:flex; justify-content:center;" target="_blank">{{$GenerSede->GSedeName}}</a></h4>
															</li>
													</ul>
													@endforeach
											</div>
									</div>
							</div>
					</div>
			</div>
		</div>
</div>
@endsection
