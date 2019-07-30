@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::message.solsertitlecreate') }}</h3>
				</div>
				<div class="box box-info">
					<form role="form" id="CreateSolSer" action="/solicitud-servicio" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
							<div class="col-md-12">
								<div class="form-group col-md-12">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserpersonal') }}</b>" data-content="{{ trans('adminlte_lang::message.solserpersonaldescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserpersonal') }}</label>
									<small class="help-block with-errors">*</small>
									<select id="FK_SolSerPersona" name="FK_SolSerPersona" class="form-control" required="">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach ($Personals as $Personal)
										<option value="{{$Personal->PersSlug}}">{{$Personal->PersFirstName.' '.$Personal->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsertypetrans') }}</b>" data-content="{{ trans('adminlte_lang::message.solsertypetransdescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsertypetrans') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" name="SolSerTipo" id="SolSerTipo" required="">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										<option onclick="TransportadorProsarc()" value="99">{{ trans('adminlte_lang::message.solsertransprosarc') }}</option>
										<option onclick="TransportadorExtr()" value="98">{{ trans('adminlte_lang::message.solsertranspro') }}</option>
									</select>
								</div>
								<div id="transportador" class="form-group col-md-6" hidden="true">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsertranspro') }}</b>" data-content="{{ trans('adminlte_lang::message.solsertransprodescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsertranspro') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolSerTransportador" name="SolSerTransportador">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										<option onclick="TransportadorCliente()" value="99">{{$Cliente->CliShortname}}</option>
										<option onclick="OtraTransportadora()" value="98">{{ trans('adminlte_lang::message.solsertransother') }}</option>
									</select>
								</div>
								<div id="nametransportadora" class="form-group col-md-6" hidden="true">
									<label for="SolSerNameTrans">{{ trans('adminlte_lang::message.solsertransname') }}</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="SolSerNameTrans" name="SolSerNameTrans" value="{{old('SolSerNameTrans')}}">
								</div>
								<div id="nittransportadora" class="form-group col-md-6" hidden="true">
									<label for="SolSerNitTrans">{{ trans('adminlte_lang::message.solsertransnit') }}</label>
									<small class="help-block with-errors">*</small>
									<input type="text" class="form-control nit" id="SolSerNitTrans" name="SolSerNitTrans" value="{{old('SolSerNitTrans')}}">
								</div>
								<div id="addresstransportadora" class="form-group col-md-12" hidden="true">
									<label for="SolSerAdressTrans">{{ trans('adminlte_lang::message.solsertransaddress') }}</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="SolSerAdressTrans" name="SolSerAdressTrans" value="{{old('SolSerAdressTrans')}}">
								</div>
								<div class="form-group col-md-6 citytransportadora" hidden>
									<label for="departamento">{{ trans('adminlte_lang::message.solsertransdepart') }}</label>
									<select class="form-control select" id="departamento">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach ($Departamentos as $Departamento)
											<option value="{{$Departamento->ID_Depart}}">{{$Departamento->DepartName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6 citytransportadora" hidden>
									<label for="municipio">{{ trans('adminlte_lang::message.solsertransmuni') }}</label><a class="load"></a>
									<small class="help-block with-errors">*</small>
									<select name="SolSerCityTrans" class="form-control select" id="municipio"></select>
								</div>
								<div id="Conductor" class="form-group col-md-6" hidden="true">
									<label for="SolSerConductor">{{ trans('adminlte_lang::message.solserconduc') }}</label>
									<input maxlength="255" type="text" class="form-control" id="SolSerConductor" name="SolSerConductor" value="{{old('SolSerConductor')}}">
								</div>
								<div id="Vehiculo" class="form-group col-md-6" hidden="true">
									<label for="SolSerVehiculo">{{ trans('adminlte_lang::message.solservehic') }}</label>
									<input type="text" class="form-control placa" id="SolSerVehiculo" name="SolSerVehiculo" value="{{old('SolSerVehiculo')}}">
								</div>
								<div id="typeaditable" class="form-group col-md-6">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solseraudi') }}</b>" data-content="{{ trans('adminlte_lang::message.solseraudidescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solseraudi') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolResAuditoriaTipo" name="SolResAuditoriaTipo" required="">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										<option value="99">{{ trans('adminlte_lang::message.solseraudiprese') }}</option>
										<option value="98">{{ trans('adminlte_lang::message.solseraudivirt') }}</option>
										<option value="97">{{ trans('adminlte_lang::message.solsernoaudi') }}</option>
									</select>
								</div>
								<div id="typecollect" class="form-group col-md-12" hidden="">
									<label>{{ trans('adminlte_lang::message.solsertypecollect') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolSerTypeCollect" name="SolSerTypeCollect" required="">
										<option onclick="HiddenTypeCollect()" value="">{{ trans('adminlte_lang::message.select') }}</option>
										<option onclick="HiddenTypeCollect()" value="99" >{{ trans('adminlte_lang::message.solsertypecollect1') }}</option>
										<option onclick="TypeCollectSede()" value="98" >{{ trans('adminlte_lang::message.solsertypecollect2') }}</option>
										<option onclick="TypeCollectOther()" value="97" >{{ trans('adminlte_lang::message.solsertypecollect3') }}</option>
									</select>
								</div>
								<div id="sedecollect" class="form-group col-md-6" hidden="">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsersedecollect') }}</b>" data-content="{{ trans('adminlte_lang::message.solsersedecollectdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsersedecollect') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control select" id="SedeCollect" name="SedeCollect">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($Sedes as $Sede)
											<option value="{{$Sede->SedeSlug}}">{{$Sede->SedeName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6 addresscollect" hidden="">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solseraddrescollect') }}</b>" data-content="{{ trans('adminlte_lang::message.solseraddrescollectdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solseraddrescollect') }}</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="AddressCollect" name="AddressCollect">
								</div>
								<div class="form-group col-md-6 addresscollect" hidden="">
									<label for="departamento2">{{ trans('adminlte_lang::message.solseraddrescollectdepa') }}</label>
									<select class="form-control select" id="departamento2">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach ($Departamentos as $Departamento)
											<option value="{{$Departamento->ID_Depart}}">{{$Departamento->DepartName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6 addresscollect" hidden="">
									<label for="municipio2">{{ trans('adminlte_lang::message.solseraddrescollectmuni') }}</label><a class="load"></a>
									<small class="help-block with-errors">*</small>
									<select name="FK_SolSerCollectMun" class="form-control select" id="municipio2"></select>
								</div>
								<div class="col-md-12" style="margin: 10px 0;">
									<center>
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requirements') }}</b>" data-content="{{ trans('adminlte_lang::message.requirementsdescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.requirements') }}</label>
									</center>
									<div class="col-md-12" style="border: 2px dashed #00c0ef">
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserticket') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserticketdescrit') }} </p>">
												<label for="SolSerBascula">{{ trans('adminlte_lang::message.solserticket') }}</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerBascula" name="SolSerBascula" {{ old('SolSerBascula') == 'on' ? 'checked' : '' }} hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserperscapa') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserperscapadescrit') }} </p>">
												<label for="SolSerCapacitacion">{{ trans('adminlte_lang::message.solserperscapa') }}</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerCapacitacion" name="SolSerCapacitacion" {{ old('SolSerCapacitacion') == 'on' ? 'checked' : '' }} hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsermaspers') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsermaspersdescrit') }} </p>">
												<label for="SolSerMasPerson">{{ trans('adminlte_lang::message.solsermaspers') }}</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerMasPerson" name="SolSerMasPerson" {{ old('SolSerMasPerson') == 'on' ? 'checked' : '' }} hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicexclusi') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicexclusidescrit') }} </p>">
												<label for="SolSerVehicExclusive">{{ trans('adminlte_lang::message.solservehicexclusi') }}</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerVehicExclusive" name="SolSerVehicExclusive" hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicplata') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicplatadescrit') }} </p>">
												<label for="SolSerPlatform">{{ trans('adminlte_lang::message.solservehicplata') }}</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerPlatform" name="SolSerPlatform" {{ old('SolSerPlatform') == 'on' ? 'checked' : '' }} hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserdevelem') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserdevelemdescrit') }} </p>">
												<label for="SolSerDevolucion">{{ trans('adminlte_lang::message.solserdevelem') }}</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerDevolucion" name="SolSerDevolucion" {{ old('SolSerDevolucion') == 'on' ? 'checked' : '' }}>
												</div>
											</label>
										</div>
										<div class="form-group col-md-6 col-md-offset-3" style="text-align: center;" hidden="">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsernameelem') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsernameelemdescrit') }} </p>" class="col-md-12" >
												<label for="SolSerDevolucionTipo">{{ trans('adminlte_lang::message.solsernameelem') }}</label>
												<input maxlength="128" type="text" class="form-control" id="SolSerDevolucionTipo" name="SolSerDevolucionTipo" value="{{ old('SolSerDevolucionTipo')}}">
												<small class="help-block with-errors"></small>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="text-align: center;">
								<b>{{ trans('adminlte_lang::message.solserrespelsend') }}</b>
							</div>
							<div id="Generador0" class="box box-success col-md-12">
								<div class="form-group col-md-16">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserselectgener') }}</b>" data-content="{{ trans('adminlte_lang::message.solserselectgenerdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserselectgener') }}</label>
									<button type="button" class="btn btn-box-tool boton" style="color: #00a65a;" data-toggle="collapse" data-target=".Respel0" onclick="AnimationMenusForm('.Respel0')" title="Reducir/Ampliar"> <i class="fa fa-plus"></i> </button>
									<small class="help-block with-errors">*</small>
									<select name="SGenerador[0]" id="SGenerador" class="form-control" required="">
										<option onclick="HiddenResiduosGener(0)" value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($SGeneradors as $SGenerador)
											<option onclick="ResiduosGener(0,'{{$SGenerador->GSedeSlug}}')" value="{{$SGenerador->GSedeSlug}}">{{$SGenerador->GenerShortname.' ('.$SGenerador->GSedeName.')'}}</option>
										@endforeach
									</select>
									<br>
								</div>
								<div id="DivRepel0" class="form-group col-md-16">
								</div>
							</div>
							<div id="AddGenerador" class="col-md-16">
								<a onclick="AgregarGenerador()" id="Agregar" class="btn btn-primary" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b> {{ trans('adminlte_lang::message.solseraddgener') }}</b>" data-content="{{ trans('adminlte_lang::message.solseraddgenerdescrit') }}"><i class="fas fa-plus-circle"></i> {{ trans('adminlte_lang::message.solseraddgener') }}</a>
							</div>
						</div>
						<div id="ModalSupport"></div>
						<div class="box box-info">
							<div class="box-footer">
								<a href="#" onclick="$('#Submit').hasClass('disabled') ? $('#Submit').click() : submitverify()" id="Submit2" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.applyfor') }}</a>
								<button type="submit" id="Submit" style="display: none;"></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
<script>
function Switch(){
	$("#SolSerBascula").bootstrapSwitch('disabled',true);
	$("#SolSerCapacitacion").bootstrapSwitch('disabled',true);
	$("#SolSerMasPerson").bootstrapSwitch('disabled',true);
	$("#SolSerVehicExclusive").bootstrapSwitch('disabled',true);
	$("#SolSerPlatform").bootstrapSwitch('disabled',true);
	$("#SolSerDevolucion").bootstrapSwitch('disabled',true);
}
Switch();
function submitverify(){
	var CantidadTotalkg = 0;
	for (var i = 0; i < contadorGenerador; i++) {
		for (var y = 0; y <= contadorRespel[i]; y++) {
			if($("#SolResKgEnviado"+i+y).val() != null){
				CantidadTotalkg = parseInt(CantidadTotalkg)+parseInt($("#SolResKgEnviado"+i+y).val());
			}
		}
	}
	if(CantidadTotalkg != 0){
		if(CantidadTotalkg >= 500){
			$("#Submit2").empty();
			$("#Submit2").append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
			$("#Submit2").attr('disabled', true);
			$('#Submit').click();
		}
		else{
			$('#ModalSupport').empty();
			$('#ModalSupport').append(`
				<div class="modal modal-default fade in" id="SupportPay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
									<i class="fas fa-exclamation-triangle"></i>
									<span style="font-size: 0.3em; color: black;"><p>Su solicitud es inferior a 500kg adjunte el soporte de pago</p></span>
									<span style="font-size: 0.3em; color: black;"><p>Su solicitud es de <b>`+CantidadTotalkg+` kg</b></p></span>
								</div>
							</div>
							<div class="modal-header">
								<div class="form-group col-md-12">
									<label style="color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsersupportpay') }}</b>" data-content="{{ trans('adminlte_lang::message.solsersupportpaydescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solsersupportpay')}}</label>
									<small class="help-block with-errors"></small>
									<input name="SupportPay" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
								</div>
							</div> 
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
								<label for="Submit" class='btn btn-success'>Enviar</label>
							</div>
						</div>
					</div>
				</div>
			`);
			popover();
			$('#CreateSolSer').validator('update');
			envsubmit();
			$('#SupportPay').modal();
		}
	}
}
</script>
@include('solicitud-serv.layaoutsSolSer.functionsSolSer')
@endsection
