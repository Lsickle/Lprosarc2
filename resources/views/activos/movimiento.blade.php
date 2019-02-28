@extends('layouts.app')
@section('htmlheader_title')
Movimiento de Activos
@endsection
@section('contentheader_title')
Registros de Movimiento de Activos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos</h3>
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
							<form role="form" action="/activos" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="col-md-6">
									<label for="activo">Tipo de Movimiento</label>
									<select class="form-control" id="activo" name="tipo" required="true">
										<option>Seleccione...</option>
										<option>Entrada</option>
										<option>Salida</option>
										<option>Asignacion</option>
									</select>
								</div>
							{{-- </div> --}}
								<div class="col-md-6">
									<label for="activo">Nombre del Activo</label>
									<select class="form-control" id="activo" name="nombre" required="true">
										<option>Seleccione...</option>
										@foreach ($Movimientos as $Movimiento)
											 <option value="{{$Movimiento->ID_Act}}">{{$Movimiento->ActName}}</option>																
										@endforeach
									</select>
                                </div>
                                <div class="col-md-6">
									<label for="activo">Asignado A</label>
									<select class="form-control" id="activo" name="nombre" required="true">
										<option>Seleccione...</option>
										@foreach ($MovimientosAct as $MovimientoAct)
											 <option value="{{$MovimientoAct->ID_Pers}}">{{$MovimientoAct->PersFirstName}}      ({{$MovimientoAct->CargName}})</option>																
										@endforeach
									</select>
								</div>
								<div class="container-fluid spark-screen">
									<div class="row">			
										<div class="box-footer" style="float:right; margin-right:5%">
											<button type="submit" class="btn btn-primary">Registrar</button>
										</div>	
							<!-- /.box-body -->
									</div>
								</div>					
                            </form>
							<!-- /.box -->
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