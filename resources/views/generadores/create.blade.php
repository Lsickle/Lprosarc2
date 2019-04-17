@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangGenerador.SGenerregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangGenerador.SGenerregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::LangGenerador.basicinfo') }}</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						{{-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button> --}}
					</div>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title">{{ trans('adminlte_lang::LangGenerador.complete') }}</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/generadores" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="col-xs-6">
										<label for="GenerInputNit">NIT</label>
										<input minlength="17" maxlength="17" required="true" name="GenerNit" autofocus="true" type="text" class="form-control" id="GenerInputNit" placeholder="XXX.XXX.XXX.XXX-X">
									</div>
									<div class="col-xs-6">
										<label for="GenerInputRazon">Razón social</label>
										<input required="true" name="GenerName" type="text" class="form-control" id="GenerInputRazon" placeholder="Prosarc S.A. ESP.">
									</div>
									<div class="col-xs-6">
										<label for="">Nombre Corto</label>
										<input required="true" name="GenerShortname" type="text" class="form-control" id="GenerInputNombre" placeholder="Prosarc">
									</div>
									<div class="col-xs-6">
										<label for="GenerInputTipo">Tipo de empresa</label>
										<select name="GenerType" class="form-control" id="GenerInputTipo" placeholder="biologico">
											<option>Biologico</option>
											<option>Industrial</option>
											<option>Medicamentos</option>
											<option>Otros</option>
										</select>
									</div>
									<div class="col-xs-6">
										<label for="GenerInputTipo">Cliente</label>
										<select name="GenerCli" class="form-control" id="GenerInputTipo" >
											<option value="1">Seleccione...</option>
											@foreach($Sedes as $sede)
												<option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
											@endforeach()
										</select>
									</div>
								</div>
								<!-- /.box-body -->
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
