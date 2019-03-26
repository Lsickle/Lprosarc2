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
          /*height: 650,
          contentHeight: 600,*/
          aspectRatio: 2.5,
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
				{
					title: "Eventos",
					@if ($evento->ProgVehSalida <> null)
						end: '{{$evento->ProgVehEntrada}}',
					@endif
					start: '{{$evento->ProgVehSalida}}'
				},
				@endforeach
			],
			color: 'black',
			textColor: 'yellow'
		}],
		eventClick: function(event,jsEvent,view){
			$('#titleModal').html(event.title);
			$('#textFecha').val(event.format());
			$
			$('#ModiEventos').modal();
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
          <div class="modal-footer">
          	<label for="submit1" class="btn btn-success">Agregar</label>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
{{-- END Modal --}}



{{--  Modal --}}
    <div class="modal modal-default fade in" id="ModiEventos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          	<h4 class="modal-title" id="titleModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div style="color: blue; text-align: center; margin: auto;" id="descripModal">
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
            <button type="button" class="btn btn-warning">Modificar</button>
            <button type="button" class="btn btn-danger">Borrar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
{{-- END Modal --}}
@endsection