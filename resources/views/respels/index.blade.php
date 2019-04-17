@extends('layouts.app')
@section('htmlheader_title', 'Respel')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respellist') }}</h3>
					<a href="respels/create" class="btn btn-primary" style="float: right;">Crear</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="RespelTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Clasificacion 4741</th>
								<th>Peligrosidad</th>
								<th>Estado del residuo</th>
								<th>Hoja de Seguridad</th>
								<th>Tarj de Emergencia</th>
								<th>Estado</th>
								<th>Generado por</th>
								<th>Ver Más...</th>
							</tr>
						</thead>
						<tbody hidden onload="renderTable()" id="readyTable">
							{{-- <h1 id="loadingTable">LOADING...</h1> --}}
							@include('layouts.partials.spinner')
							@foreach($Respels as $respel)
							@if($respel->RespelDelete == 1)
								<tr style="color: red;">
							@else
								<tr>
							@endif
								<td>{{$respel->RespelName}}</td>
								@if($respel->YRespelClasf4741 <> null)
									<td>{{$respel->YRespelClasf4741}}</td>
								@else()
									<td>{{$respel->ARespelClasf4741}}</td>
								@endif
								<td>{{$respel->RespelIgrosidad}}</td>
								<td>{{$respel->RespelEstado}}</td>
								<td>{{$respel->RespelHojaSeguridad}}</td>
								<td>{{$respel->RespelTarj}}</td>
								<td>{{$respel->RespelStatus}}</td>
								<td>{{$respel->CliName}}</td>
								<td>{{$respel->RespelSlug}}</td>
							</tr>
							@endforeach
						</tbody>
						{{-- <tfoot>
						<tr>
							<th>Nombre</th>
							<th>Clasificacion 4741 Y</th>
							<th>Clasificacion 4741 A</th>
							<th>Peligrosidad</th>
							<th>Estado del residuo</th>
							<th>Hoja de Seguridad</th>
							<th>Tarj de Emergencia</th>
							<th>Estado</th>
							<th>Generado por</th>
							<th>Ver Más...</th>
						</tr>
						</tfoot> --}}
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection