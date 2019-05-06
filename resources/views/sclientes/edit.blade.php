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
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.sclientdatasede') }}</h3>
				</div>
				<div class="box box-info">
					<!-- form start -->
					<form role="form" action="/sclientes/{{$Sede->SedeSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@csrf
						@method('PUT')
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
							<div class="col-md-6 form-group">
								<label for="sedeinputname">{{ trans('adminlte_lang::message.sclientnamesede') }}</label><small class="help-block with-errors">*</small>
								<input type="text" class="form-control" id="sedeinputname" name="SedeName" value="{{$Sede->SedeName}}" required>
							</div>
							<div class="col-md-6 form-group">
								<label for="sedeinputemail">{{ trans('adminlte_lang::message.emailaddress') }}</label><small class="help-block with-errors">*</small>
								<input type="email" class="form-control" id="sedeinputemail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" name="SedeEmail" required="true" value="{{$Sede->SedeEmail}}">
							</div>
							<div class="col-md-6 form-group">
								<label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label><small class="help-block with-errors">*</small>
								<select class="form-control select" id="departamento" name="departamento" required>
									@foreach ($Departamentos as $Departamento)
										<option value="{{$Departamento->ID_Depart}}" {{ $Municipio->FK_MunCity == $Departamento->ID_Depart ? 'selected' : '' }}>{{$Departamento->DepartName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label><small class="help-block with-errors">*</small>
								<select class="form-control select" id="municipio" name="FK_SedeMun">
									@foreach ($Municipios as $Municipio)
										<option value="{{$Municipio->ID_Mun}}" {{ $Sede->FK_SedeMun == $Municipio->ID_Mun ? 'selected' : '' }}>{{$Municipio->MunName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label><small class="help-block with-errors">*</small>
								<input type="text" class="form-control" id="sedeinputaddress" name="SedeAddress" value="{{$Sede->SedeAddress}}" required>
							</div>
							<div class="col-md-6 form-group">
								<label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
								<div class="input-group">
									<span class="input-group-addon">(+57)</span>
									<input type="text" class="form-control mobile" id="sedeinputcelular" placeholder="3014145321" name="SedeCelular" value="{{$Sede->SedeCelular}}" required>
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label for="sedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label><small class="help-block with-errors"></small>
								<input type="text" class="form-control phone tel" id="sedeinputphone1" class="btn btn-outline-success my-2 my-sm-0" name="SedePhone1" data-minlength="11" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" value="{{$Sede->SedePhone1}}">
							</div>
							<div class="col-md-6 form-group">
									<label for="sedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label><small class="help-block with-errors"></small>
								<input type="text" class="form-control extension ext" id="sedeinputext1" name="SedeExt1" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" data-minlength="2" data-maxlength="5" value="{{$Sede->SedeExt1}}" disabled>
							</div>
							<div id="telefono2" class="col-md-6 form-group" style="display: none;">
								<label for="sedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label><small class="help-block with-errors"></small>
								<input type="tel" class="form-control phone tel2" id="sedeinputphone2" name="SedePhone2" data-minlength="11"  data-maxlength="11" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" value="{{$Sede->SedePhone2}}">
							</div>
							<div id="extension2" class="col-md-6 form-group" style="display: none;">
								<label for="sedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label><small class="help-block with-errors"></small>
								<input type="text" class="form-control extension ext2" id="sedeinputext2" name="SedeExt2" data-minlength="2" maxlength="5" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}"  value="{{$Sede->SedeExt2}}" disabled>
							</div>
							<div class="col-md-12" id="tel" style="display:flex; justify-content:center">
								<a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
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
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection