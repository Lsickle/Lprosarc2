@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos Básicos de empresa</h3>
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
								<h3 class="box-title">Quick Example</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/clientes" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="form-group">
										<label for="ClienteInputNit">NIT</label>
										<input minlength="17" maxlength="17" required="true" name="CliNit" autofocus="true" type="text" class="form-control" id="ClienteInputNit" placeholder="XXX.XXX.XXX.XXX-X">
									</div>
									<div class="form-group">
										<label for="ClienteInputRazon">Razon social</label>
										<input required="true" name="CliName" type="text" class="form-control" id="ClienteInputRazon" placeholder="PROTECCION SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP.">
									</div>
									<div class="form-group">
										<label for="">Nombre Corto</label>
										<input required="true" name="CliShortname" type="text" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="col-xs-6">
										<label for="ClienteInputCategoria">Categoria</label>
										<select name="CliCategoria" class="form-control" id="ClienteInputCategoria" placeholder="Cliente">
											<option>cliente</option>
											<option>generador</option>
											<option>transportador</option>
											<option>Proveedor</option>
											<option>otro</option>
										</select>
									</div>
									<div class="col-xs-6">
										<label for="ClienteInputTipo">Tipo de cliente</label>
										<select name="CliType" class="form-control" id="ClienteInputTipo" placeholder="biologico">
											<option>biologico</option>
											<option>industrial</option>
											<option>medicamentos</option>
											<option>otros</option>
										</select>
									</div>
									<div class="col-xs-6">
										<label for="CliAuditable">{{trans('adminlte_lang::message.clientaudit')}}</label>
										<select name="CliAuditable" class="form-control" id="ClienteInputTipo" placeholder="biologico">
											<option value="1">Si</option>
											<option value="0">No</option>
										</select>
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer" style="float:right; margin-right:5%">
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
