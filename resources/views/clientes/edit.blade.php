@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
					@component('layouts.partials.modal')
						{{$cliente->ID_Cli}}
					@endcomponent
					<h3 class="box-title">Modificar datos</h3>
					@if($cliente->CliDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$cliente->ID_Cli}}' class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/clientes/{{$cliente->CliSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$cliente->ID_Cli}}" style="display: none;">
						</form>
					@else
						<form action='/clientes/{{$cliente->CliSlug}}' method='POST' style="float: right;">
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
							<div class="box-header with-border">
								<h3 class="box-title">Quick Example</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/clientes/{{$cliente->CliSlug}}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="box-body">
									<div class="form-group">
										<label for="ClienteInputNit">NIT</label>
										<input name="CliNit" autofocus="true" type="text" class="form-control" id="ClienteInputNit" placeholder="XXX.XXX.XXX.XXX-Y" value="{{$cliente->CliNit}}">
									</div>
									<div class="form-group">
										<label for="ClienteInputRazon">Razon social</label>
										<input name="CliName" type="text" class="form-control" id="ClienteInputRazon" placeholder="PROTECCION SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP." value="{{$cliente->CliName}}">
									</div>
									<div class="form-group">
										<label for="">Nombre Corto</label>
										<input name="CliShortname" type="text" class="form-control" id="ClienteInputNombre" placeholder="Prosarc" value="{{$cliente->CliShortname}}">
									</div>
									<div class="form-group">
										<label for="ClienteInputCategoria">Categoria</label>
										<select name="CliCategoria" class="form-control" id="ClienteInputCategoria" placeholder="Cliente" value="{{$cliente->CliCategoria}}">
											<option>cliente</option>
											<option>generador</option>
											<option>transportador</option>
											<option>Proveedor</option>
											<option>otro</option>
										</select>
									</div>
									<div class="form-group">
										<label for="ClienteInputTipo">Tipo de empresa</label>
										<select name="CliType" class="form-control" id="ClienteInputTipo" {{-- placeholder="biologico" --}} value="{{$cliente->CliType}}">
											<option>biologico</option>
											<option>industrial</option>
											<option>medicamentos</option>
											<option>otros</option>
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
