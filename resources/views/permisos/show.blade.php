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
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-info">
				<div class="box-body box-profile">
					<div class="col-md-12 col-xs-12">
						@if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol ===  trans('adminlte_lang::message.Cliente'))
							<a href="/permisos/{{$User->UsSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
						@endif
					</div>
					<h3 class="profile-username text-center">{{$User->name}}</h3>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$User->email}}</p>">{{$User->email}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$User->UsRol}}</p>">{{$User->UsRol}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$User->UsRol2}}</p>">{{$User->UsRol2}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$User->UsRolDesc2}}</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection