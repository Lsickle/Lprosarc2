@extends('layouts.app')
@section('htmlheader_title')
    {{ trans('adminlte_lang::message.clientcontact') }}
@endsection
@section('contentheader_title')
    {{ trans('adminlte_lang::message.clientcontact') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
                <div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.smartwizzardtitle') }}</h3>
				</div>
                <div class="box box-info">
                    <form role="form" action="/contactos" method="POST" enctype="multipart/form-data" data-toggle="validator" class="Formcontacto" id="form">
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
                        <div class="box-body" id="readyTable">
                            <div class="tab-pane" id="addRowWizz">
                                <div class="smartwizard">
                                    <ul>
                                        <li><a href="#step-1"><b>{{ trans('adminlte_lang::message.Paso 1') }}</b><br /><small>{{ trans('adminlte_lang::message.client') }}</small></a></li>
                                        <li><a href="#step-2"><b>{{ trans('adminlte_lang::message.Paso 2') }}</b><br /><small>{{ trans('adminlte_lang::message.clientsede') }}</small></a></li>
                                    </ul>
                                    <div class="row">
                                        <div id="step-1" class="tab-pane step-content" class="Formcontacto">
                                            <div id="form-step-0" role="form" data-toggle="validator" class="Formcontacto">
                                                <div class="form-group col-md-12">
                                                    <label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" value="{{ old('CliNit') }}" required>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliName" class="form-control" id="ClienteInputRazon" maxlength="100" required value="{{ old('CliName') }}">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="ClienteInputNombre" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b>" data-content="{{ trans('adminlte_lang::message.contacclientnombrecortomessage') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientnombrecorto') }}
                                                    </label>
                                                    <input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" maxlength="100" required value="{{ old('CliShortname') }}">
                                                </div>
                                                <div class="col-md-6 form-group"><small class="help-block with-errors">*</small>
                                                    <label for="categoria" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientcategoría') }}</b>" data-content="{{ trans('adminlte_lang::message.contacclientcategoríamessage1') }}<br> <b>NOTA: </b>{{ trans('adminlte_lang::message.contacclientcategoríamessage2') }}" >
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientcategoría') }}
                                                    </label>
                                                    <select class="form-control" id="categoria" name="CliCategoria" required>
                                                        <option onclick="NoAddVehiculo()" value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                        <option onclick="AddVehiculo()" {{ old('CliCategoria') == trans('adminlte_lang::message.clienttransportador') ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clienttransportador') }}</option>
                                                        <option onclick="NoAddVehiculo()" {{old('CliCategoria') == trans('adminlte_lang::message.clientproveedor') ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientproveedor') }}</option>
                                                    </select>
                                                </div>
                                                <div id="AddVehiculoPlaca" class="col-md-6 form-group" style="display:none;">
                                                    <label for="VehicPlaca" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.vehicplaca') }}</b>" data-content="Placa de un vehiculo del Tranportador">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.vehicplaca') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="text" name="VehicPlaca" class="form-control placa" id="VehicPlaca" data-minlength="7" maxlength="7" data-error="{{ trans('adminlte_lang::message.data-error-minlength6') }}" placeholder="{{ trans('adminlte_lang::message.placaplaceholder') }}" value="{{ old('VehicPlaca') }}">
                                                </div>
                                                <div id="AddVehiculoTipo" class="col-md-6 form-group" style="display:none;">
                                                    <label for="VehicTipo" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.vehictipo') }}</b>" data-content="{{ trans('adminlte_lang::message.contacvehictipomessage') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.vehictipo') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="text" name="VehicTipo" class="form-control" id="VehicTipo" maxlength="64" value="{{ old('VehicTipo') }}">
                                                </div>
                                                <div id="AddVehiculoCapacidad" class="col-md-6 form-group" style="display:none;">
                                                    <label for="VehicCapacidad" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.vehiccapacidad') }}</b>" data-content="{{ trans('adminlte_lang::message.contacvehiccapacidadmessage') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.vehiccapacidad') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="number" name="VehicCapacidad" class="form-control" id="VehicCapacidad" maxlength="64" min="0" value="{{ old('VehicCapacidad') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2">
                                            <div id="form-step-1" role="form" data-toggle="validator">
                                                <div class="col-md-9">
                                                    <h2>{{ trans('adminlte_lang::message.sclientsede') }}</h2>
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
                                                    <label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label><a class="load"></a>
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
                                                    <input type="text" class="form-control" id="sedeinputaddress" name="SedeAddress"  maxlength="128" required value="{{ old('SedeAddress') }}" placeholder="{{ trans('adminlte_lang::message.addressplaceholder') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="sedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label><small class="help-block with-errors"></small>
                                                    <input type="text" class="form-control phone tel" id="sedeinputphone1" name="SedePhone1" data-minlength="11" placeholder="{{ trans('adminlte_lang::message.phoneplaceholder') }}" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" value="{{ old('SedePhone1') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="sedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label><small class="help-block with-errors"></small>
                                                    <input type="text" disabled class="form-control extension ext" id="sedeinputext1" name="SedeExt1" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" data-minlength="2" data-maxlength="5" value="{{ old('SedeExt1') }}">
                                                </div>
                                                <div id="telefono2" class="col-md-6 form-group" style="display: none;">
                                                    <label for="sedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label><small class="help-block with-errors"></small>
                                                    <input type="tel" class="form-control phone tel2" id="sedeinputphone2" name="SedePhone2" data-minlength="11" placeholder="{{ trans('adminlte_lang::message.phoneplaceholder') }}" data-maxlength="11" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" value="{{ old('SedePhone2') }}">
                                                </div>
                                                <div id="extension2" class="col-md-6 form-group" style="display: none;">
                                                    <label for="sedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label><small class="help-block with-errors"></small>
                                                    <input type="text" class="form-control extension ext2" id="sedeinputext2" name="SedeExt2" data-minlength="2" maxlength="5" data-error="{{ trans('adminlte_lang::message.data-error-minlength2') }}" disabled value="{{ old('SedeExt2') }}">
                                                </div>
                                                <div class="col-md-12" id="tel" style="display:flex; justify-content:center">
                                                    <a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.register') }}</button>
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
@section('NewScript')
@if(old('VehicTipo') !== null)
	<script>
		$(document).ready(function(){
			Vehiculo();
		});
	</script>
@endif
@endsection
@endsection