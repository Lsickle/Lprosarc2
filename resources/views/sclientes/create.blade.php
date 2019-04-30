@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.sclientsede') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.sclientregister') }}
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
							<!-- form start -->
							<form role="form" action="/sclientes" method="POST" enctype="multipart/form-data" data-toggle="validator">
								@csrf
								<div class="box-body">
										@if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador')  || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador'))
										<div class="form-group col-md-12">
											<label for="clientname">{{ trans('adminlte_lang::message.clientcliente') }}</label>
											<select class="form-control select" id="clientname" placeholder="Funza" name="clientename" required="true">
												<option value="">{{ trans('adminlte_lang::message.select') }}</option>
												@foreach($Clientes as $cliente)
													<option value="{{$cliente->ID_Cli}}">{{$cliente->CliShortname}}</option>
												@endforeach()
											</select>
										</div>
										@endif
									<div class="form-group col-md-6">
										<label for="sedeinputname">{{ trans('adminlte_lang::message.sclientnamesede') }}</label>
										<input type="text" class="form-control" id="sedeinputname" name="SedeName" required="true">
									</div>
									<div class="form-group col-md-6">
										<label for="departamento">{{ trans('adminlte_lang::message.departamento') }}</label>
										<select class="form-control select" id="departamento" name="departamento" required="true">
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach ($Departamentos as $Departamento)		
												<option value="{{$Departamento->ID_Depart}}">{{$Departamento->DepartName}}</option>
											@endforeach
											
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label>
										<select class="form-control select" id="municipio" name="FK_SedeMun" required="true">
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputcelular">{{ trans('adminlte_lang::message.mobile') }}</label>
										<input type="text" class="form-control" id="sedeinputcelular" placeholder="3014145321" name="SedeCelular">
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputaddress">{{ trans('adminlte_lang::message.address') }}</label>
										<input type="text" class="form-control" id="sedeinputaddress" placeholder="cll 23 #11c-03" name="SedeAddress" required="true">
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputemail">{{ trans('adminlte_lang::message.emailaddress') }}</label>
										<input type="email" class="form-control" id="sedeinputemail" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" name="SedeEmail" required>
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputphone1">telf local 1</label>
										<input type="tel" class="form-control" id="sedeinputphone1" placeholder="031-4123141" name="SedePhone1" maxlength="16">
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputext1">Ext 1</label>
										<input type="number" class="form-control" id="sedeinputext1" placeholder="1555" name="SedeExt1" max="9999">
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputphone2">telf local 2</label>
										<input type="tel" class="form-control" id="sedeinputphone2" placeholder="(031)-412 3141" name="SedePhone2" maxlength="16">
									</div>
									<div class="form-group col-md-6">
										<label for="sedeinputext2">Ext 2</label>
										<input type="number" class="form-control" id="sedeinputext2" placeholder="1555" name="SedeExt2" max="9999" >
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
