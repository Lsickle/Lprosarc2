@php
$Pendientes = count($SolicitudServicios->where('SolSerStatus', 'Pendiente'));
$Aprobadas = count($SolicitudServicios->where('SolSerStatus', 'Aprobado'));
$Programadas = count($SolicitudServicios->where('SolSerStatus', 'Programado'));
$Recibidas = count($SolicitudServicios->where('SolSerStatus', 'Completado'));
$Concialiadas = count($SolicitudServicios->where('SolSerStatus', 'Conciliado'));
$Tratadas = count($SolicitudServicios->where('SolSerStatus', 'Tratado'));
$Certificadas = count($SolicitudServicios->where('SolSerStatus', 'Certificacion'));

$serviciosnoprogramados = DB::table('solicitud_servicios')
	->where('SolSerDelete', 0)
	->where('SolSerStatus', 'Aprobado')
	->orderBy('updated_at', 'asc')
	->limit(5)
	->get();
@endphp
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Solicitudes de Servicio</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<canvas id="ChartSolSer"></canvas>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Kilometraje</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<canvas id="ChartKilometraje"></canvas>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Calendario</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<a class="docs-sublanding__image" href="/vehicle-programacion/create">
								<img src="/img/CalendarWidget.png" alt="Screenshot: Drag-n-drop external events" style="width: 100%; height: 27rem; border-radius: 5px;">
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Servicios pendientes por programar</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							@foreach($serviciosnoprogramados as $servicionoprogramado)
								<p style="background-color: #001f3f; color: #fff; padding-top: 15px !important; padding-bottom: 0 !important; text-align: center;" class="external-event ui-draggable ui-draggable-handle servicionoprogramado col-md-12 form-group col-xs-12">
									<a href="/solicitud-servicio/{{$servicionoprogramado->SolSerSlug}}" class="col-md-12 form-group" style="color: white; text-align: center;">{{date('Y/m/d', strtotime($servicionoprogramado->updated_at)).' - N°'.$servicionoprogramado->ID_SolSer}}</a>
								</p>
							@endforeach
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection
@section('NewScript')
	<script type="text/javascript">
		var CSolSer = $('#ChartSolSer');
		var ChartSolSer = new Chart(CSolSer, {
			type: 'doughnut',
			data: {
				labels: ['Pendientes', 'Programadas'],
				datasets: [{
					label: 'N° Solicitudes',
					data: [{{$Aprobadas}}, {{$Programadas}}],
					backgroundColor: [
						'rgba(86, 86, 86, 0.2)',
						'rgba(0, 213, 252, 0.2)',
					],
					borderColor: [
						'rgba(86, 86, 86, 1)',
						'rgba(0, 213, 252, 1)',
					],
					hoverBackgroundColor: [
						'rgba(86, 86, 86, 1)',
						'rgba(0, 213, 252, 1)',
					],
					borderWidth: 1
				}],
			},
			options: {
				responsive: true,
				legend: {
					position: 'left', 
					display: true,
					labels: {
						usePointStyle: true,
						fontSize: 11
					}
				}
			}
		});
	</script>
	<script type="text/javascript">
		var Kilometraje = $('#ChartKilometraje');
		var ChartKilometraje = new Chart(Kilometraje, {
			type: 'bar',
			data: {
					labels: [
						@foreach($Vehiculos as $Vehiculo)
						'{{$Vehiculo->VehicPlaca}}',
						@endforeach
					],
				datasets: [{
					label: 'Kilometraje',
					data: [
						@foreach($Vehiculos as $Vehiculo)
						{y:{{$Vehiculo->VehicKmActual}}},
						@endforeach
					],
					backgroundColor: [
						'rgba(86, 86, 86, 0.2)',
						'rgba(0, 213, 252, 0.2)',
						'rgba(255, 255, 0, 0.2)',
						'rgba(255, 108, 0, 0.2)',
						'rgba(149, 15, 182, 0.2)',
					],
					borderColor: [
						'rgba(86, 86, 86, 1)',
						'rgba(0, 213, 252, 1)',
						'rgba(255, 255, 0, 1)',
						'rgba(255, 108, 0, 1)',
						'rgba(149, 15, 182, 1)',
					],
					hoverBackgroundColor: [
						'rgba(86, 86, 86, 1)',
						'rgba(0, 213, 252, 1)',
						'rgba(255, 255, 0, 1)',
						'rgba(255, 108, 0, 1)',
						'rgba(149, 15, 182, 1)',
					],
					borderWidth: 1
				}],
			},
			options: {
				responsive: true,
				legend: {
					position: 'left', 
					display: false,
					labels: {
						usePointStyle: true,
						fontSize: 11
					}
				}
			}
		});
	</script>
@endsection