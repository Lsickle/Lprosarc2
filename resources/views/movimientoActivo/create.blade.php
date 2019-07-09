@extends('layouts.app')
@section('htmlheader_title')
Movimientos
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
							<form role="form" action="/movimiento-activos" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="col-md-12">
									<label for="moviminetoActivo">Tipo de Movimiento</label>
									<select class="form-control" id="moviminetoActivo" name="MovTipo" required>
										<option value="">Seleccione...</option>
										<option>Entrada</option>
										<option>Salida</option>
										<option>Asignar</option>
									</select>
								</div>
								<div class="col-md-12">
									<label for="moviminetoActivo1">Nombre del Activo</label>
									<select class="form-control" id="moviminetoActivo1" name="FK_MovInv" required>
										<option  value="">Seleccione...</option>
										@foreach ($Activos as $Activo)
											 <option value="{{$Activo->ID_Act}}">{{$Activo->ActName}}</option>																
										@endforeach
									</select>
                                </div>
                                <div class="col-md-12">
									<label for="moviminetoActivo2">Asignado A</label>
									<select class="form-control" id="moviminetoActivo2" name="FK_ActPerson">
										<option  value="">Seleccione...</option>
										@foreach ($Personales as $Personal)
											 <option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName}} ({{$Personal->CargName}})</option>																
										@endforeach
									</select>
								</div>
                                <div class="col-md-12">		
									<div class="box-footer" style="float:right; margin-right:5%">
										<button type="submit" class="btn btn-success">Registrar</button>
									</div>	
                                </div>
                            </form>
						</div>
                    </div>	
                </div>	
			</div>
		</div>
	</div>
</div>
@endsection