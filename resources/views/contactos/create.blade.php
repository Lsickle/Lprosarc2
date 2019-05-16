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
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos Básicos de empresa</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box box-info">
					
					<div class="box-body">
						<form role="form" action="/clientes" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group col-md-12">
									<label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
									<input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" value="{{ old('CliNit') }}" required>
								</div>
								<div class="col-md-12 form-group">
									<label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
									<input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  maxlength="100" required value="{{ old('CliName') }}">
								</div>
								<div class="col-md-12 form-group">
									<label for="ClienteInputNombre">{{ trans('adminlte_lang::message.clientnombrecorto') }}</label><small class="help-block with-errors">*</small>
									<input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" maxlength="100" required value="{{ old('CliShortname') }}">
								</div>
								<div class="col-md-12 form-group"><small class="help-block with-errors">*</small>
									<label for="categoria">{{ trans('adminlte_lang::message.clientcategoría') }}</label>
									<select class="form-control select" id="categoria" name="CliCategoria" required value="{{ old('CliCategoria') }}">
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										<option {{ old('CliCategoria') == trans('adminlte_lang::message.clientcliente') ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientcliente') }}</option>
										<option {{ old('CliCategoria') == trans('adminlte_lang::message.clienttransportador') ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clienttransportador') }}</option>
										<option {{ old('CliCategoria') == trans('adminlte_lang::message.clientproveedor') ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientproveedor') }}</option>
									</select>
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.register') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
