@extends('layouts.app')
@section('htmlheader_title', 'Mantenimiento')
@section('contentheader_title', 'Edicion de Mantenimientos')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
					@component('layouts.partials.modal')
                    	{{$MantVehicles->ID_Mv}}
					@endcomponent
		          <h3 class="box-title">Datos del mantenimiento</h3>
		          @if($MantVehicles->MvDelete === 0)
                    <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$MantVehicles->ID_Mv}}' class='btn btn-danger' style="float: right;">Eliminar</a>
                    <form action='/vehicle-mantenimiento/{{$MantVehicles->ID_Mv}}' method='POST'>
                      @method('DELETE')
                      @csrf
                      <input  type="submit" id="Eliminar{{$MantVehicles->ID_Mv}}" style="display: none;">
                    </form>
                  @else
                    <form action='/vehicle-mantenimiento/{{$MantVehicles->ID_Mv}}' method='POST' style="float: right;">
                      @method('DELETE')
                      @csrf
                      <input type="submit" class='btn btn-success ' value="Añadir">
                    </form>
                  @endif
		        </div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/vehicle-mantenimiento/{{$MantVehicles->ID_Mv}}" method="POST" enctype="multipart/form-data">
								@method('PUT')
								@csrf
								<div class="box-body">
									<div class="col-md-6">
										<label for="FK_VehMan">Vehiculo</label>
										<select name="FK_VehMan" id="FK_VehMan" class="form-control">
											<option value="{{$MantVehicles->FK_VehMan}}">Seleccione...</option>
											@foreach($Vehicles as $Vehicle)
												<option value="{{$Vehicle->ID_Vehic}}">{{$Vehicle->VehicPlaca}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="MvKm">Kilometraje</label>
										<input type="number" required="true" class="form-control" id="MvKm" name="MvKm" max="999999" value="{{$MantVehicles->MvKm}}">
									</div>
									<div class="col-md-6">
										<label for="HoraMavInicio">Fecha Inicio</label>
										<input type="text" required="true" class="form-control" id="HoraMavInicio" name="HoraMavInicio" value="{{$MantVehicles->HoraMavInicio}}">
									</div>
									<div class="col-md-6">
										<label for="HoraMavFin">Fecha Fin</label>
										<input type="text" required="true" class="form-control" id="HoraMavFin" name="HoraMavFin" value="{{$MantVehicles->HoraMavFin}}">
									</div>
									<div class="col-md-6">
										<label for="MvType">Tipo de mantenimiento</label>
										<select name="MvType" id="MvType" class="form-control">
											<option value="{{$MantVehicles->MvType}}">Seleccione...</option>
											<option value="Aceite">Aceite</option>
											<option value="Tecnomecanica">Tecno-mecánica</option>
											<option value="Tanqueo">Tanqueo</option>
											<option value="Otro">Otro</option>
										</select>
									</div>
									
								</div>
								<!-- /.box-body -->
								<div class="box-footer" style="float:right; margin-right:5%">
									<button type="submit" class="btn btn-primary">Actualizar</button>
								</div>
							</form>
						</div>
						<!-- /.box -->
					</div>
					</div>
					</div>
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