@extends('layouts.app')
@section('htmlheader_title')
Tratamiento
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
    Registro del Tratamiento
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
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
							<form role="form" action="/tratamiento" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									
									<div class="col-md-6">
										<label for="tratamientoinputext1">Nombre</label>
										<input type="text" class="form-control" id="tratamientoinputext1" placeholder="Incineración" name="nombre">
									</div>
									<div class="col-md-6">
										<label for="tratamientoinputext2">Proveedor</label>
										<input type="text" class="form-control" id="tratamientoinputext2" placeholder="Bayer" name="provehedor">
									</div>
									<div class="col-md-6">
										<label for="tratamientoinputext3">Tipo de residuo</label>
										<input type="text" class="form-control" id="tratamientoinputext3" placeholder="Medicamentos" name="tipo">
									</div>
									<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											 <label for="inputcheck">
												Manejo interno
											 </label>
											  <input id="inputcheck" type="checkbox" name="manejo">
										 </div>
									</div>
								</div>
								<div>
									<div class="box-footer">
										<button type="submit" class="btn btn-success">Registrar</button>
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