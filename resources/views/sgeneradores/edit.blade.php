@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.SGenertitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.SGenertitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.gsedeupdate') }}</h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box box-info">
							<form role="form" action="/sgeneradores/{{$GSede->GSedeSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
									<div class="col-md-12 form-group">
										<label for="clientname">{{ trans('adminlte_lang::message.gener') }}</label><small class="help-block with-errors">*</small>
										<select class="form-control select" id="clientname" name="FK_GSede" required>
												<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach($Generadores as $Generador)
												<option value="{{$Generador->ID_Gener}}"  {{$GSede->FK_GSede == $Generador->ID_Gener ? 'selected' : '' }}>{{$Generador->GenerShortname}}</option>
											@endforeach()
										</select>
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputname">{{ trans('adminlte_lang::message.sgenernamesede') }}</label><small class="help-block with-errors">*</small>
										<input type="text" class="form-control" id="sedeinputname" name="GSedeName" required value="{{$GSede->GSedeName}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label><small class="help-block with-errors">*</small>
										<input type="text" class="form-control" id="sedeinputaddress" name="GSedeAddress" required="true" value="{{$GSede->GSedeAddress}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label><small class="help-block with-errors">*</small>
										<select class="form-control select" id="departamento" name="departamento" required>
											<option>{{ trans('adminlte_lang::message.select') }}</option>
											@foreach ($Departamentos as $Departamento)
												<option value="{{$Departamento->ID_Depart}}" {{ $Municipio->FK_MunCity == $Departamento->ID_Depart ? 'selected' : '' }}>{{$Departamento->DepartName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6 form-group">
										<label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label><a class="load"></a>
										<select class="form-control select" id="municipio" name="FK_GSedeMun">
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach ($Municipios as $Municipio)
												<option value="{{$Municipio->ID_Mun}}" {{ $GSede->FK_GSedeMun == $Municipio->ID_Mun ? 'selected' : '' }}>{{$Municipio->MunName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputemail">{{ trans('adminlte_lang::message.emailaddress') }}</label><small class="help-block with-errors">*</small>
										<input type="email" class="form-control" id="sedeinputemail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" name="GSedeEmail" value="{{$GSede->GSedeEmail}}" required>
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
										<div class="input-group">
											<span class="input-group-addon">(+57)</span>
											<input type="text" class="form-control mobile" id="sedeinputcelular" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" data-minlength="12" maxlength="12" name="GSedeCelular" value="{{$GSede->GSedeCelular}}" required>
										</div>
									</div>
									<div class="col-md-6 form-group">
										<label for="GSedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label>
										<small class="help-block with-errors"></small>
										<input type="tel" class="form-control phone tel" id="GSedeinputphone1" name="GSedePhone1" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" data-minlength="11" maxlength="11" value="{{$GSede->GSedePhone1}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="GSedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label>
										<small class="help-block with-errors"></small>
										<input type="text" class="form-control extension ext" id="GSedeinputext1" name="GSedeExt1" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" data-minlength="2" maxlength="5" value="{{$GSede->GSedeExt1}}" disabled>
									</div>
									<div id="telefono2" class="col-md-6 form-group" style="display: none;">
										<label for="GSedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label>
										<small class="help-block with-errors"></small>
										<input type="tel" class="form-control phone tel2" id="GSedeinputphone2" name="GSedePhone2" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" data-minlength="11" maxlength="11" value="{{$GSede->GSedePhone2}}">
									</div>
									<div id="extension2" class="col-md-6 form-group" style="display: none;">
										<label for="GSedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label> 
										<small class="help-block with-errors"></small>
										<input type="text" class="form-control extension ext2" id="GSedeinputext2" name="GSedeExt2" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" data-minlength="2" maxlength="5" value="{{$GSede->GSedeExt2}}" disabled>
									</div>
									<div class="col-md-12" id="tel" style="display:flex; justify-content:center">
										<a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
									</div>
								</div>
								<div class="box box-info">
									<div class="box-footer pull-right">
										<button type="submit" class="btn btn-warning">{{ trans('adminlte_lang::message.update') }}</button>
									</div>
								</div>
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
