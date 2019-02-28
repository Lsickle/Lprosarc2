@extends('layouts.app')
@section('htmlheader_title')
Horario
@endsection
@section('contentheader_title')
Asignar Horario
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
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/horario" method="POST" enctype="multipart/form-data">
								@csrf
                                <div class="col-md-6">
                                    <label for="horario">Asignar Horario A</label>
                                    <select class="form-control" id="horario" name="asignar" required="true">
                                        <option>Seleccione...</option>
                                        @foreach ($Horarios as $Horario)
                                            <option value="{{$Horario->ID_Pers}}">{{$Horario->PersFirstName}}</option>  
                                        @endforeach
                                    </select>
                                </div>
								<div class="col-md-6">
									<label for="horarioinputext1">Fecha del horario</label>
									<input type="date" class="form-control" id="horarioinputext1" name="fecha">
								</div>
								<div class="col-md-6">
                                    <label for="horario1">Tipo</label>
									<select class="form-control" id="horario1" name="tipo" required="true">
                                        <option>Seleccione...</option>
										<option>Trabaja</option>
										<option>Descansa</option>
										<option>Capacitacion</option>
										<option>Examen</option>
										<option>Otro</option>
									</select>
								</div>
								<div class="col-md-6">
                                    <label for="horarioinputext2">¿Cual?</label>
									<input type="text" class="form-control" id="horarioinputext2" placeholder="Que otro tipo esta realizando" name="cual">
								</div>
                                <div class="col-md-6">
                                    <label for="horario2">Feriado</label>
                                    <select class="form-control" id="horario2" name="feriado" required="true">
                                        <option>Seleccione...</option>
                                        <option value="0">Festivo</option>
                                        <option value="1">Domingo</option>
                                    </select>
                                </div>
								<div class="col-md-6">
									<label for="horarioinputext3">Entarda</label>
									<input type="text" class="form-control" id="horarioinputext3" placeholder="Serial de Prosarc" name="entrada">
								</div>
								<div class="col-md-6">
									<label for="horarioinputext4">Salida</label>
									<input type="text" class="form-control" id="horarioinputext4" placeholder="modelo del activo" name="modesalidao">
								</div>
								<div class="col-md-6">
									<label for="horarioinputext5">Inicio del permiso</label>
									<input type="text" class="form-control" id="horarioinputext5" placeholder="talla de activo" name="permisoIni">
								</div>
								<div class="col-md-6">
									<label for="horarioinputext6">Final del permiso</label>
									<input type="text" class="form-control" id="horarioinputext6" placeholder="Observaciones" name="permisoFin">
								</div>
								<div class="container-fluid spark-screen">
									<div class="row">			
                                        <div class="box-footer" style="float:right; margin-right:5%"> 
                                                <button type="submit" class="btn btn-primary">Registrar</button>
										</div>	
									</div>
                                </div>
                                
							</form>
						</div>						
					</div>
				</div>
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection