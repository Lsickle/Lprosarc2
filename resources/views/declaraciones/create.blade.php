@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangDeclar.declaregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangDeclar.boxregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::LangDeclar.box-title') }}</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">{{ trans('adminlte_lang::LangDeclar.innerbox-title') }}</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/declaraciones" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="col-md-6">
										<label for="declaraplica">Aplicacion</label>
										<select class="form-control" id="declaraplica" placeholder="Previo Aviso" name="DeclarApply" required="true">
										<option>Siempre</option>
										<option>Previo Aviso</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="declartipo">Tipo</label>
										<select class="form-control" id="declartipo" placeholder="Previo Aviso" name="DeclarTipo" required="true">
										<option>indutrial</option>
										<option>aguas</option>
										<option>servicios</option>
										<option>hospitalario</option>
										<option>cenizas y tierras</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="declartipo">Nombre</label>
										<input type="text" class="form-control" id="declartipo" placeholder="declaracion ppal" name="DeclarName">
									</div>
									<div class="col-md-6">
										<label for="decstatus">Status</label>
										<select class="form-control" id="decstatus" placeholder="incompleta" name="DeclarStatus" required="true">
										<option>aprobada</option>
										<option>negada</option>
										<option>pendiente</option>
										<option>incompleta</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="decfrec">Frecuencia</label>
										{{-- <select class="form-control" id="decstatus" placeholder="incompleta" name="DeclarStatus" required="true">
										<option>mensual</option>
										<option>quincenal</option>
										<option>semanal</option>
										<option>por solicitud</option>
										<option>N° dias</option>
										</select> --}}
										<input id="decfrec" list="decfrecuency" name="DeclarFrecuencia" placeholder="N° de dias" maxlength="14"class="form-control" type="number">
										<datalist id="decfrecuency">
										  <option value="15">
										  <option value="30">
										  <option value="7">
										</datalist>
									</div>
									
									{{-- <div class="col-md-6">
										<label for="sedeinputcliente">Nit del cliente</label>
										<input type="text" class="form-control" id="sedeinputcliente" placeholder="XXX.XXX.XXX.XXX-X" name="cliente" required="true">
									</div> --}}
									{{-- <div class="col-md-6">
										<label for="sedemunicipio">Municipio</label>
										<select class="form-control" id="sedemunicipio" placeholder="Funza" name="Municipio" required="true">
										<option>Mosquera</option>
										<option>Madrid</option>
										<option>Funza</option>
										<option>Faca</option>
										</select>
									</div> --}}
									<div class="col-md-6">
										<label for="clientname">Cliente</label>
										<select class="form-control" id="clientname" name="DeclarSede" required="true">
											@foreach($sedes as $sede)
												<option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
											@endforeach()
										</select>
									</div>
									<div class="col-md-6">
										<label for="genername">Generador</label>
										<select class="form-control" id="genername" name="DeclarGenerSede">
											@foreach($generadores as $generador)
												<option value="{{$generador->ID_GSede}}">{{$generador->GSedeName}}</option>
											@endforeach()
										</select>
									</div>
									
									
									<div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
									   <div class="icheck form-group">
			                                <label for="declaraudit">
			                                   {{trans('adminlte_lang::message.clientaudit')}}
			                                </label>
			                                 <input id="declaraudit" style="display:none;" type="checkbox" name="DeclarAuditable">
			                            </div>
			                            <div >
			                            	<input  hidden="false" type="text" name="DeclarSlug" value="temp">
			                            	<input  hidden="false" type="text" name="DeclarUser" value="{{ $user->id }}">
			                            </div>
									</div>
									{{-- <div class="form-group">
										<label for="exampleInputFile">Documento requerido</label>
										<input type="file" id="exampleInputFile">
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
