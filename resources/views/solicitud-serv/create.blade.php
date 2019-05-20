@extends('layouts.app')
@section('htmlheader_title')
Registro
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
					<h3 class="box-title">Datos</h3>
				</div>
				<div class="box box-info">
					<form role="form" id="form1" action="/solicitud-servicio" method="POST">
						@csrf
						<div class="box-body">
							<div class="col-md-12 col-xs-12">
								<div class="col-md-12">
									<label for="FK_SolSerCliente">Cliente</label>
									<select id="FK_SolSerCliente" name="FK_SolSerCliente" class="form-control" required>
										<option value="1">Seleccione...</option>
										@foreach ($Clientes as $Cliente)
										<option value="{{$Cliente->ID_Cli}}">{{$Cliente->CliName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="FK_SolSerPersona">Persona de Contacto</label>
									<select id="FK_SolSerPersona" name="FK_SolSerPersona" class="form-control" required>
										<option value="1">Seleccione...</option>
										@foreach ($Personals as $Personal)
										<option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName.' '.$Personal->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="SolSerTipo">Tipo de transportador</label>
									<select class="form-control" name="SolSerTipo" id ="SolSerTipo" required="true">
										<option value="1">Seleccione...</option>
										<option>Interno</option>
										<option>Alquilado</option>
										<option>Externo</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="Fk_SolSerTransportador">Transportador</label>
									<select class="form-control" id="Fk_SolSerTransportador" name="Fk_SolSerTransportador" required>
										<option value="1">Seleccione...</option>
										@foreach ($Sedes as $Sede)
										<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="SolSerConducExter">Nombre del conductor externo</label>
									<input type="text" class="form-control" id="SolSerConducExter" placeholder="Juan" name="SolSerConducExter">
								</div>
								<div class="col-md-6">
									<label for="SolSerVehicExter">Placa del vehiculo externo</label>
									<input type="text" class="form-control" id="SolSerVehicExter" placeholder="FDR-756" name="SolSerVehicExter">
								</div>
								<div class="col-md-6" style="padding-top: 2%; text-align: center;">
									<label for="SolSerAuditable">Auditable</label>
									<input class="AllowUncheck" type="radio" name="SolSerAuditable"/>
								</div>
								<div class="col-md-6">
									<label for="SolResAuditoriaTipo">Aditable Tipo</label>
									<select class="form-control" id="SolResAuditoriaTipo" name="SolResAuditoriaTipo" required>
										<option value="Presencial">Presencial</option>
										<option value="Virtual">Virtual</option>
									</select>
								</div>
								<div class="col-md-6" style="padding-top: 2%; text-align: center;">
									<label for="inputcheck">¿Usaria de nuevo la solicitud?</label>
									<input class="CalendarSwitch" type="radio" name="ReqAuditoriaTipo"/>
								</div>
								<div class="col-md-6">
									<label for="SolSerFrecuencia">Frecuencia de recolecta</label>
									<input type="text" class="form-control" id="SolSerFrecuencia" placeholder="15 días" name="SolSerFrecuencia"><br><br>
								</div>
								<div class="col-md-12" style="text-align: center;">
									<b>RESIDUOS A ENTREGAR</b>
								</div>
							</div>
							<div class="col-md-12">
								<div id="Generador0" class="box box-success col-md-16">
									<div class="col-md-12">
										<label for="">Seleccione el generador</label>
										<button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#DivRepel0" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
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
											<button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#RespelData0" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
											<select name="SGenerador[0]" id="SGenerador" class="form-control">
												<option value="">Seleccione...</option>
											</select>
											<br>
											<div id="RespelData0" class="collapse">
												<div class="col-md-6">
													<label>Unidades de Medida</label>
													<input type="text" class="form-control">
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
													<label>Tratamiento</label>
													<input type="text" class="form-control">
												</div>
												<div class="col-md-12">
													<label>Requerimientos</label>
													<input type="text" class="form-control">
												</div>
												<br>
											</div>
										</div>
										<div id="AddRespel0" class="col-md-16 col-md-offset-5">
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
		var contadorRespel = 1;
		var contadorGenerador = 1;
		function AgregarGenerador(){
			$("#AddGenerador").before(`@include('solicitud-serv.layaoutsSolSer.NewGener')`);
			contadorGenerador = contadorGenerador+1;
			contadorRespel = contadorRespel+1;
		}
		function AgregarRegistro(id) {
			$("#AddRespel"+id).before(`@include('solicitud-serv.layaoutsSolSer.NewRespel')`);
			contadorRespel = contadorRespel+1;
		}
		function RemoveRespel(id){
			$("#Repel"+id).remove();
		}
		function RemoveGenerador(id){
			$("#Generador"+id).remove();
		}
	</script>
@endsection
