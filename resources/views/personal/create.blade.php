@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<!-- /.box -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">{{ trans('adminlte_lang::message.personaltitleregister') }}</h3>
					</div>
					<form role="form" action="/personal" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
															<label for="Sede">{{ trans('adminlte_lang::message.sclientsede') }}</label><small class="help-block with-errors">*</small>
															<select name="Sede" id="Sede" class="form-control select" required>
																<option value="">{{ trans('adminlte_lang::message.select') }}</option>
																@foreach($Sedes as $Sede)
																	<option value="{{$Sede->ID_Sede}}" {{old('Sede') == $Sede->ID_Sede ? 'selected' : '' }}>{{$Sede->SedeName}}</option>
																@endforeach
															</select>
														</div>
														<div class="form-group col-md-6">
															<label for="CargArea">{{ trans('adminlte_lang::message.areaname') }}</label><small class="help-block with-errors">*</small>
															<select name="CargArea" id="CargArea" class="form-control" required>
																@if($Areas == null)
																	<option value="" onclick="HiddenNewInputA()">{{ trans('adminlte_lang::message.select') }}</option>
																@else
																	@foreach($Areas as $Area)
																		<option value="{{$Area->ID_Area}}" onclick="HiddenNewInputA()" {{old('CargArea') == $Area->ID_Area ? 'selected' : '' }}>{{$Area->AreaName}}</option>
																	@endforeach
																	<option onclick="NewInputA()" value="NewArea" {{old('CargArea') == "NewArea" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.newarea') }}</option>
																@endif
															</select>
														</div>
														<div class="form-group col-md-6" id="divFK_PersCargo" >
															<label for="FK_PersCargo">{{ trans('adminlte_lang::message.cargoname') }}</label><small class="help-block with-errors">*</small>
															<select name="FK_PersCargo" id="FK_PersCargo" class="form-control" required>
																@if($Cargos == null)
																	<option value="" onclick="HiddenNewInputC()">{{ trans('adminlte_lang::message.select') }}</option>
																@else
																	@foreach($Cargos as $Cargo)
																		<option value="{{$Cargo->ID_Carg}}" onclick="HiddenNewInputC()" {{old('FK_PersCargo') == $Cargo->ID_Carg ? 'selected' : '' }}>{{$Cargo->CargName}}</option>
																	@endforeach
																	<option onclick="NewInputC()" value="NewCargo" {{old('FK_PersCargo') == "NewCargo" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.newcargo') }}</option>
																@endif
															</select>
														</div>
														<div class="form-group col-md-6" id="NewArea" style="display: none;">
															<label for="NewInputA">{{ trans('adminlte_lang::message.namenewarea') }}</label><small class="help-block with-errors">*</small>
															<input data-minlength="8" data-error="{{ trans('adminlte_lang::message.data-error-minlength4') }}" name="NewArea" type="text" id="NewInputA" class="form-control inputText" placeholder="{{ trans('adminlte_lang::message.newarea') }}">
														</div>
														<div class="form-group col-md-6" id="NewCargo" style="display: none;">
															<label for="NewInputC">{{ trans('adminlte_lang::message.namenewcargo') }}</label><small class="help-block with-errors">*</small>
															<input data-minlength="8" data-error="{{ trans('adminlte_lang::message.data-error-minlength4') }}" name="NewCargo" type="text" id="NewInputC" class="form-control inputText" placeholder="{{ trans('adminlte_lang::message.newcargo') }}">
														</div>
													</div>
												</div>
											</div>
											<div id="step-2" class="">
												<div class="col-md-12">
													<div id="form-step-1" role="form" data-toggle="validator">
														<div class="form-group col-md-6">
															<label for="PersDocType">{{ trans('adminlte_lang::message.persdoctype') }}</label><small class="help-block with-errors">*</small>
															<select name="PersDocType" id="PersDocType" class="form-control select" required>
																<option value="">{{ trans('adminlte_lang::message.select') }}</option>
																<option value="CC" {{old('PersDocType') == 'CC' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.persdoctypecc') }}</option>
																<option value="CE" {{old('PersDocType') == 'CE' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.persdoctypece') }}</option>
																<option value="NIT" {{old('PersDocType') == 'NIT' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.persdoctypenit') }}</option>
																<option value="RUT" {{old('PersDocType') == 'RUT' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.persdoctyperut') }}</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label for="PersDocNumber">{{ trans('adminlte_lang::message.persdocument') }}</label><small class="help-block with-errors errorsdoc">*</small>
															<input data-minlength="6" maxlength="11" required name="PersDocNumber" data-error="{{ trans('adminlte_lang::message.data-error-minlength6') }}" type="text" class="form-control document" id="PersDocNumber" value="{{old('PersDocNumber')}}">
														</div>
														<div class="form-group col-md-6">
															<label for="PersFirstName">{{ trans('adminlte_lang::message.persfirstname') }}</label><small class="help-block with-errors">*</small>
															<input  required name="PersFirstName" autofocus="true" type="text" class="form-control nombres" id="PersFirstName" value="{{old('PersFirstName')}}">
														</div>
														<div class="form-group col-md-6">
															<label for="PersSecondName">{{ trans('adminlte_lang::message.perssecondtname') }}</label>
															<input name="PersSecondName" autofocus="true" type="text" class="form-control nombres" id="PersSecondName" value="{{old('PersSecondName')}}">
														</div>
														<div class="form-group col-md-6">
															<label for="PersLastName">{{ trans('adminlte_lang::message.perslastname') }}</label><small class="help-block with-errors">*</small>
															<input  required name="PersLastName" autofocus="true" type="text" class="form-control nombres" id="PersLastName" value="{{old('PersLastName')}}">
														</div>
														<div class="form-group col-md-6">
															<label for="PersEmail">{{ trans('adminlte_lang::message.emailaddress') }}</label><small class="help-block with-errors">*</small>
															<input type="email" name="PersEmail" id="PersEmail" class="form-control" required placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" value="{{old('PersEmail')}}">
														</div>
														<div class="form-group col-md-6">
															<label for="PersCellphone">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
															<input data-minlength="12" required name="PersCellphone" autofocus="true" type="text" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" class="form-control mobile" id="PersCellphone" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" value="{{old('PersCellphone')}}">
														</div>
														<div class="form-group col-md-6">
															<label for="PersAddress">{{ trans('adminlte_lang::message.address') }}</label>
															<input name="PersAddress" autofocus="true" type="text" class="form-control" id="PersAddress" placeholder="{{ trans('adminlte_lang::message.addressplaceholder') }}" value="{{old('PersAddress')}}">
														</div>
													</div>
													<div class="box-footer pull-right">
														<button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.register') }}</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
						<!-- /.box-body -->
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
			var area = $('#CargArea').val();
			var cargo = $('#FK_PersCargo').val();
			if(area == "NewArea"){
				$("#NewInputA").val("{{old('NewArea')}}");
				$('#FK_PersCargo').val("NewCargo");
				document.getElementById("NewArea").style.display = 'block';
				document.getElementById("NewInputA").required = true;
				document.getElementById("divFK_PersCargo").style.display = 'none';
				document.getElementById("FK_PersCargo").required = false;
			}
			if(cargo == "NewCargo"){
				$("#NewInputC").val("{{old('NewCargo')}}");
				document.getElementById("NewCargo").style.display = 'block';
				document.getElementById("NewInputC").required = true;
			}
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
						success: function(res){
							if(res != ''){
								$("#CargArea").empty();
								var areas = new Array();
								$("#CargArea").append(`<option onclick="HiddenNewInputA()" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
								for(var i = res.length -1; i >= 0; i--){
									if ($.inArray(res[i].ID_Area, areas) < 0) {
										$("#CargArea").append(`<option onclick="HiddenNewInputA()" value="${res[i].ID_Area}">${res[i].AreaName}</option>`);
										areas.push(res[i].ID_Area);
									}
								}
								$("#CargArea").append(`<option onclick="NewInputA()" value="NewArea">{{ trans('adminlte_lang::message.newarea') }}</option>`);
							}
							else{
								$("#CargArea").empty();
								$("#CargArea").append(`<option onclick="NewInputA()" value="NewArea">{{ trans('adminlte_lang::message.newarea') }}</option>`);
								document.getElementById("NewArea").style.display = 'block';
								document.getElementById("NewInputA").required = true;
								$("#FK_PersCargo").empty();
								document.getElementById("divFK_PersCargo").style.display = 'none';
								document.getElementById("FK_PersCargo").required = false;
								document.getElementById("NewCargo").style.display = 'block';
								document.getElementById("NewInputC").required = true;
							}
						},
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
						success: function(res){
							if(res != ''){
								$("#FK_PersCargo").empty();
								var cargos = new Array();
								$("#FK_PersCargo").append(`<option onclick="HiddenNewInputA()" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
								for(var i = res.length -1; i >= 0; i--){
									if ($.inArray(res[i].ID_Carg, cargos) < 0) {
										$("#FK_PersCargo").append(`<option onclick="HiddenNewInputC()" value="${res[i].ID_Carg}">${res[i].CargName}</option>`);
										cargos.push(res[i].ID_Carg);
									}
								}
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="NewCargo">{{ trans('adminlte_lang::message.newcargo') }}</option>`);
							}
							else{
								$("#FK_PersCargo").empty();
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="NewCargo">{{ trans('adminlte_lang::message.newcargo') }}</option>`);
								document.getElementById("NewCargo").style.display = 'block';
								document.getElementById("NewInputC").required = true;
							}
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
			document.getElementById("FK_PersCargo").value = "0";
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