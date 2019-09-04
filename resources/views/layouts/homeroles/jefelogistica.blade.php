@section('main-content')
	{{-- {{$Km}} --}}
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
							<h3 class="box-title">Calendario</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<a class="docs-sublanding__image" href="/vehicle-programacion/create">
								<img src="/img/CalendarWidget.png" alt="Screenshot: Drag-n-drop external events" style="width: 100%; height: 24rem; border-radius: 5px;">
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Kilometraje Mes Pasado</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<canvas id="ChartKilometrajeOld" height="100"></canvas>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Kilometraje Actual</h3>

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
		var KilometrajeOld = $('#ChartKilometrajeOld');
		var ChartKilometrajeOld1 = new Chart(KilometrajeOld, {
			type: 'line',
			data: {
				labels: [
						@for($i = 0; $i < date('t', strtotime('last month')); $i++)
							{{($i+1)}},
						@endfor
				],
				datasets: [
				@foreach($Vehiculos as $Vehiculo)
					@php
						$Kr = $Km->where('FK_ProgVehiculo', $Vehiculo->ID_Vehic);
						$r = rand(0, 256);
						$g = rand(0, 256);
						$b = rand(0, 256);
					@endphp
					{
						label: '{{$Vehiculo->VehicPlaca}}',
						borderColor: 'rgb({{$r}},{{$g}},{{$b}})',
						backgroundColor: 'rgb({{$r}},{{$g}},{{$b}})',
						fill: false,
						data: [
							@foreach($Kr as $Kv)
								{x: ({{date('d', strtotime($Kv->ProgVehFecha))}}), y: ({{$Kv->progVehKm}})},
							@endforeach
						],
						steppedLine: true,
						pointRadius: 5,
						pointHoverRadius: 7,
					},
				@endforeach
				],
			},
			options: {
				responsive: true,
				title: {
					display: true,
					fontSize: 20,
					text: '{{strftime("%B", strtotime($Km[0]->ProgVehFecha))}}'
				},
				legend: {
					position: 'top',
					display: true,
					labels: {
						usePointStyle: true,
						fontSize: 11
					},
				},
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
						{y:({{$Vehiculo->VehicKmActual}})},
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