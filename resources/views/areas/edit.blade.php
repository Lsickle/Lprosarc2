@extends('layouts.app')
@section('htmlheader_title','Areas')
@section('contentheader_title','Edicion de Areas')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
	                @component('layouts.partials.modal')
	                    {{$Areas->ID_Area}}
	                @endcomponent
					<h3 class="box-title">Datos de la area </h3>
					@if($Areas->AreaDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Areas->ID_Area}}' class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/areas/{{$Areas->ID_Area}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$Areas->ID_Area}}" style="display: none;">
						</form>
					@else
						<form action='/areas/{{$Areas->ID_Area}}' method='POST' style="float: right;">
							@method('DELETE')
							@csrf
							<input type="submit" class='btn btn-success' value="Añadir">
						</form>
					@endif
                </div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<form role="form" action="/areas/{{$Areas->ID_Area}}" method="POST" enctype="multipart/form-data">
								@method('PATCH')
								@csrf
								<div class="box-body">
									<div class="col-xs-6">
										<label for="NombreArea">Nombre Area</label>
										<input required="true" name="NomArea" autofocus="true" type="text" class="form-control" id="NombreArea" value="{{$Areas->AreaName}}">
									</div>
									<div class="col-xs-6" style="padding-left: 0; ">
										<label for="SedeSelect">Sede</label>
										<select name="AreaSede" id="SedeSelect" class="form-control">
											<option value="{{$Areas->FK_AreaSede || $Areas->FK_GenerSede}}">Seleccione...</option>
											@foreach($Sedes as $Sede)
												<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
											@endforeach
										</select>
									</div>
								</div>	
								<div class="box-footer" style="float:right; margin-right:5%">
									<button type="submit" class="btn btn-primary">Actualizar</button>
								</div>
							</form>
						</div>
						<!-- /.box -->
					</div>
					<!-- /.box-body -->
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
