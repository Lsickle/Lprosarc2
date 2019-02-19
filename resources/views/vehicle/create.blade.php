@extends('layouts.app')
@section('htmlheader_title')
Registro
@endsection
@section('contentheader_title')
{{-- {{ trans('adminlte_lang::message.sclientregistertittle') }} --}}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos de los vehiculos</h3>
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
							<form role="form" action="/vehicle" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">

									{{-- <div class="col-md-6">
										<label for="clientname">Cliente</label>
										<select class="form-control" id="clientname" placeholder="Funza" name="clientename" required="true">
											@foreach($Clientes as $cliente)
												<option value="{{$cliente->ID_Cli}}">{{$cliente->CliShortname}}</option>
											@endforeach()
										</select>
									</div> --}}
									
									<div class="col-md-6">
										<label for="vehicinputext1">Numero de placa</label>
										<input type="text" class="form-control" id="vehicinputext1" placeholder="BWK-456" name="placa">
									</div>
									<div class="col-md-6">
										<label for="vehicinputext2">Tipo de vehiculo</label>
										<input type="text" class="form-control" id="vehicinputext2" placeholder="Camión" name="tipo" maxlength="16">
									</div>
									<div class="col-md-6">
										<label for="vehicinputext3">Capacidad (Toneladas)</label>
										<input type="number" class="form-control" id="vehicinputext3" placeholder="155545" name="capacidad" max="999999">
									</div>
									<div class="col-md-6">
										<label for="vehicinputext4">Kilometraje actual</label>
										<input type="number" class="form-control" id="vehicinputext4" placeholder="100098" name="kmactual" required="true" max="999999">
									</div>
									<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											 <label for="GenerInputTipo">
												Interno
											 </label>
											  <input id="inputcheck" type="checkbox" name="GenerAuditable">
										 </div>
										 <div >
									
									
									
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Registrar</button>
								</div>
							</form>
						</div>
						<!-- /.box -->
					</div>
					</div>
					</div>
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