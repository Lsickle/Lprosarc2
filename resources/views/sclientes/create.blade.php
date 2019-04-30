@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.sclientsede') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.sclientregister') }}
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
								<div class="box-body">
									@if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador')  || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador'))
									<div class="form-group col-md-12">
										<label for="clientname">{{ trans('adminlte_lang::message.clientcliente') }}</label></label><small class="help-block with-errors">*</small>
										<select class="form-control select" id="clientname" name="FK_SedeCli" required>
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach($Clientes as $Cliente)
												<option value="{{$Cliente->ID_Cli}}">{{$Cliente->CliShortname}}</option>
											@endforeach()
										</select>
									</div>
									@endif
									<div class="form-group col-md-6">
										<label for="sedeinputname">{{ trans('adminlte_lang::message.sclientnamesede') }}</label></label><small class="help-block with-errors">*</small>
										<input type="text" class="form-control" id="sedeinputname" name="SedeName" required>
									</div>
									<div class="form-group col-md-6">
											<label for="sedeinputemail">{{ trans('adminlte_lang::message.emailaddress') }}</label></label><small class="help-block with-errors">*</small>
											<input type="email" class="form-control" id="sedeinputemail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" name="SedeEmail" required>
										</div>
									<div class="form-group col-md-6">
										<label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label></label><small class="help-block with-errors">*</small>
										<select class="form-control select" id="departamento" name="departamento" required>
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach ($Departamentos as $Departamento)		
												<option value="{{$Departamento->ID_Depart}}">{{$Departamento->DepartName}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label>
										<select class="form-control select" id="municipio" name="FK_SedeMun">
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label></label><small class="help-block with-errors">*</small>
										<input type="text" class="form-control" id="sedeinputaddress" placeholder="cll 23 #11c-03" name="SedeAddress" data-maxlength="13" required>
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label></label><small class="help-block with-errors">*</small>
										<div class="input-group">
											<span class="input-group-addon">(+57)</span>
											<input type="text" class="form-control mobile" id="sedeinputcelular" name="SedeCelular" required>
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label></label><small class="help-block with-errors"></small>
										<input type="tel" class="form-control phone" id="sedeinputphone1" placeholder="031-4123141" name="SedePhone1" maxlength="16">
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label></label><small class="help-block with-errors"></small>
										<input type="text" class="form-control ext" id="sedeinputext1" placeholder="1555" name="SedeExt1" max="9999">
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label></label><small class="help-block with-errors"></small>
										<input type="tel" class="form-control phone" id="sedeinputphone2" name="SedePhone2" maxlength="16">
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label></label><small class="help-block with-errors"></small>
										<input type="text" class="form-control ext" id="sedeinputext2" placeholder="1555" name="SedeExt2" max="9999" >
									</div>
									<div class="box-footer form-group " style="float:right; margin-right:5%;">
										<button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.register') }}</button>
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
