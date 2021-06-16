	@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangRespel.Respelinfotag') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::LangRespel.respelmenu') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
@component('layouts.partials.modal')
	@slot('slug')
		{{$Respels->RespelSlug}}
	@endslot
	@slot('textModal')
			el Residuo: <b>{{$Respels->RespelName}}</b>
	@endslot
@endcomponent
<div class="container-fluid spark-screen">
	{{-- <input hidden type="text" name="updated_by" value="{{Auth::user()->email}}"> --}}
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
							<b>Peligrosidad</b> <a href="#" title="" data-toggle="popover" id="correocopy" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Respels->RespelIgrosidad}}</p>" class="pull-right textpopover" data-original-title="Peligrosidad" style="width: 50%;">{{$Respels->RespelIgrosidad}}</a>
						</li>
						<li class="list-group-item">
							<b>Clasificación</b> <a class="pull-right">
								@if ($Respels->RespelIgrosidad != 'No peligroso')
								{{($Respels->YRespelClasf4741 <> null ? $Respels->YRespelClasf4741 : ($Respels->ARespelClasf4741 <> null ? $Respels->ARespelClasf4741 : "N/D"))}}
								@else
								N/A
								@endif
							</a>
						</li>
						<li class="list-group-item">
							<b>Estado Físico</b> <a class="pull-right">{{$Respels->RespelEstado}}</a>
						</li>
						<li class="list-group-item">
							<b>Estado de aprobación</b>
							<select disabled class="form-control">
								<option {{$Respels->RespelStatus == 'Pendiente' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatuspendiente') }}</option>
								<option {{$Respels->RespelStatus == 'Evaluado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusevaluated') }}</option>
								<option {{$Respels->RespelStatus == 'Cotizado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatuscotizado') }}</option>
								<option {{$Respels->RespelStatus == 'Aprobado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusaprovado') }}</option>
								<option {{$Respels->RespelStatus == 'Rechazado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusrechazado') }}</option>
								<option {{$Respels->RespelStatus == 'Incompleto' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusincompleto') }}</option>
								<option {{$Respels->RespelStatus == 'Vencido' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusvencido') }}</option>
								<option {{$Respels->RespelStatus == 'Falta TDE' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusfaltatde') }}</option>
								<option {{$Respels->RespelStatus == 'TDE actualizada' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatustdeupdated') }}</option>
								<option {{$Respels->RespelStatus == 'Revisado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusrevisado') }}</option>
							</select>
						</li>
						<li class="list-group-item">
							<label>Observaciones</label>
							<p>{{$Respels->RespelStatusDescription}}</p>
						</li>
						<li class="list-group-item" style="display: block; overflow: auto";>
							{{-- hoja de seguridad --}}
							@if($Respels->RespelHojaSeguridad!=='RespelHojaDefault.pdf')
								<div class="col-md-12 form-group">
									<label>{{ trans('adminlte_lang::LangRespel.Respelhoja') }}</label>
									<div class="input-group">
										<input type="text" class="form-control" value="Ver Documento" disabled>
										<div class="input-group-btn">
											<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success' style="height: auto; max-height: 2.4em;"><i class='fas fa-file-pdf fa-lg'></i></a>
										</div>
									</div>	
								</div>
							@else
								<div class="col-md-12 form-group">
									<label>{{ trans('adminlte_lang::LangRespel.Respelhoja') }}</label>
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
									<label>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</label>
									<div class="input-group">
										<input type="text" class="form-control" value="Ver Documento" disabled>
										<div class="input-group-btn">
											<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success' style="height: auto; max-height: 2.4em;"><i class='fas fa-file-pdf fa-lg'></i></a>
										</div>
									</div>	
								</div>
							@else
								<div class="col-md-12 form-group">
									<label>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</label>
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
									<label>{{ trans('adminlte_lang::LangRespel.foto') }}</label>
									<div class="input-group">
										<input type="text" class="form-control" value="Ver Documento" disabled>
										<div class="input-group-btn">
											<a method='get' href='/img/fotoRespelCreate/{{$Respels->RespelFoto}}' target='_blank' class='btn btn-success' style="height: auto; max-height: 2.4em;"><i class='fas fa-image fa-lg'></i></a>
										</div>
									</div>	
								</div>
							@else
								<div class="col-md-12 form-group">
									<label>{{ trans('adminlte_lang::LangRespel.foto') }}</label>
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
						<div class="btn-group-sm pull-right">
					@if(($deleteButton == 'borrable')&&(in_array(Auth::user()->UsRol, Permisos::CLIENTE)))
						<form action='/respels/{{$Respels->RespelSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<button type="submit" id="Eliminar{{$Respels->RespelSlug}}" style="display: none;">
								{{ trans('adminlte_lang::message.delete') }}
							</button>
						</form>
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Respels->RespelSlug}}' class='btn btn-danger'>{{ trans('adminlte_lang::message.delete') }}</a>
					@else
							<a data-placement="bottom" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Eliminar Deshabilitado</b>" data-content="<p style='width: 50%'> el <b>Cliente</b> solo puede Eliminar la información del Residuo cuando aun no ha sido evaluado por <b>Prosarc S.A. ESP</b>... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" disabled class="btn btn-default">{{ trans('adminlte_lang::message.delete') }}</a>
					@endif
					@if($editButton == 'Editable')
							@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)||in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA)||in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
								<a href="/respels/{{$Respels->RespelSlug}}/edit" class="btn btn-warning">{{ trans('adminlte_lang::message.edit') }}</a>
							@else
								<a disabled href="#" class="btn btn-default">{{ trans('adminlte_lang::message.edit') }}</a>
							@endif
					@else
							<a data-placement="bottom" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Edicion Deshabilitada</b>" data-content="<p style='width: 50%'> Editar la información del Residuo solo es permitido si su estatus se encuentra en <i><b>'Pendiente'</b></i> o <i><b>'Incompleto'</b></i>... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" disabled class="btn btn-default">{{ trans('adminlte_lang::message.edit') }}</a>
					@endif
						</div>
				</div>
				<!-- /.box header -->
				<!-- box body -->
				<div class="box-body">
					<!-- nav-tabs-custom -->
					<div class="nav-tabs-custom" style="box-shadow:3px 3px 5px grey; margin-bottom: 0px;">
						<ul class="nav nav-tabs">
							<li class="nav-item active">
								<a class="nav-link" href="#Residuopane" data-toggle="tab">{{ trans('adminlte_lang::LangRespel.respeltabtittle') }}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#Tratamientospane" data-toggle="tab">{{ trans('adminlte_lang::LangRespel.trattabtittle') }}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#Pretratamientospane" data-toggle="tab">{{ trans('adminlte_lang::LangRespel.pretrattabtittle') }}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#Requerimientospane" data-toggle="tab">{{ trans('adminlte_lang::LangRespel.requertabtittle') }}</a>
							</li>
							<li class="nav-item">
							@if(in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL) || in_array(Auth::user()->UsRol2, Permisos::SEDECOMERCIAL))
								<a class="nav-link" href="#Tarifaspane" data-toggle="tab">{{ trans('adminlte_lang::LangRespel.tarifatabtittle') }}</a>
							@endif
							</li>
						</ul>
						<!-- nav-content -->
						<div class="tab-content" style="display: block; overflow: auto;">
							<!-- tab-pane fade -->
								<div class="tab-pane fade in active" id="Residuopane">
									@include('layouts.respel-cliente.respel-residuo')
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Tratamientospane">
									@php
									$contadorphp = 0;
									@endphp	
									@foreach($requerimientos as $opcion)
										@if($opcion['ofertado']==1)			
											@include('layouts.respel-cliente.respel-tratamiento')
											@php
												$contadorphp = $contadorphp+1;
											@endphp
										@endif
									@endforeach
									@if($contadorphp==0)
										@include('layouts.respel-cliente.respel-noevaluated')
									@endif
									{{-- @include('layouts.respel-cliente.respel-tratamiento') --}}
								</div>
								<!-- tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Pretratamientospane">
									@php
									$contadorphp = 0;
									@endphp	
									@foreach($requerimientos as $opcion)
										@if($opcion['ofertado']==1)	
											@include('layouts.respel-cliente.respel-pretrat')
											@php
												$contadorphp = $contadorphp+1;
											@endphp
										@endif
									@endforeach
									@if($contadorphp==0)
										@include('layouts.respel-cliente.respel-noevaluated')
									@endif
									{{-- @include('layouts.respel-cliente.respel-pretrat') --}}
								</div>
								<!-- tab-pane fade -->
								<!-- /.tab-pane fade -->
								<div class="tab-pane fade" id="Requerimientospane">
									@php
									$contadorphp = 0;
									@endphp	
									@foreach($requerimientos as $opcion)
										@if($opcion['ofertado']==1)	
											@include('layouts.respel-cliente.respel-requerimiento')
											@php
												$contadorphp = $contadorphp+1;
											@endphp
										@endif
									@endforeach
									@if($contadorphp==0)
										@include('layouts.respel-cliente.respel-noevaluated')
									@endif
									{{-- @include('layouts.respel-cliente.respel-requerimiento') --}}
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Tarifaspane">
									<script type="text/javascript">
										var contadorRango = [];
									</script>
									@php
										$contadorphp = 0;
									@endphp	
									@foreach($requerimientos as $opcion)
										@if($opcion['ofertado']==1)	
											@php
											$contadorRango = [];
											$last = 0;
											@endphp	
											
											@include('layouts.respel-cliente.respel-tarifas')
											@php
												$contadorphp = $contadorphp+1;
											@endphp
										@endif
									@endforeach
									@if($contadorphp==0)
										@include('layouts.respel-cliente.respel-noevaluated')
									@endif
									{{-- @include('layouts.respel-cliente.respel-tarifas') --}}
								</div>
							<!-- /.tab-pane fade -->
						</div>
						<!-- /.tab-content -->
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
</div>
@endsection