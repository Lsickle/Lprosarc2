@extends('layouts.app')
@section('htmlheader_title')
Articulos
@endsection
@section('contentheader_title')
Articulos por Proveedor
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos</h3>
					@component('layouts.partials.modal')
						{{$ArtProvs->ID_ArtiProve}}
					@endcomponent
					@if($ArtProvs->ArtDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$ArtProvs->ID_ArtiProve}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/articulos-proveedor/{{$ArtProvs->ID_ArtiProve}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$ArtProvs->ID_ArtiProve}}" style="display: none;">
						</form>
					@else
						<form action='/articulos-proveedor/{{$ArtProvs->ID_ArtiProve}}' method='POST' style="float: right;">
						@method('DELETE')
						@csrf
						<input type="submit" class='btn btn-success btn-block' value="Añadir">
						</form>
					@endif
					{{-- <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div> --}}
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- form start -->
							<form role="form" action="/articulos-proveedor/{{$ArtProvs->ID_ArtiProve}}" method="POST" enctype="multipart/form-data">
								@method('PUT')
								@csrf
								<div class="col-md-6">
									<label for="articuloxprov">Numero de Cotizacion</label>
									<select class="form-control" id="articuloxprov" name="FK_ArtCotiz" required>
										<option value="{{$ArtProvs->FK_ArtCotiz}}">{{$Quotation->CotizNum}}</option>
										@foreach ($Quotations as $Quotation)
											<option value="{{$Quotation->ID_Cotiz}}">{{$Quotation->CotizNum}}</option>
										@endforeach	
									</select>
								</div>
								<div class="col-md-6">
									<label for="articuloxprov0">Activos</label>
									<select class="form-control" id="articuloxprov0" name="FK_ArtiActiv" required>
										<option value="{{$ArtProvs->FK_ArtiActiv}}">{{$Activo->ActName}}</option>
										@foreach ($Activos as $Activo)
											<option value="{{$Activo->ID_Act}}">{{$Activo->ActName}}</option>
										@endforeach	
									</select>
								</div>
								<div class="col-md-6">
									<label for="articuloxprov1">Forma del articulo</label>
									<select class="form-control" id="articuloxprov1" name="ArtiUnidad" required>
										@if ($ArtProvs->ArtiUnidad == 0)
											<option value="0">Unidad</option>
											<option value="1">Peso</option>
										@else
											<option value="1">Peso</option>
											<option value="0">Unidad</option>
										@endif
									</select>
								</div>
								<div class="col-md-6">
									<label for="articuloxprovinputext1">Cantidad</label>
									<input type="number" class="form-control" id="articuloxprovinputext1" placeholder="988888" name="ArtiCant" value="{{$ArtProvs->ArtiCant}}" max="999999" required>
								</div>
								<div class="col-md-6">
									<label for="articuloxprovinputext2">Precio</label>
									<input type="text" class="form-control" id="articuloxprovinputext2" placeholder="150000" name="ArtiPrecio" value="{{$ArtProvs->ArtiPrecio}}" required>
								</div>
								<div class="col-md-6">
									<label for="articuloxprovinputext3">Articulo costo por unidad </label>
									<input type="number" class="form-control" id="articuloxprovinputext3" placeholder="12345" name="ArtiCostoUnid" value="{{$ArtProvs->ArtiCostoUnid}}" max="9999999" required>
								</div>
								<div class="col-md-6">
									<label for="articuloxprovinputext4">Cantidad Minima de compra</label>
									<input type="number" class="form-control" id="articuloxprovinputext4" placeholder="23456" name="ArtiMinimo" value="{{$ArtProvs->ArtiMinimo}}" max="9999999" required>
								</div>

								<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
									<div class="icheck form-group">
										<label for="inputcheck">
											Autorizar
										</label>
										<input id="inputcheck" type="checkbox" name="FK_AutorizedBy">
									</div>
								</div>
								<div class="col-md-12">		
									<div class="box-footer" style="float:right; margin-right:5%">
										<button type="submit" class="btn btn-primary">Registrar</button>
									</div>	
								</div>
							</form>
						</div>
					</div>
				</div>	
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection