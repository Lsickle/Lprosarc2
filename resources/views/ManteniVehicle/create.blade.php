@extends('layouts.app')
@section('htmlheader_title', 'Mantenimiento')
@section('contentheader_title')
Registro de Mantenimientos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/vehicle-mantenimiento" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="col-md-6">
										<label for="FK_VehMan">Vehiculo</label>
										<select name="FK_VehMan" id="FK_VehMan" class="form-control">
											<option value="1">Seleccione...</option>
											@foreach($Vehicles as $Vehicle)
												<option value="{{$Vehicle->ID_Vehic}}">{{$Vehicle->VehicPlaca}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="MvKm">Kilometraje</label>
										<input type="number" required="true" class="form-control" id="MvKm" placeholder="999999" name="MvKm" max="999999">
									</div>
									<div class="col-md-6">
										<label for="HoraMavInicio">Fecha Inicio</label>
										<input type="text" required="true" class="form-control" id="HoraMavInicio" name="HoraMavInicio">
									</div>
									<div class="col-md-6">
										<label for="HoraMavFin">Fecha Fin</label>
										<input type="text" required="true" class="form-control" id="HoraMavFin" name="HoraMavFin">
									</div>
									<div class="col-md-6">
										<label for="MvType">Tipo de mantenimiento</label>
										<select name="MvType" id="MvType" class="form-control">
											<option value="Aceite">Seleccione...</option>
											<option value="Aceite">Aceite</option>
											<option value="Tecnomecanica">Tecnomecanica</option>
											<option value="Tanqueo">Tanqueo</option>
											<option value="Otro">Otro</option>
										</select>
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