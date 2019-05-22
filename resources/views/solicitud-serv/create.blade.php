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
					<form role="form" id="form1" action="/solicitud-servicio" method="POST">
						@csrf
						<div class="box-body">
							<div class="col-md-12 col-xs-12">
								<div class="col-md-12">
									<label for="FK_SolSerPersona">Persona de Contacto</label>
									<select id="FK_SolSerPersona" name="FK_SolSerPersona" class="form-control">
										<option value="">Seleccione...</option>
										@foreach ($Personals as $Personal)
										<option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName.' '.$Personal->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="SolSerTipo">Tipo de transportador</label>
									<select class="form-control" name="SolSerTipo" id="SolSerTipo">
										<option value="">Seleccione...</option>
										<option onclick="TransportadorProsarc()" value="1">Transporte Prosarc S.A.</option>
										<option onclick="TransportadorExtr()">Transporte Propio</option>
									</select>
								</div>
								<div id="transportador" class="col-md-6" hidden="true">
									<label for="SolSerTransportador">Transportador</label>
									<select class="form-control" id="SolSerTransportador" name="SolSerTransportador">
										<option value="">Seleccione...</option>
										<option onclick="TransportadorCliente()" value="{{$Cliente->ID_Cli}}">{{$Cliente->CliShortname}}</option>
										<option onclick="OtraTransportadora()" value="0">Otro</option>
									</select>
								</div>
								<div id="nametransportadora" class="col-md-6" hidden="true">
									<label for="SolSerNameTrans">Nombre de la transaportadora</label>
									<input type="text" class="form-control" id="SolSerNameTrans" placeholder="Juan" name="SolSerNameTrans">
								</div>
								<div id="nittransportadora" class="col-md-6" hidden="true">
									<label for="SolSerNitTrans">Nit de la transportadora</label>
									<input type="text" class="form-control" id="SolSerNitTrans" placeholder="FDR-756" name="SolSerNitTrans">
								</div>
								<div id="addresstransportadora" class="col-md-6" hidden="true">
									<label for="SolSerAdressTrans">Dirección de la transportadora</label>
									<input type="text" class="form-control" id="SolSerAdressTrans" placeholder="FDR-756" name="SolSerAdressTrans">
								</div>
								<div id="citytransportadora" class="col-md-6" hidden="true">
									<label for="SolSerCityTrans">Ciudad de la transportadora</label>
									<input type="text" class="form-control" id="SolSerCityTrans" placeholder="FDR-756" name="SolSerCityTrans">
								</div>
								<div id="Conductor" class="col-md-6" hidden="true">
									<label for="SolSerConductor">Conductor</label>
									<input type="text" class="form-control" id="SolSerConductor" name="SolSerConductor">
								</div>
								<div id="Vehiculo" class="col-md-6" hidden="true">
									<label for="SolSerVehiculo">Placa del Vehiculo</label>
									<input type="text" class="form-control" id="SolSerVehiculo" name="SolSerVehiculo">
								</div>
								<div id="typeaditable" class="col-md-6">
									<label for="SolResAuditoriaTipo">Auditable</label>
									<select class="form-control" id="SolResAuditoriaTipo" name="SolResAuditoriaTipo">
										<option value="">Seleccione...</option>
										<option value="Presencial">Auditable Presencial</option>
										<option value="Virtual">Auditable Virtual</option>
										<option value="No Auditable">No Auditable</option>
									</select>
								</div>
								<div class="col-md-12" style="margin: 10px 0;">
									<center><label>Requerimientos</label></center>
									<div class="col-md-12" style="border: 2px dashed #00c0ef">
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Ticket de Bascula Camionera</b>" data-content="<p style='width: 50%'> Se requiere pesaje en bascula camionera y la presentacion del ticket correspondiente</p>">
												<label for="SolSerBascula">Ticket de Bascula</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerBascula" name="SolSerBascula" hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Personal con Capacitacion</b>" data-content="<p style='width: 50%'> Se requiere que el Conductor y/o Ayudante de Prosarc S.A. ESP haya realizado capacitación especifica, la cual es dictada por el Cliente</p>">
												<label for="SolSerCapacitacion">Personal con Capacitacion</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerCapacitacion" name="SolSerCapacitacion" hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Personal Adicional</b>" data-content="<p style='width: 50%'> Se requiere el envio de una persona adicional, aparte del conductor y el ayudante, para el cargue de vehiculos de Prosarc S.A.</p>">
												<label for="SolSerMasPerson">Personal Adicional</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerMasPerson" name="SolSerMasPerson" hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Vehiculo con Plataforma</b>" data-content="<p style='width: 50%'> Se requiere que Prosarc S.A. ESP envie vehiculo con plataforma para el cargue de los residuos en las instalaciones del Cliente/Generador</p>">
												<label for="SolSerPlatform">Vehiculo con Plataforma</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerPlatform" name="SolSerPlatform" hidden="">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Devolución de elementos</b>" data-content="<p style='width: 50%'> Se requiere devolucion de elementos que son enviados a planta con los residuos a Tratar... por ejemplo: Canecas</p>">
												<label for="SolSerDevolucion">Devolución de elementos</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" id="SolSerDevolucion" name="SolSerDevolucion">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Nombre de elementos</b>" data-content="<p style='width: 50%'> Se debe especificar el nombre de los elementos que Se requiere sean devueltos al Cliente/Generador... solo aplica si se selecciono el requerimiento: <b><i>Devolución de elentos</i></b></p>">
												<label for="SolSerDevolucionTipo">Nombre elementos</label>
												<input type="text" maxlength="64" class="form-control" id="SolSerDevolucionTipo" name="SolSerDevolucionTipo">
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="text-align: center;">
								<b>RESIDUOS A ENTREGAR</b>
							</div>
							<div class="col-md-12">
								<div id="Generador0" class="box box-success col-md-16">
									<div class="col-md-12">
										<label for="">Seleccione el generador</label>
										<button type="button" class="btn btn-box-tool" style="color: #00a65a;" data-toggle="collapse" data-target="#DivRepel0" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
										<select name="SGenerador[0]" id="SGenerador" class="form-control">
											<option onclick="HiddenResiduosGener(0)" value="">Seleccione...</option>
											@foreach($SGeneradors as $SGenerador)
											<option onclick="ResiduosGener(0,{{$SGenerador->ID_GSede}})" value="{{$SGenerador->ID_GSede}}">{{$SGenerador->GenerShortname.' ('.$SGenerador->GSedeName.')'}}</option>
											@endforeach
										</select>
										<br>
									</div>
									<div id="DivRepel0" class="col-md-12 collapse in">
									</div>
								</div>
							</div>
							<div id="AddGenerador" class="col-md-16">
								<a onclick="AgregarGenerador()" id="Agregar" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Añadir Generador</a>
							</div>
						</div>
						<div class="box-footer">
							<input type="submit" class="btn btn-success pull-right" form="form1" value="Solicitar">
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
}

function TransportadorCliente() {
	$("#nametransportadora").attr('hidden', true);
	$("#nittransportadora").attr('hidden', true);
	$("#addresstransportadora").attr('hidden', true);
	$("#citytransportadora").attr('hidden', true);
}

function OtraTransportadora() {
	$("#nametransportadora").attr('hidden', false);
	$("#nittransportadora").attr('hidden', false);
	$("#addresstransportadora").attr('hidden', false);
	$("#citytransportadora").attr('hidden', false);
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
function ResiduosGener(id_div, ID_Gener){
	contadorRespel[id_div] = 0;
	$("#DivRepel"+id_div).empty();
	$("#DivRepel"+id_div).append(`@include('solicitud-serv.layaoutsSolSer.OneRespel')`);
	Switch2();
	Switch3();
	Checkboxs();
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
					if ($.inArray(res[i].ID_SGenerRes, residuos) < 0) {
						$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="RequeRespel(`+id_div+`,`+contadorRespel[id_div]+`)" value="${res[i].ID_SGenerRes}">${res[i].RespelName}</option>`);
						residuos.push(res[i].ID_SGenerRes);
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
function AgregarGenerador() {
	$("#AddGenerador").before(`@include('solicitud-serv.layaoutsSolSer.NewGener')`);
	contadorGenerador = contadorGenerador + 1;
}

function AgregarResPel(id_div, contador) {
	contadorRespel[id_div] = contadorRespel[id_div]+1;
	$("#AddRespel"+id_div).before(`@include('solicitud-serv.layaoutsSolSer.NewRespel')`);
	Switch2();
	Switch3();
	Checkboxs();
	$('#FK_SolResRg'+id_div+contadorRespel[id_div]).html($('#FK_SolResRg'+id_div+'0').html());
}
function RemoveRespel(id_div, contador) {
	$("#Repel"+id_div+contador).remove();
}

function RemoveGenerador(id) {
	$("#Generador"+id).remove();
}

</script>
@endsection
