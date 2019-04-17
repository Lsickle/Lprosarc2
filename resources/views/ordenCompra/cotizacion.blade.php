@extends('layouts.app')
@section('htmlheader_title')
Cotización
@endsection
@section('contentheader_title')
Cotización
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
							<form role="form" action="/ordenCompra" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									
									<div class="col-md-6">
										<label for="cotizacioninputext1">Numero de cotización</label>
										<input type="text" class="form-control" id="cotizacioninputext1" placeholder="0000010" name="numcotizacion">
									</div>
                                    <div class="col-md-6">
										<label for="program">Estado de cotización</label>
										<select class="form-control" id="program" name="cotizacion" required="true">
											<option>Seleccione...</option>
											<option>Aprobada</option>
											<option>Aprobada Parcial</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="cotizacioninputext3">Subtotal de cotización</label>
										<input type="number" class="form-control" id="cotizacioninputext3" placeholder="988888" name="subtotal" max="999.999.999.999">
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