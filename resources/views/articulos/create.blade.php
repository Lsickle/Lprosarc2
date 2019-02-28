@extends('layouts.app')
@section('htmlheader_title')
Articulos
@endsection
@section('contentheader_title')
Registros de Articulos por Proveedor
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
							<form role="form" action="/articulos" method="POST" enctype="multipart/form-data">
								@csrf
							{{-- </div> --}}
                                <div class="col-md-6">
                                    <label for="activo">Forma del articulo</label>
                                    <select class="form-control" id="activo" name="forma" required="true">
                                        <option>Seleccione...</option>
                                        <option value="0">Unidad</option>
                                        <option value="1">Peso</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="activoinputext1">Cantidad</label>
                                    <input type="number" class="form-control" id="activoinputext1" placeholder="988888" name="cantidad" max="999999">
                                </div>
                                <div class="col-md-6">
                                    <label for="activoinputext2">Precio</label>
                                    <input type="text" class="form-control" id="activoinputext2" placeholder="150000" name="precio">
                                </div>
                                <div class="col-md-6">
                                    <label for="activoinputext3">Articulo costo por unidad </label>
                                    <input type="number" class="form-control" id="activoinputext3" placeholder="12345" name="unidad" max="9999999">
                                </div>
								<div class="col-md-6">
									<label for="activoinputext4">Cantidad Minima de compra</label>
									<input type="number" class="form-control" id="activoinputext4" placeholder="23456" name="cantidadmin" max="9999999">
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
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection