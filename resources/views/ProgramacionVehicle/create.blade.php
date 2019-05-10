@extends('layouts.app')
@section('htmlheader_title')
Programacion
@endsection
@section('contentheader_title')
{{-- {{ trans('adminlte_lang::message.sclientregistertittle') }} --}}
@endsection
@section('main-content')
<div class="row">
	<div class="col-md-3">
		<div class="box box-info">
			<div class="box-header with-border">
				<h4 class="box-title">Servicios Por Programar</h4>
			</div>
			<div class="box-body">
				<div id="external-events">
					@foreach($serviciosnoprogramados as $servicionoprogramado)
					<div class="external-event bg-light-blue">{{$servicionoprogramado->ID_SolSer}}</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-info">
			<div class="box-body no-padding">
				<div id='calendar'></div>
			</div>
		</div>
	</div>
</div>
{{--  Modal --}}
<div class="modal modal-default fade in" id="CrearEventos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="titleModalCreate"></h4>
			</div>
			<div class="modal-body">
				<div style="text-align: center; margin: auto;" id="descripModalCreate">
					<form action="/prueba" method="POST" id="formularioCreate">
						@csrf
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<label for="textFecha">Fecha:</label>
								<input required class="form-control" type="text" id="textFecha" name="textFecha" readonly value="2019-02-11">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textTipo">Tipo:</label>
								<input required class="form-control" type="text" id="textTipo" value="Trabaja" name="textTipo" readonly>
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textVehiculo">Vehiculo:</label>
								<select name="textVehiculo" id="textVehiculo" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($vehiculos as $vehiculo)
									<option value="{{$vehiculo->ID_Vehic}}">{{$vehiculo->VehicPlaca}}</option>
									@endforeach
								</select>
							</div>
							<input type="hidden" name="FK_ProgServi" id="FK_ProgServi">
							<div class="col-xs-12 col-md-6">
								<label for="textkm">Kilometraje:</label>
								<input class="form-control" type="text" id="textkm" name="textkm">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textHoraSali">Hora Salida:</label>
								<input required class="form-control" type="text" id="textHoraSali" name="textHoraSali">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textHoraLlega">Hora Llegada:</label>
								<input class="form-control" type="text" id="textHoraLlega" name="textHoraLlega">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textConductor">Conductor:</label>
								<select name="textConductor" id="textConductor" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($conductors as $persona)
									<option value="{{$persona->ID_Pers}}">{{$persona->PersFirstName." ".$persona->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textAyudante">Ayudante:</label>
								<select name="textAyudante" id="textAyudante" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($ayudantes as $persona)
									<option value="{{$persona->ID_Pers}}">{{$persona->PersFirstName." ".$persona->PersLastName}}</option>
									@endforeach
								</select>
								<input type="submit" hidden="true" id="submit1" name="submit1">
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="ProgVehColor">Color de la programación:</label>
								<input class="form-control" type="color" id="ProgVehColor" name="ProgVehColor" value="">
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
				<div style="text-align: center; margin: auto;" id="descripModal">
					<form action="" method="POST" id="formularioModal">
						@csrf
						@method('PUT')
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<label for="textFecha1">Fecha:</label>
								<input required class="form-control" type="text" id="textFecha1" name="textFecha1">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textTipo">Tipo:</label>
								<input required class="form-control" type="text" id="textTipo" value="Trabaja" name="textTipo" readonly>
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textVehiculo1">Vehiculo:</label>
								<select name="textVehiculo1" class="form-control" id="textVehiculo1">
									<option value="" >Seleccione...</option>
									@foreach($vehiculos as $vehiculo)
									<option value="{{$vehiculo->ID_Vehic}}">{{$vehiculo->VehicPlaca}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textkm1">Kilometraje:</label>
								<input class="form-control" type="text" id="textkm1" name="textkm1">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textHoraSali1">Hora Salida:</label>
								<input required class="form-control" type="text" id="textHoraSali1" name="textHoraSali1">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textHoraLlega1">Hora Llegada:</label>
								<input class="form-control" type="text" id="textHoraLlega1" name="textHoraLlega1">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textConductor1">Conductor:</label>
								<select name="textConductor1" class="form-control" id="textConductor1">
									<option value="">Seleccione...</option>
									@foreach($conductors as $conductor)
									<option value="{{$conductor->ID_Pers}}">{{$conductor->PersFirstName." ".$conductor->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textAyudante1">Ayudante:</label>
								<select name="textAyudante1" class="form-control" id="textAyudante1">
									<option value="">Seleccione...</option>
									@foreach($ayudantes as $ayudante)
									<option value="{{$ayudante->ID_Pers}}">{{$ayudante->PersFirstName." ".$ayudante->PersLastName}}</option>
									@endforeach
								</select>
								<input type="submit" hidden="true" id="submit2" name="submit2">
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="ProgVehColor1">Color de la programación:</label>
								<input class="form-control" type="color" id="ProgVehColor1" name="ProgVehColor1" value="">
							</div>
						</div>
					</form>
					<form action="" method="POST" id="formulario2Modal1">
						@csrf
						@method('DELETE')
						
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<label for="submit2" class="btn btn-warning">Modificar</label>
				{{-- <label for="submit3" class="btn btn-danger">Borrar</label> --}}
				<a href='#' data-toggle='modal' id="buttonDelete" data-target="#myModal" class="btn btn-danger">Borrar</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
{{-- END Modal --}}
<div id="ModalDelete"></div>
@endsection
@section('NewScript')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		var Draggable = FullCalendarInteraction.Draggable;
		var containerEl = document.getElementById('external-events');
		var checkbox = document.getElementById('drop-remove');
		new Draggable(containerEl, {
			itemSelector: '.external-event',
			eventData: function(eventEl) {
				return {
					id: eventEl.innerText,
				};
			}
		});
		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: ['interaction', 'dayGrid', 'timeGrid'],
			locale: 'es',
			timeZone: 'UTC',
			droppable: true,
			eventStartEditable: true,
			defaultView: 'dayGridMonth',
			buttonText:{
				today: 'Hoy',
				month: 'Mes',
				week: 'Semana'
			},
			allDaySlot : false,
			customButtons: {
				AddMantVehc: {
					text: 'Añadir Mantenimiento',
					click: function() {
						$('#ModalEventos').modal();
					}
				}
			},
			header: {
				left: 'AddMantVehc',
				center: '',
				right: 'prev,today,next'
			},
			footer: {
				left: 'title',
				center: '',
				right: 'dayGridMonth,timeGridWeek'
			},
			eventLimit: true,
			views: {
				timeGrid: {
					eventLimit: 6
				}
			},
			aspectRatio: 2,
			eventSources:[{
				events: [
					@foreach($eventos as $evento)
						{
							id: '{{url('/vehicle-programacion/'.$evento->ID_ProgVeh)}}',
							title: '{{$evento->ID_SolSer." - ".$evento->VehicPlaca}}',
							color: '{{$evento->ProgVehColor}}',
							start: '{{$evento->ProgVehSalida}}',
							textColor: 'black'
						},
					@endforeach
					@foreach($mantenimientos as $mantenimiento)
						{
							id: '{{url('/vehicle-mantenimiento/'.$mantenimiento->ID_Mv)}}',
							title: '{{$mantenimiento->MvType." - ".$mantenimiento->VehicPlaca}}',
							color: 'brown',
							start: '{{$mantenimiento->HoraMavInicio}}',
							end: '{{$mantenimiento->HoraMavFin}}',
							textColor: 'black'
						},
					@endforeach
				],
			}],
			drop : function( dropInfo ) {
				let hora = calendar.formatDate(dropInfo.dateStr, {
					hour: '2-digit',
					minute: '2-digit'
				});
				document.getElementById('textFecha').value = dropInfo.dateStr;
				document.getElementById('textHoraSali').value = hora;
				$('#CrearEventos').modal();
			},
			eventReceive: function( info ) {
				var id = info.event.id;
				document.getElementById('FK_ProgServi').value = id;
				$("#CrearEventos").on("hidden.bs.modal", function () {
					info.event.remove();
					document.getElementById('textVehiculo').value = "";
					document.getElementById('textkm').value = "";
					document.getElementById('textConductor').value = "";
					document.getElementById('textAyudante').value = "";
					document.getElementById('ProgVehColor').value = "";
				});
			},
			eventDrop: function( eventDropInfo ) {
				CambioDeFecha(eventDropInfo.event);
			},
			eventClick: function(info){
				window.location.href = info.event.id;
				/*$.ajax({
					url: "{{url('/ProgramacionDeUnVehiculo')}}/"+info.event.id,
					type: "GET",
					data: {},
					success: function (msg) {
						let salida = calendar.formatDate(msg.ProgVehSalida, {
							hour: '2-digit',
							minute: '2-digit'
						});
						let entrada = calendar.formatDate(msg.ProgVehEntrada, {
							hour: '2-digit',
							minute: '2-digit'
						});
						
						$("#titleModal").html(info.event.title);
						$('#textFecha1').val(msg.ProgVehFecha);
						$("#textVehiculo1").val(msg.FK_ProgVehiculo);
						$('#textkm1').val(msg.progVehKm);
						$('#textHoraSali1').val(salida);
						$('#formulario2Modal1').attr('action', '/prueba/'+msg.ID_ProgVeh);
						$('#formulario2Modal1').append(`<input type="submit" hidden="true" id="Eliminar`+msg.ID_ProgVeh+`" name="Eliminar`+msg.ID_ProgVeh+`">`);
						$('#ModalDelete').empty();
						$('#ModalDelete').append(`@component('layouts.partials.modal')`+msg.ID_ProgVeh+`@endcomponent`);
						$('#buttonDelete').attr('data-target', "#myModal"+msg.ID_ProgVeh);
						if(msg.ProgVehEntrada != null){
							$('#textHoraLlega1').val(entrada);
						}
						$('#textConductor1').val(msg.FK_ProgConductor);
						$('#textAyudante1').val(msg.FK_ProgAyudante);
						$('#ProgVehColor1').val(msg.ProgVehColor);
						$("#ModalEventos").on("hidden.bs.modal", function () {
							$('#textFecha1').val('');
							$("#textVehiculo1").val('');
							$('#textkm1').val('');
							$('#textHoraSali1').val('');
							$('#textHoraLlega1').val('');
							$('#textConductor1').val('');
							$('#textAyudante1').val('');
							$('#ProgVehColor').val('');
							$('#Eliminar'+msg.ID_ProgVeh).remove();
						});
					},
					error: function (jqXHR, textStatus, errorThrown) {
						var msg = "No se encontro la programación";
						NotifiFalse(msg);
					}
				});*/
			}
		});
		calendar.render();
		function CambioDeFecha(event){
			var id = event.id;
			var fecha = event.start.toISOString();
			var Event = fecha;
			var token = '{{csrf_token()}}';
			var data={Event:Event,_token:token};
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{url('/CambioDeFechaProgVehic')}}/"+id,
				type: "PUT",
				data: data,
				success: function (msg) {
					NotifiTrue(msg);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					var msg = "No se pudo actulizar la programación";
					NotifiFalse(msg);
				}
			});
		}
	});
</script>
@endsection