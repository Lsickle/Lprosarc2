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
					<h3 class="box-title">Complete todos los campos a continuacion</h3>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-info">
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/sgeneradores/{{$GSede->GSedeSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
								@csrf
								@method('PUT')
								<div class="box-body">
									<div class="col-md-6 form-group">
										<label for="clientname">{{ trans('adminlte_lang::message.gener') }}</label>
										<select class="form-control select" id="clientname" name="FK_GSede" required>
												<option value="{{$GSede->FK_GSede}}">Seleccione....</option>
											@foreach($generadores as $generador)
												<option value="{{$generador->ID_GSede}}">{{$generador->GenerShortname}}</option>
											@endforeach()
										</select>
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputname">{{ trans('adminlte_lang::message.sgenernamesede') }}</label>
										<input type="text" class="form-control" id="sedeinputname" name="GSedeName" required value="{{$GSede->GSedeName}}">
									</div>
									<div class="col-md-6 form-group">
											<label for="sedeinputemail">{{ trans('adminlte_lang::message.emailaddress') }}</label>
											<input type="email" class="form-control" id="sedeinputemail" placeholder="Sistemas@Prosarc.com" name="GSedeEmail" required value="{{$GSede->GSedeEmail}}">
										</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label>
										<input type="text" class="form-control" id="sedeinputcelular" placeholder="3014145321" name="GSedeCelular" value="{{$GSede->GSedeCelular}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label>
										<select class="form-control select" id="departamento" name="departamento" required>
											<option>Seleccione...</option>
											@foreach ($Departamentos as $Departamento)
												<option value="{{$Departamento->ID_Depart}}">{{$Departamento->DepartName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6 form-group">
										<label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label>
										<select class="form-control select" id="municipio" name="FK_GSedeMun">
											<option value="{{$GSede->FK_GSedeMun}}">Seleccione....</option>
											@foreach ($Municipios as $Municipio)
												<option value="{{$Municipio->ID_Mun}}">{{$Municipio->MunName}}</option>
											@endforeach
										</select>
									</div>
									
									<div class="col-md-6 form-group">
										<label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label>
										<input type="text" class="form-control" id="sedeinputaddress" placeholder="cll 23 #11c-03" name="GSedeAddress" required="true" value="{{$GSede->GSedeAddress}}">
									</div>


									{{-- <div class="col-md-6 form-group">
										<label for="sedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label>
										<input type="tel" class="form-control" id="sedeinputphone1" placeholder="031-4123141" name="GSedePhone1" maxlength="16" value="{{$GSede->GSedePhone1}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label>
										<input type="text" class="form-control" id="sedeinputext1" name="GSedeExt1" maxlength="4" value="{{$GSede->GSedeExt1}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputphone2">{{ trans('adminlte_lang::message.ext') }} 2</label>
										<input type="tel" class="form-control" id="sedeinputphone2" name="GSedePhone2" maxlength="16" value="{{$GSede->GSedePhone2}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="sedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label>
										<small class="help-block with-errors"></small>
										<input type="text" class="form-control" id="sedeinputext2" name="GSedeExt2" maxlength="4" value="{{$GSede->GSedeExt2}}">
									</div> --}}

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
								
								<!-- /.box-body -->
								<div class="box box-info">
									<div class="box-footer pull-right">
										<button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.update') }}</button>
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
