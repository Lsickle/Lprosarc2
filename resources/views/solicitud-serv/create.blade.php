@extends('layouts.app')
@section('htmlheader_title')
Solicitudes de servicios
@endsection
@section('contentheader_title')
Solicitudes de servicios
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Creacion de Solicitudes</h3>
				</div>
				<div class="box box-info">
					<form role="form" id="SolicitudServicio" action="/solicitud-servicio" method="POST" data-toggle="validator">
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
							<div class="col-md-12 col-xs-12">
								<div class="form-group col-md-12">
									<label for="FK_SolSerPersona">Persona de Contacto</label>
									<small class="help-block with-errors">*</small>
									<select id="FK_SolSerPersona" name="FK_SolSerPersona" class="form-control" required="">
										<option value="">Seleccione...</option>
										@foreach ($Personals as $Personal)
										<option {{old('FK_SolSerPersona') == $Personal->PersSlug ? 'selected' : ''}} value="{{$Personal->PersSlug}}">{{$Personal->PersFirstName.' '.$Personal->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="SolSerTipo">Tipo de transportador</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" name="SolSerTipo" id="SolSerTipo" required="">
										<option value="">Seleccione...</option>
										<option onclick="TransportadorProsarc()" value="99" {{old('SolSerTipo') == 99 ? 'selected' : ''}}>Transporte Prosarc S.A.</option>
										<option onclick="TransportadorExtr()" value="98" {{old('SolSerTipo') == 98 ? 'selected' : ''}}>Transporte Propio</option>
									</select>
								</div>
								<div id="transportador" class="form-group col-md-6" hidden="true">
									<label for="SolSerTransportador">Transportador</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolSerTransportador" name="SolSerTransportador">
										<option value="">Seleccione...</option>
										<option onclick="TransportadorCliente()" value="99" value="99" {{old('SolSerTransportador') == 99 ? 'selected' : ''}}>{{$Cliente->CliShortname}}</option>
										<option onclick="OtraTransportadora()" value="98" value="98" {{old('SolSerTransportador') == 98 ? 'selected' : ''}}>Otro</option>
									</select>
								</div>
								<div id="nametransportadora" class="form-group col-md-6" hidden="true">
									<label for="SolSerNameTrans">Nombre de la transaportadora</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="SolSerNameTrans" name="SolSerNameTrans" value="{{old('SolSerNameTrans')}}">
								</div>
								<div id="nittransportadora" class="form-group col-md-6" hidden="true">
									<label for="SolSerNitTrans">Nit de la transportadora</label>
									<small class="help-block with-errors">*</small>
									<input type="text" class="form-control nit" id="SolSerNitTrans" name="SolSerNitTrans" value="{{old('SolSerNitTrans')}}">
								</div>
								<div id="addresstransportadora" class="form-group col-md-12" hidden="true">
									<label for="SolSerAdressTrans">Dirección de la transportadora</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="SolSerAdressTrans" name="SolSerAdressTrans" value="{{old('SolSerAdressTrans')}}">
								</div>
								<div id="citytransportadora" class="form-group col-md-12" style="margin: 0; padding: 0;" hidden="true">
									<div class="form-group col-md-6">
										<label for="departamento">Departamento de la transportadora</label>
										<select class="form-control select" id="departamento">
											<option value="">Seleccione...</option>
											@foreach ($Departamentos as $Departamento)
												<option value="{{$Departamento->ID_Depart}}" {{ old('departamento') == $Departamento->ID_Depart ? 'selected' : '' }}>{{$Departamento->DepartName}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="municipio">Municipio de la transportadora</label>
										<small class="help-block with-errors">*</small>
										<select name="SolSerCityTrans" class="form-control select" id="municipio"></select>
									</div>
								</div>
								<div id="Conductor" class="form-group col-md-6" hidden="true">
									<label for="SolSerConductor">Conductor</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="SolSerConductor" name="SolSerConductor" value="{{old('SolSerConductor')}}">
								</div>
								<div id="Vehiculo" class="form-group col-md-6" hidden="true">
									<label for="SolSerVehiculo">Placa del Vehiculo</label>
									<small class="help-block with-errors">*</small>
									<input type="text" class="form-control placa" id="SolSerVehiculo" name="SolSerVehiculo" value="{{old('SolSerVehiculo')}}">
								</div>
								<div id="typeaditable" class="form-group col-md-6">
									<label for="SolResAuditoriaTipo">Auditable</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolResAuditoriaTipo" name="SolResAuditoriaTipo" required="">
										<option value="">Seleccione...</option>
										<option value="99" {{ old('SolResAuditoriaTipo') == 99 ? 'selected' : '' }}>Auditable Virtual</option>
										<option value="98" {{ old('SolResAuditoriaTipo') == 98 ? 'selected' : '' }}>Auditable Presencial</option>
										<option value="97" {{ old('SolResAuditoriaTipo') == 97 ? 'selected' : '' }}>No Auditable</option>
									</select>
								</div>
								<div class="col-md-12" style="margin: 10px 0;">
									<center><label>Requerimientos</label></center>
									<div class="col-md-12" style="border: 2px dashed #00c0ef">
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Ticket de Bascula Camionera</b>" data-content="<p style='width: 50%'> Se requiere pesaje en bascula camionera y la presentacion del ticket correspondiente</p>">
												<label for="SolSerBascula">Ticket de Bascula</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerBascula" name="SolSerBascula" {{ old('SolSerBascula') == 'on' ? 'checked' : '' }} hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Personal con Capacitacion</b>" data-content="<p style='width: 50%'> Se requiere que el Conductor y/o Ayudante de Prosarc S.A. ESP haya realizado capacitación especifica, la cual es dictada por el Cliente</p>">
												<label for="SolSerCapacitacion">Personal con Capacitacion</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerCapacitacion" name="SolSerCapacitacion" {{ old('SolSerCapacitacion') == 'on' ? 'checked' : '' }} hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Personal Adicional</b>" data-content="<p style='width: 50%'> Se requiere el envio de una persona adicional, aparte del conductor y el ayudante, para el cargue de vehiculos de Prosarc S.A.</p>">
												<label for="SolSerMasPerson">Personal Adicional</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerMasPerson" name="SolSerMasPerson" {{ old('SolSerMasPerson') == 'on' ? 'checked' : '' }} hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Vehiculo con Plataforma</b>" data-content="<p style='width: 50%'> Se requiere que Prosarc S.A. ESP envie vehiculo con plataforma para el cargue de los residuos en las instalaciones del Cliente/Generador</p>">
												<label for="SolSerPlatform">Vehiculo con Plataforma</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerPlatform" name="SolSerPlatform" {{ old('SolSerPlatform') == 'on' ? 'checked' : '' }} hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Devolución de elementos</b>" data-content="<p style='width: 50%'> Se requiere devolucion de elementos que son enviados a planta con los residuos a Tratar... por ejemplo: Canecas</p>">
												<label for="SolSerDevolucion">Devolución de elementos</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerDevolucion" name="SolSerDevolucion" {{ old('SolSerDevolucion') == 'on' ? 'checked' : '' }}>
												</div>
											</label>
										</div>
										<div class="form-group col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Nombre de elementos</b>" data-content="<p style='width: 50%'> Se debe especificar el nombre de los elementos que Se requiere sean devueltos al Cliente/Generador... solo aplica si se selecciono el requerimiento: <b><i>Devolución de elentos</i></b></p>">
												<label for="SolSerDevolucionTipo">Nombre elementos</label>
												<input maxlength="128" type="text" maxlength="64" class="form-control" id="SolSerDevolucionTipo" name="SolSerDevolucionTipo" value="{{ old('SolSerDevolucionTipo')}}" disabled="">
												<small class="help-block with-errors"></small>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="text-align: center;">
								<b>RESIDUOS A ENTREGAR</b>
							</div>
							<div id="Generador0" class="box box-success col-md-12">
								<div class="form-group col-md-16">
									<label for="">Seleccione el generador</label>
									<button type="button" class="btn btn-box-tool" style="color: #00a65a;" data-toggle="collapse" data-target="#DivRepel0" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
									<small class="help-block with-errors">*</small>
									<select name="SGenerador[0]" id="SGenerador" class="form-control" required="">
										<option onclick="HiddenResiduosGener(0)" value="">Seleccione...</option>
										@foreach($SGeneradors as $SGenerador)
										<option onclick="ResiduosGener(0,'{{$SGenerador->GSedeSlug}}')" {{old('SGenerador.0') == $SGenerador->GSedeSlug ? 'selected' :''}} value="{{$SGenerador->GSedeSlug}}">{{$SGenerador->GenerShortname.' ('.$SGenerador->GSedeName.')'}}</option>
										@endforeach
									</select>
									<br>
								</div>
								<div id="DivRepel0" class="col-md-16 collapse in">
								</div>
							</div>
							<div id="AddGenerador" class="col-md-16">
								<a onclick="AgregarGenerador()" id="Agregar" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Añadir Generador</a>
							</div>
						</div>
						<div class="box-footer">
							<input type="submit" class="btn btn-success pull-right" form="SolicitudServicio" value="Solicitar">
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
function TransportadorProsarc() {
	$("#transportador").attr('hidden', true);
	$("#nametransportadora").attr('hidden', true);
	$("#nittransportadora").attr('hidden', true);
	$("#addresstransportadora").attr('hidden', true);
	$("#citytransportadora").attr('hidden', true);
	$("#Conductor").attr('hidden', true);
	$("#Vehiculo").attr('hidden', true);
	$("#typeaditable").removeClass('col-md-12');
	$("#typeaditable").addClass('col-md-6');
	$("#SolSerBascula").bootstrapSwitch('disabled',false);
	$("#SolSerCapacitacion").bootstrapSwitch('disabled',false);
	$("#SolSerMasPerson").bootstrapSwitch('disabled',false);
	$("#SolSerPlatform").bootstrapSwitch('disabled',false);
	$("#SolSerTransportador").removeAttr('required');
	$("#SolSerNameTrans").removeAttr('required');
	$("#SolSerNitTrans").removeAttr('required');
	$("#SolSerAdressTrans").removeAttr('required');
	$("#municipio").removeAttr('required');
	$("#SolSerConductor").removeAttr('required');
	$("#SolSerVehiculo").removeAttr('required');
}

function TransportadorExtr() {
	$("#transportador").attr('hidden', false);
	$("#Conductor").attr('hidden', false);
	$("#Vehiculo").attr('hidden', false);
	$("#typeaditable").removeClass('col-md-6');
	$("#typeaditable").addClass('col-md-12');
	$("#SolSerBascula").bootstrapSwitch('state',false);
	$("#SolSerBascula").bootstrapSwitch('disabled',true);
	$("#SolSerCapacitacion").bootstrapSwitch('state',false);
	$("#SolSerCapacitacion").bootstrapSwitch('disabled',true);
	$("#SolSerMasPerson").bootstrapSwitch('state',false);
	$("#SolSerMasPerson").bootstrapSwitch('disabled',true);
	$("#SolSerPlatform").bootstrapSwitch('state',false);
	$("#SolSerPlatform").bootstrapSwitch('disabled',true);
	$("#SolSerTransportador").attr('required', true);
	$("#SolSerConductor").attr('required', true);
	$("#SolSerVehiculo").attr('required', true);
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
function HiddenResiduosGener(id_div){
	$("#DivRepel"+id_div).empty();
}
function Checkboxs(){
	$('input[type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
		if(state == true){
			$("#"+this.dataset.name).val(1);
		}
		else{
			$("#"+this.dataset.name).val(0);
		}
	});
}
$("#SolSerDevolucion").on('switchChange.bootstrapSwitch', function(event, state) {
	if(state == true){
		$("#SolSerDevolucionTipo").attr('disabled', false);
		$("#SolSerDevolucionTipo").attr('required', true);
	}
	else{
		$("#SolSerDevolucionTipo").attr('disabled', true);
		$("#SolSerDevolucionTipo").attr('required', false);
	}
});
function ResiduosGener(id_div, ID_Gener){
	contadorRespel[id_div] = 0;
	$("#DivRepel"+id_div).empty();
	$("#DivRepel"+id_div).append(`@include('solicitud-serv.layaoutsSolSer.OneRespel')`);
	$('#SolicitudServicio').validator('update');
	Switch2();
	Switch3();
	Checkboxs();
	numeroDimension();
	numeroKg();
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
		success: function(res){
			if(res[0] != ''){
				if(res[0].ReqFotoDescargue === 1){
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',false);
				}
				else{
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res[0].ReqFotoDestruccion === 1){
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('disabled',false);
				}
				else{
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res[0].ReqVideoDescargue === 1){
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',false);
				}
				else{
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res[0].ReqVideoDestruccion === 1){
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
		error: function (jqXHR, textStatus, errorThrown) {
			NotifiFalse("No se pudo conectar a la base de datos");
		}
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
	$('#SolicitudServicio').validator('update');
	contadorGenerador = contadorGenerador + 1;
}

function AgregarResPel(id_div) {
	contadorRespel[id_div] = contadorRespel[id_div]+1;
	$("#AddRespel"+id_div).before(`@include('solicitud-serv.layaoutsSolSer.NewRespel')`);
	Switch2();
	Switch3();
	Checkboxs();
	numeroDimension();
	numeroKg();
	$('#FK_SolResRg'+id_div+contadorRespel[id_div]).html($('#FK_SolResRg'+id_div+'0').html());
	$('#SolicitudServicio').validator('update');
}
function RemoveRespel(id_div, contador) {
	$("#Repel"+id_div+contador).prev().remove();
	$("#Repel"+id_div+contador).remove();
}

function RemoveGenerador(id) {
	$("#Generador"+id).prev().remove();
	$("#Generador"+id).remove();
}

</script>
@endsection
