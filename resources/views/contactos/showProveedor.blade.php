@extends('layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.clientcontacto') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientcontacto') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<!-- About Me Box -->
			<div class="box box-info">
				<div class="box-body box-profile">
					<div class="col-md-12 col-xs-12">
						@php
							$ContactoShow = [trans('adminlte_lang::message.Programador'), trans('adminlte_lang::message.AdministradorPlanta'), trans('adminlte_lang::message.JefeLogistica')]
						@endphp
						@component('layouts.partials.modal')
							@slot('slug')
								{{$Cliente->ID_Cli}}
							@endslot
							@slot('textModal')
								el proveedor <b>{{$Cliente->CliShortname}}</b>
							@endslot
						@endcomponent
						@if($Cliente->CliDelete === 0 && in_array(Auth::user()->UsRol, $ContactoShow))
							<a href="/contactos/{{$Cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cliente->ID_Cli}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
							<form action='/contactos/{{$Cliente->CliSlug}}' method='POST'  class="col-12 pull-right">
								@method('DELETE')
								@csrf
								<input type="submit" id="Eliminar{{$Cliente->ID_Cli}}" style="display: none;">
							</form>
						@else
							@if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') && $Cliente->CliDelete === 1)
								<form action='/contactos/{{$Cliente->CliSlug}}' method='POST' class="pull-left">
									@method('DELETE')
									@csrf
									<button type="submit" class='btn btn-success btn-block'>
										<i class="fas fa-plus-square"></i> <b>{{ trans('adminlte_lang::message.add') }}</b>
									</button>
								</form>
							@endif
						@endif
					</div>
					<h3 class="profile-username text-center">{{$Cliente->CliShortname}}</h3>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.clientcategoría') }}</b> <a class="pull-right">{{$Cliente->CliCategoria}}</a>
					</li>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$Cliente->CliName}}</a>
					</li>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$Cliente->CliShortname}}</a>
					</li>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$Cliente->CliNit}}</a>
					</li>
				</div>
				<div class="box-body box-profile">
					<h3 class="profile-username text-center">{{ trans('adminlte_lang::message.sclientsede') }}</h3>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.sclientnamesede') }}</b> <a class="pull-right">{{$Sede->SedeName}}</a>
					</li>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.address') }}</b>
						<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.adddress') }}')"><i class="far fa-copy"></i></a>
						<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.adddress') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeAddress}} ({{$Municipio->MunName}} - {{$Departamento->DepartName}})</p>">{{$Sede->SedeAddress}} ({{$Municipio->MunName}} - {{$Departamento->DepartName}})</a>
					</li>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$Sede->SedePhone1}} - {{$Sede->SedeExt1}}</a>
					</li>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$Sede->SedePhone2}} - {{$Sede->SedeExt2}}</a>
					</li>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.email') }}</b>
						<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
						<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeEmail}}</p>">{{$Sede->SedeEmail}}</a>
					</li>
					<li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$Sede->SedeCelular}}</a>
					</li>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection