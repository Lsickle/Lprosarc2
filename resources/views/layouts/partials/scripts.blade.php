<!-- REQUIRED JS SCRIPTS -->
<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script type="text/javascript" src="{{ url (mix('/js/app.js')) }}"></script>
{{-- Dependencias Package.json --}}
<script type="text/javascript" src="{{ url (mix('/js/dependencias.js')) }}"></script>
{{-- Dependencias pdfmake --}}
@if(Auth::user()->UsRol == 'Programador')
<script type="text/javascript" src="{{ url (mix('/js/dependencias2.js')) }}"></script>
@endif
<!-- DataTables -->
<script type="text/javascript" src="{{ url (mix('/js/datatable-depen.js')) }}"></script>
{{-- plugins de datatables --}}
<script type="text/javascript" src="{{ url (mix('/js/datatable-plugins.js')) }}"></script>
{{-- fullcalendar --}}
<script type="text/javascript" src="{{ url (mix('/js/fullcalendar.js')) }}"></script>

<script type="text/javascript">
	window.onload =function(){
		$('#contenedor_carga').css('opacity', '0');
		$('#contenido').fadeIn(2000);
		setTimeout(function(){
			$('#contenedor_carga').remove();
		}, 2000);
	}
</script>
<script type="text/javascript">
$('form[data-toggle="validator"]').validator({
	custom: {
		filesize: function($el) {
			var maxBytes = $el.data("filesize")*1024;
			if ($el[0].files[0] && $el[0].files[0].size > maxBytes) {
				return "El archivo no debe pesar mas de " + maxBytes/1024/1024 + " MB.";
			}
		},
		filessizemultiple: function($el) {
			var maxBytes = $el.data("filessizemultiple")*1024;
			var max = 0;
			for (var i = 0; i < $el[0].files.length; i++) {
				if ($el[0].files[i] && $el[0].files[i].size > maxBytes) {
					return "El archivo ("+($el[0].files[i].name)+") no debe pesar mas de " + maxBytes/1024/1024 + " MB.";
				}
			}
		}
	}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('.select').select2({
		placeholder: "Seleccione...",
		allowClear: true,
		width: 'resolve',
		width: '100%',
		theme: "classic"
	});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('.select-multiple').select2({
		allowClear: true,
		width: 'resolve',
		width: '100%',
		theme: "classic"
	});
});
</script>
{{-- script para formulario en smart-wizzard --}}
<script type="text/javascript">
	$(document).ready(function(){
		$('.smartwizard').smartWizard({
			selected: 0,
			keyNavigation: false,
			theme: 'arrows',
			transitionEffect:'fade',
			toolbarSettings: {
				toolbarPosition: 'bottom',
			},
			lang: {
				next: 'Siguiente', 
				previous: 'Anterior'
			},
			anchorSettings: {
				markDoneStep: true,
				markAllPreviousStepsAsDone: true,
				removeDoneStepOnNavigateBack: true,
				enableAnchorOnDoneStep: true
			}
			});
		$(".smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
			var elmForm = $("#form-step-" + stepNumber);
			if(stepDirection === 'forward' && elmForm){
				elmForm.validator('validate');
				var elmErr = elmForm.children('.has-error');
				if(elmErr && elmErr.length > 0){
					return false;
				}
			}
			return true;
		});
	});
</script>
<script>
	$(document).ready(function(){
		var ua = navigator.userAgent.toLowerCase();
		var isAndroid = ua.indexOf("android") > -1; 
		if(isAndroid) {
			// $('.nombres').removeClass('nombres');
		}
	});
</script>
{{-- Mascaras --}}
<script type="text/javascript">
$(document).ready(function() {
	$('.nit').inputmask({ mask: "[9][9][9.][9][9][9.][9][9][9-][9]" });
	$('.phone').inputmask({ mask: "03[9 ][9][9][9][9][9][9][9]" });
	$('.mobile').inputmask({ mask: "3[9][9 ][9][9][9 ][9][9][9][9]" });
	$('.extension').inputmask({ mask: "[9][9][9][9][9]" });

	$('.document').inputmask({ mask: "[9][9][9][9][9][9][9][9][9][9][9]" });
	$('.bank').inputmask({ mask: "[9][9][9][9 ][9][9][9][9 ][9][9][9][9 ][9][9][9][9]" });
	$('.inputText').inputmask({ mask: "[a{0,20}] [a{0,20}] [a{0,20}] [a{0,20}] [a{0,20}]",disablePredictiveText:true});
	$('.nombres').inputmask({ mask: "[a{0,15}] [a{0,15}] [a{0,15}] [a{0,15}]",disablePredictiveText:true});
	$('.fechas').inputmask({ alias: "datetime", inputFormat: "yyyy-mm-dd", });
	$('.money').inputmask({
		alias: "currency",
		rightAlign: false,
		placeholder: "",
		digits: 0
	});
	$('.placa').inputmask({
		mask: "AAA-999",
		placeholder: "",
	});
	$('.horas').inputmask({
		alias: "datetime",
		inputFormat: "hh:MM TT",
		placeholder: "00:00 AM"
	});
	$('.number').inputmask({ mask: "[9{0,40}]" });

});
	function numeroDimension(){
		$('.numberDimension').inputmask({ alias: 'numeric', max:20, rightAlign:false});
	}
	function numeroKg(){
		$('.numberKg').inputmask({ alias: 'numeric', max:50000, rightAlign:false});
	}
</script>
<script type="text/javascript">
function Switch1() {
	$(".testswitch").bootstrapSwitch({
		animate: true,
		labelText: '<i class="fas fa-arrows-alt-h"></i>',
	});
}
$(document).ready(Switch1());

</script>
<script type="text/javascript">
function Switch2() {
	$(".fotoswitch").bootstrapSwitch({
		animate: true,
		labelText: '<i class="fas fa-camera"></i>',
		onText: '<i class="fas fa-check"></i>',
		offText: '<i class="fas fa-times"></i>',
	});
}
$(document).ready(Switch2());

</script>
<script type="text/javascript">
function Switch3() {
	$(".videoswitch").bootstrapSwitch({
		animate: true,
		labelText: '<i class="fas fa-video"></i>',
		onText: '<i class="fas fa-check"></i>',
		offText: '<i class="fas fa-times"></i>',
	});
}
$(document).ready(Switch3());

</script>
<script type="text/javascript">
$(document).ready(function Switch4() {
	$(".AllowUncheck").bootstrapSwitch({
		animate: true,
		radioAllOff: true,
		labelText: '<i class="fas fa-eye"></i>',
		onText: '<i class="fas fa-check"></i>',
		offText: '<i class="fas fa-times"></i>',
	});
});

</script>
<script type="text/javascript">
$(document).ready(function Switch5() {
	$(".CalendarSwitch").bootstrapSwitch({
		animate: true,
		radioAllOff: true,
		labelText: '<i class="fas fa-calendar-alt"></i>',
		onText: '<i class="fas fa-check"></i>',
		offText: '<i class="fas fa-times"></i>',
	});
});

</script>
<script type="text/javascript">
$(document).ready(function Switch6() {
	$(".CheckMin").bootstrapSwitch({
		size: "mini",
		animate: true,
		radioAllOff: true,
		labelText: '<i class="fas fa-calendar-alt"></i>',
		onText: '<i class="fas fa-check"></i>',
		offText: '<i class="fas fa-times"></i>',
	});
});

</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#RequerimientosTable').DataTable({
		"scrollX": false,
		"autoWidth": true,
		"keys": true,
		"responsive": true,
		"columnDefs": [{
				"targets": 6,
				"data": "ReqSlug",
				"render": function(data, type, row, meta) {
					return "<a href='/requerimientos/" + data + "' class='btn btn-block btn-success'>Ver</a>";
				}
			},
			{
				"targets": 7,
				"data": "ReqSlug",
				"render": function(data, type, row, meta) {
					return "<a href='/requerimientos/" + data + "/edit' class='btn btn-warning'>Edit</a>";
				}
			}
		]
	});
});
</script>
@if(
Route::currentRouteName()=='tarifas.index'
)
<script type="text/javascript">
$(document).ready(function() {

	/*var rol defino el rol del usuario*/
	var rol = "<?php echo Auth::user()->UsRol; ?>";

	/*var botoncito define los botones que se usaran si el usuario es programador*/
	var botoncito = (rol == 'Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];

	/*funcion para renderizar la tabla de cotizacion.index*/
	$('#tarifasTable').DataTable({
		responsive: true,
		select: true,
		dom: 'Bfrtip',
		buttons: [
			botoncito, {
				extend: 'collection',
				text: 'Selector',
				buttons: ['selectRows', 'selectCells']
			}
		],
		colReorder: true,
		ordering: true,
		autoWith: true,
		searchHighlight: true,
		columnDefs: [{
			"targets": 10,
			"data": "ID_Tarifa",
			"render": function(data, type, row, meta) {
				return "<a method='get' href='/tarifas/" + data + "/' class='btn btn-primary btn-block'>Ver mas</a>";
			}
		}]
	});

	/*funcion para resaltar las busquedas*/
	var table = $('#tarifasTable').DataTable();

	table.on('draw', function() {
		var body = $(table.table().body());
		body.unhighlight();
		body.highlight(table.search());
	});
});

</script>
@endif
<script type="text/javascript">
	$(document).ready(function(){
		$("#departamento").change(function(e){
			id=$("#departamento").val();
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
				success: function(res){
					$("#municipio").empty();
					var municipio = new Array();
					for(var i = res.length -1; i >= 0; i--){
						if ($.inArray(res[i].ID_Mun, municipio) < 0) {
							$("#municipio").append(`<option value="${res[i].ID_Mun}">${res[i].MunName}</option>`);
							municipio.push(res[i].ID_Mun);
						}
					}
				}
			})
		});
	});
</script>
{{-- extension de la sede --}}
@if(Route::currentRouteName() === 'clientes.create' || Route::currentRouteName() === 'contactos.create' || Route::currentRouteName() === 'contactos.edit' || Route::currentRouteName() === 'sclientes.create' ||  Route::currentRouteName() === 'sclientes.edit' ||  Route::currentRouteName() === 'generadores.create' || Route::currentRouteName() === 'sgeneradores.create' || Route::currentRouteName() === 'sgeneradores.edit')
<script type="text/javascript">
	$(document).ready(function() {
		$(".tel").change(function(){
			if($(this).val().length>10){
				$('.ext').attr('disabled',false);
			}else{
				$('.ext').attr('disabled',true);
			};
		});
	});
</script>
	@if(Route::currentRouteName() === 'clientes.create' || Route::currentRouteName() === 'contactos.create' || Route::currentRouteName() === 'contactos.edit' || Route::currentRouteName() === 'sclientes.create' ||  Route::currentRouteName() === 'sclientes.edit')
		<script type="text/javascript">
			$(document).ready(function(){    
				if({{old('SedeExt2')}} !== null){
					$('.ext').prop('disabled', false);
				};
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){    
			if({{old('SedeExt1')}} !== null){
					$('.ext2').prop('disabled', false);
				};
			});
		</script>
	@endif
	@if(Route::currentRouteName() === 'generadores.create' || Route::currentRouteName() === 'sgeneradores.create' || Route::currentRouteName() === 'sgeneradores.edit')
		<script type="text/javascript">
			$(document).ready(function(){    
				if({{old('GSedeExt1')}} !== null){
					$('.ext').prop('disabled', false);
				};
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){    
			if({{old('GSedeExt2')}} !== null){
					$('.ext2').prop('disabled', false);
				};
			});
		</script>
	@endif
<script type="text/javascript">
	$(document).ready(function(){  
		if($('.tel').val()){
			$('.ext').prop('disabled', false);
		}
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){  
		if($('.tel2').val()){
			$('.ext2').prop('disabled', false);
		}
	});
</script>
<script type="text/javascript">
	function Tel(){
		$(".tel2").change(function(){
			if($(this).val().length>10){
				$('.ext2').attr('disabled',false);
			}else{
				$('.ext2').attr('disabled',true);
			};
		});
		document.getElementById('telefono2').style.display = 'block';
		document.getElementById('extension2').style.display = 'block';
		$('#tel').remove();
	}
</script>
@endif
@if( Route::currentRouteName() === 'contactos.create' || Route::currentRouteName() === 'contactos.edit')
<script type="text/javascript">
function AddVehiculo() {
	document.getElementById('AddVehiculo').style.display = 'block';
	$('#VehicPlaca').prop('required', true);
	$('#VehicTipo').prop('required', true);
	$('#VehicCapacidad').prop('required', true);
	$('#Form').validator('update');
};

function NoAddVehiculo() {
	document.getElementById('AddVehiculo').style.display = 'none';
	$('#VehicPlaca').prop('required', false);
	$('#VehicTipo').prop('required', false);
	$('#VehicCapacidad').prop('required', false);
	$('#VehicPlaca').val('');
	$('#VehicTipo').val('');
	$('#VehicCapacidad').val('');
	$('#Form').validator('validate');
};

</script>
@endif
<script type="text/javascript">
$(document).ready(function() {
	popover();
});
function popover(){
	$('[data-toggle="popover"]').popover();
}
</script>
<script type="text/javascript">
function copiarAlPortapapeles(id_elemento) {
	var aux = document.createElement("input");
	aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy");
	document.body.removeChild(aux);
	var Mensaje = "¡Texto Copiado!";
	NotifiTrue(Mensaje);
}

</script>
<script type="text/javascript">
toastr.options = {
	"closeButton": true,
	"debug": true,
	"newestOnTop": false,
	"progressBar": true,
	"positionClass": "toast-top-right",
	"preventDuplicates": false,
	"showDuration": "300",
	"hideDuration": "1000",
	"timeOut": "6000",
	"extendedTimeOut": "3000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
}

function NotifiTrue(Mensaje) {
	toastr.success(Mensaje);
}

function NotifiFalse(Mensaje) {
	toastr.error(Mensaje);
}
</script>
{{-- Aparicion del modal si existe la variable errors --}}
@if(Route::currentRouteName() === 'generadores.show' || Route::currentRouteName() === 'sgeneradores.show')
	@if ($errors->any())
	<script type="text/javascript">
		$(document).ready(function() {
			$("#add").modal("show");
		});
	</script>
	@endif
@endif
@if(Route::currentRouteName() === 'contactos.show')
	@if ($errors->any())
		<script>
			$(document).ready(function() {
				$(".create").modal("show");
			});
		</script>
	@endif
@endif
@if(Route::currentRouteName()=='tratamiento.edit')
	<script>
		var contador = `{{$contador}}`;
		function attachPopover() {
			$('[data-toggle="popover"]').popover({
				html: true,
				trigger: 'hover',
				placement: 'auto'
			});
			$("#edittratamientoForm").validator('update');
			// alert('popover actualizados');
		}
		function AgregarPreTrat() {
			var pretratamiento = `@include('layouts.respel-comercial.respel-pretrat')`;
			$("#pretratamientosPanel").append(pretratamiento);
			$("#edittratamientoForm").validator('update');
			contador = parseInt(contador) + 1;
			attachPopover();
		}
		function EliminarPreTrat(id) {
			$("#pretratname" + id).remove();
			$("#pretratdescription" + id).remove();
			$("#pretratsparator" + id).remove();
			$("#ID_Propo" + id).remove();
			$("#edittratamientoForm").validator('update');
			// alert('eliminado pretratamiento '+id);
			contador = parseInt(contador) - 1;
		}
	</script>
@endif
<script>
	$(document).ready(function() {
		/*var rol defino el rol del usuario*/
		var rol = "<?php echo Auth::user()->UsRol; ?>";
		/*var botoncito define los botones que se usaran si el usuario es programador*/
		var botoncito = (rol == 'Programador') ? ['colvis', 'copy', 'excel', 'pdf', {
					extend: 'collection',
					text: 'Selector',
					buttons: ['selectRows', 'selectCells']
				}] : ['colvis', 'excel'];
		/*inicializacion de datatable general*/        
		$('.table').DataTable({
			"dom": "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
				"<'row'<'col-md-12'tr>>" +
				"<'row'<'col-md-6'i><'col-md-6'p>>",
			"scrollX": false,
			"autoWidth": true,
			// "select": true,
			"colReorder": true,
			"searchHighlight": true,
			"responsive": true,
			"keys": true,
			"lengthChange": true,
			"buttons": [
				botoncito
			],
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
	});
</script>
<script type="text/javascript">
	function AnimationMenusForm(target){
		var icon = $("button[data-target='"+target+"']").find('svg');
		if ($(icon).hasClass('fa-plus')){
			$(icon).removeClass('fa-plus');
			$(icon).addClass('fa-minus');
		}else if($(icon).hasClass('fa-minus')){
			$(icon).removeClass('fa-minus');
			$(icon).addClass('fa-plus');
		}
	}
</script>
<script type="text/javascript">
	function Checkboxs(){
		$('input[type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
			if(state == true){
				$("#"+this.dataset.name).val(1);
			}
			else{
				$("#"+this.dataset.name).val(0);
			}
		});
	}
	$(document).ready(function() {Checkboxs();});
</script>
<script>
	$('form').on('submit', function(){
		if(!$('[type="submit"]').hasClass('disabled')){
			$('[type="submit"]').prop('disabled', true);
			$('[type="submit"]').empty();
			$('[type="submit"]').append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
			$('[type="submit"]').val(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
		}
		$(this).submit(function(){
			return false;
		});
		return true;
	});
	$('label').on('click', function(){
		var idsubmit = $(this).attr('for');
		if(!$('#'+idsubmit).hasClass('disabled')){
			$(this).empty();
			$(this).append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
			$(this).prop('disabled', true);
		}
	});
</script>
{{-- script para activar las funciones de los options --}}
<script>
	function activateOptionScripts() {
		$('select').on('change', function(){
			// var x="";
			// var id="";
			var option="";
			// id = $(this).attr('id');
			// x = $(this).val();
			// option = $("[value=" + x.replace(" ", "\\ ") + "]");
			option = $(this).children("option:selected");
			option.click();
			// alert(x);
		});
	}
	$(document).ready(function(){
		activateOptionScripts();
	});
</script>
<script>
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    $("#topLogo").removeClass('navbar-mobile');
  } else {
    $("#topLogo").addClass('navbar-mobile');
  }
  prevScrollpos = currentScrollPos;
}
</script>
@yield('NewScript')
