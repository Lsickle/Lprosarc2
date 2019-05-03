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
				@component('layouts.partials.modal')
					{{$Sede->ID_Sede}}
				@endcomponent
				<div class="box-body box-profile">
					@if($Sede->SedeDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Sede->ID_Sede}}' class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/sclientes/{{$Sede->SedeSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$Sede->ID_Sede}}" style="display: none;">
						</form>
					@else
						<form action='/sclientes/{{$Sede->SedeSlug}}' method='POST' style="float: right;">
							@method('DELETE')
							@csrf
							<input type="submit" class='btn btn-success btn-block' value="Añadir">
						</form>
					@endif

					<h3 class="profile-username text-center">{{$Sede->SedeName}}</h3>
							<p class="text-muted text-center">Nombre del cliente</p>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.address') }}</b> <a class="pull-right">{{$Sede->SedeAddress}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$Sede->SedePhone1}} - {{$Sede->SedeExt1}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">xsxs</a>
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