@extends('layouts.app')

@section('htmlheader_title','Capacitaciones')

@section('contentheader_title', 'Capacitaciones')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<!-- /.box -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Lista de capacitaciones</h3>
						<a href="/capacitacion/create" class="btn btn-primary" style="float: right;">Crear</a>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="TrainingsTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Editar</th>
								</tr>
							</thead>
							<tbody  hidden onload="renderTable()" id="readyTable">
								@foreach($Trainings as $Training)
								<tr @if($Training->CapaDelete === 1)
											style="color: red;" 
										@endif
								>
									<td>{{$Training->CapaName}}</td>
									@if($Training->CapaTipo == 1)
										<td>Interno</td>
									@else
										<td>Externo</td>
									@endif
									<td><a method='get' href='/capacitacion/{{$Training->ID_Capa}}/edit' class='btn btn-warning btn-block'>Editar</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
@endsection