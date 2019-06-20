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
							@slot('slug')
								{{$programacion->ID_ProgVeh}}
							@endslot
							@slot('textModal')
								la programación del servicio <b>N° - {{$programacion->FK_ProgServi}}</b>
							@endslot
						@endcomponent
						@if($programacion->ProgVehDelete == 0)
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$programacion->ID_ProgVeh}}'  class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
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
								<button type="submit" class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.add') }}</button>
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
												<input  class="form-control" type="date" id="ProgVehFecha1" name="ProgVehFecha" value="{{date('Y-m-d')}}">
											</div>
											<div class="col-xs-12 col-md-6">
												<label for="ProgVehSalida1">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
												<input class="form-control" type="time" id="ProgVehSalida1" name="ProgVehSalida" value="{{date('H:i')}}">
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="FK_ProgVehiculo">{{ trans('adminlte_lang::message.progvehicvehic') }}</label>
												<select name="FK_ProgVehiculo" id="FK_ProgVehiculo1" class="form-control">
													<option value="">Seleccione...</option>
													@foreach($vehiculos as $vehiculo)
													<option value="{{$vehiculo->ID_Vehic}}">{{$vehiculo->VehicPlaca}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="FK_ProgConductor1">{{ trans('adminlte_lang::message.progvehicconduc') }}</label>
												<select name="FK_ProgConductor" id="FK_ProgConductor1" class="form-control">
													<option value="">Seleccione...</option>
													@foreach($conductors as $conductor)
														<option value="{{$conductor->ID_Pers}}" >{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="FK_ProgAyudante1">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
												<select name="FK_ProgAyudante" id="FK_ProgAyudante1" class="form-control">
													<option value="">Seleccione...</option>
													@foreach($ayudantes as $ayudante)
														<option value="{{$ayudante->ID_Pers}}" >{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="ProgVehColor1">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
												<input class="form-control" type="color" style="height: 34px;" id="ProgVehColor1" name="ProgVehColor" value="{{$programacion->ProgVehColor}}">
											</div>
											<input type="submit" hidden="true" id="submit1" name="submit1">
										</div>
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<label for="submit1" class="btn btn-success">{{ trans('adminlte_lang::message.add') }}</label>
							</div>
						</div>
					</div>
				</div>
				{{-- END Modal --}}
				@if($programacion->ProgVehtipo == 1)
					<div class="box box-info">
						<form role="form" action="/vehicle-programacion/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
								<div class="form-group col-md-6 col-md-offset-3">
									<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
									<input type="date" class="form-control" id="ProgVehFecha" name="ProgVehFecha" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
									<input type="time" class="form-control" id="ProgVehSalida"  name="ProgVehSalida" value="{{date('H:i', strtotime($programacion->ProgVehSalida))}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehEntrada">{{ trans('adminlte_lang::message.progvehicllegada') }}</label>
									<input type="time" class="form-control" id="ProgVehEntrada" name="ProgVehEntrada" value="{{$programacion->ProgVehEntrada <> null ? date('H:i', strtotime($programacion->ProgVehEntrada)) : ''}}">
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
									<input type="color" class="form-control" id="ProgVehColor" name="ProgVehColor" style="width: 30%; height: 34px;" value="{{$programacion->ProgVehColor}}">
									@if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
										<br><a href='/PdfManiCarg/{{$programacion->ID_ProgVeh}}' class="btn btn-primary"><i class="fas fa-file-pdf fa-lg"></i> {{trans('adminlte_lang::message.generatemanicargpdf')}}</a>
									@endif
								</div>
								<div class="col-md-12 col-xs-12 box box-info"></div>
								<div class="box-footer">
									@if(Auth::user()->UsRol <> trans('adminlte_lang::message.SupervisorTurno') && date("Y-m-d",strtotime($programacion->ProgVehFecha."+ 1 days")) >= date('Y-m-d') && $programacion->ProgVehEntrada == null)
									<a href='#' data-toggle='modal' data-target="#CrearProgVehic" class="btn btn-success pull-left">{{ trans('adminlte_lang::message.progvehicadd') }}</a>
									@endif
									<button type="submit" class="btn btn-warning pull-right" id="update">{{ trans('adminlte_lang::message.update') }}</button>
								</div>
							</div>
							<!-- /.box-body -->
						</form>
					</div>
				@else
					<div class="box box-info">
						<form role="form" action="/vehicle-programacion/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
							@csrf
							@method('PUT')
							<div class="box-body">
								<div class="form-group col-md-6 col-md-offset-3">
									<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label><small class="help-block with-errors">*</small>
									<input type="date" required="" class="form-control" id="ProgVehFecha" name="ProgVehFecha" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida2') }}</label><small class="help-block with-errors">*</small>
									<input type="time" required="" class="form-control" id="ProgVehSalida"  name="ProgVehSalida" value="{{date('H:i', strtotime($programacion->ProgVehSalida))}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehEntrada">{{ trans('adminlte_lang::message.progvehicllegada2') }}</label><small class="help-block with-errors">*</small>
									<input type="time" class="form-control" id="ProgVehEntrada" name="ProgVehEntrada" value="{{$programacion->ProgVehEntrada <> null ? date('H:i', strtotime($programacion->ProgVehEntrada)) : ''}}">
								</div>
								<div class="col-md-12 col-xs-12 box box-info"></div>
								<div class="box-footer">
									<button type="submit" class="btn btn-warning pull-right" id="update">{{ trans('adminlte_lang::message.update') }}</button>
								</div>
							</div>
							<!-- /.box-body -->
						</form>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
	<script>
	@if(session('mensaje'))
		NotifiTrue('{{session('mensaje')}}');
	@endif
	@if($programacion->ProgVehtipo == 1)
			$(document).ready(function(){
			@if ($errors->create->any())
				$('#CrearProgVehic').modal("show");
			@endif
			$("#CrearProgVehic").on("hidden.bs.modal", function () {
				$('#FK_ProgVehiculo1').val("");
				$('#FK_ProgConductor1').val("");
				$('#ProgVehSalida1').val("{{date('H:i')}}");
				$('#FK_ProgAyudante1').val("");
				$('#ProgVehFecha1').val("{{date('Y-m-d')}}");
				$('#ProgVehColor1').val("#0000f6");
			});
			@if($programacion->ProgVehEntrada <> null)
				$(".select2-selection").css("background-image", "none");
				$("#ProgVehFecha").prop("disabled", true);
				$("#ProgVehSalida").prop("disabled", true);
				$("#FK_ProgVehiculo").prop("disabled", true);
				$("#FK_ProgConductor").prop("disabled", true);
				$("#FK_ProgAyudante").prop("disabled", true);
				$("#ProgVehEntrada").prop("disabled", true);
				$("#progVehKm").prop("disabled", true);
				$("#ProgVehColor").prop("disabled", true);
				$("#update").prop("disabled", true);
			@endif
			@if(Auth::user()->UsRol == trans('adminlte_lang::message.SupervisorTurno'))
				$("#ProgVehEntrada").before(`<small class="help-block with-errors">*</small>`);
				$("#ProgVehEntrada").prop('required', true);
				$("#progVehKm").before(`<small class="help-block with-errors">*</small>`);
				$("#progVehKm").prop('required', true);
				$(".select2-selection").css("background-image", "none");
				$("#ProgVehFecha").prop('disabled', true);
				$("#ProgVehSalida").prop('disabled', true);
				$("#FK_ProgVehiculo").prop('disabled', true);
				$("#FK_ProgConductor").prop('disabled', true);
				$("#FK_ProgAyudante").prop('disabled', true);
				$("#ProgVehColor").prop("disabled", true);
			@endif
			@if(Auth::user()->UsRol <> trans('adminlte_lang::message.SupervisorTurno') && Auth::user()->UsRol <> trans('adminlte_lang::message.Programador'))
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
			@endif
			});
	@endif
	</script>
@endsection