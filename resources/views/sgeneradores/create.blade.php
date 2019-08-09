@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.sedesgener') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.sedesgener') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::message.SGenerregistertittle') }}</h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box box-info">
							<!-- form start -->
							<form role="form" action="/sgeneradores" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
									<div class="col-md-6 form-group ">
										<label for="FK_GSede">{{ trans('adminlte_lang::message.gener') }}</label><small class="help-block with-errors">*</small>
										<select class="form-control select" id="FK_GSede" name="FK_GSede" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach ($Generadores as $Generador)
												<option value="{{$Generador->GenerSlug}}" {{ old('FK_GSede') == $Generador->GenerSlug ? 'selected' : '' }}>{{$Generador->GenerName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6 form-group ">
										<label for="GSedeinputname">{{ trans('adminlte_lang::message.sgenernamesede') }}</label><small class="help-block with-errors">*</small>
										<input type="text" class="form-control" id="GSedeinputname" name="GSedeName" value="{{old('GSedeName')}}"required>
									</div>
									<div class="col-md-6 form-group ">
										<label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label><small class="help-block with-errors">*</small>
										<select class="form-control select" id="departamento" name="departamento" required>
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach ($Departamentos as $Departamento)		
												<option value="{{$Departamento->ID_Depart}}"  {{ old('departamento') == $Departamento->ID_Depart ? 'selected' : '' }}>{{$Departamento->DepartName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6 form-group ">
										<label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label><a class="load"></a>
										<select class="form-control select" id="municipio" name="FK_GSedeMun">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@if (isset($Municipios))
												@foreach ($Municipios as $Municipio)
													<option value="{{$Municipio->ID_Mun}}" {{ old('FK_GSedeMun') == $Municipio->ID_Mun ? 'selected' : '' }}>{{$Municipio->MunName}}</option>
												@endforeach
											@endif
										</select>
									</div>
									<div class="col-md-6 form-group ">
										<label for="GSedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label><small class="help-block with-errors">*</small>
										<input type="text" class="form-control" id="GSedeinputaddress" name="GSedeAddress" value="{{old('GSedeAddress')}}" placeholder="{{ trans('adminlte_lang::message.addressplaceholder') }}" required>
									</div>
									<div class="col-md-6 form-group ">
										<label for="GSedeinputemail">{{ trans('adminlte_lang::message.emailaddress') }}</label><small class="help-block with-errors">*</small>
										<input type="email" class="form-control" id="GSedeinputemail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" name="GSedeEmail" value="{{old('GSedeEmail')}}" required>
									</div>
									<div class="col-md-6 form-group">
										<label for="Respels" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.MenuRespel') }}</b>" data-content="{{ trans('adminlte_lang::message.respels-sede-gener') }}">
											<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
											{{ trans('adminlte_lang::message.MenuRespel') }}
										</label>
										<select class="form-control select-multiple" id="Respels" name="FK_Respel[]" multiple>
											@foreach ($Respels as $Respel)
												<option value="{{$Respel->RespelSlug}}">{{$Respel->RespelName}}</option>
											@endforeach
										</select>
									</div>
									
									<div class="col-md-6 form-group ">
										<label for="GSedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
										<div class="input-group">
											<span class="input-group-addon">(+57)</span>
											<input type="text" class="form-control mobile" name="GSedeCelular" id="GSedeinputcelular" data-minlength="12" value="{{old('GSedeCelular')}}" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" required>
										</div>
									</div>
									<div class="col-md-6 form-group">
										<label for="GSedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label>
										<small class="help-block with-errors"></small>
										<input type="tel" class="form-control phone tel" id="GSedeinputphone1" name="GSedePhone1" data-minlength="11" maxlength="11" value="{{ old('GSedePhone1') }}" placeholder="{{ trans('adminlte_lang::message.phoneplaceholder') }}">
									</div>
									<div class="col-md-6 form-group">
										<label for="GSedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label>
										<small class="help-block with-errors"></small>
										<input type="text" class="form-control extension ext" id="GSedeinputext1" name="GSedeExt1" data-minlength="2" maxlength="5" value="{{ old('GSedeExt1') }}" disabled>
									</div>
									<div id="telefono2" class="col-md-6 form-group" style="display: none;">
										<label for="GSedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label>
										<small class="help-block with-errors"></small>
										<input type="tel" class="form-control phone tel2" id="GSedeinputphone2" name="GSedePhone2" data-minlength="11" maxlength="11" value="{{ old('GSedePhone2') }}" placeholder="{{ trans('adminlte_lang::message.phoneplaceholder') }}">
									</div>
									<div id="extension2" class="col-md-6 form-group" style="display: none;">
										<label for="GSedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label> 
										<small class="help-block with-errors"></small>
										<input type="text" class="form-control extension ext2" id="GSedeinputext2" name="GSedeExt2" data-minlength="2" maxlength="5" value="{{ old('GSedeExt2') }}" disabled>
									</div>
									<div class="col-md-12" id="tel" style="display:flex; justify-content:center">
										<a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
									</div>									
								</div>
								<!-- /.box-body -->
								<div class="box box-info" >
									<div class="box-footer pull-right">
										<button type="submit" class="btn btn-success">{{ trans('adminlte_lang::message.register') }}</button>
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
