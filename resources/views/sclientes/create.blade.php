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
					<h3 class="box-title">Datos de la sede de la empresa</h3>
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
										<label for="sedeinputname">SedeName</label>
										<input type="text" class="form-control" id="sedeinputname" placeholder="Prosarc" name="SedeName" required="true">
									</div>
									<div class="col-md-6">
										<label for="sedeinputcelular">SedeCelular</label>
										<input type="text" class="form-control" id="sedeinputcelular" placeholder="3014145321" name="SedeCelular">
									</div>
									<div class="col-md-6">
										<label for="sedeinputcliente">cliente</label>
										<select class="form-control" id="sedeinputcliente" placeholder="cliente" name="cliente" required="true">
										<option>cliente 1</option>
										<option>cliente 2</option>
										<option>cliente 3</option>
										<option>cliente 4</option>
										</select>
									</div>
									<div class="form-group" style="margin-top: 9rem">
										<label for="sedeinputaddress">SedeAddress</label>
										<input type="text" class="form-control" id="sedeinputaddress" placeholder="cll 23 #11c-03" name="SedeAddress" required="true">
									</div>
									<div class="form-group">
										<label for="sedeinputphone1">SedePhone1</label>
										<input type="tel" class="form-control" id="sedeinputphone1" placeholder="031-4123141" name="SedePhone1" maxlength="16">
									</div>
									<div class="col-md-6">
										<label for="sedeinputext1">SedeExt1</label>
										<input type="number" class="form-control" id="sedeinputext1" placeholder="1555" name="SedeExt1" maxlength="4">
									</div>
									<div class="col-md-6">
										<label for="sedeinputphone2">SedePhone2</label>
										<input type="tel" class="form-control" id="sedeinputphone2" placeholder="031-4123141" name="SedePhone2" maxlength="16">
									</div>
									<div class="col-md-6">
										<label for="sedeinputext2">SedeExt2</label>
										<input type="number" class="form-control" id="sedeinputext2" placeholder="1555" name="SedeExt2" maxlength="4">
									</div>
									<div class="col-md-6">
										<label for="sedeinputemail">SedeEmail</label>
										<input type="email" class="form-control" id="sedeinputemail" placeholder="Sistemas@Prosarc.com" name="SedeEmail" required="true">
									</div>
									

									{{-- <div class="form-group">
										<label for="exampleInputFile">Documento requerido</label>
										<input type="file" id="exampleInputFile">
										<p class="help-block">Debe ingresar en formato PDF el archivo solicitado.</p>
									</div> --}}
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
