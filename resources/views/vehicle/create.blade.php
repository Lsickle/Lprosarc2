@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.sclientregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.sclientregistertittle') }}
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
							<div class="box-header with-border">
								<h3 class="box-title">complete todos los campos a continuacion</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/sclientes" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">

									<div class="col-md-6">
										<label for="clientname">Cliente</label>
										<select class="form-control" id="clientname" placeholder="Funza" name="clientename" required="true">
											@foreach($Clientes as $cliente)
												<option value="{{$cliente->ID_Cli}}">{{$cliente->CliShortname}}</option>
											@endforeach()
										</select>
									</div>
									
									<div class="col-md-6">
										<label for="vehicinputext1">Numero de placa</label>
										<input type="number" class="form-control" id="vehicinputext1" placeholder="1555" name="SedeExt1" max="9999">
									</div>
									<div class="col-md-6">
										<label for="vehicinputext2">Tipo de vehiculo</label>
										<input type="tel" class="form-control" id="vehicinputext2" placeholder="(031)-412 3141" name="SedePhone2" maxlength="16">
									</div>
									<div class="col-md-6">
										<label for="vehicinputext3">Capacidad</label>
										<input type="number" class="form-control" id="vehicinputext3" placeholder="1555" name="SedeExt2" max="9999" >
									</div>
									<div class="form-group" style="margin-top: 1em">
										<label for="vehicinputext4">Kilometraje actual</label>
										<input type="email" class="form-control" id="vehicinputext4" placeholder="Sistemas@Prosarc.com" name="SedeEmail" required="true">
									</div>
									
									<div class="icheck form-group">
										<label for="GenerInputTipo">
											{{trans('adminlte_lang::message.clientaudit')}}
										</label>
											<input id="inputcheck" type="checkbox" name="GenerAuditable">
									</div>
									
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Registrar</button>
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