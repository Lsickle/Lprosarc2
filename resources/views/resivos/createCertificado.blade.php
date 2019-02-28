@extends('layouts.app')
@section('htmlheader_title')
Create
@endsection
@section('contentheader_title')
Certificado
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
							<form role="form" action="/resivos" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									
									<div class="col-md-6">
										<label for="programnputext0">Numero del Certificado</label>
										<input type="number" class="form-control" id="programnputext0" placeholder="000001" name="numero" max="999999">
									</div>
									<div class="col-md-6">
										<label for="programnputext1">Nombre del Atributo</label>
										<input type="text" class="form-control" id="programnputext1" name="nombre" placeholder="Nombre del Atributo">
									</div>
									<div class="col-md-6">
										<label for="programnputext3">Valor del Atributo</label>
										<input type="number" class="form-control" id="programnputext3" name="valor" placeholder="734733" max="999999999">
									</div>
									<div class="col-md-6">
										<label for="programnputext4">Observaciones</label>
										<input type="text" class="form-control" id="programnputext4"  name="Observacion" placeholder="Observaciones">
                                    </div>
									<div class="col-md-6">
										<label for="programnputext4">Direccion PDF</label>
										<input type="text" class="form-control" id="programnputext4"  name="Salida">
                                    </div>
                                    
                                    <div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											 <label for="inputcheck">
												Aprobacion Jefe de Operaciones
											 </label>
											  <input id="inputcheck" type="checkbox" name="create">
										 </div>
                                    </div>
                                    
                                    <div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											 <label for="inputcheck1">
												Aprobacion Jefe de Logistica
											 </label>
											  <input id="inputcheck1" type="checkbox" name="create">
										 </div>
                                    </div>
                                    
                                    <div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											 <label for="inputcheck2">
												Aprobacion Jefe de la Planta
											 </label>
											  <input id="inputcheck2" type="checkbox" name="create">
										 </div>
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