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
										<input required="true" name="CliNit" autofocus="true" type="text" class="form-control" id="ClienteInputNit" placeholder="XXX.XXX.XXX.XXX-X">
									</div>
									<div class="form-group">
										<label for="ClienteInputRazon">Razon social</label>
										<input required="true" name="CliName" type="text" class="form-control" id="ClienteInputRazon" placeholder="PROTECCION SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP.">
									</div>
									<div class="form-group">
										<label for="">Nombre Corto</label>
										<input required="true" name="CliShortname" type="text" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
									</div>
									<div class="form-group">
										<label for="ClienteInputCategoria">Categoria</label>
										<select name="CliCategoria" class="form-control" id="ClienteInputCategoria" placeholder="Cliente">
											<option>cliente</option>
											<option>generador</option>
											<option>transportador</option>
											<option>Proveedor</option>
											<option>otro</option>
										</select>
									</div>
									<div class="form-group">
										<label for="ClienteInputTipo">Tipo de empresa</label>
										<select name="CliType" class="form-control" id="ClienteInputTipo" placeholder="biologico">
											<option>biologico</option>
											<option>industrial</option>
											<option>medicamentos</option>
											<option>otros</option>
										</select>
									</div>
									<div class="col-xs-8">
									   <div class="icheck form-group">
			                                <label for="ClienteInputTipo">
			                                   {{trans('adminlte_lang::message.clientaudit')}}
			                                </label>
			                                 <input id="ClienteInputTipo" style="display:none;" type="checkbox" name="CliAuditable">
			                            </div>
			                            <div >
			                            	<input  hidden="false" type="text" name="CliSlug" value="temp">
			                            </div>
									</div>
									{{-- <div class="form-group">
										<label for="exampleInputFile">Documento requerido</label>
										<input name="" type="file" id="exampleInputFile">
										<p class="help-block">Debe ingresar en formato PDF el archivo solicitado.</p>
									</div> --}}
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
