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
		<div class="box box-info" style="overflow-y: auto; max-height: 560px;">
			<div class="box-header with-border">
				<h4 class="box-title">Servicios Por Programar</h4>
			</div>
			<div class="box-body">
				<div id="external-events">
					@foreach($serviciosnoprogramados as $servicionoprogramado)
						@php
							if($servicionoprogramado->SolSerTipo == 'Interno'){
								$color = 'bg-aqua';
							}
							else{
								$color = 'bg-green';
							}
						@endphp
						<p style="background-color: #001f3f; color: #fff; padding-top: 15px !important; padding-bottom: 0 !important; text-align: center;" class="external-event ui-draggable ui-draggable-handle servicionoprogramado col-md-12 form-group col-xs-12" data-tipo="{{$servicionoprogramado->SolSerTipo}}" data-id="{{$servicionoprogramado->ID_SolSer}}">
							<span class="col-md-8 form-group col-xs-8">N° {{$servicionoprogramado->ID_SolSer}}</span>
							<a href="/solicitud-servicio/{{$servicionoprogramado->SolSerSlug}}" target="_blank" class='{{$color}} col-md-4 form-group col-xs-4' style="border-radius: 4px;">{{ trans('adminlte_lang::message.see') }}</a>
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
				<h4 class="modal-title" id="titleModalCreate">{{ trans('adminlte_lang::message.progvehictitle') }} Interno</h4>
			</div>
			<div class="box box-info">
				<div class="modal-body">
					<div style="margin: auto;" id="descripModalCreate">
						<form action="/vehicle-programacion" method="POST" id="formularioCreate" data-toggle="validator">
							@csrf
							<input type="text" hidden name="FK_ProgServi" class="FK_ProgServi" id="FK_ProgServi">
							<div class="box-body">
								<div class="form-group col-xs-12 col-md-6">
									<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
									<input  class="form-control ProgVehFecha" readonly type="date" id="ProgVehFecha" name="ProgVehFecha" value="{{old('ProgVehFecha')}}">
								</div>
								<div class="form-group col-xs-12 col-md-6">
									<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
									<input class="form-control" type="time" required id="ProgVehSalida" name="ProgVehSalida" value="{{old('ProgVehSalida')}}">
									<small class="help-block with-errors"></small>
								</div>
								<div class="form-group col-xs-12 col-md-12">
									<label for="FK_ProgVehiculo">{{ trans('adminlte_lang::message.progvehicvehic') }}</label>
									<small class="help-block with-errors">*</small>
									<select name="FK_ProgVehiculo" id="FK_ProgVehiculo" class="form-control" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($vehiculos as $vehiculo)
											<option value="{{$vehiculo->ID_Vehic}}" {{old('FK_ProgVehiculo') == $vehiculo->ID_Vehic ? 'selected' : ''}}>{{$vehiculo->VehicPlaca}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-xs-12 col-md-12">
									<label for="FK_ProgConductor">{{ trans('adminlte_lang::message.progvehicconduc') }}</label>
									<small class="help-block with-errors">*</small>
									<select name="FK_ProgConductor" id="FK_ProgConductor" class="form-control" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($conductors as $conductor)
											<option value="{{$conductor->ID_Pers}}" {{old('FK_ProgConductor') == $conductor->ID_Pers ? 'selected' : ''}}>{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-xs-12 col-md-12">
									<label for="FK_ProgAyudante">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
									<small class="help-block with-errors">*</small>
									<select name="FK_ProgAyudante" id="FK_ProgAyudante" class="form-control" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($ayudantes as $ayudante)
											<option value="{{$ayudante->ID_Pers}}" {{old('FK_ProgAyudante') == $ayudante->ID_Pers ? 'selected' : ''}}>{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-xs-12 col-md-12">
									<label for="ProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
									<input class="form-control" type="color" style="height: 34px;" id="ProgVehColor" name="ProgVehColor" value="{{old('ProgVehColor') == null ? '#0000f6' : old('ProgVehColor')}}">
								</div>
								<input type="submit" hidden="true" id="submit1" name="submit1">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<label for="submit1" class="btn btn-success">{{ trans('adminlte_lang::message.add') }}</label>
			</div>
		</div>
	</div>
</div>
{{-- END Modal --}}

{{--  Modal --}}
<div class="modal modal-default fade in" id="CrearProgVehic2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="titleModalCreate">{{ trans('adminlte_lang::message.progvehictitle') }} Externos</h4>
			</div>
			<div class="box box-info">
				<div class="modal-body">
					<div style="margin: auto;" id="descripModalCreate">
						<form action="/vehicle-programacion" method="POST" id="formularioCreate" data-toggle="validator">
							@csrf
							<input type="text" hidden name="FK_ProgServi" class="FK_ProgServi" id="FK_ProgServi">
							<div class="box-body">
								<div class="form-group col-xs-12 col-md-6">
									<label for="ProgVehFecha2">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
									<input  class="ProgVehFecha form-control" readonly type="date" id="ProgVehFecha2" name="ProgVehFecha" value="{{old('ProgVehFecha2')}}">
								</div>
								<div class="form-group col-xs-12 col-md-6">
									<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida2') }}</label>
									<input class="form-control" type="time" required id="ProgVehSalida2" name="ProgVehSalida" value="{{old('ProgVehSalida2')}}">
									<small class="help-block with-errors"></small>
								</div>
								<input type="submit" hidden="true" id="submit2" name="submit2">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<label for="submit2" class="btn btn-success">{{ trans('adminlte_lang::message.add') }}</label>
			</div>
		</div>
	</div>
</div>
{{-- END Modal --}}

{{--  Modal --}}
<div class="modal modal-default fade in" id="CrearMantVehic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="titleModal">{{ trans('adminlte_lang::message.mantvehititle') }}</h4>
			</div>
			<div class="box box-info">
				<div class="modal-body">
					<div style="margin: auto;" id="descripModal">
						<form action="/vehicle-mantenimiento" method="POST" id="formularioModal" data-toggle="validator">
							@csrf
							@if ($errors->createManVeh->any())
								<div class="alert alert-danger" role="alert">
									<ul>
										@foreach ($errors->createManVeh->all() as $error)
											<p>{{$error}}</p>
										@endforeach
									</ul>
								</div>
							@endif
							<div class="box-body">
								<div class="col-xs-12 col-md-12">
									<div class="form-group col-xs-12 col-md-6">
										<label for="FK_VehMan">{{ trans('adminlte_lang::message.mantvehivehic') }}</label>
										<select name="FK_VehMan" class="form-control" required id="FK_VehMan">
											<option value="" >{{ trans('adminlte_lang::message.select') }}</option>
											@foreach($vehiculos as $vehiculo)
											<option value="{{$vehiculo->ID_Vehic}}" {{old('FK_VehMan') == $vehiculo->ID_Vehic ? 'selected' : ''}}>{{$vehiculo->VehicPlaca}}</option>
											@endforeach
										</select>
										<small class="help-block with-errors"></small>
									</div>
									<div class="form-group col-xs-12 col-md-6">
										<label for="MvKm">{{ trans('adminlte_lang::message.mantvehikm') }}</label>
										<input maxlength="11" class="form-control number" required type="text" id="MvKm" name="MvKm" value="{{old('MvKm')}}">
										<small class="help-block with-errors"></small>
									</div>
								</div>
								<div class="col-xs-12 col-md-12">
									<div class="form-group col-xs-12 col-md-6">
										<label for="HoraMavInicio1">{{ trans('adminlte_lang::message.mantvehiinicio1') }}</label>
										<input type="date" required id="HoraMavInicio1" name="HoraMavInicio1" class="form-control" value="{{old('HoraMavInicio1') <> null ? old('HoraMavInicio1') : date('Y-m-d')}}">
										<small class="help-block with-errors"></small>
									</div>
									<div class="form-group col-xs-12 col-md-6">
										<label for="HoraMavFin1">{{ trans('adminlte_lang::message.mantvehifin1') }}</label>
										<input type="date" id="HoraMavFin1" required name="HoraMavFin1" class="form-control" value="{{old('HoraMavFin1') <> null ? old('HoraMavFin1') : date('Y-m-d')}}">
										<small class="help-block with-errors"></small>
									</div>
								</div>
								<div class="col-xs-12 col-md-12">
									<div class="form-group col-xs-12 col-md-6">
										<label for="HoraMavInicio">{{ trans('adminlte_lang::message.mantvehiinicio') }}</label>
										<input required class="form-control" type="time" id="HoraMavInicio" name="HoraMavInicio" value="{{old('HoraMavInicio') <> null ? old('HoraMavInicio') : date('H:i')}}">
										<small class="help-block with-errors"></small>
									</div>
									<div class="form-group col-xs-12 col-md-6">
										<label for="HoraMavFin">{{ trans('adminlte_lang::message.mantvehifin') }}</label>
										<input class="form-control horas" type="time" required id="HoraMavFin" name="HoraMavFin" value="{{old('HoraMavFin') <> null ? old('HoraMavFin') : date('H:i')}}">
										<small class="help-block with-errors"></small>
									</div>
								</div>
								<div class="col-xs-12 col-md-12">
									<div class="form-group col-xs-12 col-md-12">
										<label for="MvType">{{ trans('adminlte_lang::message.mantvehitype') }}</label>
										<input type="text" class="form-control" required maxlength="255" id="MvType" name="MvType" value="{{old('MvType')}}">
										<small class="help-block with-errors"></small>
									</div>
								</div>
								<input type="submit" hidden="true" id="submit3" name="submit3">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<label for="submit3" class="btn btn-success">Añadir</label>
			</div>
		</div>
	</div>
</div>
{{-- END Modal --}}

<div id="ModalDelete"></div>

@endsection

@section('NewScript')
{{-- fullcalendar --}}
<script type="text/javascript" src="{{ url (mix('/js/fullcalendar.js')) }}"></script>

<script>
	@if ($errors->create->any())
		$(document).ready(function(){
			$('#CrearProgVehic').modal("show");
		});
	@endif
	@if ($errors->createManVeh->any())
		$(document).ready(function(){
			$('#CrearMantVehic').modal("show");
		});
	@endif
	document.addEventListener('DOMContentLoaded', function() {
		@if(session('Delete'))
			NotifiTrue('{{session('Delete')}}');
		@endif
		var calendarEl = document.getElementById('calendar');
		var Draggable = FullCalendarInteraction.Draggable;
		var containerEl = document.getElementById('external-events');
		new Draggable(containerEl, {
			itemSelector: '.external-event',
			eventData: function(eventEl) {
				return {
					id: eventEl.dataset.id,
					title: eventEl.dataset.tipo,
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
			defaultRangeSeparator: ' - ',
			height: 'parent',
			customButtons: {
				AddMantVehc: {
					text: 'Añadir Mantenimiento',
					click: function() {
						$('#CrearMantVehic').modal();
						$("#CrearMantVehic").on("hidden.bs.modal", function () {
							$('#FK_VehMan').val('');
							$('#MvKm').val('');
							$('#HoraMavFin1').val('{{date('Y-m-d')}}');
							$('#HoraMavInicio1').val('{{date('Y-m-d')}}');
							$('#HoraMavInicio').val('{{date('H:i')}}');
							$('#HoraMavFin').val('{{date('H:i')}}');
							$('#MvType').val('');
						});
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
				left: 'dayGridMonth,timeGridWeek',
				center: 'title',
				right: 'prev,today,next'
			},
			footer: {
				left: 'AddMantVehc',
				center: '',
				right: 'ListProg'
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
						@if($programacion->ProgVehtipo == 1 && $programacion->ProgVehEntrada == null)
						{
							id: '{{$programacion->ID_ProgVeh}}',
							url: '{{url('/vehicle-programacion/'.$programacion->ID_ProgVeh.'/edit')}}',
							color: '{{$programacion->ProgVehColor}}',
							title: '{{$programacion->SolSerVehiculo." - ".$programacion->ID_SolSer}}',
							start: '{{$programacion->ProgVehSalida}}',
							textColor: 'black'
						},
						@endif
						@if($programacion->ProgVehtipo == 0)
						{
							id: '{{$programacion->ID_ProgVeh}}',
							url: '{{url('/vehicle-programacion/'.$programacion->ID_ProgVeh.'/edit')}}',
							title: '{{$programacion->SolSerVehiculo." - ".$programacion->ID_SolSer}}',
							color: '#00a65a',
							start: '{{$programacion->ProgVehSalida}}',
							end: '{{$programacion->ProgVehEntrada}}',
							textColor: 'black'
						},
						@endif
					@endforeach
					@foreach($mantenimientos as $mantenimiento)
						{
							id: '{{$mantenimiento->ID_Mv}}',
							title: '{{$mantenimiento->VehicPlaca." - ".$mantenimiento->MvType}}',
							url:'{{url('/vehicle-mantenimiento/'.$mantenimiento->ID_Mv.'/edit')}}',
							color: 'brown',
							start: '{{$mantenimiento->HoraMavInicio}}',
							end: '{{$mantenimiento->HoraMavFin}}',
							textColor: 'black'
						},
					@endforeach
				],
			}],
			drop : function( dropInfo ) {
				let hora = FullCalendar.formatDate(dropInfo.date.toUTCString(), {
					hour: '2-digit',
					hour12: false,
					minute: '2-digit'
				});
				$('.ProgVehFecha').val(dropInfo.dateStr);
				$('#ProgVehSalida').val(hora);
			},
			eventReceive: function( info ) {
				var id = info.event.id;
				var tipo = info.event.title;
				$('.FK_ProgServi').val(id);
				info.event.remove();
				if(tipo == 'Interno'){
					$('#CrearProgVehic').modal();
					$("#CrearProgVehic").on("hidden.bs.modal", function () {
						$('#FK_ProgVehiculo').val("");
						$('#FK_ProgConductor').val("");
						$('#ProgVehSalida').val("");
						$('#FK_ProgAyudante').val("");
						$('#ProgVehColor').val("#0000f6");
					});
				}
				else{
					$('#CrearProgVehic2').modal();
					$("#CrearProgVehic2").on("hidden.bs.modal", function () {
						$('#FK_ProgVehiculo').val("");
						$('#FK_ProgConductor').val("");
						$('.ProgVehSalida').val("");
						$('#FK_ProgAyudante').val("");
						$('#ProgVehColor').val("#0000f6");
					});
				}
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