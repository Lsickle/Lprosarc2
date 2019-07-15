@extends('layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.sclientsede') }}
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::message.sclientsede') }}
@endsection	
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="box box-info">
				<div class="box-body box-profile">
					@if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR))
					<div class="col-md-12 col-xs-12">
						@if($Sede->SedeDelete == 1)
							{{-- <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Sede->ID_Sede}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b> {{ trans('adminlte_lang::message.delete') }}</b></a>
							<form action='/sclientes/{{$Sede->SedeSlug}}' method='POST'>
								@method('DELETE')
								@csrf
								<input type="submit" id="Eliminar{{$Sede->ID_Sede}}" style="display: none;">
							</form>
						@else --}}
							<form action='/sclientes/{{$Sede->SedeSlug}}' method='POST' class="pull-left">
								@method('DELETE')
								@csrf
								<button type="submit" class='btn btn-success btn-block'>
									<i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.add') }}</b>
								</button>
							</form>
						@endif
					</div>
					@endif
					<div class="col-md-12">
						<h3 class="profile-username text-center">{{$Sede->SedeName}}</h3>
					</div>
					@if (in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC))
						<p class="text-muted text-center">{{$Cliente->CliShortname}}</p>
					@endif
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.address') }}</b>
							<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.address') }}')"><i class="far fa-copy"></i></a>
							<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.address') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeAddress}} - {{$Municipio->MunName}}, {{$Departamento->DepartName}}</p>">{{$Sede->SedeAddress}} - {{$Municipio->MunName}}, {{$Departamento->DepartName}}</a>
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
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection