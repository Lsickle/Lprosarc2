@extends('layouts.app')
{{-- vista del residuo para los roles validados en el if a continuacion --}}
@if(Auth::user()->UsRol == "Cliente")
@section('htmlheader_title')
{{ trans('adminlte_lang::LangRespel.Respelinfotag') }}
@endsection
@section('contentheader_title')
<span style="margin-left: 0.5em">{{ trans('adminlte_lang::LangRespel.respelmenu') }}</span>
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
		<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
		<!-- row -->
		<div class="row">
			<!-- col md3 -->
			<div class="col-md-3">
				<!-- box -->
				<div class="box box-primary">
					<!-- box body -->
					<div class="box-body box-profile">
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
							<li class="list-group-item" style="display: block; overflow: auto";>
								{{-- hoja de seguridad --}}
								@if($Respels->RespelHojaSeguridad!=='RespelHojaDefault.pdf')
									<div class="col-md-12 form-group">
										<label>Hoja de Seguridad</label>
										<div class="input-group">
											<input type="text" class="form-control" value="Ver Documento" disabled>
											<div class="input-group-btn">
												<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@else
									<div class="col-md-12 form-group">
										<label>Hoja de Seguridad</label>
										<div class="input-group">
											<input type="text" class="form-control" value="No Adjuntado" disabled>
											<div class="input-group-btn">
												<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@endif
								{{-- tarjeta de emergencia --}}
								@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
									<div class="col-md-12 form-group">
										<label>Tarjeta De Emergencia</label>
										<div class="input-group">
											<input type="text" class="form-control" value="Ver Documento" disabled>
											<div class="input-group-btn">
												<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@else
									<div class="col-md-12 form-group">
										<label>Tarjeta De Emergencia</label>
										<div class="input-group">
											<input type="text" class="form-control" value="No Adjuntado" disabled>
											<div class="input-group-btn">
												<a target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@endif
								{{-- fotografia del residuo --}}
								@if($Respels->RespelFoto!=='RespelFotoDefault.png')
									<div class="col-md-12 form-group">
										<label>Fotografía del Residuo</label>
										<div class="input-group">
											<input type="text" class="form-control" value="Ver Documento" disabled>
											<div class="input-group-btn">
												<a method='get' href='/img/fotoRespelCreate/{{$Respels->RespelFoto}}' target='_blank' class='btn btn-success'><i class='fas fa-image fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@else
									<div class="col-md-12 form-group">
										<label>Fotografía del Residuo</label>
										<div class="input-group">
											<input type="text" class="form-control" value="No Adjuntado" disabled>
											<div class="input-group-btn">
												<a target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
											</div>
										</div>	
									</div>
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
						<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respelinfotag') }}</h3>
						@if($editButton == 'Editable')
							<a href="/respels/{{$Respels->RespelSlug}}/edit" class="btn btn-warning" style="float: right;">Editar</a>
						@endif
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
	@section('htmlheader_title')
	{{ trans('adminlte_lang::LangRespel.Respelinfotag') }}
	@endsection
	@section('contentheader_title')
	<span style="margin-left: 0.5em">{{ trans('adminlte_lang::LangRespel.respelmenu') }}</span>
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
								<li class="list-group-item" style="display: block; overflow: auto";>
									{{-- hoja de seguridad --}}
									@if($Respels->RespelHojaSeguridad!=='RespelHojaDefault.pdf')
										<div class="col-md-12 form-group">
											<label>Hoja de Seguridad</label>
											<div class="input-group">
												<input type="text" class="form-control" value="Ver Documento" disabled>
												<div class="input-group-btn">
													<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
												</div>
											</div>	
										</div>
									@else
										<div class="col-md-12 form-group">
											<label>Hoja de Seguridad</label>
											<div class="input-group">
												<input type="text" class="form-control" value="No Adjuntado" disabled>
												<div class="input-group-btn">
													<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
												</div>
											</div>	
										</div>
									@endif
									{{-- tarjeta de emergencia --}}
									@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
										<div class="col-md-12 form-group">
											<label>Tarjeta De Emergencia</label>
											<div class="input-group">
												<input type="text" class="form-control" value="Ver Documento" disabled>
												<div class="input-group-btn">
													<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
												</div>
											</div>	
										</div>
									@else
										<div class="col-md-12 form-group">
											<label>Tarjeta De Emergencia</label>
											<div class="input-group">
												<input type="text" class="form-control" value="No Adjuntado" disabled>
												<div class="input-group-btn">
													<a target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
												</div>
											</div>	
										</div>
									@endif
									{{-- fotografia del residuo --}}
									@if($Respels->RespelFoto!=='RespelFotoDefault.png')
										<div class="col-md-12 form-group">
											<label>Fotografía del Residuo</label>
											<div class="input-group">
												<input type="text" class="form-control" value="Ver Documento" disabled>
												<div class="input-group-btn">
													<a method='get' href='/img/fotoRespelCreate/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-image fa-lg'></i></a>
												</div>
											</div>	
										</div>
									@else
										<div class="col-md-12 form-group">
											<label>Fotografía del Residuo</label>
											<div class="input-group">
												<input type="text" class="form-control" value="No Adjuntado" disabled>
												<div class="input-group-btn">
													<a target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
												</div>
											</div>	
										</div>
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
							<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respelinfotag') }}</h3>
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
