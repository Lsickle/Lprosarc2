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
					@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor'))
						@component('layouts.partials.modal')
						{{$programacion->ID_ProgVeh}}
						@endcomponent
						@if($programacion->ProgVehDelete == 0)
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$programacion->ID_ProgVeh}}'  class='btn btn-danger pull-right'>{{ trans('adminlte_lang::message.delete') }}</a>
							<a href="/vehicle-programacion/create" class="btn btn-info col-md-offset-3"><i class="fas fa-calendar-alt"></i> {{ trans('adminlte_lang::message.progvehiccreatetext') }}</a>
							<form action='/vehicle-programacion/{{$programacion->ID_ProgVeh}}' method='POST'>
								@method('DELETE')
								@csrf
								<input  type="submit" id="Eliminar{{$programacion->ID_ProgVeh}}" style="display: none;">
							</form>
						@else
							<a href="/vehicle-programacion/create" class="btn btn-info col-md-offset-3"><i class="fas fa-calendar-alt"></i> {{ trans('adminlte_lang::message.progvehiccreatetext') }}</a>
							<form action='/vehicle-programacion/{{$programacion->ID_ProgVeh}}' method='POST' class="pull-right">
								@method('DELETE')
								@csrf
								<input type="submit" class='btn btn-success' value="{{ trans('adminlte_lang::message.add') }}">
							</form>
						@endif
					@endif
				</div>
				{{--  Modal --}}
				<div class="modal modal-default fade in" id="CrearProgVehic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="titleModalCreate">{{ trans('adminlte_lang::message.progvehictitle') }}</h4>
							</div>
							<div class="modal-body">
								<div style="text-align: center; margin: auto;" id="descripModalCreate">
									<form action="/vehicle-programacion" method="POST" id="formularioCreate">
										@csrf
										@if ($errors->create->any())
											<div class="alert alert-danger" role="alert">
												<ul>
													@foreach ($errors->create->all() as $error)
														<p>{{$error}}</p>
													@endforeach
												</ul>
											</div>
										@endif
										<input type="hidden" name="FK_ProgServi" id="FK_ProgServi1" value="{{$programacion->FK_ProgServi}}">
										<div class="box-body">
											<div class="col-xs-12 col-md-6">
												<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
												<input  class="form-control fechas" type="date" id="ProgVehFecha1" name="ProgVehFecha">
											</div>
											<div class="col-xs-12 col-md-6">
												<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
												<input class="form-control horas" type="text" id="ProgVehSalida1" name="ProgVehSalida">
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="FK_ProgVehiculo">{{ trans('adminlte_lang::message.progvehicvehic') }}</label>
												<select name="FK_ProgVehiculo" id="FK_ProgVehiculo1" class="form-control select">
													<option value="">Seleccione...</option>
													@foreach($vehiculos as $vehiculo)
													<option value="{{$vehiculo->ID_Vehic}}">{{$vehiculo->VehicPlaca}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="FK_ProgConductor">{{ trans('adminlte_lang::message.progvehicconduc') }}</label>
												<select name="FK_ProgConductor" id="FK_ProgConductor1" class="form-control select">
													<option value="">Seleccione...</option>
													@foreach($conductors as $conductor)
														<option value="{{$conductor->ID_Pers}}" >{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="FK_ProgAyudante">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
												<select name="FK_ProgAyudante" id="FK_ProgAyudante1" class="form-control select">
													<option value="">Seleccione...</option>
													@foreach($ayudantes as $ayudante)
														<option value="{{$ayudante->ID_Pers}}" >{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="ProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
												<input class="form-control" type="color" id="ProgVehColor1" name="ProgVehColor" value="{{$programacion->ProgVehColor}}">
											</div>
											<input type="submit" hidden="true" id="submit1" name="submit1">
										</div>
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<label for="submit1" class="btn btn-success">{{ trans('adminlte_lang::message.add') }}</label>
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.cancel') }}</button>
							</div>
						</div>
					</div>
				</div>
				{{-- END Modal --}}
				<div class="box box-info">
					<form role="form" action="/vehicle-programacion/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" {{-- data-toggle="validator" --}}>
						@csrf
						@method('PUT')
						@if ($errors->edit->any())
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->edit->all() as $error)
										<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
						@endif
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
									@foreach($conductors as $conductor)
										<option value="{{$conductor->ID_Pers}}" {{$conductor->ID_Pers == $programacion->FK_ProgConductor ? 'selected' : ''}}>{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="FK_ProgAyudante">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
								<select name="FK_ProgAyudante" id="FK_ProgAyudante" class="form-control select">
									@foreach($ayudantes as $ayudante)
										<option value="{{$ayudante->ID_Pers}}" {{$ayudante->ID_Pers == $programacion->FK_ProgAyudante ? 'selected' : ''}}>{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6 col-md-offset-5">
								<label for="ProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
								<input type="color" class="form-control" id="ProgVehColor" name="ProgVehColor" style="width: 30%;" value="{{$programacion->ProgVehColor}}">
							</div>
							<div class="col-md-12 col-xs-12 box box-info"></div>
							<div class="box-footer">
								@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor') && date("Y-m-d",strtotime($programacion->ProgVehFecha."+ 1 days")) >= date('Y-m-d'))
								<a href='#' data-toggle='modal' data-target="#CrearProgVehic" class="btn btn-success pull-left">{{ trans('adminlte_lang::message.progvehicadd') }}</a>
								@endif
								<button type="submit" class="btn btn-warning pull-right" id="update">{{ trans('adminlte_lang::message.update') }}</button>
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
		@if ($errors->create->any())
			$('#CrearProgVehic').modal("show");
		@endif
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
			// $("#ProgVehSalida").prop('required', true);
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