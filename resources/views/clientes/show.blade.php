@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('contentheader_title', '')

@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-8" style="margin-left: 15%;">
		<!-- About Me Box -->
			<div class="box box-info">
				<div class="box-body box-profile">
					@if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol ===  trans('adminlte_lang::message.Cliente'))
						<a href="/clientes/{{$cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
					@endif
					<h3 class="profile-username text-center">{{$cliente->CliShortname}}</h3>
					@if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
						<p class="text-muted text-center">{{$cliente->CliCategoria}}</p>
					@endif
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$cliente->CliName}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$cliente->CliShortname}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$cliente->CliNit}}</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection