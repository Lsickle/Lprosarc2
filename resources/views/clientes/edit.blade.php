@extends('layouts.app')
@section('htmlheader_title')
Editar datos
@endsection
@section('contentheader_title')
Edita tus datos
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
					@if (Auth::user()->UsRol !== "Cliente")
						
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
					@endif
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Formulario de edición</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/clientes/{{$cliente->CliSlug}}" method="POST" enctype="multipart/form-data"  data-toggle="validator">
								@csrf
								@method('PUT')
								<div class="box-body">
									<div class="form-group col-md-6">
										<label for="ClienteInputNit">NIT</label><small class="help-block with-errors"></small>
										<input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" placeholder="XXX.XXX.XXX-Y" required value="{{$cliente->CliNit}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="ClienteInputRazon">Razón Social</label><small class="help-block with-errors"></small>
										<input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  minlength="5"  maxlength="100" placeholder="PROTECCION SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP." required value="{{$cliente->CliName}}">
									</div>
									<div class="col-md-6 form-group">
										<label for="ClienteInputNombre">Nombre Corto</label><small class="help-block with-errors"></small>
										<input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" placeholder="Prosarc" minlength="2"  maxlength="100" required value="{{$cliente->CliShortname}}">
									</div>
									<div class="form-group col-md-6">
										<label for="tipo">Tipo de Empresa</label><small class="help-block with-errors"></small>
										<select class="form-control" id="tipo" name="CliType" required value="{{$cliente->CliType}}">
											<option onclick="HiddenOtroType()" value="Organico">Organico</option>
											<option onclick="HiddenOtroType()" value="Biologico">Biologico</option>
											<option onclick="HiddenOtroType()" value="Industrial">Industrial</option>
											<option onclick="HiddenOtroType()" value="Medicamentos">Medicamentos</option>
											<option onclick="OtroType()" value="">Otro</option>
										</select>
										
									</div>
									<div id="otro" class="form-group col-md-6">
									</div>
									@if(Auth::user()->UsRol === "admin")
									<div class="col-md-6">
										<label for="categoria">Categoría</label>
										<select class="form-control" id="categoria" name="CliCategoria" required value="{{$cliente->CliCategoria}}">
											<option value="">Seleccione...</option>
											<option>Cliente</option>
											<option>Transportador</option>
											<option>Proveedor</option>
										</select>
									</div>
									@endif

								</div>
								<div class="box-footer" style="float:right; margin-right:5%">
									<button type="submit" class="btn btn-primary">Actualizar</button>
								</div>
								<!-- /.box-body -->
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
<script>
function OtroType(){
        var Otro = `<label for="otroType">¿Cuál?</label><small class="help-block with-errors">*</small>
                    <input name="tipoCual" type="text" class="form-control" id="otroType" data-smaxlength="32" required>`;
        $('#otro').append(Otro);
        $('#tipo').prop('required', false);
        $('#myForm1').validator('update');
    }
    function HiddenOtroType(){
        $('#otro').empty();
        $('#myForm1').validator('update');
    }
</script>
@endsection
