@extends('layouts.app')
@section('htmlheader_title')
{{trans('adminlte_lang::message.vehicletitle')}}
@endsection
@section('contentheader_title')
{{trans('adminlte_lang::message.vehicletitle')}}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Lista de vehiculos</h3>
					<a href="/vehicle/create" class="btn btn-primary" style="float: right;">Crear</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="VehicleTable" class="table table-compact table-bordered table-striped">
						<thead>
								<tr>
									<th>Placa</th>
									<th>Tipo</th>
									<th>Capacidad</th>
									<th>Km Actual</th>
									<th>Sede</th>
									<th>Fecha Registrado</th>
									<th>Editar</th>
								</tr>
						</thead>
						<tbody id="readyTable">
							@foreach ($Vehicles as $Vehicle)
								<tr @if($Vehicle->VehicDelete === 1)
											style="color: red;"
										@endif
								>
									<td>{{$Vehicle->VehicPlaca}}</td>
									<td>{{$Vehicle->VehicTipo}}</td>
									<td>{{$Vehicle->VehicCapacidad}} kg</td>
									<td>{{$Vehicle->VehicKmActual}}</td>
									<td>{{$Vehicle->SedeName}}</td>
									<td>{{$Vehicle->created_at}}</td>
									<td><a href='/vehicle/{{$Vehicle->VehicPlaca}}/edit' class='btn btn-warning btn-block'>Edit</a></td>
								</tr>
							@endforeach
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection