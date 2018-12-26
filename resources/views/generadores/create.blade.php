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
							<form role="form" action="/Generadores" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="form-group">
										<label for="GenerInputNit">NIT</label>
										<input minlength="17" maxlength="17" required="true" name="GenerNit" autofocus="true" type="text" class="form-control" id="GenerInputNit" placeholder="XXX.XXX.XXX.XXX-X">
									</div>
									<div class="form-group">
										<label for="GenerInputRazon">Razon social</label>
										<input required="true" name="GenerName" type="text" class="form-control" id="GenerInputRazon" placeholder="ALIMENTOS BALANCEADOS TEQUENDAMA S.A.">
									</div>
									<div class="form-group">
										<label for="">Nombre Corto</label>
										<input required="true" name="GenerShortname" type="text" class="form-control" id="GenerInputNombre" placeholder="ALBATEQ SA">
									</div>
									<div class="col-xs-6">
										<label for="GenerInputTipo">Tipo de empresa</label>
										<select name="GenerType" class="form-control" id="GenerInputTipo" placeholder="biologico">
											<option>biologico</option>
											<option>industrial</option>
											<option>medicamentos</option>
											<option>otros</option>
										</select>
									</div>
									<div class="col-xs-6">
										<label for="GenerInputTipo">Cliente</label>
										<select name="GenerCli" class="form-control" id="GenerInputTipo" placeholder="biologico">
											@foreach($Sedes as $sede)
											<option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
											@endforeach()
										</select>
									</div>
									<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
									   <div class="icheck form-group">
			                                <label for="GenerInputTipo">
			                                   {{trans('adminlte_lang::message.clientaudit')}}
			                                </label>
			                                 <input id="GenerInputTipo" style="display:none;" type="checkbox" name="GenerAuditable">
			                            </div>
			                            <div >
			                            	<input  hidden="false" type="text" name="GenerSlug" value="temp">
			                            </div>
									</div>
									{{-- <div class="form-group">
										<label for="exampleInputFile">Documento requerido</label>
										<input name="" type="file" id="exampleInputFile">
										<p class="help-block">Debe ingresar en formato PDF el archivo solicitado.</p>
									</div> --}}
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
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
