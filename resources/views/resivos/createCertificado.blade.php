@extends('layouts.app')
@section('htmlheader_title')
Certificado
@endsection
@section('contentheader_title')
Nuevo Certificado
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos</h3>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/resivos" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="col-md-6">
										<label for="CertiEspName">Nombre del Atributo (Opcional)</label>
										<input type="text" class="form-control" id="programnputext1" name="nombre" placeholder="Nombre del Atributo">
									</div>
									<div class="col-md-6">
										<label for="programnputext3">Valor del Atributo (Opcional)</label>
										<input type="number" class="form-control" id="programnputext3" name="valor" placeholder="734733" max="999999999">
									</div>
									<div class="col-md-6">
										<label for="programnputext4">Observaciones</label>
										<input type="text" class="form-control" id="programnputext4"  name="Observacion" placeholder="Observaciones">
                                    </div>
									<div class="col-md-6">
										<label for="FK_CertSolser">Solicitud de Servicio</label>
										<select name="FK_CertSolser" id="FK_CertSolser" class="form-control">
											<option value="1">Seleccione...</option>
											@foreach($solicitudes as $solicitud)
												<option value="{{$solicitud->ID_SolSer}}">{{$solicitud->ID_SolSer}}</option>
											@endforeach
										</select>
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