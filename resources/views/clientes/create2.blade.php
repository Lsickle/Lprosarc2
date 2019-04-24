@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::message.clientboxtitle') }}</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
                            @include('layouts.partials.spinner')
                            <!-- form start -->
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
										<p>{{ trans('adminlte_lang::message.smartwizzardtitle') }}</p>
										<div class="smartwizard">
											<ul>
												<li><a href="#step-1"><b>{{ trans('adminlte_lang::message.Paso 1') }}</b><br /><small>{{ trans('adminlte_lang::message.client') }}</small></a></li>
												<li><a href="#step-2"><b>{{ trans('adminlte_lang::message.Paso 2') }}</b><br /><small>{{ trans('adminlte_lang::message.clientsede') }}</small></a></li>
												<li><a href="#step-3"><b>{{ trans('adminlte_lang::message.Paso 3') }}</b><br /><small>{{ trans('adminlte_lang::message.clientpers') }}</small></a></li>
											</ul>
											<!-- general form elements -->
								            <div class="row">
                                                
												<div id="step-1" class="tab-pane step-content">
                                                    
                                                    <div id="form-step-0" role="form" data-toggle="validator">
                                                        <div class="form-group col-md-12">
                                                            <label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" required>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  minlength="5"  maxlength="100" required>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label for="ClienteInputNombre">{{ trans('adminlte_lang::message.clientnombrecorto') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" minlength="2"  maxlength="100" required>
                                                        </div>
                                                        @if(Auth::user()->UsRol === "admin")
                                                        <div class="col-md-6 form-group"><small class="help-block with-errors">*</small>
                                                            <label for="categoria">{{ trans('adminlte_lang::message.clientcategoría') }}</label>
                                                            <select class="form-control" id="categoria" name="CliCategoria" required>
                                                                <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                                <option>{{ trans('adminlte_lang::message.clientcliente') }}</option>
                                                                <option>{{ trans('adminlte_lang::message.clienttransportador') }}</option>
                                                                <option>{{ trans('adminlte_lang::message.clientproveedor') }}</option>
                                                            </select>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div id="step-2" class="">
                                                    <div id="form-step-1" role="form" data-toggle="validator">
                                                        <div class="col-md-9">
                                                            <h2>{{ trans('adminlte_lang::message.sclititleh2') }}</h2>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sedeinputname">{{ trans('adminlte_lang::message.name') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" class="form-control" id="sedeinputname" name="SedeName" data-maxlength="128" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sedeinputemail">{{ trans('adminlte_lang::message.email') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="email" class="form-control" id="sedeinputemail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" name="SedeEmail" maxlength="128" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label><small class="help-block with-errors">*</small>
                                                            <select class="form-control" id="departamento" name="departamento" required data-dependent="FK_SedeMun">
                                                                <option onclick="Disabled()" value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                                @foreach ($Departamentos as $Departamento)		
                                                                    <option value="{{$Departamento->ID_Depart}}" onclick="Enabled()">{{$Departamento->DepartName}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label>
                                                            <select class="form-control" id="municipio" name="FK_SedeMun"  disabled>
                                                                <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">(+57)</span>
                                                                <input type="text" class="form-control mobile" id="sedeinputcelular" placeholder="301 414 5321" name="SedeCelular" data-minlength="12" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" class="form-control" id="sedeinputaddress" name="SedeAddress" minlength="5"  maxlength="128" required>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="sedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label><small class="help-block with-errors"></small>
                                                            <input type="text" class="form-control phone tel" id="sedeinputphone1" name="SedePhone1" data-minlength="11">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                                <label for="sedeinputext1">{{ trans('adminlte_lang::message.ext') }}</label><small class="help-block with-errors"></small>
                                                            <input type="text" disabled class="form-control extension ext" id="sedeinputext1" name="SedeExt1" data-minlength="3" data-maxlength="5">
                                                        </div>
                                                        <div id="telefono2" class="col-md-6 form-group" style="display: none;">
                                                            <label for="sedeinputphone2">{{ trans('adminlte_lang::message.phone') }} 2</label><small class="help-block with-errors"></small>
                                                            <input type="tel" class="form-control phone tel2" id="sedeinputphone2" name="SedePhone1" data-minlength="11"  data-maxlength="11">
                                                        </div>
                                                        <div id="extension2" class="col-md-6 form-group" style="display: none;">
                                                            <label for="sedeinputext2">{{ trans('adminlte_lang::message.ext') }} 2</label><small class="help-block with-errors"></small>
                                                            <input type="text" class="form-control extension ext2" id="sedeinputext2" name="SedeExt1" data-minlength="3" maxlength="5" disabled>
                                                        </div>
                                                        <div class="col-md-12" id="tel">
                                                            <div class="box-footer" style="display:flex; justify-content:center">
                                                                <a onclick="Tel()"class="btn btn-info">{{ trans('adminlte_lang::message.scliotrotelefono') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="step-3" class="">
                                                    <div id="form-step-2" role="form" data-toggle="validator">
                                                        <h2>{{ trans('adminlte_lang::message.personaltitleh2') }}</h2>
                                                        <div class="form-group col-md-6">
                                                            <label for="AreaName">{{ trans('adminlte_lang::message.areaname') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" class="form-control inputText" id="AreaName" name="AreaName"  maxlength="128" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="CargName">{{ trans('adminlte_lang::message.cargoname') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" class="form-control inputText" id="CargName" name="CargName" maxlength="128" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="PersDocType">{{ trans('adminlte_lang::message.persdoctype') }}</label><small class="help-block with-errors">*</small>
                                                            <select class="form-control" id="PersDocType" name="PersDocType" required>
                                                                <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                                <option value="CC">{{ trans('adminlte_lang::message.persdoctypenit') }}</option>
                                                                <option value="CE">{{ trans('adminlte_lang::message.persdoctyperut') }}</option>
                                                                <option value="NIT">{{ trans('adminlte_lang::message.persdoctypecc') }}</option>
                                                                <option value="RUT">{{ trans('adminlte_lang::message.persdoctypece') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="PersDocNumber">{{ trans('adminlte_lang::message.persdocument') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" class="form-control document" id="PersDocNumber" name="PersDocNumber" maxlength="15" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="PersFirstName">{{ trans('adminlte_lang::message.persfirstname') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" class="form-control nombres" id="PersFirstName" name="PersFirstName" maxlength="25" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="PersSecondName">{{ trans('adminlte_lang::message.perssecondtname') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" class="form-control nombres" id="PersSecondName" name="PersSecondName" maxlength="25">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="PersLastName">{{ trans('adminlte_lang::message.perslastname') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="text" class="form-control inputText" id="PersLastName" name="PersLastName" maxlength="64" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="PersEmail">{{ trans('adminlte_lang::message.email') }}</label><small class="help-block with-errors">*</small>
                                                            <input type="email" class="form-control" id="PersEmail" name="PersEmail" maxlength="255" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="PersCellphone">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors"></small>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">(+57)</span>
                                                                <input type="text" class="form-control mobile" id="PersCellphone" name="PersCellphone" data-minlength="12"  maxlength="12">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input hidden value="1" name="number">
                                                    <div class="form-group col-md-12">
                                                        <div class="box-footer" style="float:right; margin-right:5%;">
                                                            <button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.register') }}</button>
                                                        </div>
                                                    </div>
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
<script>
    function Tel(){
        $(".tel2").change(function(){
            if($(this).val().length>10){
                $('.ext2').attr('disabled',false);
            }else{
                $('.ext2').attr('disabled',true);
            };
        });
        document.getElementById('telefono2').style.display = 'block';
        document.getElementById('extension2').style.display = 'block';
        $('#tel').remove();
    }
    function Enabled(){
        document.getElementById("municipio").disabled = false;
    }
    function Disabled(){
        document.getElementById("FK_SedeMun").disabled = true;
    }
</script>

@endsection
