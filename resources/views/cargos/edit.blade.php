@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					@component('layouts.partials.modal')
						{{$Cargos->CargSlug}}
					@endcomponent
					<h3 class="box-title">{{trans('adminlte_lang::message.editcargo')}}</h3>
					@if($Cargos->CargDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cargos->CargSlug}}' class='btn btn-danger pull-right'>{{ trans('adminlte_lang::message.delete') }}</a>
						<form action='/cargos/{{$Cargos->CargSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$Cargos->CargSlug}}" style="display: none;">
						</form>
					@else
						<form action='/cargos/{{$Cargos->CargSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<input type="submit" class='btn btn-success btn-block pull-right' value="{{ trans('adminlte_lang::message.add') }}">
						</form>
					@endif
				</div>
				<div class="box box-info">
					<form role="form" action="/cargos/{{$Cargos->CargSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@method('PATCH')
						@csrf
						@if ($errors->any())
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->all() as $error)
										<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="box-body">
							<div class="form-group col-xs-12 col-md-12">
								<label for="NombreCargo">{{trans('adminlte_lang::message.cargoname')}}</label><small class="help-block with-errors">*</small>
								<input required name="CargName" autofocus="true" type="text" class="form-control inputText" id="NombreCargo" value="{{$Cargos->CargName}}">
							</div>
							<div class="form-group col-xs-12 col-md-12">
								<label for="AreaSelect">{{trans('adminlte_lang::message.areaname')}}</label><small class="help-block with-errors">*</small>
								<select name="CargArea" required id="AreaSelect" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									@foreach($Areas as $Area)
										<option value="{{$Area->ID_Area}}" {{$Cargos->CargArea == $Area->ID_Area ? 'selected' : ''}}>{{$Area->AreaName}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.register')}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
