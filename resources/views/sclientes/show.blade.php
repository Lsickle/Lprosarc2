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
		<div class="col-md-8" style="margin-left: 15%;">
		<!-- About Me Box -->
			<div class="box box-info">
				<div class="box-body box-profile">
						<a href="/sclientes/{{$Sede->SedeSlug}}/edit" class="btn btn-warning pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
					@if(!isset($Verify))
						@component('layouts.partials.modal')
							{{$Sede->ID_Sede}}
						@endcomponent
						@if($Sede->SedeDelete == 0)
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Sede->ID_Sede}}' class='btn btn-danger pull-left'><b>{{ trans('adminlte_lang::message.delete') }}</b></a>
							<form action='/sclientes/{{$Sede->SedeSlug}}' method='POST'>
								@method('DELETE')
								@csrf
								<input type="submit" id="Eliminar{{$Sede->ID_Sede}}" style="display: none;">
							</form>
						@else
							<form action='/sclientes/{{$Sede->SedeSlug}}' method='POST' style="float: right;">
								@method('DELETE')
								@csrf
								<input type="submit" class='btn btn-success btn-block' value="{{ trans('adminlte_lang::message.add') }}">
							</form>
						@endif
					@endif
					<h3 class="profile-username text-center">{{$Sede->SedeName}}</h3>
					@if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador'))
						<p class="text-muted text-center">{{$Cliente->CliShortname}}</p>
					@endif
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.address') }}</b> <a class="pull-right">{{$Sede->SedeAddress}} - {{$Municipio->MunName}}, {{$Departamento->DepartName}}</a>
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
							<b>{{ trans('adminlte_lang::message.emailaddress') }}</b> <a class="pull-right">{{$Sede->SedeEmail}}</a>
						</li>
					</ul>
				</div>
				<!-- /.box-body -->
			</div>
		<!-- /.tab-content -->
		</div>
		<!-- /.nav-tabs-custom -->
	</div>
	<!-- /.col -->
</div>
		  <!-- /.row -->
@endsection