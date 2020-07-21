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
			<div class="box">
                <div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.smartwizzardtitle') }}</h3>
				</div>
                <div class="box box-info">
                    <form role="form" action="/clientes" method="POST" enctype="multipart/form-data" data-toggle="validator">
                        {{csrf_field()}}
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
                                        <li><a href="#step-3"><b>{{ trans('adminlte_lang::message.Paso 3') }}</b><br /><small>{{ trans('adminlte_lang::message.clientpers') }}</small></a></li>
                                    </ul>
                                    <div class="row">
                                        <div id="step-1" class="tab-pane step-content">
                                            <div id="form-step-0" role="form" data-toggle="validator">
                                                <div class="col-md-6 form-group ">
                                                    <label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" value="{{ old('CliNit') }}" required>
                                                </div>
                                                {{-- <div class="col-md-6 form-group">
                                                    <label for="ClienteInputNombre" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b>" data-content="{{ trans('adminlte_lang::message.contacclientnombrecortomessage') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientnombrecorto') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" maxlength="100" required value="{{ old('CliShortname') }}">
                                                </div> --}}
                                                <div class="col-md-6 form-group">
                                                    <label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  maxlength="100" required value="{{ old('CliName') }}">
                                                </div>
                                                {{-- <div class="col-md-6 form-group">
                                                    <label for="CliRut" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientrut') }}</b>" data-content="{{ trans('adminlte_lang::message.clientrut-info') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientrut') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="file" name="CliRut" class="form-control" id="CliRut" accept=".pdf" data-accept="pdf" data-filesize="5120" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="CliCamaraComercio" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientcamaracomercio') }}</b>" data-content="{{ trans('adminlte_lang::message.clientcamaracomercio-info') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientcamaracomercio') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="file" name="CliCamaraComercio" class="form-control" id="CliCamaraComercio" accept=".pdf" data-accept="pdf" data-filesize="5120" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="CliRepresentanteLegal" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientlegalrepresentative') }}</b>" data-content="{{ trans('adminlte_lang::message.clientlegalrepresentative-info') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientlegalrepresentative') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="file" name="CliRepresentanteLegal" class="form-control" id="CliRepresentanteLegal" accept=".pdf" data-accept="pdf" data-filesize="5120" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="CliCertificaionBancaria" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientbankcertification') }}</b>" data-content="{{ trans('adminlte_lang::message.clientbankcertification-info') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientbankcertification') }}
                                                    </label>
                                                    <small class="help-block with-errors"></small>
                                                    <input type="file" name="CliCertificaionBancaria" class="form-control" id="CliCertificaionBancaria" accept=".pdf" data-accept="pdf" data-filesize="5120">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="CliCertificaionComercial" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientcommercialcertification') }}</b>" data-content="{{ trans('adminlte_lang::message.clientcommercialcertification-info') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientcommercialcertification') }}
                                                    </label>
                                                    <small class="help-block with-errors"></small>
                                                    <input type="file" name="CliCertificaionComercial" class="form-control" id="CliCertificaionComercial" accept=".pdf" data-accept="pdf" data-filesize="5120">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="CliCertificaionComercial2" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientcommercialcertification') }} 2</b>" data-content="{{ trans('adminlte_lang::message.clientcommercialcertification-info') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.clientcommercialcertification') }} 2
                                                    </label>
                                                    <small class="help-block with-errors"></small>
                                                    <input type="file" name="CliCertificaionComercial2" class="form-control" id="CliCertificaionComercial2" accept=".pdf" data-accept="pdf" data-filesize="5120">
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div id="step-2" class="">
                                            <div id="form-step-1" role="form" data-toggle="validator">
                                                <div class="col-md-9">
                                                    <h2>{{ trans('adminlte_lang::message.sclititleh2') }}</h2>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="sedeinputname">{{ trans('adminlte_lang::message.sclientnamesede') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control" id="sedeinputname" name="SedeName" maxlength="128" value="{{ old('SedeName') }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="sedeinputemail">Correo electrónico de la Sede</label><small class="help-block with-errors">*</small>
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
                                                    <small class="help-block with-errors">*</small>
                                                    <select class="form-control select" id="municipio" name="FK_SedeMun" required>
                                                        @if (isset($Municipios))
                                                            @foreach ($Municipios as $Municipio)
                                                                <option value="{{$Municipio->ID_Mun}}" {{ old('FK_SedeMun') == $Municipio->ID_Mun ? 'selected' : '' }}>{{$Municipio->MunName}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">(+57)</span>
                                                        <input type="text" class="form-control mobile" id="sedeinputcelular" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" name="SedeCelular" data-minlength="12" value="{{ old('SedeCelular') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control" id="sedeinputaddress" name="SedeAddress" placeholder="{{ trans('adminlte_lang::message.addressplaceholder') }}" minlength="5" maxlength="128" required value="{{ old('SedeAddress') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="sedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label><small class="help-block with-errors"></small>
                                                    <input type="text" class="form-control phone tel" id="sedeinputphone1" name="SedePhone1" placeholder="{{ trans('adminlte_lang::message.phoneplaceholder') }}" data-minlength="11" value="{{ old('SedePhone1') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                        <label for="sedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label><small class="help-block with-errors"></small>
                                                    <input type="text" disabled class="form-control extension ext" id="sedeinputext1" name="SedeExt1" data-minlength="2" data-maxlength="5" value="{{ old('SedeExt1') }}">
                                                </div>
                                                <div id="telefono2" class="col-md-6 form-group" style="display: none;">
                                                    <label for="sedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label><small class="help-block with-errors"></small>
                                                    <input type="tel" class="form-control phone tel2" id="sedeinputphone2" name="SedePhone2" placeholder="{{ trans('adminlte_lang::message.phoneplaceholder') }}" data-minlength="11"  data-maxlength="11" value="{{ old('SedePhone2') }}">
                                                </div>
                                                <div id="extension2" class="col-md-6 form-group" style="display: none;">
                                                    <label for="sedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label><small class="help-block with-errors"></small>
                                                    <input type="text" class="form-control extension ext2" id="sedeinputext2" name="SedeExt2" data-minlength="2" maxlength="5" disabled value="{{ old('SedeExt2') }}">
                                                </div>
                                                <div class="col-md-12" id="tel" style="display:flex; justify-content:center">
                                                    <a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-3">
                                            <div id="form-step-2" role="form" data-toggle="validator">
                                                <div class="col-md-9">
                                                    <h2>{{ trans('adminlte_lang::message.personaltitleh2') }}</h2>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="AreaName" data-placement="auto" data-html="true" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.areaname') }}</b>" data-content="{{ trans('adminlte_lang::message.clientarea-info') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.areaname') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control inputText" id="AreaName" name="AreaName" maxlength="128" required value="{{ old('AreaName') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="AreaName" data-placement="auto" data-html="true" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.cargoname') }}</b>" data-content="{{ trans('adminlte_lang::message.clientcargo-info') }}">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        {{ trans('adminlte_lang::message.cargoname') }}
                                                    </label>
                                                    <small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control inputText" id="CargName" name="CargName" maxlength="128" required value="{{ old('CargName') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersDocType">{{ trans('adminlte_lang::message.persdoctype') }}</label><small class="help-block with-errors">*</small>
                                                    <select class="form-control select" id="PersDocType" name="PersDocType" required>
                                                        <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                        <option value="CC" {{ old('PersDocType') == 'CC' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.persdoctypecc') }}</option>      
                                                        <option value="CE" {{ old('PersDocType') == 'CE' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.persdoctypece') }}</option>
                                                        <option value="RUT" {{ old('PersDocType') == 'RUT' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.persdoctyperut') }}</option> 
                                                        <option value="NIT" {{ old('PersDocType') == 'NIT' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.persdoctypenit') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersDocNumber">{{ trans('adminlte_lang::message.persdocument') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control document" id="PersDocNumber" data-minlength="6" name="PersDocNumber" maxlength="15" required value="{{ old('PersDocNumber') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersFirstName">{{ trans('adminlte_lang::message.persfirstname') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control nombres" id="PersFirstName" name="PersFirstName" maxlength="25" required value="{{ old('PersFirstName') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersSecondName">{{ trans('adminlte_lang::message.perssecondtname') }}</label><small class="help-block with-errors"></small>
                                                    <input type="text" class="form-control nombres" id="PersSecondName" name="PersSecondName" maxlength="25" value="{{ old('PersSecondName') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersLastName">{{ trans('adminlte_lang::message.perslastname') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control inputText" id="PersLastName" name="PersLastName" maxlength="64" required value="{{ old('PersLastName') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersEmail" data-placement="auto" data-html="true" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Correo electrónico de la Persona de Contacto</b>" data-content="Este dato es importante para que la persona de contacto pueda recibir las novedades con relacion a sus residuos y solicitudes de servicio... <br>Si la persona de contacto no cuenta con una dirección de correo electrónico también puede escribir acá el correo electrónico con el que se registro al sistema <b>SisPro</b>.">
                                                        <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
                                                        Correo electrónico del Contacto
                                                    </label><small class="help-block with-errors">*</small>
                                                    <input type="email" class="form-control" id="PersEmail" name="PersEmail" maxlength="255" required value="{{ old('PersEmail') }}" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}">
                                                    
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersCellphone">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">(+57)</span>
                                                        <input type="text" class="form-control mobile" id="PersCellphone" name="PersCellphone" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" data-minlength="12"  maxlength="12" value="{{ old('PersCellphone') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="CliComercial" data-placement="auto" data-html="true" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Correo electrónico de la Persona de Contacto</b>" data-content="Este dato es importante para que la persona de contacto pueda recibir las novedades con relacion a sus residuos y solicitudes de servicio... <br>Si la persona de contacto no cuenta con una dirección de correo electrónico también puede escribir acá el correo electrónico con el que se registro al sistema <b>SisPro</b>.">
                                                    Comercial Asignado
                                                </label><small class="help-block with-errors">*</small>
                                                <select class="form-control select" id="CliComercial" name="CliComercial" required>
                                                    <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                    @foreach ($comerciales as $comercial)    
                                                        <option value="{{$comercial->ID_Pers}}" {{ old('CliComercial') == $comercial->ID_Pers ? 'selected' : '' }}>{{ $comercial->PersFirstName }} {{$comercial->PersSecondName}} {{$comercial->PersLastName}}</option>      
                                                    @endforeach
                                                </select>
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
@endsection