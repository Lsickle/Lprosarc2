











													<td>{{$residuo->ARespelClasf4741}}</td>
													<td>{{$residuo->CliName}}</td>
													<td>{{$residuo->RespelEstado}}</td>
													<td>{{$residuo->RespelHojaSeguridad}}</td>
													<td>{{$residuo->RespelIgrosidad}}</td>
													<td>{{$residuo->RespelName}}</td>
													<td>{{$residuo->RespelSlug}}</td>
													<td>{{$residuo->RespelSlug}}</td>
													<td>{{$residuo->RespelStatus}}</td>
													<td>{{$residuo->RespelTarj}}</td>
													<td>{{$residuo->YRespelClasf4741}}</td>
													<th>Clasificacion 4741 A</th>
													<th>Clasificacion 4741 Y</th>
													<th>Editar</th>
													<th>Estado del residuo</th>
													<th>Estado</th>
													<th>Generado por</th>
													<th>Hoja de Seguridad</th>
													<th>Nombre</th>
													<th>Peligrosidad</th>
													<th>Seleccionar</th>
													<th>Tarj de Emergencia</th>
												</tr>
												</tr>
												<tr>
												<tr>
												@endforeach
												@foreach($residuos as $residuo)
												@include('layouts.partials.spinner')
											</tbody>
											</thead>
											<option>Cm³</option>
											<option>Cm³</option>
											<option>Cm³</option>
											<option>Galon</option>
											<option>Galon</option>
											<option>Galon</option>
											<option>Kg</option>
											<option>Kg</option>
											<option>Kg</option>
											<option>Litros</option>
											<option>Litros</option>
											<option>Litros</option>
											<option>Unidad</option>
						k					<option>Unidad</option>
											<opti
											<thead>
										</select>
										</select>
										</select>
										</table>
										<input class="form-control" id="final1" type="number" min="1" pattern="^[0-9]+" name="TarifaPesofinal1">
										<input class="form-control" id="final2" type="number" min="2" pattern="^[0-9]+" name="TarifaPesofinal2">
										<input class="form-control" id="final3" type="number" min="3" pattern="^[0-9]+" name="TarifaPesofinal3">
										<input class="form-control" id="inicio1" type="number" min="1" pattern="^[0-9]+" name="TarifaPesoinicial1">
										<input class="form-control" id="inicio2" type="number" min="2" pattern="^[0-9]+" name="TarifaPesoinicial2">
										<input class="form-control" id="inicio3" type="number" min="3" pattern="^[0-9]+" name="TarifaPesoinicial3">
										<input class="form-control" id="precio1" type="number" min="1" pattern="^[0-9]+" name="TarifaPrecio1">
										<input class="form-control" id="precio2" type="number" min="2" pattern="^[0-9]+" name="TarifaPrecio2">
										<input class="form-control" id="precio3" type="number" min="3" pattern="^[0-9]+" name="TarifaPrecio3">
										<label for="final1">rango 1 final</label>
										<label for="final2">rango 2 final</label>
										<label for="final3">rango 3 final</label>
										<label for="inicio1">rango 1 inicial</label>
										<label for="inicio2">rango 2 inicial</label>
										<label for="inicio3">rango 3 inicial</label>
										<label for="precio1">rango 1 Precio</label>
										<label for="precio2">rango 2 Precio</label>
										<label for="precio3">rango 3 Precio</label>
										<label for="unidad1">Unidad 1</label>
										<label for="unidad2">Unidad 2</label>
										<label for="unidad3">Unidad 3</label>
										<select class="form-control" id="unidad1" name="TarifaTipounidad1">
										<select class="form-control" id="unidad2" name="TarifaTipounidad2">
										<select class="form-control" id="unidad3" name="TarifaTipounidad3">
										<table id="RespelTable" class="table table-bordered table-striped">
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div> --}}
									<button type="submit" class="btn btn-primary">Registrar</button>
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									<div class="col-md-3">
									{{-- <div>
									{{-- residuos adjuntables a la cotizacion --}}
								<!-- /.box-body -->
								</div>
								</div>
								<div class="box-body">
								<div class="box-footer">
								@csrf
							<!-- /.box-header -->
							<!-- form start -->
							</form>
							<form role="form" action="/tarifas" method="POST">
							<i class="fa fa-minus"></i></button>
							<i class="fa fa-times"></i></button>
						<!-- /.box -->
						<!-- general form elements -->
						</div>
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<div class="box box-primary">
					<!-- /.box-body -->
					<!-- left column -->
					</div>
					</div>
					<div class="box-tools pull-right">
					<div class="col-md-12">
					<h3 class="box-title">Nueva Tarifa</h3>
				<!-- /.box -->
				</div>
				</div>
				<div class="box-header with-border">
				<div class="row">
			<!-- Default box -->
			<!--/.col (right) -->
			</div>
			<div class="box">
		<!-- /.box-body -->
		</div>
		<div class="col-md-16 col-md-offset-0">
	<!-- /.box -->
	</div>
	<div class="row">
</div>
<div class="container-fluid spark-screen">
@endsection
@endsection
@endsection
@extends('layouts.app')
@section('contentheader_title')
@section('htmlheader_title')
@section('main-content')
Nueva Tarifa
Nueva Tarifa