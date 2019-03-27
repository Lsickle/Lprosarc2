@extends('layouts.app')

@section('htmlheader_title','Prueba')

@section('NewScript')
		<script>
		$(function() {
			$('#calendar').fullCalendar({
				themeSystem: 'bootstrap4',
				fixedWeekCount: true,
				showNonCurrentDates: true,
				selectable: true,
				selectHelper: true,
				// height: "parent",
				// contentHeight: 600,
				aspectRatio: 2,
				header: {
					left: 'title',
					center: 'prevYear,prev,next,nextYear',
					right: 'month,agendaWeek,agendaDay'
				},
				footer: {
					left: 'title',
					center: 'prevYear,prev,next,nextYear',
					right: 'month,agendaWeek,agendaDay'
				},
				dayClick: function(data,jsEvent,view){
					$('#textFecha').val(data.format());
					$('#CrearEventos').modal();
				},
				eventSources:[{
					events: [
						@foreach($eventos as $evento)
							@foreach($vehiculos as $vehiculo)
								@if($vehiculo->ID_Vehic === $evento->FK_ProgVehiculo && $evento->ProgVehDelete === 0)
									{
										title: '{{$vehiculo->VehicPlaca}}',
										fecha: '{{$evento->ProgVehFecha}}',
										km: '{{$evento->progVehKm}}',
										id: '{{$evento->ID_ProgVeh}}',
										ID_Vehic: '{{$vehiculo->ID_Vehic}}',
										salida: '{{date("h:i:s",strtotime($evento->ProgVehSalida))}}',
										@if($evento->ProgVehEntrada)
											llegada: '{{date("h:i:s",strtotime($evento->ProgVehEntrada))}}',
										@else
											llegada: '{{$evento->ProgVehEntrada}}',
										@endif
										@foreach($personal as $persona)
											@if($persona->ID_Pers === $evento->FK_ProgConductor)
												conductor: '{{$persona->ID_Pers}}',
											@elseif($persona->ID_Pers === $evento->FK_ProgAyudante)
												ayudante: '{{$persona->ID_Pers}}',
											@endif
										@endforeach
										@if ($evento->ProgVehSalida <> null)
											end: '{{$evento->ProgVehEntrada}}',
										@endif
										start: '{{$evento->ProgVehSalida}}'
									},
								@endif
							@endforeach
						@endforeach
					],
					color: 'black',
					textColor: 'yellow'
				}],
				eventClick: function(event,jsEvent,view){
					document.getElementById('formularioModal').action = '/prueba/'+event.id;
					document.getElementById('formularioModal1').action = '/prueba/'+event.id;
					$('#titleModal').html(event.title);
					$('#textFecha1').val(event.fecha);
					$('#textVehiculo1').val(event.ID_Vehic);
					$('#textkm1').val(event.km);
					$('#textHoraSali1').val(event.salida);
					$('#textHoraLlega1').val(event.llegada);
					$('#textConductor1').val(event.conductor);
					$('#textAyudante1').val(event.ayudante);
					$('#ModalEventos').modal();
				}
			});
		});
	</script>
@endsection

@section('contentheader_title', 'FullCalendar')

@section('main-content')
	<div id='calendar'></div>
	{{--  Modal --}}
	<div class="modal modal-default fade in" id="CrearEventos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleModalCreate"></h4>
				</div>
				<div class="modal-body">
					<div style="color: blue; text-align: center; margin: auto;" id="descripModalCreate">
						<form action="/prueba" method="POST" id="formularioCreate">
							@csrf
							<div class="box-body">
								<div class="col-xs-6">
									<label for="textFecha">Fecha:</label>
									<input required class="form-control" type="text" id="textFecha" name="textFecha" readonly>
								</div>
								<div class="col-xs-6">
									<label for="textTipo">Tipo:</label>
									<input required class="form-control" type="text" id="textTipo" value="Trabaja" name="textTipo" readonly>
								</div>
								<div class="col-xs-6">
									<label for="textVehiculo">Vehiculo:</label>
									<select name="textVehiculo" id="textVehiculo" class="form-control">
											<option value="1">Seleccione...</option>
										@foreach($vehiculos as $vehiculo)
											<option value="{{$vehiculo->ID_Vehic}}">{{$vehiculo->VehicPlaca}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-xs-6">
									<label for="textkm">Kilometraje:</label>
									<input class="form-control" type="text" id="textkm" name="textkm">
								</div>
								<div class="col-xs-6">
									<label for="textHoraSali">Hora Salida:</label>
									<input required class="form-control" type="text" id="textHoraSali" name="textHoraSali">
								</div>
								<div class="col-xs-6">
									<label for="textHoraLlega">Hora Llegada:</label>
									<input class="form-control" type="text" id="textHoraLlega" name="textHoraLlega">
								</div>
								<div class="col-xs-6">
									<label for="textConductor">Conductor:</label>
									<select name="textConductor" id="textConductor" class="form-control">
										<option value="1">Seleccione...</option>
										@foreach($personal as $persona)
											<option value="{{$persona->ID_Pers}}">{{$persona->PersFirstName." ".$persona->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-xs-6">
									<label for="textAyudante">Ayudante:</label>
									<select name="textAyudante" id="textAyudante" class="form-control">
										<option value="1">Seleccione...</option>
										@foreach($personal as $persona)
											<option value="{{$persona->ID_Pers}}">{{$persona->PersFirstName." ".$persona->PersLastName}}</option>
										@endforeach
									</select>
									<input type="submit" hidden="true" id="submit1" name="submit1">
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<label for="submit1" class="btn btn-success">Agregar</label>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	{{-- END Modal --}}

	{{--  Modal --}}
	<div class="modal modal-default fade in" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleModal"></h4>
				</div>
				<div class="modal-body">
					<div style="color: blue; text-align: center; margin: auto;" id="descripModal">
						<form action="" method="POST" id="formularioModal">
							@csrf
							@method('PUT')
							<div class="box-body">
								<div class="col-xs-6">
									<label for="textFecha1">Fecha:</label>
									<input required class="form-control" type="text" id="textFecha1" name="textFecha1" readonly>
								</div>
								<div class="col-xs-6">
									<label for="textTipo">Tipo:</label>
									<input required class="form-control" type="text" id="textTipo" value="Trabaja" name="textTipo" readonly>
								</div>
								<div class="col-xs-6">
									<label for="textVehiculo1">Vehiculo:</label>
									<select name="textVehiculo1" class="form-control">
											<option value="1" id="textVehiculo1">Seleccione...</option>
										@foreach($vehiculos as $vehiculo)
											<option value="{{$vehiculo->ID_Vehic}}">{{$vehiculo->VehicPlaca}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-xs-6">
									<label for="textkm1">Kilometraje:</label>
									<input class="form-control" type="text" id="textkm1" name="textkm1">
								</div>
								<div class="col-xs-6">
									<label for="textHoraSali1">Hora Salida:</label>
									<input required class="form-control" type="text" id="textHoraSali1" name="textHoraSali1">
								</div>
								<div class="col-xs-6">
									<label for="textHoraLlega1">Hora Llegada:</label>
									<input class="form-control" type="text" id="textHoraLlega1" name="textHoraLlega1">
								</div>
								<div class="col-xs-6">
									<label for="textConductor1">Conductor:</label>
									<select name="textConductor1" class="form-control">
										<option value="1" id="textConductor1">Seleccione...</option>
										@foreach($personal as $persona)
											<option value="{{$persona->ID_Pers}}">{{$persona->PersFirstName." ".$persona->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-xs-6">
									<label for="textAyudante1">Ayudante:</label>
									<select name="textAyudante1" class="form-control">
										<option value="1" id="textAyudante1">Seleccione...</option>
										@foreach($personal as $persona)
											<option value="{{$persona->ID_Pers}}">{{$persona->PersFirstName." ".$persona->PersLastName}}</option>
										@endforeach
									</select>
									<input type="submit" hidden="true" id="submit2" name="submit2">
								</div>
							</div>
						</form>
						<form action="" method="POST" id="formularioModal1">
							@csrf
							@method('DELETE')
							<input type="submit" hidden="true" id="submit3" name="submit3">
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<label for="submit2" class="btn btn-warning">Modificar</label>
					<label for="submit3" class="btn btn-danger">Borrar</label>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	{{-- END Modal --}}
@endsection