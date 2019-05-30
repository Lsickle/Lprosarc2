@extends('layouts.app')
@if(Auth::user()->UsRol !== "Cliente")
@section('htmlheader_title')
Respel-Editar
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangRespel.Respelcreate') }}
@endsection
@section('main-content')
@component('layouts.partials.modal')
	@slot('slug')
		{{$Respels->ID_Respel}}
	@endslot
	@slot('textModal')
		la solicitud <b>N° {{$Respels->ID_Respel}}</b>
	@endslot
@endcomponent
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edición de Residuos</h3>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<div class="box box-primary">
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/respels/{{$Respels->ID_Respel}}" method="POST" enctype="multipart/form-data">
								@method('PUT')
								@csrf
								@include('layouts.RespelPartials.respelform1Edit')
								<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
								<!-- /.box-body -->
								<div class="col-md-12">
									<div class="box-footer">
										<button type="submit" class="btn btn-primary pull-right" style="margin-right:5em">Actualizar</button>
									</div>
								</div>
							</form>
							<!-- /.box -->
						</div>
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
@endif
@if(Auth::user()->UsRol == "Cliente")
@section('htmlheader_title')
Respel-Tratamiento
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangRespel.Respelasig') }}
@endsection
@section('main-content')
@component('layouts.partials.modal')
	@slot('slug')
		{{$Respels->ID_Respel}}
	@endslot
	@slot('textModal')
		la solicitud <b>N° {{$Respels->ID_Respel}}</b>
	@endslot
@endcomponent
<div class="container-fluid spark-screen">
	<!-- form start -->
	<form id="evaluacioncomercial" role="form" action="/Requerimientos/{{$Respels->ID_Respel}}" method="POST" enctype="multipart/form-data">
		@method('POST')
		@csrf
		<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
		<!-- row -->
		<div class="row">
			<!-- col md3 -->
			<div class="col-md-3">
				<!-- box -->
				<div class="box box-primary">
					<!-- box body -->
					<div class="box-body box-profile">
						{{-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
						<h3 class="profile-username text-center">{{$Respels->RespelName}}</h3>
						<p class="text-muted text-center">{{$Respels->RespelDescrip}}</p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Clasificación</b> <a class="pull-right">{{$Respels->YRespelClasf4741 <> null ? $Respels->YRespelClasf4741 : $Respels->ARespelClasf4741 }}</a>
							</li>
							<li class="list-group-item">
								<b>Peligrosidad</b> <a class="pull-right">{{$Respels->RespelIgrosidad}}</a>
							</li>
							<li class="list-group-item">
								<b>Estado Físico</b> <a class="pull-right">{{$Respels->RespelEstado}}</a>
							</li>
							<li class="list-group-item">
								<b>Estado de aprobación</b>
								<select name="RespelStatus" class="form-control">
									<option {{$Respels->RespelStatus == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
									<option {{$Respels->RespelStatus == 'Negado' ? 'selected' : '' }}>Negado</option>
									<option {{$Respels->RespelStatus == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
									<option {{$Respels->RespelStatus == 'Incompleto' ? 'selected' : '' }}>Incompleto</option>
								</select>
							</li>
						</ul>
						<a method='get' href='/img/HojaSeguridad/" + data + "' target='_blank' class='btn btn-success btn-block'><i class='fas fa-file-pdf fa-2x'></i> Hoja de Seguridad</a>
						{{-- <br>
						<a method='get' href='/img/TarjetaEmergencia/" + data + "' target='_blank' class='btn btn-danger btn-block'><i class='fas fa-file-pdf fa-2x'></i> Tarj de Emergencia</a> --}}
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box body -->
			</div>
			<!-- /.col md3 -->
			<!-- col md9 -->
			<div class="col-md-9">
				<!-- box -->
				<div class="box">
					<!-- box header -->
					<div class="box-header with-border">
						<h3 class="box-title">Edición de Residuos</h3>
					</div>
					<!-- /.box header -->
					<!-- box body -->
					<div class="box-body">
						<!-- nav-tabs-custom -->
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="nav-item active">
									<a class="nav-link" href="#Residuopane" data-toggle="tab">Residuo</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Tratamientospane" data-toggle="tab">Tratamientos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Requerimientospane" data-toggle="tab">Requerimientos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Tarifaspane" data-toggle="tab">Tarifas</a>
								</li>
							</ul>
							<!-- nav-content -->
							<div class="tab-content" style="min-height:40vh;">
								<!-- tab-pane fade -->
								<div class="tab-pane fade in active" id="Residuopane">
									<div class="form-horizontal">
										@include('layouts.respel-comercial.respel-residuo')
									</div>
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade " id="Tratamientospane">
									@include('layouts.respel-comercial.respel-tratamiento')
								</div>
								<!-- tab-pane fade -->
								<!-- /.tab-pane fade -->
								<div class="tab-pane fade" id="Requerimientospane">
									@include('layouts.respel-comercial.respel-requerimiento')
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="tarifaspane">
									<div class="form-horizontal">
										@include('layouts.respel-comercial.respel-tarifas')
									</div>
								</div>
								<!-- /.tab-pane fade -->
							</div>
							<!-- /.tab-content -->
						</div>
						<div class="row">
							 <input class="btn btn-primary pull-right" type="submit" value="Actualizar" style="margin-right:5em" />
						</div>
						<!-- /.nav-tabs-custom -->
					</div>
					<!-- /.box body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col md9 -->
		</div>
		<!-- /.row -->
	</form>
	<!-- /.form  -->
</div>
@endsection
@endif
