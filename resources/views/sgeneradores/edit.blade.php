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
				<div class="box-header">
					@component('layouts.partials.modal')
						{{$GSede->ID_GSede}}
					@endcomponent
					<h3 class="box-title">Complete todos los campos a continuacion</h3>
					@if($GSede->GSedeDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$GSede->ID_GSede}}' class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/sgeneradores/{{$GSede->GSedeSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$GSede->ID_GSede}}" style="display: none;">
						</form>
					@else
						<form action='/sgeneradores/{{$GSede->GSedeSlug}}' method='POST' style="float: right;">
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
										<label for="Departamento">Departamentos</label>
										<select class="form-control" id="Departamento" name="Departamento" required="true">
											<option>Seleccione...</option>
											@foreach ($Departamentos as $Departamento)
												<option value="{{$Departamento->ID_Depart}}">{{$Departamento->DepartName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="sedemunicipio">Municipio</label>
										<select class="form-control" id="sedemunicipio" name="FK_GSedeMun" required="true">
											<option value="{{$GSede->FK_GSedeMun}}">Seleccione....</option>
											@foreach ($Municipios as $Municipio)
												<option value="{{$Municipio->ID_Mun}}">{{$Municipio->MunName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="clientname">Cliente</label>
										<select class="form-control" id="clientname" name="FK_GSede" required="true">
												<option value="{{$GSede->FK_GSede}}">Seleccione....</option>
											@foreach($generadores as $generador)
												<option value="{{$generador->ID_GSede}}">{{$generador->GenerShortname}}</option>
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
									{{-- <div class="form-group" style="margin-top: 10em"> --}}
									<div class="col-md-6">
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
