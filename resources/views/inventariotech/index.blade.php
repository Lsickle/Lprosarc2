@extends('layouts.app')

@section('htmlheader_title','InventarioTech')

@section('contentheader_title', 'InventarioTechnoligy')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<!-- /.box -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Inventario de tecnologia</h3>
						<a href="/inventariotech/create" class="btn btn-primary" style="float: right;">Crear</a>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="InventarioTechTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
								<th>Nombre</th>
								<th>Modelo</th>
								<th>Sistema Operativo</th>
								<th>Observaciones</th>
								<th>Ver más..</th>
								</tr>
							</thead>
							<tbody  hidden onload="renderTable()" id="readyTable">
								@foreach($Inventarios as $Inventario)
								<tr>
									<td>{{$Inventario->PersFirstName." ".$Inventario->PersLastName}}</td>
									<td>{{$Inventario->TecnBrand}}</td>
									<td>{{$Inventario->TecnOs}}</td>
									<td>{{$Inventario->Tecnobserv}}</td>
									<td><a method='get' href='/inventariotech/{{$Inventario->ID_Tecn}}' class='btn btn-success'/>Ver</a></td>
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
