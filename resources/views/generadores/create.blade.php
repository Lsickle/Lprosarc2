@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.Generregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.Generregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos Básicos del Generador</h3>
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
							<form role="form">
								<div class="box-body">
									<div class="form-group">
										<label for="ClienteInputNit">NIT</label>
										<input autofocus="true" type="number" class="form-control" id="ClienteInputNit" placeholder="XXX.XXX.XXX.XXX-Y">
									</div>
									<div class="form-group">
										<label for="ClienteInputRazon">Razon social</label>
										<input type="text" class="form-control" id="ClienteInputRazon" placeholder="PROTECCION SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP.">
									</div>
									<div class="form-group">
										<label for="ClienteInputNombre">Nombre Corto</label>
										<input type="text" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="form-group">
										<label for="ClienteInputCategoria">Categoria</label>
										<select class="form-control" id="ClienteInputCategoria" placeholder="Cliente">
											<option>cliente</option>
											<option>generador</option>
											<option>transportador</option>
											<option>Proveedor</option>
											<option>otro</option>
										</select>
									</div>
									<div class="form-group">
										<label for="ClienteInputTipo">Tipo de empresa</label>
										<select class="form-control" id="ClienteInputTipo" placeholder="biologico">
											<option>biologico</option>
											<option>industrial</option>
											<option>medicamentos</option>
											<option>otros</option>
										</select>
									</div>
									<div class="col-xs-8">
									   <div class="checkbox icheck">
									      <label class="">
									         <div class="icheckbox_square-blue checked" style="position: relative;">
									         	<input type="checkbox" name="remember" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
									         	<ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
									         	</ins>
									         </div>
									         Auditoria permanente
									      </label>
									   </div>
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
