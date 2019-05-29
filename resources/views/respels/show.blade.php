@extends('layouts.app')
{{-- vista del residuo para los roles validados en el if a continuacion --}}
@if(Auth::user()->UsRol == "Cliente")
@section('htmlheader_title')
Respel-Tratamiento
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangRespel.Respelasig') }}
@endsection
@section('main-content')
@component('layouts.partials.modal')
{{$Respels->ID_Respel}}
@endcomponent
<div class="container-fluid spark-screen">
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
								<select disabled name="RespelStatus" class="form-control">
									<option {{$Respels->RespelStatus == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
									<option {{$Respels->RespelStatus == 'Negado' ? 'selected' : '' }}>Negado</option>
									<option {{$Respels->RespelStatus == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
									<option {{$Respels->RespelStatus == 'Incompleto' ? 'selected' : '' }}>Incompleto</option>
								</select>
							</li>
							<li class="list-group-item">
								{{-- hoja de seguridad --}}
								@if($Respels->RespelHojaSeguridad!=='RespelHojaDefault.pdf')
									<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success btn-block'><i class='fas fa-file-pdf fa-2x'></i> Hoja de Seguridad</a>
								@else
									<a href='#' target='_blank' class='btn btn-default btn-block'><i class='fas fa-ban fa-lg'></i>No Adjuntado</a>
								@endif
								{{-- tarjeta de emergencia --}}
								@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
									<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success btn-block'><i class='fas fa-file-pdf fa-2x'></i> Tarjeta De Emergencia</a>
								@else
									<a href='#' target='_blank' class='btn btn-default btn-block'><i class='fas fa-ban fa-lg'></i>No Adjuntado</a>
								@endif
								{{-- fotografia del residuo --}}
								@if($Respels->RespelFoto!=='RespelFotoDefault.png')
									<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelFoto}}' target='_blank' class='btn btn-success btn-block'><i class='fas fa-file-pdf fa-2x'></i> Fotografía del Residuo</a>
								@else
									<a href='#' target='_blank' class='btn btn-default btn-block'><i class='fas fa-ban fa-lg'></i>No Adjuntado</a>
								@endif
							</li>
						</ul>
						
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
							<div class="tab-content" style="display: block; overflow: auto;">
								<!-- tab-pane fade -->
								<div class="tab-pane fade in active" id="Residuopane">
									<div class="">
										@include('layouts.respel-cliente.respel-residuo')
									</div>
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade " id="Tratamientospane">
									@include('layouts.respel-cliente.respel-tratamiento')
								</div>
								<!-- tab-pane fade -->
								<!-- /.tab-pane fade -->
								<div class="tab-pane fade" id="Requerimientospane">
									@include('layouts.respel-cliente.respel-requerimiento')
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="tarifaspane">
									<div class="form-horizontal">
										@include('layouts.respel-cliente.respel-tarifas')
									</div>
								</div>
								<!-- /.tab-pane fade -->
							</div>
							<!-- /.tab-content -->
						</div>
						{{-- <div class="row">
							 <input class="btn btn-primary pull-right" type="submit" value="Actualizar" style="margin-right:5em" />
						</div> --}}
						<!-- /.nav-tabs-custom -->
					</div>
					<!-- /.box body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col md9 -->
		</div>
		<!-- /.row -->
</div>
@endsection
@endif


@if(Auth::user()->UsRol !== "Cliente")
	@section('htmlheader_title', 'Información de Residuo')

	@section('main-content')
		@component('layouts.partials.modal')
			{{$Respels->RespelSlug}}
		@endcomponent
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<div class="box">
					<div class="box-header with-border">
						<div class="col-md-12">
							@if(Auth::user()->UsRol === "Cliente" && $Respels->RespelStatus <> "Aprobado" && $deleteButton == 'borrable')
								@if($Respels->RespelDelete == 0)
									<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Respels->RespelSlug}}' class='btn btn-danger' style="float: right;">Eliminar</a>
									<form action='/respels/{{$Respels->RespelSlug}}' method='POST'>
										@method('DELETE')
										@csrf
										<input  type="submit" id="Eliminar{{$Respels->RespelSlug}}" style="display: none;">
									</form>
								@else
									<form action='/respels/{{$Respels->RespelSlug}}' method='POST' style="float: right;">
										@method('DELETE')
										@csrf
										<input type="submit" class='btn btn-success' value="Añadir">
									</form>
								@endif
							@endif
							<a href="/respels/{{$Respels->RespelSlug}}/edit" class="btn btn-warning" style="float: right; margin-right: 5px;">Editar</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<table id="Clasificacion" class="table table-bordered table-striped">
									<tr>
										<th colspan="2">
											<h2>{{$Respels->RespelName}}</h2>
										</th>
									</tr>
									<tr>
										<th>Estado de aprobación:</th>
										<td>
											<h4>{{$Respels->RespelStatus}}</h4>
										</td>
									</tr>
									<tr>
										<th>N° de cotizacion:</th>
										<td>
											<h4>{{$Respels->FK_RespelCoti}}</h4>
										</td>
									</tr>
									<tr>
										<th>Descripción:</th>
										<td>
											<h4>{{$Respels->RespelDescrip}}</h4>
										</td>
									</tr>
									<tr>
										<th>Corriente de clasificacion Y:</th>
										<td>
											<h4>{{$Respels->YRespelClasf4741}}</h4>
										</td>
									</tr>
									<tr>
										<th>Corriente de clasificacion A:</th>
										<td>
											<h4>{{$Respels->ARespelClasf4741}}</h4>
										</td>
									</tr>
									<tr>
										<th>Peligrosidad del residuo:</th>
										<td>
											<h4>{{$Respels->RespelIgrosidad}}</h4>
										</td>
									</tr>
									<tr>
										<th>Estado del residuo:</th>
										<td>
											<h4>{{$Respels->RespelEstado}}</h4>
										</td>
									</tr>
									<tr>
										<th>Hoja de seguridad:</th>
										<td>
											<h4>
												<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-primary'><i class="fas fa-search"></i></a>
											</h4>
										</td>
									</tr>
									<tr>
										<th>Tarjeta De Emergencia:</th>
										<td>
											<h4>
												<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-primary'><i class="fas fa-search"></i></a>
											</h4>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	No Adjuntado@endsection
@endif
