@extends('layouts.app')
@section('htmlheader_title')
Registro
@endsection
@section('contentheader_title')
Solicitudes de residuos
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
							<form role="form" action="/solicitud-residuo" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="col-md-6"> 
										<label for="SolicitudResiduo">Respel</label>										
										<select id="SolicitudResiduo" multiple="multiple" name="SolResRespel" class="form-control" required>
											@foreach ($SolRes as $SolRe)
											<option value="{{$SolRe->ID_Respel}}">{{$SolRe->RespelName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6"> 
										<label for="soliresidinputext">Solicitud de servicio</label>										
										<select id="soliresidinputext" name="SolResSolSer" class="form-control" required>
											<option value="">Seleccione...</option>
											@foreach ($SolRes as $SolRe)
											<option value="{{$SolRe->ID_SolSer}}">({{$SolRe->CliShortname}}) y ({{$SolRe->GenerName}})</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="soliresidinputext1">Kg Enviado</label>
										<input type="number" class="form-control" id="soliresidinputext1" placeholder="46586" name="SolResKgEnviado" max="99999999">
									</div>
									<div class="col-md-6">
										<label for="soliresidinputext2">Kg recibidos</label>
										<input type="number" class="form-control" id="soliresidinputext2" placeholder="787698" name="SolResKgRecibido" max="99999999">
									</div>
									<div class="col-md-6">
										<label for="soliresidinputext3">Kg conciliados</label>
										<input type="number" class="form-control" id="soliresidinputext3" placeholder="789678" name="SolResKgConciliado" max="99999999">
									</div>
									<div class="col-md-6">
										<label for="soliresidinputext4">Kg Tratado</label>
										<input type="number" class="form-control" id="soliresidinputext4" placeholder="100098" name="SolResKgTratado"  max="99999999">
									</div>
								</div>
								<div class="col-md-8">
									<div class="box-footer">
										<button type="submit" class="btn btn-primary">Registrar</button>
									</div>
								</div>
								<!-- /.box-body -->
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