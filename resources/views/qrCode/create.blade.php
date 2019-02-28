@extends('layouts.app')
@section('htmlheader_title')
Code Qr
@endsection
@section('contentheader_title')
Registros del Qr
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
							<form role="form" action="/activos" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="col-md-6">
									<label for="activoinputext2">Cantidad de estibas del residuo</label>
									<input type="number" class="form-control" id="activoinputext2" placeholder="988888" name="cantidad" max="999999">
								</div>
								<div class="col-md-6">
									<label for="activoinputext4">Direccion del Qr</label>
									<input type="text" class="form-control" id="activoinputext4" placeholder="App\qr" name="direccion">
								</div>
								<div class="container-fluid spark-screen">
									<div class="row">			
										<div class="box-footer" style="float:right; margin-right:5%">
											<button type="submit" class="btn btn-primary">Registrar</button>
										</div>	
									</div>
								</div>
							</form>
						</div>						
					</div>
				</div>
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection