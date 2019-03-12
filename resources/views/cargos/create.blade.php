@extends('layouts.app')
@section('htmlheader_title','Cargos')
@section('contentheader_title','Registro de Cargos')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- form start -->
							<form role="form" action="/cargos" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="col-xs-6">
										<label for="NombreCargo">Nombre del Cargo</label>
										<input required="true" name="NomCarg" autofocus="true" type="text" class="form-control" id="NombreCargo" >
									</div>
									<div class="col-xs-6">
										<label for="CargoSalary">Salario del Cargo ($)</label>
										<input required="true" name="CargSalary" autofocus="true" type="number" class="form-control" id="CargoSalary" >
									</div>
									<div class="col-xs-6">
										<label for="CargoGrade">Grado del Cargo</label>
										<select name="CargGrade" id="CargoGrade" class="form-control">
											<option value="Bachiller">Bachiller</option>
											<option value="Tecnico">Tecnico</option>
											<option value="Tecnologo">Tecnologo</option>
											<option value="Profesional">Profesional</option>
										</select>
									</div>
									<div class="col-xs-6" style="padding-left: 0; ">
										<label for="AreaSelect">Area</label>
										<select name="SelectArea" id="AreaSelect" class="form-control">
											@foreach($Areas as $Area)
												<option value="{{$Area->ID_Area}}">{{$Area->AreaName}}</option>
											@endforeach
										</select>
									</div>
								</div>	
								<div class="box-footer" style="float:right; margin-right:5%">
									<button type="submit" class="btn btn-primary">Registrar</button>
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
