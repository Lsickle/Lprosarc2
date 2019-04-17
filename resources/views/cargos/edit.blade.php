@extends('layouts.app')
@section('htmlheader_title','Cargos')
@section('contentheader_title','Edición de Cargos')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
					@component('layouts.partials.modal')
						{{$Cargos->ID_Carg}}
					@endcomponent
					<h3 class="box-title">Datos del mantenimiento</h3>
					@if($Cargos->CargDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cargos->ID_Carg}}' class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/cargos/{{$Cargos->ID_Carg}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$Cargos->ID_Carg}}" style="display: none;">
						</form>
					@else
						<form action='/cargos/{{$Cargos->ID_Carg}}' method='POST' style="float: right;">
							@method('DELETE')
							@csrf
							<input type="submit" class='btn btn-success btn-block' value="Añadir">
						</form>
					@endif
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- form start -->
							<form role="form" action="/cargos/{{$Cargos->ID_Carg}}" method="POST" enctype="multipart/form-data">
								@method('PATCH')
								@csrf
								<div class="box-body">
									<div class="col-xs-6">
										<label for="NombreCargo">Nombre del Cargo</label>
										<input required="true" name="NomCarg" autofocus="true" type="text" class="form-control" id="NombreCargo" value="{{$Cargos->CargName}}">
									</div>
									<div class="col-xs-6">
										<label for="CargoSalary">Salario del Cargo ($)</label>
										<input required="true" name="CargSalary" autofocus="true" type="number" class="form-control" id="CargoSalary" value="{{$Cargos->CargSalary}}">
									</div>
									<div class="col-xs-6">
										<label for="CargoGrade">Grado del Cargo</label>
										<select name="CargGrade" id="CargoGrade" class="form-control">
											<option value="{{$Cargos->CargGrade}}">Seleccione...</option>
											<option value="Bachiller">Bachiller</option>
											<option value="Tecnico">Tecnico</option>
											<option value="Tecnologo">Tecnologo</option>
											<option value="Profesional">Profesional</option>
										</select>
									</div>
									<div class="col-xs-6">
										<label for="AreaSelect">Área</label>
										<select name="SelectArea" id="AreaSelect" class="form-control">
											<option value="{{$Cargos->CargArea}}">Seleccione...</option>
											@foreach($Areas as $Area)
												<option value="{{$Area->ID_Area}}">{{$Area->AreaName}}</option>
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
