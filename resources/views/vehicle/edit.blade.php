@extends('layouts.app')
@section('htmlheader_title', 'Vehiculos')
@section('contentheader_title')
Edicion de vehiculos
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
						@foreach($Vehicles as $Vehicle)
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/vehicle/{{$Vehicle->VehicPlaca}}" method="POST" enctype="multipart/form-data">
								@method('PUT')
								@csrf
								<div class="box-body">
									<div class="col-md-6">
										<label for="VehicPlaca">Numero de placa</label>
										<input type="text" class="form-control" id="VehicPlaca" name="VehicPlaca" required="true" value="{{$Vehicle->VehicPlaca}}">
									</div>
									<div class="col-md-6">
										<label for="VehicTipo">Tipo de vehiculo</label>
										<input type="text" class="form-control" id="VehicTipo" name="VehicTipo" maxlength="16" value="{{$Vehicle->VehicTipo}}">
									</div>
									<div class="col-md-6">
										<label for="VehicCapacidad">Capacidad (Kilos)</label>
										<input type="number" class="form-control" id="VehicCapacidad" name="VehicCapacidad" max="999999" value="{{$Vehicle->VehicCapacidad}}">
									</div>
									<div class="col-md-6">
										<label for="VehicKmActual">Kilometraje actual</label>
										<input type="number" class="form-control" id="VehicKmActual" name="VehicKmActual" required="true" max="999999" value="{{$Vehicle->VehicKmActual}}">
									</div>
									<div class="col-md-6">
											<label for="FK_VehiSede">Sede</label>
											<select class="form-control" id="FK_VehiSede" name="FK_VehiSede" required="true">
												<option value="{{$Vehicle->FK_VehiSede}}">Seleccione...</option>
												@foreach($Sedes as $Sede)
													<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
												@endforeach
											</select>
									</div>
									<div class="col-md-6">
										<label for="VehicInternExtern">Vehiculo</label>
										@if($Vehicle->VehicInternExtern === 1)
											<select class="form-control" id="VehicInternExtern" name="VehicInternExtern" required="true">
												<option value="1">Interno</option>
												<option value="0">Externo</option>
											</select>
										@else
											<select class="form-control" id="VehicInternExtern" name="VehicInternExtern" required="true">
												<option value="0">Externo</option>
												<option value="1">Interno</option>
											</select>
										@endif
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Registrar</button>
								</div>
							</form>
						@endforeach
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