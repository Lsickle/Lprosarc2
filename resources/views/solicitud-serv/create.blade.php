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
					<form role="form" id="CreateSolSer" action="/solicitud-servicio" method="POST" data-toggle="validator">
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
								<div id="citytransportadora" class="form-group col-md-12" style="margin: 0; padding: 0;" hidden="true">
									<div class="form-group col-md-6">
										<label for="departamento">{{ trans('adminlte_lang::message.solsertransdepart') }}</label>
										<select class="form-control select" id="departamento">
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach ($Departamentos as $Departamento)
												<option value="{{$Departamento->ID_Depart}}">{{$Departamento->DepartName}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="municipio">{{ trans('adminlte_lang::message.solsertransmuni') }}</label><a class="load"></a>
										<small class="help-block with-errors">*</small>
										<select name="SolSerCityTrans" class="form-control select" id="municipio"></select>
									</div>
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
								<div id="addresscollect" class="form-group col-md-6" hidden="">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solseraddrescollect') }}</b>" data-content="{{ trans('adminlte_lang::message.solseraddrescollectdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solseraddrescollect') }}</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="AddressCollect" name="AddressCollect">
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
						<div class="box-footer">
							<button type="submit" class="btn btn-success pull-right" form="CreateSolSer">{{ trans('adminlte_lang::message.applyfor') }}</button>
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
function TransportadorProsarc() {
	$("#transportador").attr('hidden', true);
	$("#transportador option:selected").prop("selected", false);
	$("#Conductor").attr('hidden', true);
	$("#SolSerConductor").val(null);
	$("#Vehiculo").attr('hidden', true);
	$("#SolSerVehiculo").val(null);
	$("#typeaditable").removeClass('col-md-12');
	$("#typeaditable").addClass('col-md-6');
	$("#SolSerBascula").bootstrapSwitch('disabled',false);
	$("#SolSerCapacitacion").bootstrapSwitch('disabled',false);
	$("#SolSerMasPerson").bootstrapSwitch('disabled',false);
	$("#SolSerVehicExclusive").bootstrapSwitch('disabled',false);
	$("#SolSerPlatform").bootstrapSwitch('disabled',false);
	$("#SolSerDevolucion").bootstrapSwitch('disabled',false);
	$("#SolSerTransportador").removeAttr('required');
	$("#typecollect").attr('hidden', false);
	$("#typecollect").attr('required', true);
	$("#typecollect").removeClass('col-md-6');
	$("#typecollect").addClass('col-md-12');
	$("#typecollect option:selected").prop("selected", false);
	HiddenTypeCollect();
	TransportadorCliente();
}
function HiddenTypeCollect(){
	$("#sedecollect").attr('hidden', true);
	$("#SedeCollect").attr('required', false);
	$("#SedeCollect").val(null).trigger('change');
	$("#addresscollect").attr('hidden', true);
	$("#AddressCollect").attr('required', false);
	$("#AddressCollect").val(null);
	$("#typecollect").removeClass('col-md-6');
	$("#typecollect").addClass('col-md-12');
}
function TypeCollectSede(){
	$("#sedecollect").attr('hidden', false);
	$("#SedeCollect").attr('required', true);
	$("#addresscollect").attr('hidden', true);
	$("#AddressCollect").attr('required', false);
	$("#AddressCollect").val(null);
	$("#typecollect").removeClass('col-md-12');
	$("#typecollect").addClass('col-md-6');
}
function TypeCollectOther(){
	$("#sedecollect").attr('hidden', true);
	$("#SedeCollect").attr('required', false);
	$("#SedeCollect").val(null).trigger('change');
	$("#addresscollect").attr('hidden', false);
	$("#AddressCollect").attr('required', true);
	$("#AddressCollect").val(null);
	$("#typecollect").removeClass('col-md-12');
	$("#typecollect").addClass('col-md-6');
}
function TransportadorExtr() {
	$("#transportador").attr('hidden', false);
	$("#Conductor").attr('hidden', false);
	$("#Vehiculo").attr('hidden', false);
	$("#SolSerTransportador").attr('required', true);
	$("#typeaditable").removeClass('col-md-6');
	$("#typeaditable").addClass('col-md-12');
	$("#SolSerBascula").bootstrapSwitch('state',false);
	$("#SolSerBascula").bootstrapSwitch('disabled',true);
	$("#SolSerCapacitacion").bootstrapSwitch('state',false);
	$("#SolSerCapacitacion").bootstrapSwitch('disabled',true);
	$("#SolSerMasPerson").bootstrapSwitch('state',false);
	$("#SolSerMasPerson").bootstrapSwitch('disabled',true);
	$("#SolSerVehicExclusive").bootstrapSwitch('state',false);
	$("#SolSerVehicExclusive").bootstrapSwitch('disabled',true);
	$("#SolSerPlatform").bootstrapSwitch('state',false);
	$("#SolSerPlatform").bootstrapSwitch('disabled',true);
	$("#SolSerDevolucion").bootstrapSwitch('disabled',false);
	$("#typecollect").attr('hidden', true);
	$("#SolSerTypeCollect").attr('required', false);
	$("#typecollect option:selected").prop("selected", false);
	HiddenTypeCollect();
	TransportadorCliente();
}

function TransportadorCliente() {
	$("#nametransportadora").attr('hidden', true);
	$("#nittransportadora").attr('hidden', true);
	$("#addresstransportadora").attr('hidden', true);
	$("#citytransportadora").attr('hidden', true);
	$("#SolSerNameTrans").removeAttr('required');
	$("#SolSerNitTrans").removeAttr('required');
	$("#SolSerAdressTrans").removeAttr('required');
	$("#municipio").removeAttr('required');
	$("#SolSerNameTrans").val(null);
	$("#SolSerNitTrans").val(null);
	$("#SolSerAdressTrans").val(null);
	$("#municipio").empty();
	$("#departamento").val(null).trigger('change');
}

function OtraTransportadora() {
	$("#nametransportadora").attr('hidden', false);
	$("#nittransportadora").attr('hidden', false);
	$("#addresstransportadora").attr('hidden', false);
	$("#citytransportadora").attr('hidden', false);
	$("#SolSerNameTrans").attr('required', true);
	$("#SolSerNitTrans").attr('required', true);
	$("#SolSerAdressTrans").attr('required', true);
	$("#municipio").attr('required', true);
}
var contadorGenerador = 1;
var contadorRespel = [];
var icon = '';
function HiddenResiduosGener(id_div){
	icon = $('button[data-target=".Respel'+id_div+'"]').find('svg');
	$(icon).removeClass('fa-minus');
	$(icon).addClass('fa-plus');
	$("#DivRepel"+id_div).empty();
}
$("#SolSerDevolucion").on('switchChange.bootstrapSwitch', function(event, state) {
	if(state == true){
		$("#SolSerDevolucionTipo").parent().parent().attr('hidden', false);
		$("#SolSerDevolucionTipo").attr('disabled', false);
		$("#SolSerDevolucionTipo").attr('required', true);
	}
	else{
		$("#SolSerDevolucionTipo").parent().parent().attr('hidden', true);
		$("#SolSerDevolucionTipo").attr('disabled', true);
		$("#SolSerDevolucionTipo").attr('required', false);
		$("#SolSerDevolucionTipo").val(null);
	}
});
function ResiduosGener(id_div, ID_Gener){
	contadorRespel[id_div] = 0;
	$("#DivRepel"+id_div).empty();
	$("#DivRepel"+id_div).append(`@include('solicitud-serv.layaoutsSolSer.OneRespel')`);
	$('#CreateSolSer').validator('update');
	Switch2();
	Switch3();
	Checkboxs();
	numeroDimension();
	numeroKg();
	popover();
	ChangeSelect();
	Selects();
	icon = $('button[data-target=".Respel'+id_div+'"]').find('svg');
	$(icon).removeClass('fa-plus');
	$(icon).addClass('fa-minus');
	HiddenRequeRespel(id_div, contadorRespel[id_div]);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{url('/RespelGener')}}/"+ID_Gener,
		method: 'GET',
		data:{},
		beforeSend: function(){
			$(".loadrespelone"+id_div+contadorRespel[id_div]).append('<i class="fas fa-sync-alt fa-spin"></i>');
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).prop('disabled', true);
		},
		success: function(res){
			if(res != ''){
				var residuos = new Array();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).empty();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="HiddenRequeRespel(`+id_div+`,`+contadorRespel[id_div]+`)" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
				for(var i = res.length -1; i >= 0; i--){
					if ($.inArray(res[i].SlugSGenerRes, residuos) < 0) {
						$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="RequeRespel(`+id_div+`,`+contadorRespel[id_div]+`,'`+res[i].RespelSlug+`')" value="${res[i].SlugSGenerRes}">${res[i].RespelName}</option>`);
						residuos.push(res[i].SlugSGenerRes);
					}
				}
			}
			else{
				$("#DivRepel"+id_div).empty();
				NotifiFalse("Lo sentimos esta sede de generador no tiene residuos asignados");
			}
		},
		complete: function(){
			$(".loadrespelone"+id_div+contadorRespel[id_div]).empty();
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).prop('disabled', false);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			NotifiFalse("No se pudo conectar a la base de datos");
		}
	})
}
function RequeRespel(id_div, contador, Id_Respel){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{url('/RequeRespel')}}/"+Id_Respel,
		method: 'GET',
		data:{},
		beforeSend: function(){
			$(".loadrequired"+id_div+contadorRespel[id_div]).append('<i class="fas fa-sync-alt fa-spin"></i>');
		},
		success: function(res){
			if(res != ''){
				if(res.ReqFotoDescargue === 1){
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',false);
				}
				else{
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res.ReqFotoDestruccion === 1){
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('disabled',false);
				}
				else{
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res.ReqVideoDescargue === 1){
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',false);
				}
				else{
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res.ReqVideoDestruccion === 1){
					$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('disabled',false);
				}
				else{
					$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
				}
			}
			else{
				HiddenRequeRespel(id_div, contador);
			}
		},
		complete: function(){
			$(".loadrequired"+id_div+contadorRespel[id_div]).empty();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			NotifiFalse('Falla en la consulta');
			HiddenRequeRespel(id_div, contador);
		},
	});
}
function HiddenRequeRespel(id_div, contador){
	$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
	$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
	$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
	$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
}
function AgregarGenerador() {
	$("#AddGenerador").before(`@include('solicitud-serv.layaoutsSolSer.NewGener')`);
	popover();
	ChangeSelect();
	Selects();
	$('#CreateSolSer').validator('update');
	contadorGenerador = contadorGenerador + 1;
}

function AgregarResPel(id_div,ID_Gener) {
	contadorRespel[id_div] = contadorRespel[id_div]+1;
	$("#AddRespel"+id_div).before(`@include('solicitud-serv.layaoutsSolSer.NewRespel')`);
	Switch2();
	Switch3();
	Checkboxs();
	numeroDimension();
	numeroKg();
	popover();
	ChangeSelect();
	Selects();
	HiddenRequeRespel(id_div, contadorRespel[id_div]);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{url('/RespelGener')}}/"+ID_Gener,
		method: 'GET',
		data:{},
		beforeSend: function(){
			$(".loadrespelnew"+id_div+contadorRespel[id_div]).append('<i class="fas fa-sync-alt fa-spin"></i>');
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).prop('disabled', true);
		},
		success: function(res){
			if(res != ''){
				var residuos = new Array();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).empty();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="HiddenRequeRespel(`+id_div+`,`+contadorRespel[id_div]+`)" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
				for(var i = res.length -1; i >= 0; i--){
					if ($.inArray(res[i].SlugSGenerRes, residuos) < 0) {
						$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="RequeRespel(`+id_div+`,`+contadorRespel[id_div]+`,'`+res[i].RespelSlug+`')" value="${res[i].SlugSGenerRes}">${res[i].RespelName}</option>`);
						residuos.push(res[i].SlugSGenerRes);
					}
				}
			}
			else{
				$("#DivRepel"+id_div).empty();
				NotifiFalse("Lo sentimos esta sede de generador no tiene residuos asignados");
			}
		},
		complete: function(){
			$(".loadrespelnew"+id_div+contadorRespel[id_div]).empty();
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).prop('disabled', false);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			NotifiFalse("No se pudo conectar a la base de datos");
		}
	})
	$('#CreateSolSer').validator('update');
}
function RemoveRespel(id_div, contador) {
	$("#Repel"+id_div+contador).prev().remove();
	$("#Repel"+id_div+contador).remove();
	$('#CreateSolSer').validator('update');
}

function RemoveGenerador(id) {
	$("#Generador"+id).prev().remove();
	$("#Generador"+id).remove();
	$('#CreateSolSer').validator('update');
}

</script>
@endsection
