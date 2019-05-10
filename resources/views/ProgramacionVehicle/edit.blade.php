@extends('layouts.app')
@section('htmlheader_title')
Programacion
@endsection
@section('contentheader_title')
{{-- {{ trans('adminlte_lang::message.sclientregistertittle') }} --}}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Programacion</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/vehicle" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									
									<div class="col-md-6">
										<label for="programnputext0">Km inicio del día</label>
										<input type="number" class="form-control" id="programnputext0" placeholder="999999" name="km" max="999999">
									</div>
									<div class="col-md-6">
										<label for="programnputext1">Fecha Programación</label>
										<input type="date" class="form-control" id="programnputext1" name="date">
									</div>
									<div class="col-md-6">
										<label for="programnputoption1">Turno</label>
										<select class="form-control" id="programnputoption1" placeholder="Funza" name="Turno" required="true">
											<option>Seleccione...</option>
											<option>Día</option>
											<option>Tarde</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="program">Tipo</label>
										<select class="form-control" id="program" placeholder="Funza" name="Tipo" required="true">											
											<option>Seleccione...</option>
											<option>En Mantenimiento</option>
											<option>Usando</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="programnputoption2">Feriado</label>
										<select class="form-control" id="programnputoption2" name="Feriado" required="true">
											<option>Festivo</option>
											<option>Domingos</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="programnputext3">Hora de llegada a planta</label>
										<input type="text" class="form-control" id="programnputext3" name="Llegada">
									</div>
									<div class="col-md-6">
										<label for="programnputext4">Hora de salida de planta</label>
										<input type="text" class="form-control" id="programnputext4"  name="Salida">
									</div>
									
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Registrar</button>
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