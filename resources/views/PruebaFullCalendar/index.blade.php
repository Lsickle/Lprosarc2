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
            left: 'prevYear,nextYear',
            center: 'title',
            right: 'prev,month,agendaWeek,agendaDay,next'
          },
          footer: {
            left: 'prevYear,myCustomButton,nextYear',
            center: 'title',
            right: 'prev,month,agendaWeek,agendaDay,next'
          },
          bootstrapFontAwesome: {
            close: 'fa-times',
            prev: 'fa-chevron-left',
            next: 'fa-chevron-right',
            prevYear: 'fas fa-caret-square-left',
            nextYear: 'fas fa-caret-square-right'
          },
		eventSources:[{
			events: [
				{
					title  : 'event1',
					descripcion: "hola soy la descripcion 1",
					start  : '2019-03-15',
					color: "#ff0f00",
					textColor: "#ffffff"
				},
				{
					title  : 'event2',
					descripcion: "hola soy la descripcion 2",
					start  : '2019-03-15',
					end    : '2019-03-17'
				},
				{
					title  : 'event3',
					descripcion: "hola soy la descripcion 3",
					start  : '2019-03-29T12:30:00',
					allDay : false,
					color: "#fff000",
					textColor: "#000000"
				}
			],
			color: 'black',
			textColor: 'yellow'
		}],
		eventClick: function(event,jsEvent,view){
			$('#titleModal').html(event.title);
			$('#descripModal').html(event.descripcion);
			$('#myModal').modal();
		}
        });
      });
    </script>
@endsection

@section('contentheader_title', 'FullCalendar')

@section('main-content')
	<div class="container">
		<div class="row">
			<div class="col"></div>
			<div class="col-7">
				<div id='calendar'></div>
			</div>
			<div class="col"></div>
		</div>
	</div>
	 {{--  Modal --}}
    <div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          	<h2 class="modal-title" id="titleModal"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div style="font-size: 5em; color: red; text-align: center; margin: auto;">
              <i class="fas fa-exclamation-triangle"></i>
              <span style="font-size: 0.3em; color: black;"><p id="descripModal"></p></span>
            </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success">Agregar</button>
            <button type="button" class="btn btn-warning">Modificar</button>
            <button type="button" class="btn btn-danger">Borrar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

          </div>
        </div>
      </div>
    </div>
{{-- END Modal --}}
@endsection