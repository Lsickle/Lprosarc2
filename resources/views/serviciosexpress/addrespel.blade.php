@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
	Express-Solicitudes
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Añadir residuos adicionales</h3>
				</div>
				<div class="box box-info">
					<form role="form" id="EditSolSer" action="/solicitud-servicio/{{$Solicitud->SolSerSlug}}/update-respel" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@method('PUT')
						@csrf
						<div class="box-body">
							<div class="col-md-12" style="margin-bottom: 1.5em;">
								<div class="form-group col-md-6">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserpersonal') }}</b>" data-content="{{ trans('adminlte_lang::message.solserpersonaldescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserpersonal') }}</label>
									<small class="help-block with-errors">*</small>
									<select id="FK_SolSerPersona" class="form-control" required="" disabled>
										<option Selected >{{$Persona->PersFirstName.' '.$Persona->PersLastName}}</option>
									</select>
								</div>
								
								<div class="form-group col-md-6">
									<label style="color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsersupportpay') }}</b>" data-content="En este campo puede adjuntar un archivo PDF del Soporte de Pago como constancia de haber cancelado el costo de la solicitud de servicio... <br><b>Tamaño maximo del archivo: 5 Mb.</b> <br><br> Para mas detalles comuníquese con su <b>Asesor Comercial</b>"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solsersupportpay')}}</label>
										<small class="help-block with-errors"></small>
									<div class="input-group">
										<input type="file" data-validate="true" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf" disabled>
										<div class="input-group-btn">
											<a href="#" class="btn btn-default"> <i class="fas fa-file-pdf fa-lg"></i> </a>
										</div>
									</div>
								</div>

								<div class="form-group col-md-12">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserpersonalcopy') }}</b>" data-content="{{ trans('adminlte_lang::message.solsermailcopy') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserpersonalcopy') }}</label>
									<small class="help-block with-errors"></small>
									<select multiple id="SolServMailCopia" class="form-control" disabled>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach ($Personals as $Personal)
										<option 
										@if ($Solicitud->SolServMailCopia !== "null")
										@foreach(json_decode($Solicitud->SolServMailCopia) as $contactoCopia)
											@if ($contactoCopia == $Personal->PersEmail)
												selected
											@endif
										@endforeach
										@endif
										value="{{$Personal->PersEmail}}">{{$Personal->PersFirstName.' '.$Personal->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								
								<div class="form-group col-md-6">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsertypetrans') }}</b>" data-content="{{ trans('adminlte_lang::message.solsertypetransdescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsertypetrans') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolSerTipo" required="" disabled>
										@if(true)
											<option value="99" {{$Solicitud->SolSerTipo == 'Interno' ? 'selected' : ''}}>{{ trans('adminlte_lang::message.solsertransprosarc') }}</option>
											<option value="98" {{$Solicitud->SolSerTipo == 'Externo' ? 'selected' : ''}}>{{ trans('adminlte_lang::message.solsertranspro') }}</option>
										@else
											<option value="99" {{$Solicitud->SolSerTipo == 'Interno' ? 'selected' : ''}}>{{ trans('adminlte_lang::message.solsertransprosarc') }}</option>
											<option value="98" {{$Solicitud->SolSerTipo == 'Externo' ? 'selected' : ''}}>{{ trans('adminlte_lang::message.solsertranspro') }}</option>
										@endif
									</select>
								</div>
								<div id="transportador" class="form-group col-md-6">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsertranspro') }}</b>" data-content="{{ trans('adminlte_lang::message.solsertransprodescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsertranspro') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolSerTransportador" selected disabled>
										<option value="99" {{$Cliente->CliName == $Solicitud->SolSerNameTrans ? 'selected' : ''}}>{{$Cliente->CliName}}</option>
										<option value="98" {{$Cliente->CliName <> $Solicitud->SolSerNameTrans ? 'selected' : ''}}>{{ trans('adminlte_lang::message.solsertransother') }}</option>
									</select>
								</div>
								<div id="nametransportadora" class="form-group col-md-6">
									<label for="SolSerNameTrans">{{ trans('adminlte_lang::message.solsertransname') }}</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="SolSerNameTrans" value="" disabled>
								</div>
								<div id="nittransportadora" class="form-group col-md-6">
									<label for="SolSerNitTrans">{{ trans('adminlte_lang::message.solsertransnit') }}</label>
									<small class="help-block with-errors">*</small>
									<input type="text" class="form-control nit" id="SolSerNitTrans" value="" disabled>
								</div>
								<div id="addresstransportadora" class="form-group col-md-12">
									<label for="SolSerAdressTrans">{{ trans('adminlte_lang::message.solsertransaddress') }}</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="SolSerAdressTrans" value="" disabled>
								</div>
								<div class="form-group col-md-6 citytransportadora">
									<label for="departamento">{{ trans('adminlte_lang::message.solsertransdepart') }}</label>
									<select class="form-control select" id="departamento" disabled>
										@foreach ($Departamentos as $Departament)
											<option value="{{$Departament->ID_Depart}}" {{$Solicitud->SolSerCityTrans <> null ? ($Departamento->ID_Depart == $Departament->ID_Depart ? 'selected' : '') : ''}}>{{$Departament->DepartName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6 citytransportadora">
									<label for="municipio">{{ trans('adminlte_lang::message.solsertransmuni') }}</label><a class="load"></a>
									<small class="help-block with-errors">*</small>
									<select name="SolSerCityTrans" class="form-control select" id="municipio" disabled>
										@if($Solicitud->SolSerCityTrans <> null)
										@foreach($Municipios as $Municipi)
											<option value="{{$Municipi->ID_Mun}}" {{$Solicitud->SolSerCityTrans <> null ? ($Solicitud->SolSerCityTrans == $Municipi->ID_Mun ? 'selected' : '') : ''}}>{{$Municipi->MunName}}</option>
										@endforeach
										@endif
									</select>
								</div>
								<div id="Conductor" class="form-group col-md-6">
									<label for="SolSerConductor">{{ trans('adminlte_lang::message.solserconduc') }}</label>
									<input maxlength="255" type="text" class="form-control" id="SolSerConductor" value="" disabled>
								</div>
								<div id="Vehiculo" class="form-group col-md-6">
									<label for="SolSerVehiculo">{{ trans('adminlte_lang::message.solservehic') }}</label>
									<input type="text" class="form-control placa" id="SolSerVehiculo" value="" disabled>
								</div>
								<div id="typeaditable" class="form-group col-md-12">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserpersonal') }}</b>" data-content="{{ trans('adminlte_lang::message.solserpersonaldescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solseraudi') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolResAuditoriaTipo" required="" disabled>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										<option value="99" {{ $Solicitud->SolResAuditoriaTipo == 'Presencial' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solseraudiprese') }}</option>
										<option value="98" {{ $Solicitud->SolResAuditoriaTipo == 'Virtual' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solseraudivirt') }}</option>
										<option value="97" {{ $Solicitud->SolResAuditoriaTipo == 'No Auditable' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solsernoaudi') }}</option>
									</select>
								</div>
								<div id="typecollect" class="form-group col-md-12">
									<label>{{ trans('adminlte_lang::message.solsertypecollect') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control" id="SolSerTypeCollect" required="" disabled>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										<option value="99" {{ $Solicitud->SolSerTypeCollect == 99 ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solsertypecollect1') }}</option>
										<option value="98" {{ $Solicitud->SolSerTypeCollect == 98 ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solsertypecollect2') }}</option>
										<option value="97" {{ $Solicitud->SolSerTypeCollect == 97 ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solsertypecollect3') }}</option>
									</select>
								</div>
								<div id="sedecollect" class="form-group col-md-6">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsersedecollect') }}</b>" data-content="{{ trans('adminlte_lang::message.solsersedecollectdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsersedecollect') }}</label>
									<small class="help-block with-errors">*</small>
									<select class="form-control select" id="SedeCollect" disabled>
										@foreach($Sedes as $Sede)
											<option value="{{$Sede->SedeSlug}}" {{ $Solicitud->SolSerCollectAddress == $Sede->ID_Sede ? 'selected' : '' }}>{{$Sede->SedeName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6 addresscollect" hidden="">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solseraddrescollect') }}</b>" data-content="{{ trans('adminlte_lang::message.solseraddrescollectdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solseraddrescollect') }}</label>
									<small class="help-block with-errors">*</small>
									<input maxlength="255" type="text" class="form-control" id="AddressCollect" disabled>
								</div>
								<div class="form-group col-md-6 addresscollect" hidden="">
									<label for="departamento2">{{ trans('adminlte_lang::message.solseraddrescollectdepa') }}</label>
									<select class="form-control select" id="departamento2" disabled>
										@foreach ($Departamentos as $Departament2)
											<option value="{{$Departament2->ID_Depart}}" {{$Solicitud->FK_SolSerCollectMun <> null ? ($Departamento2->ID_Depart == $Departament2->ID_Depart ? 'selected' : '' ) : ''}}>{{$Departament2->DepartName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6 addresscollect" hidden="">
									<label for="municipio2">{{ trans('adminlte_lang::message.solseraddrescollectmuni') }}</label><a class="load"></a>
									<small class="help-block with-errors">*</small>
									<select name="FK_SolSerCollectMun" class="form-control select" id="municipio2" disabled>
										@if($Solicitud->FK_SolSerCollectMun <> null)
										@foreach($Municipios2 as $Municipio2)
											<option value="{{$Municipio2->ID_Mun}}" {{$Solicitud->FK_SolSerCollectMun <> null ? ($Solicitud->FK_SolSerCollectMun == $Municipio2->ID_Mun ? 'selected' : '') : ''}}>{{$Municipio2->MunName}}</option>
										@endforeach
										@endif
									</select>
								</div>
								<div>
									<center>
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="Observaciones <b>Opcional</b>" data-content="En este campo puede redactar sus observaciones con relación a esta solicitud de servicio"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones</label>
										<button type="button" class="btn btn-box-tool boton" style="color: black;" data-toggle="collapse" data-target=".Observaciones" onclick="AnimationMenusForm('.Observaciones')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requirements') }}</b>" data-content="{{ trans('adminlte_lang::message.requirementsdescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.requirements') }}</label>
										<button type="button" class="btn btn-box-tool boton" style="color: black;" data-toggle="collapse" data-target=".Requerimientos" onclick="AnimationMenusForm('.Requerimientos')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>	
									</center>
									<div class="form-group col-md-12 collapse Observaciones" style="margin-bottom: 1em;">
										<small id="caracteresrestantes" class="help-block with-errors"></small>
										<textarea onchange="updatecaracteres()" id="textDescription" rows ="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" name="SolSerDescript"></textarea>
									</div>
									<div id="requirimientos" class="col-md-12 collapse Requerimientos" style="margin: 10px 0;">
										<div class="col-md-12" style="border: 2px dashed #00c0ef">
											<div class="col-md-4" style="text-align: center;">
												<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserticket') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserticketdescrit') }} </p>">
													<label for="SolSerBascula">{{ trans('adminlte_lang::message.solserticket') }}</label>
													<div style="width: 100%; height: 34px;">
														<input type="checkbox" class="testswitch" disabled {{$Solicitud->SolSerBascula <> null ? 'checked' : '' }}>
													</div>
												</label>
											</div>
											<div class="col-md-4" style="text-align: center;">
												<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserperscapa') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solserperscapadescrit') }} </p>">
													<label for="SolSerCapacitacion">{{ trans('adminlte_lang::message.solserperscapa') }}</label>
													<div style="width: 100%; height: 34px;">
														<input type="checkbox" class="testswitch" disabled {{$Solicitud->SolSerCapacitacion <> null ? 'checked' : '' }}>
													</div>
												</label>
											</div>
											<div class="col-md-4" style="text-align: center;">
												<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsermaspers') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solsermaspersdescrit') }} </p>">
													<label for="SolSerMasPerson">{{ trans('adminlte_lang::message.solsermaspers') }}</label>
													<div style="width: 100%; height: 34px;">
														<input type="checkbox" class="testswitch" disabled {{$Solicitud->SolSerMasPerson <> null ? 'checked' : '' }}>
													</div>
												</label>
											</div>
											<div class="col-md-4" style="text-align: center;">
												<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicexclusi') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicexclusidescrit') }} </p>">
													<label for="SolSerVehicExclusive">{{ trans('adminlte_lang::message.solservehicexclusi') }}</label>
													<div style="width: 100%; height: 34px;">
														<input type="checkbox" class="testswitch" disabled {{$Solicitud->SolSerVehicExclusive <> null ? 'checked' : '' }}>
													</div>
												</label>
											</div>
											<div class="col-md-4" style="text-align: center;">
												<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solservehicplata') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.solservehicplatadescrit') }} </p>">
													<label for="SolSerPlatform">{{ trans('adminlte_lang::message.solservehicplata') }}</label>
													<div style="width: 100%; height: 34px;">
														<input type="checkbox" class="testswitch" disabled {{$Solicitud->SolSerPlatform <> null ? 'checked' : '' }}>
													</div>
												</label>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div id="AddGenerador" class="col-md-16">
								<a onclick="AgregarGenerador()" id="Agregar" class="btn btn-primary" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b> {{ trans('adminlte_lang::message.solseraddgener') }}</b>" data-content="{{ trans('adminlte_lang::message.solseraddgenerdescrit2') }}"><i class="fas fa-plus-circle"></i> {{ trans('adminlte_lang::message.solseraddgener') }}</a>
							</div>
						</div>
						<div id="ModalSupport"></div>
						<div class="box box-info">
							<div class="box-footer">
								<a href="#" onclick="$('#Submit').hasClass('disabled') ? $('#Submit').click() : submitverify()" id="Submit2" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.update') }}</a>
								<button type="submit" id="Submit" style="display: none;"></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
<script>
$(document).ready(function(){
	var area = document.getElementById("textDescription");
	var message = document.getElementById("caracteresrestantes");
	var maxLength = 4000;
	$('#textDescription').keyup(function updatecaracteres() {
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
	});
})
@if($Solicitud->SolSerTipo == 'Externo')
	$("#SolSerTransportador").attr('required', true);
	$('#transportador').attr('hidden',false);
	@if($Cliente->CliName <> $Solicitud->SolSerNameTrans)
		$('#SolSerNameTrans').val('{{$Solicitud->SolSerNameTrans}}');
		$("#SolSerNameTrans").attr('required', true);
		$('#nametransportadora').attr('hidden',false);
		$('#SolSerNitTrans').val('{{$Solicitud->SolSerNitTrans}}');
		$("#SolSerNitTrans").attr('required', true);
		$('#nittransportadora').attr('hidden',false);
		$('#SolSerAdressTrans').val('{{$Solicitud->SolSerAdressTrans}}');
		$("#SolSerAdressTrans").attr('required', true);
		$('#addresstransportadora').attr('hidden',false);
		$("#municipio").attr('required', true);
		$('.citytransportadora').attr('hidden',false);
	@else
		$("#SolSerNameTrans").attr('required', false);
		$('#nametransportadora').attr('hidden',true);
		$("#SolSerNitTrans").attr('required', false);
		$('#nittransportadora').attr('hidden',true);
		$("#SolSerAdressTrans").attr('required', false);
		$('#addresstransportadora').attr('hidden',true);
		$("#municipio").attr('required', false);
		$('.citytransportadora').attr('hidden',true);
	@endif
	$('#SolSerConductor').val('{{$Solicitud->SolSerConductor}}');
	$('#Conductor').attr('hidden',false);
	$('#SolSerVehiculo').val('{{$Solicitud->SolSerVehiculo}}');
	$('#Vehiculo').attr('hidden',false);
	$('#typeaditable').removeClass('col-md-6');
	$('#typeaditable').addClass('col-md-12');
	$('#SolSerTypeCollect').attr('required', false);
	$('#typecollect').attr('hidden',true);
	$('#SedeCollect').attr('required', false);
	$('#sedecollect').attr('hidden',true);
	$('#AddressCollect').attr('required', false);
	$('.addresscollect').attr('hidden',true);
	$("#SolSerBascula").bootstrapSwitch('state',false);
	$('#SolSerBascula').bootstrapSwitch('disabled',true);
	$('#SolSerCapacitacion').bootstrapSwitch('state',false);
	$('#SolSerCapacitacion').bootstrapSwitch('disabled',true);
	$('#SolSerMasPerson').bootstrapSwitch('state',false);
	$('#SolSerMasPerson').bootstrapSwitch('disabled',true);
	$('#SolSerVehicExclusive').bootstrapSwitch('state',false);
	$('#SolSerVehicExclusive').bootstrapSwitch('disabled',true);
	$('#SolSerPlatform').bootstrapSwitch('state',false);
	$('#SolSerPlatform').bootstrapSwitch('disabled',true);
@else
	$("#SolSerTransportador").attr('required', false);
	$('#transportador').attr('hidden',true);
	$("#SolSerNameTrans").attr('required', false);
	$('#nametransportadora').attr('hidden',true);
	$("#SolSerNitTrans").attr('required', false);
	$('#nittransportadora').attr('hidden',true);
	$("#SolSerAdressTrans").attr('required', false);
	$('#addresstransportadora').attr('hidden',true);
	$("#municipio").attr('required', false);
	$('.citytransportadora').attr('hidden',true);
	$('#Conductor').attr('hidden',true);
	$('#Vehiculo').attr('hidden',true);
	$('#typeaditable').removeClass('col-md-12');
	$('#typeaditable').addClass('col-md-6');
	$('#SolSerTypeCollect').attr('required', true);
	$('#typecollect').attr('hidden',false);
	@if($Solicitud->SolSerTypeCollect == 98)
		$('#SedeCollect').attr('required', true);
		$('#sedecollect').attr('hidden',false);
		$('#AddressCollect').val('');
		$("#typecollect").removeClass('col-md-12');
		$("#typecollect").addClass('col-md-6');
		$('#AddressCollect').attr('required', false);
		$('.addresscollect').attr('hidden',true);
	@elseif($Solicitud->SolSerTypeCollect == 97)
		$('#SedeCollect').attr('required', false);
		$('#sedecollect').attr('hidden',true);
		$('#AddressCollect').val('{{$Solicitud->SolSerCollectAddress}}');
		$("#typecollect").removeClass('col-md-12');
		$("#typecollect").addClass('col-md-6');
		$('#AddressCollect').attr('required', true);
		$('.addresscollect').attr('hidden',false);
	@else
		$('#SedeCollect').attr('required', false);
		$('#sedecollect').attr('hidden',true);
		$('#AddressCollect').val('');
		$('#AddressCollect').attr('required', false);
		$('.addresscollect').attr('hidden',true);
	@endif
	var SolSerBascula = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliBascula'] === 1) ? "true" : "false"}};
	var SolSerCapacitacion = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliCapacitacion'] === 1) ? "true" : "false"}};
	var SolSerMasPerson = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliMasPerson'] === 1) ? "true" : "false"}};
	var SolSerVehicExclusive = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliVehicExclusive'] === 1) ? "true" : "false"}};
	var SolSerPlatform = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliPlatform'] === 1) ? "true" : "false"}};
	
	if (SolSerBascula) {
		$("#SolSerBascula").bootstrapSwitch('disabled',false);
	}else{
		$("#SolSerBascula").bootstrapSwitch('disabled',true);
	}
	if (SolSerCapacitacion) {
		$("#SolSerCapacitacion").bootstrapSwitch('disabled',false);
	}else{
		$("#SolSerCapacitacion").bootstrapSwitch('disabled',true);
	}
	if (SolSerMasPerson) {
		$("#SolSerMasPerson").bootstrapSwitch('disabled',false);
	}else{
		$("#SolSerMasPerson").bootstrapSwitch('disabled',true);
	}
	if (SolSerVehicExclusive) {
		$("#SolSerVehicExclusive").bootstrapSwitch('disabled',false);
	}else{
		$("#SolSerVehicExclusive").bootstrapSwitch('disabled',true);
	}
	if (SolSerPlatform) {
		$("#SolSerPlatform").bootstrapSwitch('disabled',false);
	}else{
		$("#SolSerPlatform").bootstrapSwitch('disabled',true);
	}
	// $('#SolSerBascula').bootstrapSwitch('disabled',false);
	// $('#SolSerCapacitacion').bootstrapSwitch('disabled',false);
	// $('#SolSerMasPerson').bootstrapSwitch('disabled',false);
	// $('#SolSerVehicExclusive').bootstrapSwitch('disabled',false);
	// $('#SolSerPlatform').bootstrapSwitch('disabled',false);
@endif
@if($Solicitud->SolSerStatus === 'Programado')
	$("#SolSerTipo").parent().remove();
	$("#transportador").removeClass('col-md-6');
	$("#transportador").addClass('col-md-12');
	$("#typeaditable").remove();
	$("#typecollect").remove();
	$("#sedecollect").remove();
	$(".addresscollect").remove();
	$("#requirimientos").remove();
	$("#AddGenerador").remove();
	$('form[data-toggle="validator"]').validator('update');
@endif
function submitverify(){
	var CantidadTotalkg = {{$totalenviado}};
	for (var i = 0; i < contadorGenerador; i++) {
		for (var y = 0; y <= contadorRespel[i]; y++) {
			if($("#SolResKgEnviado"+i+y).val() != null){
				CantidadTotalkg = parseInt(CantidadTotalkg)+parseInt($("#SolResKgEnviado"+i+y).val());
			}
		}
	}
	if(CantidadTotalkg != 0){
		if(CantidadTotalkg >= 500){
			$("#Submit2").empty();
			$("#Submit2").append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
			$("#Submit2").attr('disabled', true);
			$('#Submit').click();
		}
		else{
			@if($Solicitud->SolSerSupport == null)
			$('#ModalSupport').empty();
			$('#ModalSupport').append(`
				<div class="modal modal-default fade in" id="SupportPay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
									<i class="fas fa-exclamation-triangle"></i>
									<span style="font-size: 0.3em; color: black;"><p>Su solicitud es inferior a 500kg adjunte el soporte de pago</p></span>
									<span style="font-size: 0.3em; color: black;"><p>Su solicitud es de <b>`+CantidadTotalkg+` kg</b></p></span>
								</div>
							</div>
							<div class="modal-header">
								<div class="form-group col-md-12">
									<label style="color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsersupportpay') }}</b>" data-content="{{ trans('adminlte_lang::message.solsersupportpaydescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solsersupportpay')}}</label>
									<small class="help-block with-errors"></small>
									<input name="SupportPay" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
								</div>
							</div> 
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
								<label for="Submit" class='btn btn-success'>Enviar</label>
							</div>
						</div>
					</div>
				</div>
			`);
			popover();
			$('#CreateSolSer').validator('update');
			envsubmit();
			$('#SupportPay').modal();
			@else
			$("#Submit2").empty();
			$("#Submit2").append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
			$("#Submit2").attr('disabled', true);
			$('#Submit').click();
			@endif
		}
	}
}
</script>
@include('solicitud-serv.layaoutsSolSer.functionsSolSer')
@endsection