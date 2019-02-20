@extends('layouts.app')
@section('htmlheader_title')
Orden de Compra
@endsection
@section('contentheader_title')
Orden de Compra
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
										<label for="ordeninputext1">Numero de orden</label>
										<input type="text" class="form-control" id="ordeninputext1" placeholder="0000001" name="numerorden">
									</div>
                                    <div class="col-md-6">
										<label for="program">Estado de cotizacion</label>
										<select class="form-control" id="program" name="cotizacion" required="true">
											<option>Seleccione...</option>
											<option>Autorizada</option>
											<option>Pendiente</option>
											<option>Cotizada</option>
											<option>Rechazada</option>
											<option>Eliminada</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="ordeninputext3">Numero de factura</label>
										<input type="text" class="form-control" id="ordeninputext3" placeholder="0000099" name="factura">
									</div>
									<div class="col-md-6">
										<label for="ordeninputext3">Total de la orden</label>
										<input type="number" class="form-control" id="ordeninputext3" placeholder="988888" name="capacidad" max="999.999.999.999">
									</div>
									<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											 <label for="inputcheck">
												Orden resivida
											 </label>
											  <input id="inputcheck" type="checkbox" name="resivida"><br>
										 </div>
									</div>	
									<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											 <label for="inputcheck1">
												Orden Pagada
											 </label>
											  <input id="inputcheck1" type="checkbox" name="paga">
										 </div>
                                    </div>	
									<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
										<div class="icheck form-group">
											 <label for="inputcheck2">
												Orden Autorizada
											 </label>
											  <input id="inputcheck2" type="checkbox" name="autor">
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