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
					<h3 class="box-title">Datos de la sede del Generador</h3>
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
							<form role="form" action="/sgeneradores/{{$GSede->GSedeSlug}}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="box-body">

									<div class="form-group">
										<label for="sedeinputname">Nombre de Sede</label>
										<input type="text" class="form-control" id="sedeinputname" placeholder="Prosarc" name="GSedeName" required="true" value="{{$GSede->GSedeName}}">
									</div>
									<div class="col-md-6">
										<label for="sedeinputcelular">N° Celular</label>
										<input type="text" class="form-control" id="sedeinputcelular" placeholder="3014145321" name="GSedeCelular" value="{{$GSede->GSedeCelular}}">
									</div>
									{{-- <div class="col-md-6">
										<label for="sedeinputcliente">Nit del cliente</label>
										<input type="text" class="form-control" id="sedeinputcliente" placeholder="XXX.XXX.XXX.XXX-X" name="cliente" required="true">
									</div> --}}
									<div class="col-md-6">
										<label for="sedemunicipio">Municipio</label>
										<select class="form-control" id="sedemunicipio" name="Municipio" required="true">
											<option>Mosquera</option>
											<option>Madrid</option>
											<option>Funza</option>
											<option>Faca</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="clientname">Cliente</label>
										<select class="form-control" id="clientname" name="FK_GSede" required="true">
											@foreach($generadores as $generador)
												<option value="{{$generador->ID_Gener}}">{{$generador->GenerShortname}}</option>
											@endforeach()
										</select>
									</div>
									<div class="col-md-6">
										<label for="sedeinputaddress">Direccion</label>
										<input type="text" class="form-control" id="sedeinputaddress" placeholder="cll 23 #11c-03" name="GSedeAddress" required="true" value="{{$GSede->GSedeAddress}}">
									</div>
									<div class="col-md-6">
										<label for="sedeinputphone1">telf local 1</label>
										<input type="tel" class="form-control" id="sedeinputphone1" placeholder="031-4123141" name="GSedePhone1" maxlength="16" value="{{$GSede->GSedePhone1}}">
									</div>
									<div class="col-md-6">
										<label for="sedeinputext1">Ext 1</label>
										<input type="number" class="form-control" id="sedeinputext1" placeholder="1555" name="GSedeExt1" maxlength="4" value="{{$GSede->GSedeExt1}}">
									</div>
									<div class="col-md-6">
										<label for="sedeinputphone2">telf local 2</label>
										<input type="tel" class="form-control" id="sedeinputphone2" placeholder="(031)-412 3141" name="GSedePhone2" maxlength="16" value="{{$GSede->GSedePhone2}}">
									</div>
									<div class="col-md-6">
										<label for="sedeinputext2">Ext 2</label>
										<input type="number" class="form-control" id="sedeinputext2" placeholder="1555" name="GSedeExt2" maxlength="4" value="{{$GSede->GSedeExt2}}">
									</div>
									<div class="form-group" style="margin-top: 10em">
										<label for="sedeinputemail">Email de la Sede</label>
										<input type="email" class="form-control" id="sedeinputemail" placeholder="Sistemas@Prosarc.com" name="GSedeEmail" required="true" value="{{$GSede->GSedeEmail}}">
									</div>
									

									{{-- <div class="form-group">
										<label for="exampleInputFile">Documento requerido</label>
										<input type="file" id="exampleInputFile">
										<p class="help-block">Debe ingresar en formato PDF el archivo solicitado.</p>
									</div> --}}
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
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
