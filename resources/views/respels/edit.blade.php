@extends('layouts.app')
{{-- vista de edición para el cliente --}}
@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
	@section('htmlheader_title')
	{{ trans('adminlte_lang::LangRespel.Respeledittag') }}
	@endsection
	
	@section('contentheader_title')
	  <span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
	  	{{ trans('adminlte_lang::LangRespel.Respeleditmenu') }}
	    <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
	  </span>
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
				<div class="col-md-12 col-md-offset-0">
					<!-- Default box -->
					<div class="box">
						<form role="form" action="/respels/{{$Respels->RespelSlug}}" method="POST" id="myform" enctype="multipart/form-data" data-toggle="validator">
							@method('PUT')
							@csrf
							<div class="box-header">
								<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respeleditmenu') }}</h3>
							</div>
								<!-- left column -->
								<!-- general form elements -->
							<div class="box box-info">
								<div class="box-body">
									<!-- /.box-header -->
									@if ($errors->any())
										<div class="alert alert-danger" role="alert">
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{$error}}</li>
												@endforeach
											</ul>
										</div>
									@endif
									<input type="text" name="Sede" style="display: none;" value="{{$Sede}}">
									@include('layouts.RespelPartials.respelform1Edit')
								</div>
								<div class="box box-info">
									<div class="box-footer">
										<button type="submit" class="btn btn-success pull-right"><i class="fa fa-check"></i>{{ trans('adminlte_lang::LangRespel.updaterespelButton') }}</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endsection
@else
{{-- VISTA PARA PROSARC --}}
@section('htmlheader_title')
	{{ trans('adminlte_lang::LangRespel.Respelevaluatetag') }}
@endsection
@section('contentheader_title')
	<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
		{{ trans('adminlte_lang::LangRespel.Respelevaluetemenu') }}
	  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
	</span>
@endsection
@section('main-content')
@component('layouts.partials.modal')
	@slot('slug')
		{{$Respels->ID_Respel}}
	@endslot
	@slot('textModal')
		El residuo <b>N° {{$Respels->ID_Respel}}</b>
	@endslot
@endcomponent
<div class="container-fluid spark-screen">
	<!-- form start -->
	<form id="evaluacioncomercial" role="form" action="/respels/{{$Respels->RespelSlug}}/updateStatusRespel" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		{{-- <input hidden type="text" name="updated_by" value="{{Auth::user()->email}}"> --}}
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
							@if ($Respels->RespelIgrosidad != 'No peligroso')
							<li class="list-group-item">
								<b>Clasificación</b> <a class="pull-right">
									{{($Respels->YRespelClasf4741 <> null ? $Respels->YRespelClasf4741 : ($Respels->ARespelClasf4741 <> null ? $Respels->ARespelClasf4741 : "N/D"))}}
								</a>
							</li>
							@else
							<li class="list-group-item">
								<b>Clasificación</b> <a class="pull-right">N/A</a>
							</li>
							@endif
							<li class="list-group-item">
								<b>Peligrosidad</b> <a href="#" title="" data-toggle="popover" id="correocopy" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Respels->RespelIgrosidad}}</p>" class="pull-right textpopover" data-original-title="Peligrosidad" style="width: 50%;">{{$Respels->RespelIgrosidad}}</a>
							</li>
							<li class="list-group-item">
								<b>Estado Físico</b> <a class="pull-right">{{$Respels->RespelEstado}}</a>
							</li>
							<li class="list-group-item">
								<b>Estado de aprobación</b>
								<select name="RespelStatus" class="form-control">
									<option {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))||($Respels->RespelStatus == 'Pendiente') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Pendiente' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatuspendiente') }}</option>
									<option {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))||($Respels->RespelStatus == 'Evaluado') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Evaluado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusevaluated') }}</option>
									<option {{(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))||($Respels->RespelStatus == 'Cotizado') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Cotizado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatuscotizado') }}</option>
									<option {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))||($Respels->RespelStatus == 'Aprobado') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Aprobado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusaprovado') }}</option>
									{{-- <option {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))||($Respels->RespelStatus == 'Aceptado') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Aceptado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusaceptado') }}</option> --}}
									<option {{(in_array(Auth::user()->UsRol, Permisos::AREALOGISTICA)||in_array(Auth::user()->UsRol2, Permisos::AREALOGISTICA))||($Respels->RespelStatus == 'Revisado') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Revisado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusrevisado') }}</option>
									<option {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))||($Respels->RespelStatus == 'Rechazado') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Rechazado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusrechazado') }}</option>
									<option {{(in_array(Auth::user()->UsRol, Permisos::AREALOGISTICA)||in_array(Auth::user()->UsRol2, Permisos::AREALOGISTICA))||($Respels->RespelStatus == 'Falta TDE') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Falta TDE' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusfaltatde') }}</option>
									<option {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))||($Respels->RespelStatus == 'Incompleto') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Incompleto' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusincompleto') }}</option>
									<option {{(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))||($Respels->RespelStatus == 'Vencido') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'Vencido' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusvencido') }}</option>
									<option {{(in_array(Auth::user()->UsRol, Permisos::AREALOGISTICA)||in_array(Auth::user()->UsRol2, Permisos::AREALOGISTICA))||($Respels->RespelStatus == 'TDE actualizada') ? '' : 'disabled'}} {{$Respels->RespelStatus == 'TDE actualizada' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatustdeupdated') }}</option>
								</select>
							</li>
							<li class="list-group-item">
								<label>Observaciones</label>
								<textarea style="resize: vertical;" maxlength="250" name="RespelStatusDescription" id="taid" class="form-control" rows ="5">{{$Respels->RespelStatusDescription}}</textarea>
							</li>
							<li class="list-group-item" style="display: block; overflow: auto";>
								{{-- hoja de seguridad --}}
								@if($Respels->RespelHojaSeguridad!=='RespelHojaDefault.pdf')
									<div class="col-md-12 form-group">
										<label>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</label>
										<div class="input-group">
											<input type="text" class="form-control" value="Ver Documento" disabled>
											<div class="input-group-btn">
												<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@else
									<div class="col-md-12 form-group">
										<label>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</label>
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
												<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
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
												<a method='get' href='/img/fotoRespelCreate/{{$Respels->RespelFoto}}' target='_blank' class='btn btn-success'><i class='fas fa-image fa-lg'></i></a>
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
						<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respelevaluetemenu') }}</h3>
						<div class="box-tools pull-right">
							@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
							<button onclick="AgregarOption()" class="btn btn-primary pull-right" id="addOptionButton"> <i class="fa fa-plus"></i> {{ trans('adminlte_lang::LangTratamiento.optionadd') }}</button> 
							@endif
							@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
								@switch($Respels->RespelStatus)
									@case('Revisado')
									@case('Evaluado')
									@case('Cotizado')
									@case('Aprobado')
									@case('Vencido')
										<a method='get' style="margin-right: 1em;" href='/clientToRp/{{$Respels->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'>Haga click en este boton para copiar la información de este residuo y crear uno nuevo, el cual quedara disponible en la lista de residuos comunes para que otros clientes puedan utilizarlo </p>" class='btn btn-primary'><i class='fas fa-lg fa-copy'></i> Copiar</a>
										@break
									@case('Falta TDE')
									@case('Pendiente')
									@case('Incompleto')
									@case('Rechazado')
										<a disabled method='get' style="margin-right: 1em;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'>Este residuo aun no cumple con las condiciones para incluirlo en la lista de residuos comunes </p>" class='btn btn-default'><i class='fas fa-lg fa-copy'></i> Copiar</a>
										@break
									@default
										<a disabled method='get' style="margin-right: 1em;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'>Este residuo aun no cumple con las condiciones para incluirlo en la lsta de residuos comunes </p>" class='btn btn-default'><i class='fas fa-lg fa-copy'></i> Copiar</a>
								@endswitch
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
								@if(in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL) || in_array(Auth::user()->UsRol2, Permisos::SEDECOMERCIAL))
								<li class="nav-item">
									<a class="nav-link" href="#Tarifaspane" data-toggle="tab">{{ trans('adminlte_lang::LangRespel.tarifatabtittle') }}</a>
								</li>
								@endif
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
										@include('layouts.respel-comercial.respel-tratamiento-edit')
										@php
											$contadorphp = $contadorphp+1;
										@endphp
									@endforeach
									{{-- @include('layouts.respel-comercial.respel-tratamiento') --}}
								</div>
								<!-- tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Pretratamientospane">
									@php
									$contadorphp = 0;
									@endphp	
									@foreach($requerimientos as $opcion)
										@include('layouts.respel-comercial.respel-pretratEvaluacion-edit')
										@php
											$contadorphp = $contadorphp+1;
										@endphp
									@endforeach
									{{-- @include('layouts.respel-comercial.respel-pretrat') --}}
								</div>
								<!-- tab-pane fade -->
								<!-- /.tab-pane fade -->
								<div class="tab-pane fade" id="Requerimientospane">
									@php
									$contadorphp = 0;
									@endphp	
									@foreach($requerimientos as $opcion)
										@include('layouts.respel-comercial.respel-requerimiento-edit')
										@php
											$contadorphp = $contadorphp+1;
										@endphp
									@endforeach
									{{-- @include('layouts.respel-comercial.respel-requerimiento') --}}
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								@if(in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL) || in_array(Auth::user()->UsRol2, Permisos::SEDECOMERCIAL))
								<div class="tab-pane fade" id="Tarifaspane">
									<script type="text/javascript">
										var contadorRango = [];
									</script>
									@php
										$contadorphp = 0;
									@endphp	
									@foreach($requerimientos as $opcion)
										@php
										$contadorRango = [];
										$last = 0;
										@endphp	
										
										@include('layouts.respel-comercial.respel-tarifas-edit')
										@php
											$contadorphp = $contadorphp+1;
										@endphp
									@endforeach
									{{-- @include('layouts.respel-comercial.respel-tarifas') --}}
								</div>
								@endif
								<div id="modalrango"></div>
								<!-- /.tab-pane fade -->
							</div>
							<!-- /.tab-content -->
						</div>
					</div>
					<!-- /.box body -->
					<div class="box-footer">
						<button class="btn btn-success" type="submit" style="margin-right:5em"><i class="fa fa-check"></i>{{ trans('adminlte_lang::LangRespel.updaterespelButton') }}</button>
						<a class="btn btn-danger btn-close pull-right" style="margin-right: 2rem;" href="{{ route('respels.index') }}"><i class="fas fa-times"></i> {{ trans('adminlte_lang::LangTratamiento.cancel') }}</a>
					</div>
					{{-- @php
					foreach ($contadorRango as $key => $value) {
						foreach ($value as $key2 => $value2) {
							echo $value2;
						}
					}
					@endphp --}}
					<!-- /.nav-tabs-custom -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col md9 -->
		<!-- /.row -->
	</form>
	<!-- /.form  -->
</div>
@endsection
@section('NewScript')
	<script type="text/javascript">
		var contador = {{isset($contadorphp)?$contadorphp:"0"}};
		// var contadorRango = [];

		
		function SelectsRangoTipo(id){
			$('#typerangeSelect'+id).select2({
				allowClear: true,
				tags: true,
				width: 'resolve',
				width: '100%',
				theme: "classic",
			});
		}
		/*desactivar el envio de formulario al usar el boton de agregar opcion*/
		$("#addOptionButton").click(function(event) {
		  event.preventDefault();
		});
		function validarprevent(id){
			$("#droOptionButton"+id).click(function(event) {
			  event.preventDefault();
			});
			$("#addrangeButton"+id).click(function(event) {
			  event.preventDefault();
			});
		}
		function recargarAjaxTratamiento(contador){
			selector = $("#opciontratamiento"+contador);
			id = selector.val();
				$.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				  }
				});
				$.ajax({
					url: "{{url('/preTratamientoDinamico')}}/"+id,
					method: 'GET',
					data:{},
					beforeSend: function(){
						$(".load").append('<i class="fas fa-sync-alt fa-spin"></i>');
						$("#pretratamiento").prop('disabled', true);
					},
					success: function(res){
						$("#pretratamiento"+contador).empty();
						var pretrataOption = new Array();
						for(var i = res.pretratamientos.length -1; i >= 0; i--){
							if ($.inArray(res.pretratamientos[i].ID_PreTrat, pretrataOption) < 0) {
								$("#pretratamiento"+contador).append(`<option value="${res.pretratamientos[i].ID_PreTrat}">${res.pretratamientos[i].PreTratName}</option>`);
								pretrataOption.push(res.pretratamientos[i].ID_PreTrat);
							}else{
								$("#pretratamiento"+contador).append(`<option value="">el Tratamiento elegido no tiene Pretratamientos relacionados</option>`);
							}
						}
						$("#pretratamiento"+contador+"TratName").empty();
						$("#tarifa"+contador+"TratName").empty();
						$("#requerimiento"+contador+"TratName").empty();
						$("#pretratamiento"+contador+"TratName").append(" "+res.TratName);
						$("#tarifa"+contador+"TratName").append(" "+res.TratName);
						$("#requerimiento"+contador+"TratName").append(" "+res.TratName);

					},
					complete: function(){
						$(".load").empty();
						$("#pretratamiento").prop('disabled', false);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						NotifiFalse("No se pudo conectar a la base de datos");
					}
				});
			
		}
		function AgregarOption(){
			contadorRango[contador] = [];
			contadorRango[contador][0] = 0;
			var tratamiento = `@include('layouts.respel-comercial.respel-tratamiento')`;
			var pretratamiento = `@include('layouts.respel-comercial.respel-pretratEvaluacion')`;
			var requerimiento = `@include('layouts.respel-comercial.respel-requerimiento')`;
			var tarifas = `@include('layouts.respel-comercial.respel-tarifas')`;
			$("#Tratamientospane").append(tratamiento);
			$("#Pretratamientospane").append(pretratamiento);
			$("#Requerimientospane").append(requerimiento);
			$("#Tarifaspane").append(tarifas);
			$("#evaluacioncomercial").validator('update');
			popover();
			ChangeSelect();
			SelectsRangoTipo(contador);
			Selects();
			SwitchMain();
			SwitchAuto();
			Switch7();
			validarprevent(contador);
			contador = parseInt(contador)+1;

		}
		function EliminarOption(contador){
			$("#tratamiento"+contador+"Container").remove();
			$("#pretratamiento"+contador+"Container").remove();
			$("#requerimiento"+contador+"Container").remove();
			$("#tarifa"+contador+"Container").remove();
			$("#evaluacioncomercial").validator('update');
		}
		function AgregarRango(opcion){
			if (contadorRango[opcion].length>1) {
				last=contadorRango[opcion].length-1;
			}else{
				last=1;
			}
			var modalrango = `@include('layouts.respel-comercial.modal-rango')`;
			$("#modalrango").empty();
			$("#modalrango").append(modalrango);
			window.addEventListener("keypress", function(event){
				if (event.keyCode == 13){
					event.preventDefault();
				}
			}, false);
			popover();
			$("#createrank").modal();
			$("#createrank").on("hidden.bs.modal", function () {
				var rango = $("#ranktarifa").val();
				if(rango != ''){
					var tarifa = `@include('layouts.respel-comercial.respel-rango')`;
					$("#rango"+opcion+"row").append(tarifa);
					$("#evaluacioncomercial").validator('update');
					// validarprevent(opcion);
					last=last+1
					contadorRango[opcion][last] = last;
				}else{
					$("#modalrango").empty();
					$("#evaluacioncomercial").validator('update');
					// validarprevent(opcion);
				}
			});
		}
		function EliminarRango(opcion,rango){
			$("#rango"+opcion+rango).remove();
			$("#rangodefault"+opcion+rango).append(`<input hidden  type="text" name="Opcion[`+opcion+`][TarifaDesde][]" value=""><input hidden  type="text" name="Opcion[`+opcion+`][TarifaPrecio][]" value="">`);
			$("#evaluacioncomercial").validator('update');
			validarprevent(opcion);
		}
		$(document).ready(function(){
			ChangeSelect();
			Selects();
		});
	</script>
	<script type="text/javascript">
		function SwitchAuto() {
			$(".autoswitch").bootstrapSwitch({
				animate: true,
				labelText: '<i class="fas fa-power-off"></i>',
				onText: 'A',
				offText: 'M',
				onColor: 'success',
				offColor: 'danger',
				onSwitchChange: function () {
					updateMain($(this).data("switch"));
				}
			});
		}
		function updateMain(id) {
			main = $('#main_'+id);
			auto = $('#auto_'+id);
			if (auto.prop("checked")) {
				if (!main.prop("checked")) {
					main.bootstrapSwitch('state', true);
				}
			}
		}
		function SwitchMain() {
			$(".fotoswitchedit").bootstrapSwitch({
				animate: true,
				labelText: '<i class="fas fa-camera"></i>',
				onText: '<i class="fas fa-check"></i>',
				offText: '<i class="fas fa-times"></i>',
				onSwitchChange: function () {
					updateAuto($(this).data("switch"));
				}
			});
			$(".videoswitchedit").bootstrapSwitch({
				animate: true,
				labelText: '<i class="fas fa-video"></i>',
				onText: '<i class="fas fa-check"></i>',
				offText: '<i class="fas fa-times"></i>',
				onSwitchChange: function () {
					updateAuto($(this).data("switch"));
				}
			});
			$(".embalajeswitchedit").bootstrapSwitch({
				animate: true,
				labelText: '<i class="fas fa-trash"></i>',
				onText: '<i class="fas fa-check"></i>',
				offText: '<i class="fas fa-times"></i>',
				onSwitchChange: function () {
					updateAuto($(this).data("switch"));
				}
			});
			$(".auditoriaswitchedit").bootstrapSwitch({
				animate: true,
				labelText: '<i class="fas fa-eye"></i>',
				onText: '<i class="fas fa-check"></i>',
				offText: '<i class="fas fa-times"></i>',
				onSwitchChange: function () {
					updateAuto($(this).data("switch"));
				}
			});
		}
		function updateAuto(name) {
			var main = $('#main_'+name);
			var auto = $('#auto_'+name);
			if (!main.prop("checked")) {
				if (auto.prop("checked")) {
					auto.bootstrapSwitch('state', false);
				}
			}
		}
		$(document).ready(SwitchAuto());
		$(document).ready(SwitchMain());
	</script>
@endsection
@endif
