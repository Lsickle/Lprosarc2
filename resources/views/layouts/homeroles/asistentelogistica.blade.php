@php
$SolicitudServicios = DB::table('solicitud_servicios')
	->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
	->where('SolSerDelete', 0)
	->get();
$Recibidas = count($SolicitudServicios->where('SolSerStatus', 'Completado'));
$Concialiadas = count($SolicitudServicios->where('SolSerStatus', 'Conciliado'));

$serviciosnoconciliados = DB::table('solicitud_servicios')
	->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
	->where('SolSerDelete', 0)
	->where('SolSerStatus', 'No Conciliado')
	->orderBy('solicitud_servicios.updated_at', 'asc')
	->limit(5)
	->get();

$Km = DB::table('progvehiculos')
	->select('FK_ProgVehiculo', 'progVehKm', 'ProgVehFecha')
	->where('ProgVehDelete', 0)
	->where('progVehKm', '<>', null)
	->whereBetween('ProgVehFecha', [date('Y-m-d', strtotime("first day of last month")), date('Y-m-d', strtotime("last day of last month"))])
	->orderBy('ProgVehFecha', 'asc')
	->get();
setlocale(LC_ALL, "es_CO.UTF-8");
	
$serviciosnoprocesados = DB::table('solicitud_servicios')
	->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
	->where('SolSerDelete', 0)
	->where('SolSerStatus', 'Completado')
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

				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Kilometraje Mes Pasado</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<canvas id="ChartKilometrajeOld"></canvas>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Servicios pendientes por conciliar</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							@foreach($serviciosnoconciliados as $servicionoconciliado)
								<p style="background-color: #001f3f; color: #fff; padding-top: 15px !important; padding-bottom: 0 !important; text-align: center;" class="external-event ui-draggable ui-draggable-handle servicionoconciliado col-md-12 form-group col-xs-12">
									<a href="/solicitud-servicio/{{$servicionoconciliado->SolSerSlug}}" class="col-md-12 form-group" style="color: white; text-align: center;">{{$servicionoconciliado->CliShortname.' - N°'.$servicionoconciliado->ID_SolSer.' - '.date('Y/m/d', strtotime($servicionoconciliado->updated_at))}}</a>
								</p>
							@endforeach
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Servicios sin procesar</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							@foreach($serviciosnoprocesados as $servicionoprocesado)
								<p style="background-color: #001f3f; color: #fff; padding-top: 15px !important; padding-bottom: 0 !important; text-align: center;" class="external-event ui-draggable ui-draggable-handle servicionoprocesado col-md-12 form-group col-xs-12">
									<a href="/solicitud-servicio/{{$servicionoprocesado->SolSerSlug}}" class="col-md-12 form-group" style="color: white; text-align: center;">{{$servicionoprocesado->CliShortname.' - N°'.$servicionoprocesado->ID_SolSer.' - '.date('Y/m/d', strtotime($servicionoprocesado->updated_at))}}</a>
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
				labels: ['Por Conciliar', 'Conciliadas'],
				datasets: [{
					label: 'N° Solicitudes',
					data: [{{$Recibidas}}, {{$Concialiadas}}],
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