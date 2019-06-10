@extends('layouts.app')
@section('htmlheader_title')
Cotizaciones
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Cotizaciones</h3>
					<a href="/cotizacion/create" class="btn btn-primary" style="float: right;">Crear</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="cotizacionesTable" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Fecha de Solicitud</th>
								<th>Fecha de Respuesta</th>
								<th>Fecha de Vencimiento</th>
								<th>Status</th>
								<th>Dirección</th>
								<th>Municipio</th>
								<th>Cliente</th>
								<th>Celular</th>
								<th>Subtotal</th>
								<th>Total</th>
								<th>Sede Email</th>
								<th>Telefono 1</th>
								<th>Ver Mas</th>
							</tr>
						</thead>
						<tbody hidden onload="renderTable()" id="readyTable">
							@foreach($cotizaciones as $cotizacion)
							<tr @if($cotizacion->CotiDelete === 1)
								style="color: red;"
								@endif
								>
								<td>{{$cotizacion->CotiNumero}}</td>
								<td>{{$cotizacion->CotiFechaSolicitud}}</td>
								<td>{{$cotizacion->CotiFechaRespuesta}}</td>
								<td>{{$cotizacion->CotiFechaVencimiento}}</td>
								<td>{{$cotizacion->CotiStatus}}</td>
								<td>{{$cotizacion->SedeAddress}}</td>
								@if($cotizacion->MunName=='Bogotá D.C.')
									<td>{{$cotizacion->MunName}}</td>
								@else()
									<td>{{$cotizacion->MunName.' - '.$cotizacion->DepartName}}</td>
								@endif
								<td>{{$cotizacion->CliName}}</td>
								<td>{{$cotizacion->SedeCelular}}</td>
								<td>{{$cotizacion->CotiPrecioSubtotal}}</td>
								<td>{{$cotizacion->CotiPrecioTotal}}</td>
								{{-- <td>{{$cotizacion->CotiDelete}}</td> --}}
								<td>{{$cotizacion->SedeEmail}}</td>
								<td>{{$cotizacion->SedePhone1.' - '.$cotizacion->SedeExt1}}</td>
								<td><a method='get' href='/cotizacion/{{$cotizacion->ID_Coti}}/' class='btn btn-primary btn-block'>Mas información</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</div>
@endsection
