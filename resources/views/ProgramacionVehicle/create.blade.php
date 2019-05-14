@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
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
						<p style="background-color: #001f3f; border-color: #001f3f; text-align: center; color: rgb(255, 255, 255); position: relative;" class="external-event ui-draggable ui-draggable-handle col-md-12">
							<span style="background-color: #001f3f; border-color: #001f3f; color: rgb(255, 255, 255); position: relative;" class="external-event ui-draggable ui-draggable-handle servicionoprogramado col-md-12">{{$servicionoprogramado->ID_SolSer}}</span>
							<a href="/solicitud-servicio/{{$servicionoprogramado->SolSerSlug}}" target="_blank" class='bg-aqua pull-right col-md-3 btn-block' style="border-radius: 4px;">{{ trans('adminlte_lang::message.see') }}</a>
						</p>
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
						<input type="hidden" name="FK_ProgServi" id="FK_ProgServi">
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
								<input  class="form-control fechas" readonly type="text" id="ProgVehFecha" name="ProgVehFecha">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
								<input class="form-control horas" type="text" id="ProgVehSalida" name="ProgVehSalida">
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="FK_ProgVehiculo">{{ trans('adminlte_lang::message.progvehicvehic') }}</label>
								<select name="FK_ProgVehiculo" id="FK_ProgVehiculo" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($vehiculos as $vehiculo)
										<option value="{{$vehiculo->ID_Vehic}}">{{$vehiculo->VehicPlaca}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="FK_ProgConductor">{{ trans('adminlte_lang::message.progvehicconduc') }}</label>
								<select name="FK_ProgConductor" id="FK_ProgConductor" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($conductors as $conductor)
										<option value="{{$conductor->ID_Pers}}" >{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="FK_ProgAyudante">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
								<select name="FK_ProgAyudante" id="FK_ProgAyudante" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($ayudantes as $ayudante)
										<option value="{{$ayudante->ID_Pers}}" >{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="ProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
								<input class="form-control" type="color" id="ProgVehColor" name="ProgVehColor" value="#0000f6">
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
									@foreach($conductors as $conductor)
									<option value="{{$conductor->ID_Pers}}">{{$conductor->PersFirstName." ".$conductor->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="textAyudante1">Ayudante:</label>
								<select name="textAyudante1" class="form-control" id="textAyudante1">
									@foreach($ayudantes as $ayudante)
									<option value="{{$ayudante->ID_Pers}}">{{$ayudante->PersFirstName." ".$ayudante->PersLastName}}</option>
									@endforeach
								</select>
								<input type="submit" hidden="true" id="submit2" name="submit2">
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="ProgVehColor1">Color de la programación:</label>
								{{-- <input class="form-control" type="color" id="ProgVehColor1" name="ProgVehColor1" value=""> --}}
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
		@if(session('Delete'))
			NotifiTrue('{{session('Delete')}}');
		@endif
		var calendarEl = document.getElementById('calendar');
		var Draggable = FullCalendarInteraction.Draggable;
		var containerEl = document.getElementById('external-events');
		var checkbox = document.getElementById('drop-remove');
		new Draggable(containerEl, {
			itemSelector: '.external-event .servicionoprogramado',
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
				},
				ListProg: {
					text: 'Listar Programaciones',
					click: function() {
						window.location.href = "{{url('/vehicle-programacion')}}";
					}
				}
			},
			header: {
				left: 'AddMantVehc',
				center: 'ListProg',
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
					@foreach($programacions as $programacion)
						@if($programacion->ProgVehEntrada == null && $programacion->ProgVehDelete == 0)
						{
							id: '{{$programacion->ID_ProgVeh}}',
							url: '{{url('/vehicle-programacion/'.$programacion->ID_ProgVeh.'/edit')}}',
							title: '{{$programacion->ID_SolSer." - ".$programacion->VehicPlaca}}',
							color: '{{$programacion->ProgVehColor}}',
							start: '{{$programacion->ProgVehSalida}}',
							textColor: 'black'
						},
						@endif
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
				document.getElementById('ProgVehFecha').value = dropInfo.dateStr;
				document.getElementById('ProgVehSalida').value = hora;
				$('#CrearProgVehic').modal();
			},
			eventReceive: function( info ) {
				var id = info.event.id;
				$('#FK_ProgServi').val(id);
				info.event.remove();
				$("#CrearProgVehic").on("hidden.bs.modal", function () {
					$('#FK_ProgVehiculo').val("");
					$('#FK_ProgConductor').val("");
					$('#ProgVehSalida').val("");
					$('#FK_ProgAyudante').val("");
					$('#ProgVehColor').val("#0000f6");
				});
			},
			eventDrop: function( eventDropInfo ) {
				CambioDeFecha(eventDropInfo.event);
			},
			eventClick: function(info){
				info.jsEvent.preventDefault();
				window.open(info.event.url);
			}
		});
		calendar.render();
		function CambioDeFecha(event){
			var id = event.id;
			var fecha = event.start.toISOString();
			var token = '{{csrf_token()}}';
			var data={Event:fecha,_token:token};
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
					NotifiFalse("{{trans('adminlte_lang::message.progvehcediterror')}}");
				}
			});
		}
	});
</script>
@endsection