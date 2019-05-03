@extends('layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.areatitle') }}
@endsection

@section('contentheader_title')
{{ trans('adminlte_lang::message.areatitle') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						@component('layouts.partials.modal')
							{{$Areas->AreaSlug}}
						@endcomponent
						<h3 class="box-title">{{ trans('adminlte_lang::message.editarea') }}</h3>
						@if($Areas->AreaDelete == 0)
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Areas->AreaSlug}}' class='btn btn-danger pull-right'>{{ trans('adminlte_lang::message.delete') }}</a>
							<form action='/areas/{{$Areas->AreaSlug}}' method='POST'>
								@method('DELETE')
								@csrf
								<input  type="submit" id="Eliminar{{$Areas->AreaSlug}}" style="display: none;">
							</form>
						@else
							<form action='/areas/{{$Areas->AreaSlug}}' method='POST'>
								@method('DELETE')
								@csrf
								<input type="submit" class='btn btn-success pull-right' value="{{ trans('adminlte_lang::message.add') }}">
							</form>
						@endif
					</div>
					<div class="box box-info">
						<form role="form" action="/areas/{{$Areas->AreaSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
									<label for="NombreArea">{{ trans('adminlte_lang::message.areaname') }}</label><small class="help-block with-errors">*</small>
									<input data-minlength="8" data-error="{{ trans('adminlte_lang::message.data-error-minlength4') }}" required="true" name="AreaName" autofocus="true" type="text" class="form-control inputText" id="NombreArea" value="{{$Areas->AreaName}}">
								</div>
								<div class="form-group col-xs-12 col-md-12">
									<label for="SedeSelect">{{ trans('adminlte_lang::message.sclientsede') }}</label><small class="help-block with-errors">*</small>
									<select name="FK_AreaSede" id="SedeSelect" class="form-control select" required>
										@foreach($Sedes as $Sede)
											<option value="{{$Sede->ID_Sede}}" {{$Areas->FK_SedeCli == $Sede->ID_Sede ? 'select' : ''}}>{{$Sede->SedeName}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="box box-info">
								<div class="box-footer">
									<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.update') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
