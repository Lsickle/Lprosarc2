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
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- form start -->
							<form role="form" action="/sclientes" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
								<div class="box-header">
									<h3 class="box-title">{{ trans('adminlte_lang::message.sclientregister') }}</h3>
								</div>
								<div class="box-body">
									@if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador')  || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador'))
									<div class="form-group col-md-12">
										<label for="clientname">{{ trans('adminlte_lang::message.clientcliente') }}</label></label><small class="help-block with-errors">*</small>
										<select class="form-control select" id="clientname" name="FK_SedeCli" required>
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach($Clientes as $Cliente)
												<option value="{{$Cliente->ID_Cli}}" {{ old('FK_SedeCli') == $Cliente->ID_Cli ? 'selected' : '' }}>{{$Cliente->CliShortname}}</option>
											@endforeach()
										</select>
									</div>
									@endif
									<div class="form-group col-md-6">
										<label for="sedeinputname">{{ trans('adminlte_lang::message.sclientnamesede') }}</label></label><small class="help-block with-errors">*</small>
										<input type="text" class="form-control" id="sedeinputname" name="SedeName" value="{{ old('SedeName') }}" required>
									</div>
									<div class="form-group col-md-6">
											<label for="sedeinputemail">{{ trans('adminlte_lang::message.emailaddress') }}</label></label><small class="help-block with-errors">*</small>
											<input type="email" class="form-control" id="sedeinputemail" name="SedeEmail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" value="{{ old('SedeEmail') }}" required>
										</div>
									<div class="form-group col-md-6">
										<label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label></label><small class="help-block with-errors">*</small>
										<select class="form-control select" id="departamento" name="departamento" required>
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach ($Departamentos as $Departamento)		
												<option value="{{$Departamento->ID_Depart}}" {{ old('departamento') == $Departamento->ID_Depart ? 'selected' : '' }}>{{$Departamento->DepartName}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label>
										<select class="form-control select" id="municipio" name="FK_SedeMun">
											@if (isset($Municipios))
												@foreach ($Municipios as $Municipio)
													<option value="{{$Municipio->ID_Mun}}" {{ old('FK_SedeMun') == $Municipio->ID_Mun ? 'selected' : '' }}>{{$Municipio->MunName}}</option>
												@endforeach
											@endif
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label></label><small class="help-block with-errors">*</small>
										<input type="text" class="form-control" id="sedeinputaddress" name="SedeAddress" value="{{ old('SedeAddress') }}" required>
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label></label><small class="help-block with-errors">*</small>
										<div class="input-group">
											<span class="input-group-addon">(+57)</span>
											<input type="text" class="form-control mobile" id="sedeinputcelular" name="SedeCelular" data-minlength="12" data-maxlength="12" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" value="{{ old('SedeCelular') }}" required>
										</div>
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label><small class="help-block with-errors"></small>
										<input type="text" class="form-control phone tel" id="sedeinputphone1" name="SedePhone1" data-minlength="11" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" value="{{ old('SedePhone1') }}">
									</div>
									<div class="col-md-6 form-group">
											<label for="sedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label><small class="help-block with-errors"></small>
										<input type="text" disabled class="form-control extension ext" id="sedeinputext1" name="SedeExt1" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" data-minlength="2" data-maxlength="5" value="{{ old('SedeExt1') }}">
									</div>
									<div id="telefono2" class="col-md-6 form-group" style="display: none;">
										<label for="sedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label><small class="help-block with-errors"></small>
										<input type="tel" class="form-control phone tel2" id="sedeinputphone2" name="SedePhone2" data-minlength="11"  data-maxlength="11" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" value="{{ old('SedePhone2') }}">
									</div>
									<div id="extension2" class="col-md-6 form-group" style="display: none;">
										<label for="sedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label><small class="help-block with-errors"></small>
										<input type="text" class="form-control extension ext2" id="sedeinputext2" name="SedeExt2" data-minlength="2" maxlength="5" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" disabled value="{{ old('SedeExt2') }}">
									</div>
									<div class="col-md-12" id="tel">
										<div class="box-footer" style="display:flex; justify-content:center">
											<a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
										</div>
									</div>
									<div class="box-footer">
										<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.register') }}</button>
									</div>
								</div>
									<!-- /.box-body -->
							</form>
						</div>
						<!-- /.box -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection
