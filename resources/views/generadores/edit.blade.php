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
				<div class="box-header">
					@component('layouts.partials.modal')
						{{$generadors->ID_Gener}}
					@endcomponent
					<h3 class="box-title">Modificar datos</h3>
					@if($generadors->GenerDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$generadors->ID_Gener}}' class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/generadores/{{$generadors->GenerSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$generadors->ID_Gener}}" style="display: none;">
						</form>
					@else
						<form action='/generadores/{{$generadors->GenerSlug}}' method='POST' style="float: right;">
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
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title">{{ trans('adminlte_lang::LangGenerador.complete') }}</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/generadores/{{$generadors->GenerSlug}}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="box-body">
									<div class="col-xs-6">
										<label for="GenerInputNit">NIT</label>
										<input minlength="17" maxlength="17" required="true" name="GenerNit" autofocus="true" type="text" class="form-control" id="GenerInputNit" placeholder="XXX.XXX.XXX.XXX-X" value="{{$generadors->GenerNit}}">
									</div>
									<div class="col-xs-6">
										<label for="GenerInputRazon">Razón social</label>
										<input required="true" name="GenerName" type="text" class="form-control" id="GenerInputRazon" placeholder="Prosarc S.A. ESP." value="{{$generadors->GenerName}}">
									</div>
									<div class="col-xs-6">
										<label for="">Nombre Corto</label>
										<input required="true" name="GenerShortname" type="text" class="form-control" id="GenerInputNombre" placeholder="Prosarc" value="{{$generadors->GenerShortname}}">
									</div>
									<div class="col-xs-6">
										<label for="GenerInputTipo">Tipo de empresa</label>
										<select name="GenerType" class="form-control" id="GenerInputTipo" placeholder="biologico" value="{{$generadors->GenerType}}">
											<option>Biologico</option>
											<option>Industrial</option>
											<option>Medicamentos</option>
											<option>Otros</option>
										</select>
									</div>
									<div class="col-xs-6">
										<label for="GenerInputTipo">Cliente</label>
										<select name="FK_GenerCli" class="form-control" id="GenerInputTipo" placeholder="biologico">
											<option value="{{$generadors->FK_GenerCli}}">Seleccione...</option>
											@foreach($Sedes as $sede)
											<option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
											@endforeach()
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
