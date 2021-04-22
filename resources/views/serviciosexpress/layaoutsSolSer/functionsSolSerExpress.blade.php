<script>
var contadorGenerador = 1;
var contadorRespel = [];
var icon = '';


$("#FK_SolSerCliente").change(function(e){
	id=$("#FK_SolSerCliente").val();
	e.preventDefault();
	$.ajaxSetup({
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{url('/ClienteExpress-Residuos')}}/"+id,
		method: 'GET',
		data:{},
		beforeSend: function(){
			$(".load").append('<i class="fas fa-sync-alt fa-spin"></i>');
			// $("#FK_SolSerCliente").prop('disabled', true);
		},
		success: function(res){
			id_div = 0;
			ID_Gener = res[0].GSedeSlug;
			contadorRespel[id_div] = 0;
			$("#SGenerador").val(ID_Gener);
			$("#DivRepel"+id_div).empty();
			$("#DivRepel"+id_div).append(`@include('serviciosexpress.layaoutsSolSer.OneRespel')`);
			$('form[data-toggle="validator"]').validator('update');
			numeroKg();
			popover();
			ChangeSelect();
			Selects();

			icon = $('button[data-target=".Respel'+id_div+'"]').find('svg');
			$(icon).removeClass('fa-plus');
			$(icon).addClass('fa-minus');
			
			var residuos = new Array();
			// $("#FK_SolResRg"+id_div+contadorRespel[id_div]).empty();
			$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="HiddenRequeRespel(`+id_div+`,`+contadorRespel[id_div]+`)" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
			for(var i = res.length -1; i >= 0; i--){
				if ($.inArray(res[i].SlugSGenerRes, residuos) < 0) {
					$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="RequeRespel(`+id_div+`,`+contadorRespel[id_div]+`,'`+res[i].RespelSlug+`')" value="${res[i].SlugSGenerRes}">${res[i].RespelName} (${res[i].TratName})</option>`);
					residuos.push(res[i].SlugSGenerRes);
				}
			}
		},
		complete: function(){
			$(".load").empty();
			$("#municipio2").prop('disabled', false);
		}
	})
});


function HiddenResiduosGener(id_div){
	icon = $('button[data-target=".Respel'+id_div+'"]').find('svg');
	$(icon).removeClass('fa-minus');
	$(icon).addClass('fa-plus');
	$("#DivRepel"+id_div).empty();
}


function ResiduosGener(id_div, ID_Gener){
	contadorRespel[id_div] = 0;
	$("#DivRepel"+id_div).empty();
	$("#DivRepel"+id_div).append(`@include('serviciosexpress.layaoutsSolSer.OneRespel')`);
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

function AgregarGenerador() {
	$("#AddGenerador").before(`@include('serviciosexpress.layaoutsSolSer.NewGener')`);
	popover();
	ChangeSelect();
	Selects();
	$('form[data-toggle="validator"]').validator('update');
	contadorGenerador = contadorGenerador + 1;
}

function AgregarResPel(id_div,ID_Gener) {
	contadorRespel[id_div] = contadorRespel[id_div]+1;
	console.log(contadorRespel[id_div]);
	$("#AddRespel"+id_div).before(`@include('serviciosexpress.layaoutsSolSer.NewRespel')`);
	Switch2();
	Switch3();
	Checkboxs();
	numeroDimension();
	numeroKg();
	popover();
	ChangeSelect();
	Selects();
	// HiddenRequeRespel(id_div, contadorRespel[id_div]);
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
				// $("#FK_SolResRg"+id_div+contadorRespel[id_div]).empty();
				$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="HiddenRequeRespel(`+id_div+`,`+contadorRespel[id_div]+`)" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
				for(var i = res.length -1; i >= 0; i--){
					if ($.inArray(res[i].SlugSGenerRes, residuos) < 0) {
						$("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="RequeRespel(`+id_div+`,`+contadorRespel[id_div]+`,'`+res[i].RespelSlug+`')" value="${res[i].SlugSGenerRes}">${res[i].RespelName} (${res[i].TratName})</option>`);
						residuos.push(res[i].SlugSGenerRes);
					}
				}
			}
			else{
				// $("#DivRepel"+id_div).empty();
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