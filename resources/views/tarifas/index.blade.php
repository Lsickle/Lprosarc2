@extends('layouts.app')
@section('htmlheader_title')
Lista de Tarifas
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Lista de Tarifas</h3>
					<a href="/tarifas/create" class="btn btn-primary" style="float: right;">Crear</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="tarifasTable" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Unidad 1</th>
								<th>Rango 1</th>
								<th>Precio 1</th>
								<th>Unidad 2</th>
								<th>Rango 2</th>
								<th>Precio 2</th>
								<th>Unidad 3</th>
								<th>Rango 3</th>
								<th>Precio 3</th>
								<th>Ver mas</th>
							</tr>
						</thead>
						<tbody id="readyTable">
							@foreach($tarifas as $tarifa)
							<tr @if($tarifa->TarifaDelete === 1) style="color: red;" @endif>
								<th>{{$tarifa->ID_Tarifa}}</th>
								<th>{{$tarifa->TarifaTipounidad1}}</th>
								<th>{{$tarifa->TarifaPesoinicial1}}/{{$tarifa->TarifaPesofinal1}}</th>
								<th>{{$tarifa->TarifaPrecio1}}</th>
								<th>{{$tarifa->TarifaTipounidad2}}</th>
								<th>{{$tarifa->TarifaPesoinicial2}}/{{$tarifa->TarifaPesofinal2}}</th>
								<th>{{$tarifa->TarifaPrecio2}}</th>
								<th>{{$tarifa->TarifaTipounidad3}}</t>
								<th>{{$tarifa->TarifaPesoinicial3}}/{{$tarifa->TarifaPesofinal3}}</th>
								<th>{{$tarifa->TarifaPrecio3}}</th>
								<th>{{$tarifa->ID_Tarifa}}</th>
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
