@extends('layouts.app')
@section('htmlheader_title')
Registro
@endsection
@section('contentheader_title')
Solicitudes de servicios
@endsection
@section('NewScript')
	<script>
		var contador = 1;
		function AgregarGenerador(){
			var GenerRes = '<div id="GenerRes"> <div class="col-md-12"> <label for="">Seleccione el generador</label> <select name="Generador['+contador+']" id="Generador" class="form-control"> <option value="1">Seleccione...</option> @foreach($Generadors as $Generador) <option value="{{$Generador->ID_Gener}}">{{$Generador->GenerName}}</option> @endforeach </select><br> </div> <div class="divRes"> <div class="col-md-3"> <a onclick="AgregarRegistro('+contador+')" id="Agregar" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</a><br><br> <label>Residuos</label><hr> <div id="divRespel'+contador+'"></div> </div> <div class="col-md-9 smartwizard"> <ul> <li><a href="#step-1"><b>Descripción</b><br/><small>Datos del residuo</small></a></li> <li><a href="#step-2"><b>Requerimientos</b><br/><small>Requerimientos del residuo</small></a></li> </ul> <div> <div id="step-1"> <div class="col-md-4"> <br><label>Tipo</label><hr> <div id="divTipoCate'+contador+'"></div> </div> <div class="col-md-4"> <br><label>Cantidad</label><hr> <div id="divCateEnviado'+contador+'"></div> </div> <div class="col-md-4"> <br><label>Tratamiento</label><hr> <div id="divTratamiento'+contador+'"></div> </div> </div> <div id="step-2"> <div class="divReq"> <label title="Foto Cargue">F.Ca</label> <label title="Foto Descargue">F.De</label> <label title="Foto Persaje">F.Pe</label> <label title="Foto Reempacado">F.Re</label> <label title="Foto Mezclaje">F.Me</label> <label title="Foto Destrucción">F.Des</label> <label title="Video Cargue">V.Ca</label> <label title="Video Descargue">V.De</label> <label title="Video Persaje">V.Pe</label> <label title="Video Reempacado">V.Re</label> <label title="Video Mezclaje">V.Me</label> <label title="Video Destrucción">V.Des</label> <label title="Devolucion">Dev</label> <label title="Planillas">Pla</label> <label title="Alistamiento">Ali</label> <label title="Capacitación">Cap</label> <label title="Bascula">Bas</label> <label title="Vehiculo con Plataforma">Ve.P</label> <label title="Certificación Especial">Cer</label> </div> <div class="divReq"> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <input class="inputcheck" type="checkbox"/> <hr> </div> <div class="divReq" id="divRequerimientos'+contador+'"></div> </div> </div> </div> </div> </div>';
			$("#divGenerRes").append(GenerRes);
			$(document).ready(function(){
			  $('.smartwizard').smartWizard({
			    theme: 'arrows',
			    keyNavigation:true
			  });
			});
			$(function () {
			  $('.inputcheck').iCheck({
			    checkboxClass: 'icheckbox_square-blue',
			    radioClass: 'iradio_square-blue',
			    increaseArea: '20%' // optional
			  });
			});
			contador= parseInt(contador)+1;
		}
		function AgregarRegistro(id) {
			var Respel, Categoria, CateEnviado, Tratamiento, Requerimientos, GenerRes;

			Respel = '<select name="Respel['+id+'][]" id="Respel"class="form-control"> <option value="1">Seleccione...</option> @foreach($Respels as $Respel) <option value="{{$Respel->ID_Respel}}">{{$Respel->RespelName}}</option> @endforeach </select><hr>';
			Categoria = '<select class="form-control" id="TipoCate" name="TipoCate['+id+'][]"> <option value="Kg">Seleccione...</option> <option value="Kg">Kg</option><option value="Unidad">Unidad</option><option value="CM3">CM3</option></select><hr>';
			CateEnviado = '<input type="text" class="form-control" id="CateEnviado" name="CateEnviado['+id+'][]"><hr>';
			Tratamiento = '<select class="form-control" id="Tratamiento" name="Tratamiento['+id+'][]"> <option value="1">Seleccione...</option> <option value="1">Incineracion</option> <option value="2">Celda</option> <option value="3">Piscina</option></select><hr>';
			Requerimientos = '<input name="FotoCargue['+id+'][]" id="FotoCargue" class="inputcheck" type="checkbox"/> <input name="FotoDescargue['+id+'][]" id="FotoDescargue" class="inputcheck" type="checkbox"/> <input name="FotoPesaje['+id+'][]" id="FotoPesaje" class="inputcheck" type="checkbox"/> <input name="FotoReempacado['+id+'][]" id="FotoReempacado" class="inputcheck" type="checkbox"/> <input name="FotoMezclado['+id+'][]" id="FotoMezclado" class="inputcheck" type="checkbox"/> <input name="FotoDestruccion['+id+'][]" id="FotoDestruccion" class="inputcheck" type="checkbox"/> <input name="VideoCargue['+id+'][]" id="VideoCargue" class="inputcheck" type="checkbox"/> <input name="VideoDescargue['+id+'][]" id="VideoDescargue" class="inputcheck" type="checkbox"/> <input name="VideoPesaje['+id+'][]" id="VideoPesaje" class="inputcheck" type="checkbox"/> <input name="VideoReempacado['+id+'][]" id="VideoReempacado" class="inputcheck" type="checkbox"/> <input name="VideoMezclado['+id+'][]" id="VideoMezclado" class="inputcheck" type="checkbox"/> <input name="VideoDestruccion['+id+'][]" id="VideoDestruccion" class="inputcheck" type="checkbox"/> <input name="Devolucion['+id+'][]" id="Devolucion" class="inputcheck" type="checkbox"/> <input name="Planillas['+id+'][]" id="Planillas" class="inputcheck" type="checkbox"/> <input name="Alistamiento['+id+'][]" id="Alistamiento" class="inputcheck" type="checkbox"/> <input name="Capacitacion['+id+'][]" id="Capacitacion" class="inputcheck" type="checkbox"/> <input name="Bascula['+id+'][]" id="Bascula" class="inputcheck" type="checkbox"/> <input name="Platform['+id+'][]" id="Platform" class="inputcheck" type="checkbox"/> <input name="CertiEspecial['+id+'][]" id="CertiEspecial" class="inputcheck" type="checkbox"/><hr>';
			$("#divRespel"+id).append(Respel);
			$("#divTipoCate"+id).append(Categoria);
			$("#divCateEnviado"+id).append(CateEnviado);
			$("#divTratamiento"+id).append(Tratamiento);
			$("#divRequerimientos"+id).append(Requerimientos);
			$(function () {
			  $('.inputcheck').iCheck({
			    checkboxClass: 'icheckbox_square-blue',
			    radioClass: 'iradio_square-blue',
			    increaseArea: '20%' // optional
			  });
			});
		}
	</script>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos</h3>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- form start -->
							<form role="form" id="form1" action="/solicitud-servicio" method="POST">
								@csrf
								<div class="col-md-6">
									<label for="FK_SolSerCliente">Cliente</label>
									<select id="FK_SolSerCliente" name="FK_SolSerCliente" class="form-control" required>
										<option value="1">Seleccione...</option>
										@foreach ($Clientes as $Cliente)
											<option value="{{$Cliente->ID_Cli}}">{{$Cliente->CliName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="FK_SolSerPersona">Persona</label>
									<select id="FK_SolSerPersona" name="FK_SolSerPersona" class="form-control" required>
										<option value="1">Seleccione...</option>
										@foreach ($Personals as $Personal)
											<option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName.' '.$Personal->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="SolSerTipo">Tipo</label>
									<select class="form-control" name="SolSerTipo" id ="SolSerTipo" required="true">
										<option value="1">Seleccione...</option>
										<option>Interno</option>
										<option>Alquilado</option>
										<option>Externo</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="Fk_SolSerTransportador">Sede</label>
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
								<div id="divGenerRes">
								</div>
								<a onclick="AgregarGenerador()" id="Agregar" class="btn btn-success" style="float: right;"><i class="fas fa-plus"></i> Añadir Generador</a>
								<div class="col-md-12">
									<div class="box-footer">
										<input type="submit" class="btn btn-primary" form="form1" value="Siguiente">
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