@extends('layouts.app')
@section('htmlheader_title')
Lista de Tratamientos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Lista de Tratamientos</h3>
					<a href="/tratamiento/create" class="btn btn-primary" style="float: right;">Crear</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="tratamientosTable" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Tipo</th>
								<th>Proveedor</th>
								<th>Nombre</th>
								<th>Pretratamiento</th>
								<th>Dirección</th>
								<th>Ver Mas</th>
							</tr>
						</thead>
						<tbody hidden onload="renderTable()" id="readyTable">
							@include('layouts.partials.spinner')
							@foreach($tratamientos as $tratamiento)
							<tr @if($tratamiento->TratDelete === 1)
								style="color: red;"
								@endif
								>
								<td>{{$tratamiento->ID_Trat}}</td>
								@if($tratamiento->TratTipo=='1')
								<td>Interno</td>
								@else
								<td>Externo</td>
								@endif
								<td>{{$tratamiento->CliShortname}}</td>
								<td>{{$tratamiento->TratName}}</td>
								<td>{{$tratamiento->TratPretratamiento}}</td>
								<td>{{$tratamiento->SedeAddress}}</td>
								<td>{{$tratamiento->ID_Trat}}</td>
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
