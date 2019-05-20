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
									<select id="FK_SolSerPersona" name="FK_SolSerPersona" class="form-control" required>
										<option value="">Seleccione...</option>
										@foreach ($Personals as $Personal)
										<option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName.' '.$Personal->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="SolSerTipo">Tipo de transportador</label>
									<select class="form-control" name="SolSerTipo" id="SolSerTipo" required="true">
										<option value="">Seleccione...</option>
										<option onclick="TransportadorProsarc()" value="1">Prosarc S.A.</option>
										<option onclick="TransportadorExtr()">Propio</option>
									</select>
								</div>
								<div id="transportador" class="col-md-6" hidden="true">
									<label for="Fk_SolSerTransportador">Transportador</label>
									<select class="form-control" id="Fk_SolSerTransportador" name="Fk_SolSerTransportador" required>
										<option value="">Seleccione...</option>
										<option onclick="TransportadorCliente()" value="3">Nombre del cliente</option>
										<option onclick="OtraTransportadora()">Otro</option>
									</select>
								</div>
								<div id="nametransportadora" class="col-md-6" hidden="true">
									<label for="SolSerConducExter">Nombre de la transaportadora</label>
									<input type="text" class="form-control" id="SolSerConducExter" placeholder="Juan" name="SolSerConducExter">
								</div>
								<div id="nittransportadora" class="col-md-6" hidden="true">
									<label for="SolSerVehicExter">Nit de la transportadora</label>
									<input type="text" class="form-control" id="SolSerVehicExter" placeholder="FDR-756" name="SolSerVehicExter" />
								</div>
								<div id="addresstransportadora" class="col-md-6" hidden="true">
									<label for="SolSerVehicExter">Dirección de la transportadora</label>
									<input type="text" class="form-control" id="SolSerVehicExter" placeholder="FDR-756" name="SolSerVehicExter" />
								</div>
								<div id="citytransportadora" class="col-md-6" hidden="true">
									<label for="SolSerVehicExter">Ciudad de la transportadora</label>
									<input type="text" class="form-control" id="SolSerVehicExter" placeholder="FDR-756" name="SolSerVehicExter" />
								</div>
								<div id="Conductor" class="col-md-6" hidden="true">
									<label>Conductor</label>
									<input type="text" class="form-control">
								</div>
								<div id="Vehiculo" class="col-md-6" hidden="true">
									<label>Placa del Vehiculo</label>
									<input type="text" class="form-control">
								</div>
								<div id="typeaditable" class="col-md-6">
									<label for="SolResAuditoriaTipo">Auditable</label>
									<select class="form-control" id="SolResAuditoriaTipo" name="SolResAuditoriaTipo" required>
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
												<label>Ticket de Bascula</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" name="ReqBascula">
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Personal con Capacitacion</b>" data-content="<p style='width: 50%'> Se requiere que el Conductor y/o Ayudante de Prosarc S.A. ESP haya realizado capacitación especifica, la cual es dictada por el Cliente</p>">
												<label>Personal con Capacitacion</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" name="ReqCapacitacion" />
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Personal Adicional</b>" data-content="<p style='width: 50%'> Se requiere el envio de una persona adicional, aparte del conductor y el ayudante, para el cargue de vehiculos de Prosarc S.A.</p>">
												<label>Personal Adicional</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" name="ReqMasPerson" />
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Vehiculo con Plataforma</b>" data-content="<p style='width: 50%'> Se requiere que Prosarc S.A. ESP envie vehiculo con plataforma para el cargue de los residuos en las instalaciones del Cliente/Generador</p>">
												<label>Vehiculo con Plataforma</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" name="ReqPlatform" />
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Devolución de elementos</b>" data-content="<p style='width: 50%'> Se requiere devolucion de elementos que son enviados a planta con los residuos a Tratar... por ejemplo: Canecas</p>">
												<label>Devolución de elementos</label>
												<div style="width: 100%; height: 34px;">
													<input type="checkbox" class="testswitch" name="ReqDevolucion" />
												</div>
											</label>
										</div>
										<div class="col-md-4" style="text-align: center;">
											<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Nombre de elementos</b>" data-content="<p style='width: 50%'> Se debe especificar el nombre de los elementos que Se requiere sean devueltos al Cliente/Generador... solo aplica si se selecciono el requerimiento: <b><i>Devolución de elentos</i></b></p>">
												<label>Nombre elementos</label>
												<input type="text" maxlength="64" class="form-control" name="ReqDevolucionTipo" />
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
											<option value="">Seleccione...</option>
											@foreach($SGeneradors as $SGenerador)
											<option value="{{$SGenerador->ID_GSede}}">{{$SGenerador->GSedeName}}</option>
											@endforeach
										</select>
										<br>
									</div>
									<div id="DivRepel0" class="col-md-12 collapse in">
										<div id="Repel0" class="col-md-12 box box-warning">
											<label>Residuo</label>
											<button type="button" class="btn btn-box-tool" style="color: #f39c12;" data-toggle="collapse" data-target="#RespelData0" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
											<select name="SGenerador[0]" id="SGenerador" class="form-control">
												<option value="">Seleccione...</option>
											</select>
											<br>
											<div id="RespelData0" class="collapse in">
												<div class="col-md-6">
													<label>Unidades de Medida</label>
													<select name="" id="" class="form-control">
														<option value="">Seleccione...</option>
													</select>
												</div>
												<div class="col-md-6">
													<label>Cantidad</label>
													<input type="text" class="form-control">
												</div>
												<div class="col-md-6">
													<label>Cantidad (Kg)</label>
													<input type="text" class="form-control">
												</div>
												<div class="col-md-6">
													<label>Embalaje</label>
													<select name="" id="" class="form-control">
														<option value="">Seleccione...</option>
													</select>
												</div>
												<div class="col-md-16" style="text-align: center;">
													<div class="col-md-12">
														<label>Dimensiones del Residuo</label>
													</div>
													<div class="col-md-4">
														<label>Alto</label>
														<input type="number" class="form-control">
													</div>
													<div class="col-md-4">
														<label>Ancho</label>
														<input type="number" class="form-control">
													</div>
													<div class="col-md-4">
														<label>Profundo</label>
														<input type="number" class="form-control">
													</div>
												</div>
												<div class="col-md-12" style="text-align: center;">
													<div class="col-md-12">
														<label>Requerimientos</label>
													</div>
													<div class="col-md-6" style="border: 2px dashed #00c0ef">
														<div class="col-md-12">
															<label>Fotos</label>
														</div>
														<div class="col-md-6">
															<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
																<label>Descargue/Pesaje</label>
																<div style="width: 100%; height: 34px;">
																	<input type="checkbox" class="fotoswitch" name="ReqFotoDescargue"/>
																</div>
															</label>
														</div>
														<div class="col-md-6">
															<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
																<label>Tratamiento</label>
																<div style="width: 100%; height: 34px;">
																	<input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion"/>
																</div>
															</label>
														</div>
													</div>
													<div class="col-md-6" style="border: 2px dashed #00c0ef">
														<div class="col-md-12">
															<label>Videos</label>
														</div>
														<div class="col-md-6">
															<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p style='width: 50%'> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
																<label>Descargue/Pesaje</label>
																<div style="width: 100%; height: 34px;">
																	<input type="checkbox" class="videoswitch" name="ReqVideoDescargue"/>
																</div>
															</label>
														</div>
														<div class="col-md-6">
															<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
																<label>Tratamiento</label>
																<div style="width: 100%; height: 34px;">
																	<input type="checkbox" class="videoswitch" name="ReqVideoDestruccion"/>
																</div>
															</label>
														</div>
													</div>
												</div>
												<br>
											</div>
										</div>
										<div id="AddRespel0" class="col-md-16 col-md-offset-5 col-xs-offset-5">
											<a onclick="AgregarRegistro(0)" id="Agregar" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</a><br><br>
										</div>
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
}

function TransportadorExtr() {
	$("#transportador").attr('hidden', false);
	$("#Conductor").attr('hidden', false);
	$("#Vehiculo").attr('hidden', false);
	$("#typeaditable").removeClass('col-md-6');
	$("#typeaditable").addClass('col-md-12');
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
var contadorRespel = 1;
var contadorGenerador = 1;

function AgregarGenerador() {
	$("#AddGenerador").before(`@include('solicitud-serv.layaoutsSolSer.NewGener')`);
	contadorGenerador = contadorGenerador + 1;
	contadorRespel = contadorRespel + 1;
}

function AgregarRegistro(id) {
	$("#AddRespel" + id).before(`@include('solicitud-serv.layaoutsSolSer.NewRespel')`);
	contadorRespel = contadorRespel + 1;
}

function RemoveRespel(id) {
	$("#Repel" + id).remove();
}

function RemoveGenerador(id) {
	$("#Generador" + id).remove();
}

</script>
@endsection
