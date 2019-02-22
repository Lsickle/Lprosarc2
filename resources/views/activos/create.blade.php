@extends('layouts.app')
@section('htmlheader_title')
Activos
@endsection
@section('contentheader_title')
Registros de Activos
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
							{{-- <div class="box-header with-border">
								<h3 class="box-title">Formulario de registro</h3>
							</div> --}}
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/activos" method="POST" enctype="multipart/form-data">
								@csrf
								
								{{-- <h1 id="loadingTable">LOADING...</h1> --}}
									{{-- <div class="fingerprint-spinner" id="loadingTable">
										<div class="spinner-ring"><b style="font-size: 1.8rem;">L</b></div>
										<div class="spinner-ring"><b style="font-size: 1.8rem;">o</b></div>
										<div class="spinner-ring"><b style="font-size: 1.8rem;">a</b></div>
										<div class="spinner-ring"><b style="font-size: 1.8rem;">d</b></div>
										<div class="spinner-ring"><b style="font-size: 1.8rem;">i</b></div>
										<div class="spinner-ring"><b style="font-size: 1.8rem;">n</b></div>
										<div class="spinner-ring"><b style="font-size: 1.8rem;">g</b></div>
										<div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
										<div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
									</div> --}}
								{{-- <div class="box-body" hidden onload="renderTable()" id="readyTable">
									<div class="tab-pane" id="addRowWizz">
										<p>Ingrese la informacion necesara completando todos los campos requeridos segun la informacion del activo que desea registrar en cada paso</p>
										<div id="smartwizard">
											<ul>
												<li><a href="#step-1"><b>Paso 1</b><br /><small>Categoria de activos</small></a></li>
												<li><a href="#step-2"><b>Paso 2</b><br /><small>SubCategoria de activos</small></a></li>
												<li><a href="#step-3"><b>paso 3</b><br /><small>Activos</small></a></li>
											</ul>
											<div> --}}
								<div class="col-md-6">
									<label for="activo">Categoria</label>
									<select class="form-control" id="activo" name="categoria" required="true">
										<option>Seleccione...</option>
										@foreach ($SubActivos as $SubActivo)
											<option>{{$SubActivo->CatName}}</option>																
										@endforeach
									</select>
								</div>
							{{-- </div> --}}
								<div class="col-md-6">
									<label for="activo">SubCategoria</label>
									<select class="form-control" id="activo" name="subcategoria" required="true">
										<option>Seleccione...</option>
										@foreach ($SubActivos as $SubActivo)
											<option>{{$SubActivo->SubCatName}}</option>																
										@endforeach
									</select>
								</div>
							{{-- </div> --}}
								<div class="col-md-6">
									<label for="activoinputext1">Nombre del activo</label>
									<input type="text" class="form-control" id="activoinputext1" placeholder="Nombre del activo" name="nombre">
								</div>
								<div class="col-md-6">
									<label for="activo">Forma del activo</label>
									<select class="form-control" id="activo" name="Forma" required="true">
										<option>Seleccione...</option>
										<option>Unidad</option>
										<option>Peso</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="activoinputext2">Cantidad</label>
									<input type="number" class="form-control" id="activoinputext2" placeholder="988888" name="cantidad" max="999.999">
								</div>
								<div class="col-md-6">
									<label for="activoinputext3">Serial de Prosarc</label>
									<input type="text" class="form-control" id="activoinputext3" placeholder="Serial de Prosarc" name="serialPro">
								</div>
								<div class="col-md-6">
									<label for="activoinputext4">Modelo</label>
									<input type="number" class="form-control" id="activoinputext4" placeholder="modelo del activo" name="modelo">
								</div>
								<div class="col-md-6">
									<label for="activoinputext5">Talla</label>
									<input type="text" class="form-control" id="activoinputext5" placeholder="talla de activo" name="talla">
								</div>
								<div class="col-md-6">
									<label for="activoinputext6">Observaciones</label>
									<input type="text" class="form-control" id="activoinputext6" placeholder="Observaciones sobre el activo" name="observacion">
								</div>
								<div class="col-md-6">
									<label for="activoinputext7">Serial Proveedor</label>
									<input type="text" class="form-control" id="activoinputext7" placeholder="Serial del proveedor" name="serialproveedor">
								</div>
												{{-- </div> --}}
											{{-- </div>
										</div>
									</div>
								</div> --}}
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