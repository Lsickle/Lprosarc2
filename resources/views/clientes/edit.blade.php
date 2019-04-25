@extends('layouts.app')
@section('htmlheader_title')
Editar datos
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.edit') }}
@endsection
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
							{{-- <div class="box-header with-border">
								<h3 class="box-title">Formulario de edición</h3>
							</div> --}}
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/clientes/{{$cliente->CliSlug}}" method="POST" enctype="multipart/form-data"  data-toggle="validator" class="form">
								@csrf
								@method('PUT')
								<div class="box-body">
									<div class="form-group col-md-12">
										<label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
										<input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" required value="{{$cliente->CliNit}}">
									</div>
									<div class="col-md-12 form-group">
										<label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
										<input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  minlength="5"  maxlength="100" required value="{{$cliente->CliName}}">
									</div>
									<div class="col-md-12 form-group">
										<label for="ClienteInputNombre">{{ trans('adminlte_lang::message.clientnombrecorto') }}</label><small class="help-block with-errors">*</small>
										<input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" minlength="2"  maxlength="100" required value="{{$cliente->CliShortname}}">
									</div>
									@if(Auth::user()->UsRol === "Administrador")
									<div class="col-md-6 form-group"><small class="help-block with-errors">*</small>
										<label for="categoria">{{ trans('adminlte_lang::message.clientcategoría') }}</label>
										<select class="form-control" id="categoria" name="CliCategoria" required>
											<option {{ $cliente->CliCategoria == 'Cliente' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientcliente') }}</option>
											<option {{ $cliente->CliCategoria == 'Transportador' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clienttransportador') }}</option>
											<option {{ $cliente->CliCategoria == 'Proveedor' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientproveedor') }}</option>
										</select>
									</div>
									@endif
								</div>
								<div class="box-footer" style="float:right; margin-right:5%">
									<button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.update') }}</button>
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
@endsection
