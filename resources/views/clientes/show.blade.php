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
						@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PersInter1))
							@if(Route::currentRouteName() === 'cliente-show')
								<a href="/cliente/{{$cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
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
											<input type="text" value="{{$cliente->CliNit === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliNit === null ? '#' : $cliente->CliNit}}" class="{{$cliente->CliNit === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliNit === null ? 'disabled' : ''}}>
													<i class='{{$cliente->CliNit === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
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
											<input type="text" value="{{$cliente->CliNit === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliNit === null ? '#' : $cliente->CliNit}}" class="{{$cliente->CliNit === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliNit === null ? 'disabled' : ''}}>
													<i class='{{$cliente->CliNit === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
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
											<input type="text" value="{{$cliente->CliNit === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliNit === null ? '#' : $cliente->CliNit}}" class="{{$cliente->CliNit === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliNit === null ? 'disabled' : ''}}>
													<i class='{{$cliente->CliNit === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
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
											<input type="text" value="{{$cliente->CliNit === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliNit === null ? '#' : $cliente->CliNit}}" class="{{$cliente->CliNit === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliNit === null ? 'disabled' : ''}}>
													<i class='{{$cliente->CliNit === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
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
											<input type="text" value="{{$cliente->CliNit === null ? 'No adjunto' : 'Ver archivo adjunto'}}" class="form-control" disabled>
											<div class="input-group-btn ">
												<a href="{{$cliente->CliNit === null ? '#' : $cliente->CliNit}}" class="{{$cliente->CliNit === null ? 'btn btn-default' : 'btn btn-success'}} pull-right" {{$cliente->CliNit === null ? 'disabled' : ''}}>
													<i class='{{$cliente->CliNit === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
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
			<div class="box box-info">
				<div class="box-body box-profile">
					<div style="border-bottom:#dddddd 1px solid; padding-bottom:16px;">
						<span style="font-size: 21px;">Sedes</span>
						@if (Route::currentRouteName() === 'cliente-show')
							<a href="/sclientes/create" class="btn btn-primary pull-right"><b>{{ trans('adminlte_lang::message.create') }} Sede</b></a>
						@endif
					</div>
					<div style='overflow-y:auto; max-height:463px;'>
						@foreach ($Sedes as $Sede)
						<div style="margin-bottom:30px;">
							<div class="col-md-12 col-xs-12">
								@if(Route::currentRouteName() === 'cliente-show')
									@if($Sede->SedeDelete == 0 )
										<a href="/sclientes/{{$Sede->SedeSlug}}/edit" class="btn btn-warning pull-right" title="{{ trans('adminlte_lang::message.edit') }}"><i class="fas fa-edit"></i></a>
										@if(count($Sedes) > 1)
											<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Sede->SedeSlug}}' class='btn btn-danger pull-left' title="{{ trans('adminlte_lang::message.delete') }}" onclick="DeleteSede(`{{$Sede->SedeSlug}}`, `{{$Sede->SedeName}}`)"><i class="fas fa-trash-alt"></i></a>
											<div id="deleteSede"></div>
										@endif
									@else
										<form action='/sclientes/{{$Sede->SedeSlug}}' method='POST' class="pull-left">
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
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
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
				<form action='/sclientes/`+slug+`' method='POST'>
					@method('DELETE')
					@csrf
					<input type="submit" id="Eliminar`+slug+`" style="display: none;">
				</form>
			`);
		}
	</script>
@endsection