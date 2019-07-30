@php
$SolicitudServicios = DB::table('solicitud_servicios')
	->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
	->join('progvehiculos', 'solicitud_servicios.ID_SolSer', '=', 'progvehiculos.FK_ProgServi')
	->where('SolSerDelete', 0)
	->where('ProgVehDelete', 0)
	->get();
$Pendientes = count($SolicitudServicios->where('SolSerStatus', 'Pendiente'));
$Aprobadas = count($SolicitudServicios->where('SolSerStatus', 'Aprobado'));
$Programadas = count($SolicitudServicios->where('SolSerStatus', 'Programado'));
$Recibidas = count($SolicitudServicios->where('SolSerStatus', 'Completado'));
$Concialiadas = count($SolicitudServicios->where('SolSerStatus', 'Conciliado'));
$Tratadas = count($SolicitudServicios->where('SolSerStatus', 'Tratado'));
$Certificadas = count($SolicitudServicios->where('SolSerStatus', 'Certificacion'));

$ProgramacionesHoy = $SolicitudServicios->where('ProgVehFecha', '=', date('Y-m-d', strtotime(now())));
$ProgramacionesMañana = $SolicitudServicios->where('ProgVehFecha', '=', date('Y-m-d', strtotime(now()."+1 day")));

$serviciosnoprogramados = DB::table('solicitud_servicios')
	->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
	->where('SolSerDelete', 0)
	->where('SolSerStatus', 'Aprobado')
	->orderBy('solicitud_servicios.updated_at', 'asc')
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
									<a href="/solicitud-servicio/{{$servicionoprogramado->SolSerSlug}}" class="col-md-12 form-group" style="color: white; text-align: center;">{{$servicionoprogramado->CliShortname.' - N°'.$servicionoprogramado->ID_SolSer.' - '.date('Y/m/d', strtotime($servicionoprogramado->updated_at))}}</a>
								</p>
							@endforeach
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Servicios programados para hoy</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							@foreach($ProgramacionesHoy as $ProgramacionHoy)
								<p style="background-color: #001f3f; color: #fff; padding-top: 15px !important; padding-bottom: 0 !important; text-align: center;" class="external-event ui-draggable ui-draggable-handle servicionoprogramado col-md-12 form-group col-xs-12">
									<a href="/solicitud-servicio/{{$ProgramacionHoy->SolSerSlug}}" class="col-md-12 form-group" style="color: white; text-align: center;">{{$ProgramacionHoy->CliShortname.' - N°'.$ProgramacionHoy->ID_SolSer.' - '.date('Y/m/d', strtotime($ProgramacionHoy->updated_at))}}</a>
								</p>
							@endforeach
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Servicios programados para mañana</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							@foreach($ProgramacionesMañana as $ProgramacionMañana)
								<p style="background-color: #001f3f; color: #fff; padding-top: 15px !important; padding-bottom: 0 !important; text-align: center;" class="external-event ui-draggable ui-draggable-handle servicionoprogramado col-md-12 form-group col-xs-12">
									<a href="/solicitud-servicio/{{$ProgramacionMañana->SolSerSlug}}" class="col-md-12 form-group" style="color: white; text-align: center;">{{$ProgramacionMañana->CliShortname.' - N°'.$ProgramacionMañana->ID_SolSer.' - '.date('Y/m/d', strtotime($ProgramacionMañana->updated_at))}}</a>
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