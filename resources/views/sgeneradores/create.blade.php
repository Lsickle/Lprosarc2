@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.sclientregistertittle') }}
@endsection
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
					<h3 class="box-title">Datos de la sede del generador</h3>
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
							<div class="box-header with-border">
								<h3 class="box-title">complete todos los campos a continuacion</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/sgeneradores" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">

									<div class="form-group">
										<label for="GSedeinputname">Nombre de Sede</label>
										<input type="text" class="form-control" id="GSedeinputname" placeholder="Prosarc" name="GSedeName" required="true">
									</div>
									<div class="col-md-6">
										<label for="GSedeinputcelular">N° Celular</label>
										<input type="text" class="form-control" id="GSedeinputcelular" placeholder="3014145321" name="GSedeCelular">
									</div>
									{{-- <div class="col-md-6">
										<label for="GSedeinputcliente">Nit del cliente</label>
										<input type="text" class="form-control" id="GSedeinputcliente" placeholder="XXX.XXX.XXX.XXX-X" name="cliente" required="true">
									</div> --}}
									<div class="col-md-6">
										<label for="departamento">Departamento</label>
										<select class="form-control" id="departamento" name="Departamento" required="true">
											<option>Seleccione...</option>
											@foreach ($Departamentos as $Departamento)		
												<option value="{{$Departamento->ID_Depart}}">{{$Departamento->DepartName}}</option>
											@endforeach
											
										</select>
									</div>
									<div class="col-md-6">
										<label for="GSedemunicipio">Municipio</label>
										<select class="form-control" id="GSedemunicipio" name="FK_GSedeMun" required="true">
										<option>Seleccione...</option>
										@foreach ($Municipios as $Municipio)
											<option value="{{$Municipio->ID_Mun}}">{{$Municipio->MunName}}</option>
										@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="clientname">Cliente</label>
										<select class="form-control" id="clientname" name="FK_GSede" required="true">
											<option>Seleccione....</option>
											@foreach($generadors as $generador)
												<option value="{{$generador->ID_Gener}}">{{$generador->GenerShortname}}</option>
											@endforeach()
										</select>
									</div>
									<div class="col-md-6">
										<label for="GSedeinputaddress">Direccion</label>
										<input type="text" class="form-control" id="GSedeinputaddress" placeholder="cll 23 #11c-03" name="GSedeAddress" required="true">
									</div>
									<div class="col-md-6">
										<label for="GSedeinputemail">Email de la Sede</label>
										<input type="email" class="form-control" id="GSedeinputemail" placeholder="Sistemas@Prosarc.com" name="GSedeEmail" required="true">
									</div>
									<div class="col-md-6">
										<label for="GSedeinputphone1">telf local 1</label>
										<input type="tel" class="form-control" id="GSedeinputphone1" placeholder="031-4123141" name="GSedePhone1" maxlength="16">
									</div>
									<div class="col-md-6">
										<label for="GSedeinputext1">Ext 1</label>
										<input type="text" class="form-control" id="GSedeinputext1" placeholder="1555" name="GSedeExt1" maxlength="4">
									</div>
									<div class="col-md-6">
										<label for="GSedeinputphone2">telf local 2</label>
										<input type="tel" class="form-control" id="GSedeinputphone2" placeholder="(031)-412 3141" name="GSedePhone2" maxlength="16">
									</div>
									<div class="col-md-6">
										<label for="GSedeinputext2">Ext 2</label>
										<input type="text" class="form-control" id="GSedeinputext2" placeholder="1555" name="GSedeExt2" maxlength="4">
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
