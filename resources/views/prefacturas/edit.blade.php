@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('contentheader_title')
@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
<span style="background-image: linear-gradient(40deg, #FFFFFF, #A3A2AE); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@else
<span style="background-image: linear-gradient(40deg, rgb(255, 216, 111), rgb(252, 98, 98)); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endif
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.personaltitleedit') }}</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="/personal/{{$Persona->PersSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
					@method('PATCH')
					@csrf
					@if ($errors->any())
						<div class="alert alert-danger" role="alert">
							<ul>
								@foreach ($errors->all() as $error)
									<p>{{$error}}</p>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="box box-info">
						<div class="box-body" id="readyTable">
							<div class="tab-pane" id="addRowWizz">
								<p>{{ trans('adminlte_lang::message.smartwizzardtitle') }}</p>
								<div class="smartwizard">
									<ul>
										<li><a href="#step-1"><b>{{ trans('adminlte_lang::message.Paso 1') }}</b><br /><small>{{ trans('adminlte_lang::message.personalpaso1smart-wizzard') }}</small></a></li>
										<li><a href="#step-2"><b>{{ trans('adminlte_lang::message.Paso 2') }}</b><br /><small>{{ trans('adminlte_lang::message.personalpaso2smart-wizzard') }}</small></a></li>
										<input name="PersType" id="PersType" type="text" hidden value="1">
									</ul>
									<div>
										<div id="step-1" class="">
											<div class="col-md-12">
												<div id="form-step-0" role="form" data-toggle="validator">
													<div class="form-group col-md-6">
														<label for="Sede" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.sclientsede') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfosede') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.sclientsede') }}</label>
														<small class="help-block with-errors">*</small>
														<select name="Sede" id="Sede" class="form-control select" required>
															<option value="">{{ trans('adminlte_lang::message.select') }}</option>
															@foreach($Sedes as $Sede1)
																<option value="{{$Sede1->SedeSlug}}" {{$Sede->ID_Sede == $Sede1->ID_Sede ? 'selected' : ''}}>{{$Sede1->SedeName}}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group col-md-6">
														<label for="CargArea" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.areaname') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfoarea') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.areaname') }}</label><a class="loadCargArea"></a>
														<small class="help-block with-errors">*</small>
														<select name="CargArea" id="CargArea" class="form-control" required>
															<option onclick="HiddenNewInputA()" value="">{{ trans('adminlte_lang::message.select') }}</option>
															@foreach($Areas as $Area)
																<option value="{{$Area->AreaSlug}}" {{$Sede->ID_Area == $Area->ID_Area ? 'selected' : ''}} onclick="HiddenNewInputA()">{{$Area->AreaName}}</option>
															@endforeach
															<option onclick="NewInputA()" value="NewArea">{{ trans('adminlte_lang::message.newarea') }}</option>
														</select>
													</div>
													<div class="form-group col-md-6" id="divFK_PersCargo" >
														<label for="FK_PersCargo" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.cargoname') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfocargo') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.cargoname') }}</label><a class="loadFK_PersCargo"></a>
														<small class="help-block with-errors">*</small>
														<select name="FK_PersCargo" id="FK_PersCargo" class="form-control" required>
															<option onclick="HiddenNewInputC()" value="">{{ trans('adminlte_lang::message.select') }}</option>
															@foreach($Cargos as $Cargo)
																<option value="{{$Cargo->CargSlug}}" {{$Sede->ID_Carg == $Cargo->ID_Carg ? 'selected' : ''}} onclick="HiddenNewInputC()">{{$Cargo->CargName}}</option>
															@endforeach
															<option onclick="NewInputC()" value="NewCargo">{{ trans('adminlte_lang::message.newcargo') }}</option>
														</select>
													</div>
													@if(($IdPersonaAdmin[0]->ID_Pers == Auth::user()->FK_UserPers)&&($Persona->ID_Pers !== Auth::user()->FK_UserPers))
													<div class="form-group col-md-6" id="Persfacturacion" >
														<label for="Persadmin" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.persadminlabel') }}</b>" data-content="{{ trans('adminlte_lang::message.persadmininfo') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.persadminlabel') }}</label><a class="loadFK_PersCargo"></a>
														<small class="help-block with-errors">*</small>
														<select name="PersAdmin" id="Persadmin" class="form-control" required>
															<option {{$Persona->PersAdmin == 1 ? 'selected' : ''}} value="1">Si</option>
															
															<option {{$Persona->PersAdmin == 0 ? 'selected' : ''}} value="0">No</option>
														</select>
													</div>
													@elseif(($IdPersonaAdmin[0]->ID_Pers == Auth::user()->FK_UserPers)&&($Persona->ID_Pers == Auth::user()->FK_UserPers))
														<input hidden type="text" name="PersAdmin" value="1">
													@else
														<input hidden type="text" name="PersAdmin" value="0">
													@endif
													@if(($IdPersonaAdmin[0]->ID_Pers == Auth::user()->FK_UserPers)&&($Persona->ID_Pers !== Auth::user()->FK_UserPers))
													<div class="form-group col-md-6" id="Persfacturacion" >
														<label for="Persfactura" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.persfacturalabel') }}</b>" data-content="{{ trans('adminlte_lang::message.persfacturainfo') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.persfacturalabel') }}</label><a class="loadFK_PersCargo"></a>
														<small class="help-block with-errors">*</small>
														<select name="Persfactura" id="Persfactura" class="form-control" required>
															<option {{$Persona->PersFactura == 1 ? 'selected' : ''}} value="1">Si</option>
															
															<option {{$Persona->PersFactura == 0 ? 'selected' : ''}} value="0">No</option>
														</select>
													</div>
													@elseif(($IdPersonaAdmin[0]->ID_Pers == Auth::user()->FK_UserPers)&&(Auth::user()->FK_UserPers !=  $IdPersonaFacturacion[0]->ID_Pers))
														<div class="form-group col-md-6" id="Persfacturacion" >
															<label for="Persfactura" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.persfacturalabel') }}</b>" data-content="{{ trans('adminlte_lang::message.persfacturainfo') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.persfacturalabel') }}</label><a class="loadFK_PersCargo"></a>
															<small class="help-block with-errors">*</small>
															<select name="Persfactura" id="Persfactura" class="form-control" required>
																<option {{$Persona->PersFactura == 1 ? 'selected' : ''}} value="1">Si</option>
																
																<option {{$Persona->PersFactura == 0 ? 'selected' : ''}} value="0">No</option>
															</select>
														</div>
													@else
														<input hidden type="text" name="Persfactura" value="0">
													@endif
													<div class="form-group col-md-6" id="NewArea" style="display: none;">
														<label for="NewInputA" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.namenewarea') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfonewarea') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.namenewarea') }}</label>
														<small class="help-block with-errors">*</small>
														<input data-minlength="4" name="NewArea" type="text" id="NewInputA" class="form-control inputText" placeholder="{{ trans('adminlte_lang::message.newarea') }}">
													</div>
													<div class="form-group col-md-6" id="NewCargo" style="display: none;">
														<label for="NewInputC" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.namenewcargo') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfonewcarg') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.namenewcargo') }}</label>
														<small class="help-block with-errors">*</small>
														<input data-minlength="4" name="NewCargo" type="text" id="NewInputC" class="form-control inputText" placeholder="{{ trans('adminlte_lang::message.newcargo') }}">
													</div>
												</div>
											</div>
										</div>
										<div id="step-2" class="">
											<div class="col-md-12">
												<div id="form-step-1" role="form" data-toggle="validator">
													<div class="form-group col-md-6">
														<label for="PersDocType" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.persdoctype') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfotypedoc') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.persdoctype') }}</label>
														<small class="help-block with-errors"></small>
														<select name="PersDocType" id="PersDocType" class="form-control">
															<option {{$Persona->PersDocType == 'CC' ? 'selected' : ''}} value="CC">{{ trans('adminlte_lang::message.persdoctypecc') }}</option>
															<option {{$Persona->PersDocType == 'CE' ? 'selected' : ''}} value="CE">{{ trans('adminlte_lang::message.persdoctypece') }}</option>
															<option {{$Persona->PersDocType == 'NIT' ? 'selected' : ''}} value="NIT">{{ trans('adminlte_lang::message.persdoctypenit') }}</option>
															<option {{$Persona->PersDocType == 'RUT' ? 'selected' : ''}} value="RUT">{{ trans('adminlte_lang::message.persdoctyperut') }}</option>
														</select>
													</div>
													<div class="form-group col-md-6">
														<label for="PersDocNumber" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.persdocument') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfodoc') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.persdocument') }}</label>
														<small class="help-block with-errors errorsdoc"></small>
														<input data-minlength="6" maxlength="11" name="PersDocNumber" type="text" class="form-control document" id="PersDocNumber" value="{{$Persona->PersDocNumber}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersFirstName" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.persfirstname') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfofirstname') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.persfirstname') }}</label>
														<small class="help-block with-errors">*</small>
														<input  required name="PersFirstName" autofocus="true" type="text" class="form-control nombres" id="PersFirstName" value="{{$Persona->PersFirstName}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersSecondName" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.perssecondtname') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfosecondname') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.perssecondtname') }}</label>
														<input name="PersSecondName" autofocus="true" type="text" class="form-control nombres" id="PersSecondName" value="{{$Persona->PersSecondName}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersLastName" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.perslastname') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfolastname') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.perslastname') }}</label>
														<small class="help-block with-errors">*</small>
														<input  required name="PersLastName" autofocus="true" type="text" class="form-control nombres" id="PersLastName" value="{{$Persona->PersLastName}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersEmail" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.emailaddress') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfoemailextr') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.emailaddress') }}</label>
														<small class="help-block with-errors">*</small>
														<input type="email" name="PersEmail" id="PersEmail" class="form-control" required placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" value="{{$Persona->PersEmail}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersCellphone" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.mobile') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfotel') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.mobile') }}</label>
														<small class="help-block with-errors">*</small>
														<div class="input-group">
															<span class="input-group-addon">(+57)</span>
															<input data-minlength="12" required name="PersCellphone" autofocus="true" type="tel" class="form-control mobile" id="PersCellphone" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" value="{{$Persona->PersCellphone}}">
														</div>
													</div>
													<div class="form-group col-md-6">
														<label for="PersAddress" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.address') }}</b>" data-content="{{ trans('adminlte_lang::message.persinfodir') }} <b>(Opcional)</b>"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.address') }}</label>
														<input name="PersAddress" autofocus="true" type="text" class="form-control" id="PersAddress" placeholder="{{ trans('adminlte_lang::message.addressplaceholder') }}" value="{{$Persona->PersAddress}}">
													</div>
													<input name="PersSlug" hidden value="{{$Persona->PersSlug}}">
												</div>
												<div class="box-footer">
													<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.update') }}</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
				</form>
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
@section('NewScript')
	<script>
		$(document).ready(function(){
			$('#Sede').on('change', function() { 
				var id = $('#Sede').val();
				if(id != 0){
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						}
					});
					$.ajax({
						url: "{{url('/area-sede')}}/"+id,
						method: 'GET',
						data:{},
						beforeSend: function(){
							$(".loadCargArea").append('<i class="fas fa-sync-alt fa-spin"></i>');
							$("#CargArea").prop('disabled', true);
						},
						success: function(res){
							if(res != ''){
								$("#CargArea").empty();
								var areas = new Array();
								$("#CargArea").append(`<option onclick="HiddenNewInputA()" value="">Seleccione...</option>`);
								for(var i = res.length -1; i >= 0; i--){
									if ($.inArray(res[i].AreaSlug, areas) < 0) {
										$("#CargArea").append(`<option onclick="HiddenNewInputA()" value="${res[i].AreaSlug}">${res[i].AreaName}</option>`);
										areas.push(res[i].AreaSlug);
									}
								}
								$("#CargArea").append(`<option onclick="NewInputA()" value="NewArea">Nuevo Area</option>`);
							}
							else{
								$("#CargArea").empty();
								$("#CargArea").append(`<option onclick="NewInputA()" value="NewArea">Nueva Area</option>`);
								document.getElementById("NewArea").style.display = 'block';
								document.getElementById("NewInputA").required = true;
								$("#FK_PersCargo").empty();
								document.getElementById("divFK_PersCargo").style.display = 'none';
								document.getElementById("FK_PersCargo").required = false;
								document.getElementById("FK_PersCargo").value = "NewCargo";
								document.getElementById("NewCargo").style.display = 'block';
								document.getElementById("NewInputC").required = true;
							}
						},
						complete: function(){
							$(".loadCargArea").empty();
							$("#CargArea").prop('disabled', false);
						}
					})
				}
			});

			$('#CargArea').on('change', function() { 
				var id = $('#CargArea').val();
				if(id != 0){
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						}
					});
					$.ajax({
						url: "{{url('/cargo-area')}}/"+id,
						method: 'GET',
						data:{},
						beforeSend: function(){
							$(".loadFK_PersCargo").append('<i class="fas fa-sync-alt fa-spin"></i>');
							$("#FK_PersCargo").prop('disabled', true);
						},
						success: function(res){
							if(res != ''){
								$("#FK_PersCargo").empty();
								var cargos = new Array();
								$("#FK_PersCargo").append(`<option onclick="HiddenNewInputA()" value="">Seleccione...</option>`);
								for(var i = res.length -1; i >= 0; i--){
									if ($.inArray(res[i].CargSlug, cargos) < 0) {
										$("#FK_PersCargo").append(`<option onclick="HiddenNewInputC()" value="${res[i].CargSlug}">${res[i].CargName}</option>`);
										cargos.push(res[i].CargSlug);
									}
								}
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="NewCargo">Nuevo Cargo</option>`);
							}
							else{
								$("#FK_PersCargo").empty();
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="NewCargo">Nuevo Cargo</option>`);
								document.getElementById("NewCargo").style.display = 'block';
								document.getElementById("NewInputC").required = true;
							}
						},
						complete: function(){
							$(".loadFK_PersCargo").empty();
							$("#FK_PersCargo").prop('disabled', false);
						}
					})
				}
			});

		});
		function NewInputA(){
			document.getElementById("NewArea").style.display = 'block';
			document.getElementById("NewInputA").required = true;
			document.getElementById("divFK_PersCargo").style.display = 'none';
			document.getElementById("FK_PersCargo").required = false;
			document.getElementById("FK_PersCargo").value = "NewCargo";
			document.getElementById("NewCargo").style.display = 'block';
			document.getElementById("NewInputC").required = true;
		}
		function HiddenNewInputA(){
			document.getElementById("NewArea").style.display = 'none';
			document.getElementById("NewInputA").required = false;
			document.getElementById("divFK_PersCargo").style.display = 'block';
			document.getElementById("FK_PersCargo").required = true;
			document.getElementById("NewCargo").style.display = 'none';
			document.getElementById("NewInputC").required = false;
		}
		function NewInputC(){
			document.getElementById("NewCargo").style.display = 'block';
			document.getElementById("NewInputC").required = true;
		}
		function HiddenNewInputC(){
			document.getElementById("NewCargo").style.display = 'none';
			document.getElementById("NewInputC").required = false;
		}

		$(document).ready(function(){
			var type = $("#PersType").val();
			if(type == 0){
				$("#PersAddress").prop('required', true);
				$("#PersAddress").before('<small class="help-block with-errors dir">*</small>');
			}
		});
	</script>
@endsection