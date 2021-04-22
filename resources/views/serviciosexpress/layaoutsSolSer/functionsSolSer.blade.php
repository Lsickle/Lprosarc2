<script>
function TransportadorProsarc() {
	var SolSerBascula = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliBascula'] === 1) ? "true" : "false"}};
	var SolSerCapacitacion = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliCapacitacion'] === 1) ? "true" : "false"}};
	var SolSerMasPerson = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliMasPerson'] === 1) ? "true" : "false"}};
	var SolSerVehicExclusive = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliVehicExclusive'] === 1) ? "true" : "false"}};
	var SolSerPlatform = {{(isset($Requerimientos[0]))&&($Requerimientos[0]['RequeCliPlatform'] === 1) ? "true" : "false"}};
	
	$("#transportador").attr('hidden', true);
	$("#Conductor").attr('hidden', true);
	$("#Vehiculo").attr('hidden', true);
	$("#typeaditable").removeClass('col-md-12');
	$("#typeaditable").addClass('col-md-6');
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
	// $("#SolSerDevolucion").bootstrapSwitch('disabled',false);
	$("#SolSerTransportador").removeAttr('required');
	$("#typecollect").attr('hidden', false);
	$("#typecollect").removeClass('col-md-6');
	$("#typecollect").addClass('col-md-12');
	$("#SolSerNameTrans").val(null);
	$("#SolSerNitTrans").val(null);
	$("#SolSerAdressTrans").val(null);
	$("#SolSerConductor").val(null);
	$("#SolSerVehiculo").val(null);
	$("#AddressCollect").val(null);
	$("#SolSerTypeCollect").val(null).trigger("change");
	$("#SolSerTypeCollect").attr('required', true);
	$("#SolSerTransportador").val(null).trigger("change");
	$("#departamento").val(null).trigger("change");
	$("#municipio").empty();
	$("#municipio2").empty();
	$("#municipio2").attr('required', false);
	$("#departamento2").val(null).trigger("change");
	$("#SedeCollect").val(null).trigger("change");
	TransportadorCliente();
	HiddenTypeCollect();
}
function HiddenTypeCollect(){
	$("#sedecollect").attr('hidden', true);
	$("#SedeCollect").attr('required', false);
	$("#SedeCollect").val(null).trigger("change");
	$(".addresscollect").attr('hidden', true);
	$("#AddressCollect").attr('required', false);
	$("#AddressCollect").val(null);
	$("#municipio2").empty();
	$("#municipio2").attr('required', false);
	$("#departamento2").val(null).trigger("change");
	$("#typecollect").removeClass('col-md-6');
	$("#typecollect").addClass('col-md-12');
}
function TypeCollectSede(){
	$("#sedecollect").attr('hidden', false);
	$("#SedeCollect").attr('required', true);
	$(".addresscollect").attr('hidden', true);
	$("#AddressCollect").attr('required', false);
	$("#AddressCollect").val(null);
	$("#municipio2").empty();
	$("#municipio2").attr('required', false);
	$("#departamento2").val(null).trigger("change");
	$("#typecollect").removeClass('col-md-12');
	$("#typecollect").addClass('col-md-6');
}
function TypeCollectOther(){
	$("#sedecollect").attr('hidden', true);
	$("#SedeCollect").attr('required', false);
	$("#SedeCollect").val(null).trigger("change");
	$(".addresscollect").attr('hidden', false);
	$("#AddressCollect").attr('required', true);
	$("#AddressCollect").val(null);
	$("#municipio2").empty();
	$("#municipio2").attr('required', true);
	$("#departamento2").val(null).trigger("change");
	$("#typecollect").removeClass('col-md-12');
	$("#typecollect").addClass('col-md-6');
}
function TransportadorExtr() {
	$("#transportador").attr('hidden', false);
	$("#Conductor").attr('hidden', false);
	$("#Vehiculo").attr('hidden', false);
	$("#typeaditable").removeClass('col-md-6');
	$("#typeaditable").addClass('col-md-12');
	$("#SolSerBascula").bootstrapSwitch('state',false);
	$("#SolSerBascula").bootstrapSwitch('disabled',true);
	$("#SolSerCapacitacion").bootstrapSwitch('state',false);
	$("#SolSerCapacitacion").bootstrapSwitch('disabled',true);
	$("#SolSerMasPerson").bootstrapSwitch('state',false);
	$("#SolSerMasPerson").bootstrapSwitch('disabled',true);
	$("#SolSerVehicExclusive").bootstrapSwitch('state',false);
	$("#SolSerVehicExclusive").bootstrapSwitch('disabled',true);
	$("#SolSerPlatform").bootstrapSwitch('state',false);
	$("#SolSerPlatform").bootstrapSwitch('disabled',true);
	// $("#SolSerDevolucion").bootstrapSwitch('disabled',false);
	$("#typecollect").attr('hidden', true);
	$("#SolSerTypeCollect").attr('required', false);
	$("#municipio2").attr('required', false);
	$("#SolSerConductor").val(null);
	$("#SolSerVehiculo").val(null);
	$("#SolSerNameTrans").val(null);
	$("#SolSerNitTrans").val(null);
	$("#SolSerAdressTrans").val(null);
	$("#AddressCollect").val(null);
	$("#SolSerTypeCollect").val(null).trigger("change");
	$("#SolSerTransportador").val(null).trigger("change");
	$("#SolSerTransportador").attr('required', true);
	$("#departamento").val(null).trigger("change");
	$("#municipio").empty();
	$("#municipio2").empty();
	$("#departamento2").val(null).trigger("change");
	$("#SedeCollect").val(null).trigger("change");
	TransportadorCliente();
	HiddenTypeCollect();
}

function TransportadorCliente() {
	$("#nametransportadora").attr('hidden', true);
	$("#nittransportadora").attr('hidden', true);
	$("#addresstransportadora").attr('hidden', true);
	$(".citytransportadora").attr('hidden', true);
	$("#SolSerNameTrans").removeAttr('required');
	$("#SolSerNitTrans").removeAttr('required');
	$("#SolSerAdressTrans").removeAttr('required');
	$("#municipio").removeAttr('required');
	$("#SolSerNameTrans").val(null);
	$("#SolSerNitTrans").val(null);
	$("#SolSerAdressTrans").val(null);
	$("#municipio").empty();
	$("#departamento").val(null).trigger("change");
}

function OtraTransportadora() {
	$("#nametransportadora").attr('hidden', false);
	$("#nittransportadora").attr('hidden', false);
	$("#addresstransportadora").attr('hidden', false);
	$(".citytransportadora").attr('hidden', false);
	$("#SolSerNameTrans").attr('required', true);
	$("#SolSerNitTrans").attr('required', true);
	$("#SolSerAdressTrans").attr('required', true);
	$("#SolSerNameTrans").val(null);
	$("#SolSerNitTrans").val(null);
	$("#SolSerAdressTrans").val(null);
	$("#municipio").empty();
	$("#municipio").attr('required', true);
	$("#departamento").val(null).trigger("change");
}
var contadorGenerador = 1;
var contadorRespel = [];
var icon = '';
function HiddenResiduosGener(id_div){
	icon = $('button[data-target=".Respel'+id_div+'"]').find('svg');
	$(icon).removeClass('fa-minus');
	$(icon).addClass('fa-plus');
	$("#DivRepel"+id_div).empty();
}
// $("#SolSerDevolucion").on('switchChange.bootstrapSwitch', function(event, state) {
// 	if(state == true){
// 		$("#SolSerDevolucionTipo").parent().parent().attr('hidden', false);
// 		$("#SolSerDevolucionTipo").attr('disabled', false);
// 		$("#SolSerDevolucionTipo").attr('required', true);
// 	}
// 	else{
// 		$("#SolSerDevolucionTipo").parent().parent().attr('hidden', true);
// 		$("#SolSerDevolucionTipo").attr('disabled', true);
// 		$("#SolSerDevolucionTipo").attr('required', false);
// 		$("#SolSerDevolucionTipo").val(null);
// 	}
// });
function ResiduosGener(id_div, ID_Gener){
	contadorRespel[id_div] = 0;
	$("#DivRepel"+id_div).empty();
	$("#DivRepel"+id_div).append(`@include('solicitud-serv.layaoutsSolSer.OneRespel')`);
	$('form[data-toggle="validator"]').validator('update');
	Switch2();
	Switch3();
	Checkboxs();
	numeroDimension();
	numeroKg();
	popover();
	ChangeSelect();
	Selects();
	icon = $('button[data-target=".Respel'+id_div+'"]').find('svg');
	$(icon).removeClass('fa-plus');
	$(icon).addClass('fa-minus');
	HiddenRequeRespel(id_div, contadorRespel[id_div]);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{url('/RespelGener')}}/"+ID_Gener,
		method: 'GET',
		data:{},
		beforeSend: function(){
			$(".loadrespelone"+id_div+contadorRespel[id_div]).append('<i class="fas fa-sync-alt fa-spin"></i>');
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).prop('disabled', true);
		},
		success: function(res){
			if(res != ''){
				var residuos = new Array();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).empty();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="HiddenRequeRespel(`+id_div+`,`+contadorRespel[id_div]+`)" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
				for(var i = res.length -1; i >= 0; i--){
					if ($.inArray(res[i].SlugSGenerRes, residuos) < 0) {
						$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="RequeRespel(`+id_div+`,`+contadorRespel[id_div]+`,'`+res[i].RespelSlug+`')" value="${res[i].SlugSGenerRes}">${res[i].RespelName} (${res[i].TratName})</option>`);
						residuos.push(res[i].SlugSGenerRes);
					}
				}
			}
			else{
				$("#DivRepel"+id_div).empty();
				NotifiFalse("Lo sentimos esta sede de generador no tiene residuos asignados");
			}
		},
		complete: function(){
			$(".loadrespelone"+id_div+contadorRespel[id_div]).empty();
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).prop('disabled', false);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			NotifiFalse("No se pudo conectar a la base de datos");
		}
	});
}
function RequeRespel(id_div, contador, Id_Respel){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{url('/RequeRespel')}}/"+Id_Respel,
		method: 'GET',
		data:{},
		beforeSend: function(){
			$(".loadrequired"+id_div+contadorRespel[id_div]).append('<i class="fas fa-sync-alt fa-spin"></i>');
		},
		success: function(res){
			if(res != ''){
				// console.log(res);
				if(res.ReqFotoDescargue === 1){
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',false);
					if(res.auto_ReqFotoDescargue === 1){
						$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',true);
					}else{
						$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					}
				}
				else{
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res.ReqFotoDestruccion === 1){
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('disabled',false);
					if(res.auto_ReqFotoDestruccion === 1){
						$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',true);
					}else{
						$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
					}
				}
				else{
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res.ReqVideoDescargue === 1){
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',false);
					if(res.auto_ReqVideoDescargue === 1){
						$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',true);
					}else{
						$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);	
					}
				}
				else{
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);	
					$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res.ReqVideoDestruccion === 1){
					$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('disabled',false);
					if(res.auto_ReqVideoDestruccion === 1){
						$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('state',true);
					}else{
						$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('state',false);	
					}
				}
				else{
					$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('state',false);	
					$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
				}
				if(res.ReqDevolucion === 1){
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('disabled',false);
					if(res.auto_ReqDevolucion === 1){
						$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('state',true);
					}else{
						$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('state',false);	
					}
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('labelText','<i class="fas fa-trash"></i>');
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('onText','<i class="fas fa-check"></i>');
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('offText','<i class="fas fa-times"></i>');
				}
				else{
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('disabled',true);
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('labelText','<i class="fas fa-trash"></i>');
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('onText','<i class="fas fa-check"></i>');
					$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('offText','<i class="fas fa-times"></i>');
				}
				if(res.ReqAuditoria === 1){
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('disabled',false);
					if(res.auto_ReqAuditoria === 1){
						$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('state',true);
					}else{
						$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('state',false);	
					}
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('labelText','<i class="fas fa-eye"></i>');
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('onText','<i class="fas fa-check"></i>');
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('offText','<i class="fas fa-times"></i>');
				}
				else{
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('state',false);
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('disabled',true);
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('labelText','<i class="fas fa-eye"></i>');
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('onText','<i class="fas fa-check"></i>');
					$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('offText','<i class="fas fa-times"></i>');
				}
				switch (res.Tarifatipo) { 
					case 'Kg':
						$('#SolResTypeUnidad'+id_div+contador).prop('required',false);
						$('#SolResTypeUnidad'+id_div+contador).val('');
						$('#RespelCantidadTipo'+id_div+contador).hide();
						break;
					case 'Unid':
						$('#SolResTypeUnidad'+id_div+contador).prop('required',true);
						$('#RespelCantidadTipo'+id_div+contador).hide();
						$('#SolResTypeUnidad'+id_div+contador).select2("destroy");
						$('#SolResTypeUnidad'+id_div+contador).empty();
						$('#SolResTypeUnidad'+id_div+contador).append('<option value="99">Unidad</option>');
						Selects();
						$('#RespelCantidadTipo'+id_div+contador).show();
						break;
					case 'Lt':
						$('#SolResTypeUnidad'+id_div+contador).prop('required',true);
						$('#RespelCantidadTipo'+id_div+contador).hide();
						$('#SolResTypeUnidad'+id_div+contador).select2("destroy");
						$('#SolResTypeUnidad'+id_div+contador).empty();
						$('#SolResTypeUnidad'+id_div+contador).append('<option value="98">Litros</option>');
						Selects();
						$('#RespelCantidadTipo'+id_div+contador).show();

						break;
					default:
						$('#SolResTypeUnidad'+id_div+contador).prop('required',false);
						$('#SolResTypeUnidad'+id_div+contador).val('');
						$('#RespelCantidadTipo'+id_div+contador).hide();
						$('#SolResTypeUnidad'+id_div+contador).select2("destroy");
						$('#SolResTypeUnidad'+id_div+contador).empty();
						$('#SolResTypeUnidad'+id_div+contador).append('<option>Seleccione...</option>');
						$('#SolResTypeUnidad'+id_div+contador).append('<option value="98">Litros</option>');
						$('#SolResTypeUnidad'+id_div+contador).append('<option value="99">Unidad</option>');
						Selects();
						$('#RespelCantidadTipo'+id_div+contador).show();
				}
			}
			else{
				HiddenRequeRespel(id_div, contador);
			}
		},
		complete: function(){
			$(".loadrequired"+id_div+contadorRespel[id_div]).empty();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			NotifiFalse('Falla en la consulta');
			HiddenRequeRespel(id_div, contador);
		},
	});
}
function HiddenRequeRespel(id_div, contador){
	$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResFotoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
	$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResFotoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
	$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResVideoDescargue_Pesaje'+id_div+contador).bootstrapSwitch('disabled',true);
	$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResVideoTratamiento'+id_div+contador).bootstrapSwitch('disabled',true);
	$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResDevolucion'+id_div+contador).bootstrapSwitch('disabled',true);
	$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('state',false);
	$('#SolResAuditoria'+id_div+contador).bootstrapSwitch('disabled',true);
}
function AgregarGenerador() {
	$("#AddGenerador").before(`@include('solicitud-serv.layaoutsSolSer.NewGener')`);
	popover();
	ChangeSelect();
	Selects();
	$('form[data-toggle="validator"]').validator('update');
	contadorGenerador = contadorGenerador + 1;
}

function AgregarResPel(id_div,ID_Gener) {
	contadorRespel[id_div] = contadorRespel[id_div]+1;
	$("#AddRespel"+id_div).before(`@include('solicitud-serv.layaoutsSolSer.NewRespel')`);
	Switch2();
	Switch3();
	Checkboxs();
	numeroDimension();
	numeroKg();
	popover();
	ChangeSelect();
	Selects();
	HiddenRequeRespel(id_div, contadorRespel[id_div]);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{url('/RespelGener')}}/"+ID_Gener,
		method: 'GET',
		data:{},
		beforeSend: function(){
			$(".loadrespelnew"+id_div+contadorRespel[id_div]).append('<i class="fas fa-sync-alt fa-spin"></i>');
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).prop('disabled', true);
		},
		success: function(res){
			if(res != ''){
				var residuos = new Array();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).empty();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="HiddenRequeRespel(`+id_div+`,`+contadorRespel[id_div]+`)" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
				for(var i = res.length -1; i >= 0; i--){
					if ($.inArray(res[i].SlugSGenerRes, residuos) < 0) {
						$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="RequeRespel(`+id_div+`,`+contadorRespel[id_div]+`,'`+res[i].RespelSlug+`')" value="${res[i].SlugSGenerRes}">${res[i].RespelName} (${res[i].TratName})</option>`);
						residuos.push(res[i].SlugSGenerRes);
					}
				}
			}
			else{
				$("#DivRepel"+id_div).empty();
				NotifiFalse("Lo sentimos esta sede de generador no tiene residuos asignados");
			}
		},
		complete: function(){
			$(".loadrespelnew"+id_div+contadorRespel[id_div]).empty();
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).prop('disabled', false);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			NotifiFalse("No se pudo conectar a la base de datos");
		}
	})
	$('form[data-toggle="validator"]').validator('update');
}
function RemoveRespel(id_div, contador) {
	$("#Repel"+id_div+contador).prev().remove();
	$("#Repel"+id_div+contador).remove();
	$('form[data-toggle="validator"]').validator('update');
}

function RemoveGenerador(id) {
	$("#Generador"+id).prev().remove();
	$("#Generador"+id).remove();
	$('form[data-toggle="validator"]').validator('update');
}

$("#departamento2").change(function(e){
	id=$("#departamento2").val();
	e.preventDefault();
	$.ajaxSetup({
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{url('/muni-depart')}}/"+id,
		method: 'GET',
		data:{},
		beforeSend: function(){
			$(".load").append('<i class="fas fa-sync-alt fa-spin"></i>');
			$("#municipio2").prop('disabled', true);
		},
		success: function(res){
			$("#municipio2").empty();
			var municipio2 = new Array();
			for(var i = res.length -1; i >= 0; i--){
				if ($.inArray(res[i].ID_Mun, municipio2) < 0) {
					$("#municipio2").append(`<option value="${res[i].ID_Mun}">${res[i].MunName}</option>`);
					municipio2.push(res[i].ID_Mun);
				}
			}
		},
		complete: function(){
			$(".load").empty();
			$("#municipio2").prop('disabled', false);
		}
	})
});
</script>