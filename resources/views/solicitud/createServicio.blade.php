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
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos</h3>
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
							<!-- form start -->
							<form role="form" action="/solicitud-servicio" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="col-md-6">
										<label for="Tipo">Sede</label>
										<select class="form-control" id="Tipo" name="Fk_SolSerTransportador" required>
											<option value="">Seleccione...</option>
											@foreach ($Servicios as $Servicio)
												<option value="{{$Servicio->ID_Sede}}">{{$Servicio->SedeName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="Tipo">Sede Generador</label>
										<select class="form-control" id="Tipo" name="FK_SolSerGenerSede" required>
											<option value="">Seleccione...</option>
											@foreach ($Servicios as $Servicio)
												<option value="{{$Servicio->ID_GSede}}">{{$Servicio->GSedeName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="estado">Estado</label>
										<select class="form-control" id="estado" name="SolSerStatus" required="true">
											<option value="">Seleccione...</option>
											<option>Aprobada</option>
											<option>Negada</option>
											<option>Pendiente</option>
											<option>Incompleta</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="Tipo">Tipo</label>
										<select class="form-control" id="Tipo" name="SolSerTipo" required="true">
											<option value="">Seleccione...</option>
											<option>Interno</option>
											<option>Alquilado</option>
											<option>Externo</option>
										</select>
									</div>
									
									<div class="col-md-6">
										<label for="soliservicioinputext3">Frecuencia de recolecta</label>
										<input type="text" class="form-control" id="soliservicioinputext3" placeholder="15 días" name="SolSerFrecuencia">
									</div>
									<div class="col-md-6">
										<label for="soliservicioinputext4">Nombre del conductor externo</label>
										<input type="text" class="form-control" id="soliservicioinputext4" placeholder="Juan" name="SolSerConducExter">
									</div>
									
									<div class="col-md-6">
										<label for="soliservicioinputext5">Placa del vehiculo externo</label>
										<input type="text" class="form-control" id="soliservicioinputext5" placeholder="FDR-756" name="SolSerVehicExter">
									</div>
									<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											<label for="inputcheck">
												Auditable
											</label>
											<input id="inputcheck" type="checkbox" name="SolSerAuditable">
										</div>
									</div>
									<div class="col-md-8">
										<div class="box-footer">
											<button type="submit" class="btn btn-primary">Registrar</button>
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