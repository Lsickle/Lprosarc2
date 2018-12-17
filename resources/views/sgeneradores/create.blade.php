@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.SGenerregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.SGenerregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos de la sede del generador</h3>
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
							<form role="form">
								<div class="box-body">
									<div class="form-group">
										<label for="ClienteInputRazon">Nombre</label>
										<input type="text" class="form-control" id="ClienteInputRazon" placeholder="PROTECCION SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP.">
									</div>
									<div class="form-group">
										<label for="ClienteInputNombre">Direccion</label>
										<input type="text" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="form-group">
										<label for="ClienteInputNombre">Email</label>
										<input type="Email" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="col-md-6">
										<label for="ClienteInputNombre">Telefono 1</label>
										<input type="tel" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="col-md-6">
										<label for="ClienteInputNombre">Extension</label>
										<input type="number" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="col-md-6">
										<label for="ClienteInputNombre">Telefono 2</label>
										<input type="tel" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="col-md-6">
										<label for="ClienteInputNombre">Extension</label>
										<input type="number" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="col-md-6">
										<label for="ClienteInputNombre">Celular</label>
										<input type="text" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="col-md-6">
										<label for="ClienteInputTipo">Municipio</label>
										<select class="form-control" id="ClienteInputTipo" placeholder="biologico">
											<option>biologico</option>
											<option>industrial</option>
											<option>medicamentos</option>
											<option>otros</option>
										</select>
									</div>

									<div class="form-group">
										<label for="exampleInputFile">Documento requerido</label>
										<input type="file" id="exampleInputFile">
										<p class="help-block">Debe ingresar en formato PDF el archivo solicitado.</p>
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
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
