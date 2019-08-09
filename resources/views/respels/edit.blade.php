@extends('layouts.app')
{{-- vista de edición para el cliente --}}
@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
	@section('htmlheader_title')
	{{ trans('adminlte_lang::LangRespel.Respeledittag') }}
	@endsection
	
	@section('contentheader_title')
	{{ trans('adminlte_lang::LangRespel.Respeleditmenu') }}
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
									@include('layouts.RespelPartials.Respelform1Edit')
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
	{{ trans('adminlte_lang::LangRespel.Respelevaluetemenu') }}
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
									<option {{$Respels->RespelStatus == 'Aprobado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusaprovado') }}</option>
									<option {{$Respels->RespelStatus == 'Rechazado' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusrechazado') }}</option>
									<option {{$Respels->RespelStatus == 'Pendiente' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatuspendiente') }}</option>
									<option {{$Respels->RespelStatus == 'Incompleto' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusincompleto') }}</option>
									<option {{$Respels->RespelStatus == 'Vencido' ? 'selected' : '' }}>{{ trans('adminlte_lang::LangRespel.respelstatusvencido') }}</option>
								</select>
							</li>
							<li class="list-group-item">
								<label>Observaciones</label>
								<textarea maxlength="250" name="RespelStatusDescription" id="taid" class="form-control" rows ="5">{{$Respels->RespelStatusDescription}}</textarea>
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
						 <button onclick="AgregarOption()" class="btn btn-primary pull-right" id="addOptionButton"> <i class="fa fa-plus"></i> {{ trans('adminlte_lang::LangTratamiento.optionadd') }}</button>
						</div>
					</div>

					<!-- /.box header -->
					<!-- box body -->
					<div class="box-body">
						<!-- nav-tabs-custom -->
						<div class="nav-tabs-custom" style="box-shadow:3px 3px 5px grey; margin-bottom: 0px;">
							<ul class="nav nav-tabs">
								<li class="nav-item">
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
								<li class="nav-item active">
									<a class="nav-link" href="#Tarifaspane" data-toggle="tab">{{ trans('adminlte_lang::LangRespel.tarifatabtittle') }}</a>
								</li>
							</ul>
							<!-- nav-content -->
							<div class="tab-content" style="display: block; overflow: auto;">
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Residuopane">
									@include('layouts.respel-cliente.respel-residuo')
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade " id="Tratamientospane">
									{{-- @include('layouts.respel-comercial.respel-tratamiento') --}}
								</div>
								<!-- tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade " id="Pretratamientospane">
									{{-- @include('layouts.respel-comercial.respel-pretrat') --}}
								</div>
								<!-- tab-pane fade -->
								<!-- /.tab-pane fade -->
								<div class="tab-pane fade" id="Requerimientospane">
									{{-- @include('layouts.respel-comercial.respel-requerimiento') --}}
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade in active" id="Tarifaspane">
									{{-- @include('layouts.respel-comercial.respel-tarifas') --}}
								</div>
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
					<!-- /.nav-tabs-custom -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col md9 -->
		<!-- /.row -->
	</form>
	<!-- /.form  -->
</div>
@section('NewScript')
	<script type="text/javascript">
		var contador = 0;
		var contadorRango = [];

		function SelectsRangoTipo(id){
			$('#typerangeSelect'+id).select2({
				allowClear: true,
				tags: true,
				width: 'resolve',
				width: '100%',
				theme: "classic"
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
		function validarSwitch(){
			if ({{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial) ? '' : 'true' }}) {
				Switch1();
				$('.testswitch').bootstrapSwitch('disabled', true);
			}else{
				Switch1();
			}
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
						for(var i = res.length -1; i >= 0; i--){
							if ($.inArray(res[i].ID_PreTrat, pretrataOption) < 0) {
								$("#pretratamiento"+contador).append(`<option value="${res[i].ID_PreTrat}">${res[i].PreTratName}</option>`);
								pretrataOption.push(res[i].ID_PreTrat);
							}else{
								$("#pretratamiento"+contador).append(`<option value="">el Tratamiento elegido no tiene Pretratamientos relacionados</option>`);
							}
						}
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
			contadorRango[contador][0]= 0;
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
			validarSwitch();
			ChangeSelect();
			SelectsRangoTipo(contador);
			Selects();
			Switch2();
			Switch3();
			Switch6();
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
					$("#rango"+opcion+"Container").append(tarifa);
					$("#evaluacioncomercial").validator('update');
					validarprevent(opcion);
					last=last+1
					contadorRango[opcion][last] = last;
				}
			});
		}
		function EliminarRango(opcion,rango){
			console.log(opcion,rango);
			$("#rango"+opcion+rango).remove();
			$("#evaluacioncomercial").validator('update');
		}
		$(document).ready(function(){
			validarSwitch();
			Selects();
			ChangeSelect();
		});
	</script>
@endsection
@endif
@endsection

