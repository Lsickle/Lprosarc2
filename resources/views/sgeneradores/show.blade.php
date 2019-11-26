@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.SGenertitle') }}
@endsection
@section('contentheader_title')
 <span style="background-image: linear-gradient(40deg, rgb(69, 202, 252), rgb(48, 63, 159)); padding-right:30vw; position:relative; overflow:hidden;">
 	{{ trans('adminlte_lang::message.SGenertitle') }}
   <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
 </span>
@endsection 
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<div class="col-md-12 col-xs-12">
						@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
							<a href="/sgeneradores/{{$SedeGener->GSedeSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
							@component('layouts.partials.modal')
								@slot('slug')
									{{$SedeGener->GSedeSlug}}
								@endslot
								@slot('textModal')
									la sede <b>{{$SedeGener->GSedeName}}</b> del generador <b>{{$Generador->GenerName}}</b>
								@endslot
							@endcomponent
						@endif
						@if($SedeGener->GSedeDelete == 0 && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)))
							@if (count($CountSedeGener) > 1 )
								<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SedeGener->GSedeSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{ trans('adminlte_lang::message.delete') }}</b></a>
								<form action='/sgeneradores/{{$SedeGener->GSedeSlug}}' method='POST'  class="col-12 pull-right">
									@method('DELETE')
									@csrf
									<input type="submit" id="Eliminar{{$SedeGener->GSedeSlug}}" style="display: none;">
								</form>
							@endif 	
						@else
							@if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
								<form action='/sgeneradores/{{$SedeGener->GSedeSlug}}' method='POST' class="pull-left">
									@method('DELETE')
									@csrf
									<button type="submit" class='btn btn-success btn-block'>
										<i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.add') }}</b>
									</button>
									{{-- <input type="submit" class='btn btn-success btn-block' value="{{ trans('adminlte_lang::message.add') }}"> --}}
								</form>
							@endif
						@endif
					</div>
					<h3 class="profile-username text-center textolargo">{{$SedeGener->GSedeName}}</h3>
					<ul class="list-group list-group-unbordered">
						@if (in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
							<li class="list-group-item">
								<b>{{ trans('adminlte_lang::message.clientcliente') }}</b> 
								<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->CliName}}</p>">{{$Cliente->CliName}}</a>
							</li>
						@endif
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.gener') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.gener') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Generador->GenerName}}</p>">{{$Generador->GenerName}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.address') }}</b> 
							<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.adddress') }}')"><i class="far fa-copy"></i></a>
							<p href="#" class="pull-right textpopoveraddress" id="{{ trans('adminlte_lang::message.adddress') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedeAddress}} ({{$Municipio->MunName}} - {{$Departamento->DepartName}})</p>">{{$SedeGener->GSedeAddress}} ({{$Municipio->MunName}} - {{$Departamento->DepartName}})</p>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.mobile') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.mobile') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedeCelular}}</p>">{{$SedeGener->GSedeCelular}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.phone') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedePhone1}}{{' - '.$SedeGener->GSedeExt1}}</p>">{{$SedeGener->GSedePhone1}}{{" - ".$SedeGener->GSedeExt1}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }} 2</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.phone') }} 2" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedePhone2}}{{' - '.$SedeGener->GSedeExt2}}</p>">{{$SedeGener->GSedePhone2}}{{" - ".$SedeGener->GSedeExt2}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.emailaddress') }}</b>
							<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
							<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedeEmail}}</p>">{{$SedeGener->GSedeEmail}}</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		{{--  Modal Agregar un Residuo a una SedeGener--}}
		@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
			<form role="form" action="/respelSGener" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
									<label for="FK_Respel">{{ trans('adminlte_lang::message.MenuRespel') }} </label><small class="help-block with-errors">*</small>
									<select class="form-control select-multiple" id="FK_Respel" name="FK_Respel[]" multiple required>
										@foreach ($Residuos as $Residuo)
											<option value="{{$Residuo->RespelSlug}}">{{$Residuo->RespelName}}</option>
										@endforeach     
									</select>
									<input type="text" hidden name="FK_SGener" value="{{$SedeGener->GSedeSlug}}">
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success pull-right"><b>{{ trans('adminlte_lang::message.add') }}</b></button>
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
					<li class="active box-info" ><a href="#residuos" data-toggle="tab">{{ trans('adminlte_lang::message.MenuRespel') }}</a></li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="residuos">
						@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
							{{-- Barra de Navegacion --}}
							<a href="/respels/create" class="btn btn-primary mx-auto"><i class="fas fa-plus-square"></i> <b>{{ trans('adminlte_lang::message.respelscreate') }}</b></a>
							<a method='get' href='#' data-toggle='modal' data-target='#add'  class="btn btn-success mx-auto pull-right"><i class="fas fa-plus-circle"></i><b> {{ trans('adminlte_lang::message.assignrespels') }}</b></a>
						@endif
						<div style='overflow-y:auto; max-height:400px;'>
							@foreach ($Respels as $Respel)
								<ul class="list-group" style="list-style:none; margin-top:10px;">
									<li class="col-md-11 col-xs-12 col-12">
										@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
											<a method='get' href='#' data-toggle='modal' data-target='#eliminar{{$Respel->SlugSGenerRes}}' onclick="deleteRespelGener(`{{$Respel->SlugSGenerRes}}`, `{{$Respel->RespelName}}`, `{{$SedeGener->GSedeName}}`)" style="font-size: 1.5em; color: red; margin-bottom:-2px;" class="pull-right" ><i class="fas fa-times-circle"></i></a>
										@endif
										<h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light textolargo col-md-offset-1" style="display:flex; justify-content:center;" target="_blank">{{$Respel->RespelName}}</a></h4>
									</li>
									<li class="col-md-12 col-xs-12 col-12">
										{{--  Modal Eliminar un Residuo de una SedeGener--}}
										@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
											<div class="deleterespelgener"></div>
										@endif
										{{-- END Modal --}}
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