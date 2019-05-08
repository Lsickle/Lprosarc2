@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.gener') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.gener') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::message.Generregistertittle') }}</h3>
				</div>
				<!-- general form elements -->
				<div class="box box-info">
					@include('layouts.partials.spinner')
					<!-- form start -->
					<form role="form" action="/generadores" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
						<div class="box-body" hidden onload="renderTable()" id="readyTable">
							<div class="tab-pane" id="addRowWizz">
								<div class="smartwizard">
									<ul>
										<li><a href="#step-1"><b>{{ trans('adminlte_lang::message.Paso 1') }}</b><br /><small>{{ trans('adminlte_lang::message.client') }}</small></a></li>
										<li><a href="#step-2"><b>{{ trans('adminlte_lang::message.Paso 2') }}</b><br /><small>{{ trans('adminlte_lang::message.clientsede') }}</small></a></li>
									</ul>
									<div class="row">
										<div id="step-1" class="tab-pane step-content">
											<div id="form-step-0" role="form" data-toggle="validator">

												<div class="col-md-12 form-group">
													<label for="GenerInputTipo">{{ trans('adminlte_lang::message.MenuSedes') }}<i class="fas fa-question-circle"></i></label><small class="help-block with-errors">*</small>
													<select name="FK_GenerCli" class="form-control select" id="GenerInputTipo" required>
														<option value="">{{ trans('adminlte_lang::message.select') }}</option>
														@foreach($Sedes as $Sede)
															<option value="{{$Sede->ID_Sede}}" {{ old('FK_GenerCli') == $Sede->ID_Sede ? 'selected' : '' }}>{{$Sede->SedeName}}</option>
														@endforeach()
													</select>
												</div>
												<div class="col-md-12 form-group">
													<label for="GenerInputNit">{{ trans('adminlte_lang::message.clientNIT') }} </label><i class="far fa-question-circle"></i><small class="help-block with-errors">*</small>
													<input class="form-control nit" data-minlength="13" maxlength="13"  name="GenerNit" autofocus="true" type="text" id="GenerInputNit" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" value="{{ old('GenerNit') }}" required>
												</div>
												<div class="col-md-12 form-group">
													<label for="GenerInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
													<input name="GenerName" type="text" class="form-control" id="GenerInputRazon" value="{{ old('GenerName') }}" required>
												</div>
												<div class="col-md-12 form-group">
													<label for="">{{ trans('adminlte_lang::message.clientnombrecorto') }}</label><small class="help-block with-errors">*</small>
													<input name="GenerShortname" type="text" id="GenerInputNombre" class="form-control" value="{{ old('GenerShortname') }}" required>
												</div>
											</div>
										</div>
										<div id="step-2" class="tab-pane step-content">
											<div id="form-step-1" role="form" data-toggle="validator">
													<div class="form-group col-md-6">
															<label for="GSedeinputname">{{ trans('adminlte_lang::message.sclientnamesede') }}</label><small class="help-block with-errors">*</small>
															<input type="text" class="form-control" id="GSedeinputname" name="GSedeName" value="{{ old('GSedeName') }}" required>
														</div>
														<div class="col-md-6 form-group">
																<label for="GSedeinputemail">{{ trans('adminlte_lang::message.emailaddress') }}</label><small class="help-block with-errors">*</small>
																<input type="email" name="GSedeEmail" class="form-control" id="GSedeinputemail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" value="{{ old('GSedeEmail') }}" required>
															</div>
														
														<div class="col-md-6 form-group">
															<label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label><small class="help-block with-errors">*</small>
															<select class="form-control select" id="departamento" name="departamento" required>
																<option value="">{{ trans('adminlte_lang::message.select') }}</option>
																@foreach ($Departamentos as $Departamento)		
																	<option value="{{$Departamento->ID_Depart}}" {{ old('departamento') == $Departamento->ID_Depart ? 'selected' : '' }}>{{$Departamento->DepartName}}</option>
																@endforeach
																
															</select>
														</div>
														<div class="col-md-6 form-group">
															<label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label>
															<select class="form-control select" id="municipio" name="FK_GSedeMun">
																@if (isset($Municipios))
																	@foreach ($Municipios as $Municipio)
																		<option value="{{$Municipio->ID_Mun}}" {{ old('FK_GSedeMun') == $Municipio->ID_Mun ? 'selected' : '' }}>{{$Municipio->MunName}}</option>
																	@endforeach
																@endif
															</select>
														</div>
														{{-- <div class="col-md-6 form-group">
															<label for="clientname">Cliente</label>
															<select class="form-control" id="clientname" name="FK_GSede" required="true">
																<option>Seleccione....</option>
																@foreach($generadors as $generador)
																	<option value="{{$generador->ID_Gener}}">{{$generador->GenerShortname}}</option>
																@endforeach()
															</select>
														</div> --}}
														<div class="col-md-6 form-group">
															<label for="GSedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label><small class="help-block with-errors">*</small>
															<input type="text" class="form-control" id="GSedeinputaddress" name="GSedeAddress" value="{{ old('GSedeAddress') }}" required>
														</div>
														<div class="col-md-6 form-group">
																<label for="GSedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors"></small>
																<div class="input-group">
																	<span class="input-group-addon">(+57)</span>
																	<input type="text" class="form-control mobile" id="GSedeinputcelular" name="GSedeCelular" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" data-minlength="12" maxlength="12" value="{{ old('GSedeCelular') }}">
																</div>
															</div>
														<div class="col-md-6 form-group">
															<label for="GSedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label><small class="help-block with-errors"></small>
															<input type="tel" class="form-control phone tel" id="GSedeinputphone1" name="GSedePhone1" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" data-minlength="11" maxlength="11" value="{{ old('GSedePhone1') }}">
														</div>
														<div class="col-md-6 form-group">
															<label for="GSedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label><small class="help-block with-errors"></small>
															<input type="text" class="form-control extension ext" id="GSedeinputext1" name="GSedeExt1" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" data-minlength="2" maxlength="5" value="{{ old('GSedeExt1') }}" disabled>
														</div>
														<div id="telefono2" class="col-md-6 form-group" style="display: none;">
															<label for="GSedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label><small class="help-block with-errors"></small>
															<input type="tel" class="form-control phone tel2" id="GSedeinputphone2" name="GSedePhone2" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" data-minlength="11" maxlength="11" value="{{ old('GSedePhone2') }}">
														</div>
														<div id="extension2" class="col-md-6 form-group" style="display: none;">
															<label for="GSedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label><small class="help-block with-errors"></small>
															<input type="text" class="form-control extension ext2" id="GSedeinputext2" name="GSedeExt2" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" data-minlength="2" maxlength="5" value="{{ old('GSedeExt2') }}" disabled>
														</div>
														<div class="col-md-12" id="tel" style="display:flex; justify-content:center">
															<a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
														</div>
													</div>
													<div class="box-footer">
														<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.register') }}</button>
													</div>

											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
