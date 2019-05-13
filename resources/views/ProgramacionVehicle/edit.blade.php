@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.progvehicedit') }}</h3>
					<a href="/vehicle-programacion/create" class="btn btn-primary pull-right"><i class="fas fa-calendar-alt"></i> {{ trans('adminlte_lang::message.progvehiccreatetext') }}</a>
				</div>
				<div class="box box-info">
					<form role="form" action="/vehicle-programacion/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@csrf
						@method('PUT')
						<div class="box-body">
							<div class="form-group col-md-6">
								<label for="FK_ProgServi">{{ trans('adminlte_lang::message.progvehicservi') }}</label>
								<select name="FK_ProgServi" id="FK_ProgServi" class="form-control select">
									@foreach($servicios as $servicio)
										<option value="{{$servicio->ID_SolSer}}" {{$servicio->ID_SolSer == $programacion->FK_ProgServi ? 'selected' : ''}}>{{$servicio->ID_SolSer}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
								<input type="text" class="form-control fechas" id="ProgVehFecha" name="ProgVehFecha" value="{{$programacion->ProgVehFecha}}">
							</div>
							<div class="form-group col-md-6">
								<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
								<input type="text" class="form-control horas" id="ProgVehSalida"  name="ProgVehSalida" value="{{date('h:i A', strtotime($programacion->ProgVehSalida))}}">
							</div>
							<div class="form-group col-md-6">
								<label for="ProgVehEntrada">{{ trans('adminlte_lang::message.progvehicllegada') }}</label>
								<input type="text" class="form-control horas" id="ProgVehEntrada" name="ProgVehEntrada" value="{{$programacion->ProgVehEntrada <> null ? date('h:i A', strtotime($programacion->ProgVehEntrada)) : ''}}">
							</div>
							<div class="form-group col-md-6">
								<label for="FK_ProgVehiculo">{{ trans('adminlte_lang::message.progvehicvehic') }}</label>
								<select name="FK_ProgVehiculo" id="FK_ProgVehiculo" class="form-control select">
									@foreach($vehiculos as $vehiculo)
										<option value="{{$vehiculo->ID_Vehic}}" {{$vehiculo->ID_Vehic == $programacion->FK_ProgVehiculo ? 'selected' : ''}}>{{$vehiculo->VehicPlaca}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="progVehKm">{{ trans('adminlte_lang::message.progvehickm') }}</label>
								<input type="text" class="form-control number" id="progVehKm" name="progVehKm" value="{{$programacion->progVehKm}}">
							</div>
							<div class="form-group col-md-6">
								<label for="FK_ProgConductor">{{ trans('adminlte_lang::message.progvehicconduc') }}</label>
								<select name="FK_ProgConductor" id="FK_ProgConductor" class="form-control select">
									@foreach($personals as $personal)
										<option value="{{$personal->ID_Pers}}" {{$personal->ID_Pers == $programacion->FK_ProgConductor ? 'selected' : ''}}>{{$personal->PersFirstName.' '.$personal->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="FK_ProgAyudante">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
								<select name="FK_ProgAyudante" id="FK_ProgAyudante" class="form-control select">
									@foreach($personals as $personal)
										<option value="{{$personal->ID_Pers}}" {{$personal->ID_Pers == $programacion->FK_ProgAyudante ? 'selected' : ''}}>{{$personal->PersFirstName.' '.$personal->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6 col-md-offset-5">
								<label for="ProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
								<input type="color" class="form-control" id="ProgVehColor" name="ProgVehColor" style="width: 30%;" value="{{$programacion->ProgVehColor}}">
							</div>
							<div class="box-footer pull-right">
								<button type="submit" class="btn btn-primary" id="update">{{ trans('adminlte_lang::message.update') }}</button>
							</div>
						</div>
						<!-- /.box-body -->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
	<script>
		$(document).ready(function(){
		@if(session('mensaje'))
			NotifiTrue('{{session('mensaje')}}');
		@endif
		@if($programacion->ProgVehEntrada <> null)
			$(".select2-selection").css("background-image", "none");
			$("#FK_ProgServi").prop("disabled", true);
			$("#ProgVehFecha").prop("disabled", true);
			$("#ProgVehSalida").prop("disabled", true);
			$("#FK_ProgVehiculo").prop("disabled", true);
			$("#FK_ProgConductor").prop("disabled", true);
			$("#FK_ProgAyudante").prop("disabled", true);
			$("#ProgVehEntrada").prop("disabled", true);
			$("#progVehKm").prop("disabled", true);
			$("#ProgVehColor").prop("disabled", true);
			$("#update").prop("disabled", true);
		@elseif(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor'))
			$("#FK_ProgServi").before(`<small class="help-block with-errors">*</small>`);
			$("#FK_ProgServi").prop('required', true);
			$("#ProgVehFecha").before(`<small class="help-block with-errors">*</small>`);
			$("#ProgVehFecha").prop('required', true);
			$("#ProgVehSalida").before(`<small class="help-block with-errors">*</small>`);
			$("#ProgVehSalida").prop('required', true);
			$("#FK_ProgVehiculo").before(`<small class="help-block with-errors">*</small>`);
			$("#FK_ProgVehiculo").prop('required', true);
			$("#FK_ProgConductor").before(`<small class="help-block with-errors">*</small>`);
			$("#FK_ProgConductor").prop('required', true);
			$("#FK_ProgAyudante").before(`<small class="help-block with-errors">*</small>`);
			$("#FK_ProgAyudante").prop('required', true);
			$("#ProgVehEntrada").prop('readonly', true);
			$("#progVehKm").prop('readonly', true);
		@else
			$("#ProgVehEntrada").before(`<small class="help-block with-errors">*</small>`);
			$("#ProgVehEntrada").prop('required', true);
			$("#progVehKm").before(`<small class="help-block with-errors">*</small>`);
			$("#progVehKm").prop('required', true);
			$(".select2-selection").css("background-image", "none");
			$("#FK_ProgServi").prop("disabled", true);
			$("#ProgVehFecha").prop('disabled', true);
			$("#ProgVehSalida").prop('disabled', true);
			$("#FK_ProgVehiculo").prop('disabled', true);
			$("#FK_ProgConductor").prop('disabled', true);
			$("#FK_ProgAyudante").prop('disabled', true);
			$("#ProgVehColor").prop("disabled", true);
		@endif
		});
	</script>

@endsection