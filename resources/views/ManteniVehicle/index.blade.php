@extends('layouts.app')
@section('htmlheader_title', 'Registro')
@section('contentheader_title')
{{ trans('adminlte_lang::message.sclientregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Mantenimiento</h3>
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
										<label for="mantenputext0">Km ultimo mantenimiento</label>
										<input type="number" class="form-control" id="mantenputext0" placeholder="999999" name="km" max="999999">
									</div>
									<div class="col-md-6">
										<label for="mantenputext1">Cambio de Aceite</label>
										<input type="date" class="form-control" id="mantenputext1" name="aceite">
									</div>
									<div class="col-md-6">
										<label for="manteinputext2">Fecha ultima tecnico mecanica</label>
										<input type="date" class="form-control" id="manteinputext2" name="tecmecanica" maxlength="16">
									</div>
									<div class="col-md-6">
										<label for="manteinputext3">Tanqueo</label>
										<input type="date" class="form-control" id="manteinputext3" name="Tanqueo">
									</div>
									<div class="col-md-6">
										<label for="manteinputext4">Cantida de tanqueo</label>
										<input type="number" class="form-control" id="manteinputext4" placeholder="100098" name="cantidad" required="true" max="999999">
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