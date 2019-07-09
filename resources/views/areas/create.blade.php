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
						<h3 class="box-title">{{ trans('adminlte_lang::message.createarea') }}</h3>
					</div>
					<div class="box box-info">
						<form role="form" action="/areas" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
									<label for="SedeSelect">{{ trans('adminlte_lang::message.sclientsede') }}</label><small class="help-block with-errors">*</small>
									<select name="FK_AreaSede" id="SedeSelect" class="form-control select" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($Sedes as $Sede)
											<option value="{{$Sede->SedeSlug}}">{{$Sede->SedeName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-xs-12 col-md-12">
									<label for="AreaName" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.areaname') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfonewarea') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.areaname') }}</label>
									<small class="help-block with-errors">*</small>
									<input data-minlength="5" required name="AreaName" autofocus="true" type="text" class="form-control inputText" id="AreaName" value="{{old('AreaName')}}">
								</div>
							</div>	
							<div class="box box-info">
								<div class="box-footer">
									<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.register') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
