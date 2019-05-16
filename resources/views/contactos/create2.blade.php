@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
                <div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.smartwizzardtitle') }}</h3>
				</div>
                <div class="box box-info">
                    @include('layouts.partials.spinner')
                    <form role="form" id="formCliente " action="/clientes" method="POST" enctype="multipart/form-data" data-toggle="validator" class="form">
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
                                                <div class="form-group col-md-12">
                                                    <label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" value="{{ old('CliNit') }}" required>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  maxlength="100" required value="{{ old('CliName') }}">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="ClienteInputNombre">{{ trans('adminlte_lang::message.clientnombrecorto') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" maxlength="100" required value="{{ old('CliShortname') }}">
                                                </div>
                                                <div class="col-md-6 form-group"><small class="help-block with-errors">*</small>
                                                    <label for="categoria">{{ trans('adminlte_lang::message.clientcategoría') }}</label>
                                                    <select class="form-control select" id="categoria" name="CliCategoria" required value="{{ old('CliCategoria') }}">
                                                        <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                        <option {{ old('CliCategoria') == trans('adminlte_lang::message.clientcliente') ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientcliente') }}</option>
                                                        <option {{ old('CliCategoria') == trans('adminlte_lang::message.clienttransportador') ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clienttransportador') }}</option>
                                                        <option {{ old('CliCategoria') == trans('adminlte_lang::message.clientproveedor') ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientproveedor') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2" class="">
                                            <div id="form-step-1" role="form" data-toggle="validator">
                                                <div class="col-md-9">
                                                    <h2>{{ trans('adminlte_lang::message.sclititleh2') }}</h2>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="sedeinputname">{{ trans('adminlte_lang::message.name') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control" id="sedeinputname" name="SedeName" data-maxlength="128" value="{{ old('SedeName') }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="sedeinputemail">{{ trans('adminlte_lang::message.email') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="email" class="form-control" id="sedeinputemail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" name="SedeEmail" maxlength="128" value="{{ old('SedeEmail') }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label><small class="help-block with-errors">*</small>
                                                    <select class="form-control select" id="departamento" name="departamento" required data-dependent="FK_SedeMun">
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
                                                <div class="col-md-6 form-group">
                                                    <label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">(+57)</span>
                                                        <input type="text" class="form-control mobile" id="sedeinputcelular" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" name="SedeCelular" data-minlength="12" value="{{ old('SedeCelular') }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control" id="sedeinputaddress" name="SedeAddress" minlength="5"  maxlength="128" required value="{{ old('SedeAddress') }}">
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
                                                <div class="col-md-12" id="tel" style="display:flex; justify-content:center">
                                                    <a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.register') }}</button>
                                        </div>
                                    </div>
                                </div>
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
