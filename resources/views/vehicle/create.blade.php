@extends('layouts.app')
@section('htmlheader_title')
{{trans('adminlte_lang::message.vehicletitle')}}
@endsection
@section('contentheader_title')
{{trans('adminlte_lang::message.vehicletitle')}}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{trans('adminlte_lang::message.vehiclecreate')}}</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box box-info">
					<form role="form" action="/vehicle" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@csrf
						<div class="box-body">
							<div class="form-group col-md-12">
									<label for="FK_VehiSede">Sede</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="FK_VehiSede" name="FK_VehiSede" required="true">
										<option value="">Seleccione...</option>
										@foreach($Sedes as $Sede)
											<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
										@endforeach
									</select>
							</div>
							<div class="form-group col-md-6">
								<label for="VehicPlaca">Número de placa</label>
								<small class="help-block with-errors">*</small>
								<input type="text" class="form-control placa" id="VehicPlaca" name="VehicPlaca" data-minlength="7" required="true">
							</div>
							<div class="form-group col-md-6">
								<label for="VehicTipo">Tipo de vehiculo</label>
								<small class="help-block with-errors">*</small>
								<input type="text" class="form-control" id="VehicTipo" name="VehicTipo" required="true" maxlength="64">
							</div>
							<div class="form-group col-md-6">
								<label for="VehicCapacidad">Capacidad (kg)</label>
								<small class="help-block with-errors">*</small>
								<input type="number" class="form-control" id="VehicCapacidad" name="VehicCapacidad" required="true" max="999999">
							</div>
							<div class="form-group col-md-6">
								<label for="VehicKmActual">Kilometraje actual</label>
								<small class="help-block with-errors">*</small>
								<input type="number" class="form-control" id="VehicKmActual" name="VehicKmActual" required="true" max="999999">
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-success pull-right">{{trans('adminlte_lang::message.register')}}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection