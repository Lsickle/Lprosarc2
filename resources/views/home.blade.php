@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Home</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						{{ trans('adminlte_lang::message.logged') }}. Comienza creandote una aplicacion increible!
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
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
		</div>
	</div>
@endsection
@section('NewScript')
	<script type="text/javascript">
		var CSolSer = $('#ChartSolSer');
		var ChartSolSer = new Chart(CSolSer, {
			type: 'doughnut',
			data: {
				labels: ['Pendientes {{$Pendientes}}', 'Aprobadas {{$Aprobadas}}', 'Programadas {{$Programadas}}', 'Recibidas {{$Recibidas}}', 'Concialiadas {{$Concialiadas}}', 'Tratadas {{$Tratadas}}', 'Certificadas {{$Certificadas}}'],
				datasets: [{
					label: 'No Solicitudes',
					data: [{{$Pendientes}}, {{$Aprobadas}}, {{$Programadas}}, {{$Recibidas}}, {{$Concialiadas}}, {{$Tratadas}}, {{$Certificadas}}],
					backgroundColor: [
						'rgba(86, 86, 86, 0.2)',
						'rgba(0, 213, 252, 0.2)',
						'rgba(255, 255, 0, 0.2)',
						'rgba(255, 108, 0, 0.2)',
						'rgba(149, 15, 182, 0.2)',
						'rgba(255, 0, 0, 0.2)',
						'rgba(0, 255, 0, 0.2)'
					],
					borderColor: [
						'rgba(86, 86, 86, 1)',
						'rgba(0, 213, 252, 1)',
						'rgba(255, 255, 0, 1)',
						'rgba(255, 108, 0, 1)',
						'rgba(149, 15, 182, 1)',
						'rgba(255, 0, 0, 1)',
						'rgba(0, 255, 0, 1)'
					],
					hoverBackgroundColor: [
						'rgba(86, 86, 86, 1)',
						'rgba(0, 213, 252, 1)',
						'rgba(255, 255, 0, 1)',
						'rgba(255, 108, 0, 1)',
						'rgba(149, 15, 182, 1)',
						'rgba(255, 0, 0, 1)',
						'rgba(0, 255, 0, 1)'
					],
					borderWidth: 1
				}]
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
@endsection