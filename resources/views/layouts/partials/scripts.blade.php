<!-- REQUIRED JS SCRIPTS -->
<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script type="text/javascript" src="{{ url (mix('/js/app.js')) }}"></script>
{{-- Dependencias Package.json --}}
<script type="text/javascript" src="{{ url (mix('/js/dependencias.js')) }}"></script>
{{-- Dependencias pdfmake --}}
@if(Auth::user()->UsRol == 'Programador')
{{-- <script type="text/javascript" src="{{ url (mix('/js/dependencias2.js')) }}"></script> --}}
@endif
<!-- DataTables -->
<script type="text/javascript" src="{{ url (mix('/js/datatable-depen.js')) }}"></script>
{{-- plugins de datatables --}}
<script type="text/javascript" src="{{ url (mix('/js/datatable-plugins.js')) }}"></script>
@if(Route::currentRouteName()=='vehicle-programacion.create')
	{{-- fullcalendar --}}
	{{-- <script type="text/javascript" src="{{ url (mix('/js/fullcalendar.js')) }}"></script> --}}
@endif

@if(Route::currentRouteName()=='serviciosexpress.show')
{{-- signature_pad --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
@endif
{{-- Chart --}}
@if(Route::currentRouteName()=='home')
	{{-- fullcalendar --}}
	<script type="text/javascript" src="{{ url (mix('/js/chart.js')) }}"></script>
@endif

{{-- Moment --}}
{{-- <script type="text/javascript" src="{{ url (mix('js/moment.js')) }}"></script> --}}


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
		},
		accept: function ($el){
			var permitido = $el.data("accept")
			var tipo = $el[0].files[0].type.split('/').pop();
			var existe = permitido.indexOf(tipo);
			if ($el[0].files[0] && existe < 0) {
				return "Las extensiones permitidas son: "+permitido;
			}
		},
	}
});
</script>
@if(Route::currentRouteName()!=='solicitud-residuos.reportes')
<script type="text/javascript">
	function Selects(){
		$('select').select2({
			placeholder: "Seleccione...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
$(document).ready(function() {
	Selects();
});
</script>
@endif
<script type="text/javascript">
function SelectsMultiple(){
	$('.select-multiple').select2({
		allowClear: true,
		width: 'resolve',
		width: '100%',
		tags: true,
		theme: "classic"
	});
}
$(document).ready(function() {
	SelectsMultiple();
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
			$('.nombres').prop('maxlength', '60');
			$('.nombres').prop('pattern', '[A-ZÀ-ÿa-z ]+');
			$('.nombres').attr('data-error', 'Unicamente letras');
			$('.nombres').removeClass('nombres');
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
	$('.inputText').prop('maxlength', '100');
	$('.inputText').prop('pattern', '[A-Za-zÀ-ÿ ]+');
	$('.document').inputmask({ mask: "[9][9][9][9][9][9][9][9][9][9][9]" });
	$('.bank').inputmask({ mask: "[9][9][9][9 ][9][9][9][9 ][9][9][9][9 ][9][9][9][9]" });
	$('.nombres').inputmask({ mask: "[a{0,15}] [a{0,15}] [a{0,15}] [a{0,15}]"});
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
	numeroDimension();
	numeroKg();
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
		onText: 'Si',
		offText: 'No',
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
function Switch6() {
	$(".embalajeswitch").bootstrapSwitch({
		animate: true,
		labelText: '<i class="fas fa-trash"></i>',
		onText: '<i class="fas fa-check"></i>',
		offText: '<i class="fas fa-times"></i>',
	});
}
$(document).ready(Switch6());
</script>
<script type="text/javascript">
function Switch7() {
	$(".ofertaswitch").bootstrapSwitch({
		animate: true,
		labelText: '<i class="fas fa-arrows-alt-h"></i>',
		onText: 'Si',
		offText: 'No',
		radioAllOff: true,
	});
}
$(document).ready(Switch7());
</script>
<script type="text/javascript">
function Switch8() {
	$(".auditoriaswitch").bootstrapSwitch({
		animate: true,
		labelText: '<i class="fas fa-eye"></i>',
		onText: '<i class="fas fa-check"></i>',
		offText: '<i class="fas fa-times"></i>',
	});
}
$(document).ready(Switch8());
</script>
@if(Route::currentRouteName()=='tarifas.index')
<script type="text/javascript">
$(document).ready(function() {

	/*var rol defino el rol del usuario*/
	var rol = "<?php echo Auth::user()->UsRol; ?>";

	/*var botoncito define los botones que se usaran si el usuario es programador*/
	var botoncito = (rol == 'Programador') ? [{extend: 'colvis', text: 'Columnas Visibles'}, {extend: 'copy', text: 'Copiar'}, {extend: 'excelHtml5', text: 'Excel'}, {extend: 'pdf', text: 'Pdf'}, {
					extend: 'collection',
					text: 'Selector',
					buttons: ['selectRows', 'selectCells']
				}] : [{extend: 'colvis', text: 'Columnas Visibles'}, {extend: 'excelHtml5', text: 'Excel'}];

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

{{-- script para tabla de totales --}}
@if(Route::currentRouteName()=='solicitud-servicio.show')
<script type="text/javascript">
$(document).ready(function() {

	/*funcion para renderizar la tabla de cotizacion.index*/
	$('#totalesTable').DataTable({
		responsive: true,
		select: true,
		dom: '',
		colReorder: true,
		ordering: true,
		autoWith: true,
		searchHighlight: true,
	});

	/*funcion para resaltar las busquedas*/
	var table = $('#totalesTable').DataTable();

	table.on('draw', function() {
		var body = $(table.table().body());
		body.unhighlight();
		body.highlight(table.search());
	});
});

</script>
<script type="text/javascript">
	$(document).ready(function() {

	/*funcion para renderizar la tabla de observaciones del solser.show*/
	$('#observacionesTable').DataTable({
		responsive: false,
		select: true,
		ordering: false,
		autoWith: true,
		pageLength: 2,
		searchHighlight: true,
		"language": {
			"sLengthMenu": "Mostrar _MENU_",
			"sZeroRecords": "Aun No hay observaciones para este Servicio",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "_START_ al _END_ de _TOTAL_ observaciones",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 observaciones",
			"sInfoFiltered": "",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
			}
		}
	});

	/*funcion para resaltar las busquedas*/
	var table = $('#observacionesTable').DataTable();

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
			if (id) {
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
						$("#municipio").prop('disabled', true);
					},
					success: function(res){
						$("#municipio").empty();
						var municipio = new Array();
						for(var i = res.length -1; i >= 0; i--){
							if ($.inArray(res[i].ID_Mun, municipio) < 0) {
								$("#municipio").append(`<option value="${res[i].ID_Mun}">${res[i].MunName}</option>`);
								municipio.push(res[i].ID_Mun);
							}
						}
					},
					complete: function(){
						$(".load").empty();
						$("#municipio").prop('disabled', false);
					}
				})
			}
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
	Vehiculo();
};
function NoAddVehiculo() {
	document.getElementById('AddVehiculoPlaca').style.display = 'none';
	document.getElementById('AddVehiculoTipo').style.display = 'none';
	document.getElementById('AddVehiculoCapacidad').style.display = 'none';
	$('#VehicPlaca').prop('required', false);
	$('#VehicTipo').prop('required', false);
	$('#VehicCapacidad').prop('required', false);
	$('#VehicPlaca').val('');
	$('#VehicTipo').val('');
	$('#VehicCapacidad').val('');
	$('#form').validator('destroy');
	$('#form').validator('update');
};

function Vehiculo(){
	document.getElementById('AddVehiculoPlaca').style.display = 'block';
	document.getElementById('AddVehiculoTipo').style.display = 'block';
	document.getElementById('AddVehiculoCapacidad').style.display = 'block';
	$('#VehicPlaca').prop('required', true);
	$('#VehicTipo').prop('required', true);
	$('#VehicCapacidad').prop('required', true);
	$('#form').validator('update');
}
</script>
@endif
<script type="text/javascript">
$(document).ready(function() {
	popover();
});
function popover(){
	$('[data-toggle="popover"]').popover({
        container: 'body',
        html: true,
        placement: 'auto',
    });
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
	"debug": false,
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
@if(Route::currentRouteName()=='tratamiento.edit')
	<script>
		var contador = 0;
		$("#edittratamientoForm").validator('update');
		popover();
		function AgregarPreTrat() {
			var pretratamiento = `@include('layouts.respel-comercial.respel-pretrat')`;
			$("#pretratamientosPanel").append(pretratamiento);
			$("#edittratamientoForm").validator('update');
			contador = parseInt(contador) + 1;
			popover();
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
		var botoncito = (rol == 'Programador') ? [{extend: 'colvis', text: 'Columnas Visibles'}, {extend: 'copy', text: 'Copiar'}, {extend: 'excel', text: 'Excel'}, {extend: 'pdf', text: 'Pdf'}, {
					extend: 'collection',
					text: 'Selector',
					buttons: ['selectRows', 'selectCells']
				}] : [{extend: 'colvis', text: 'Columnas Visibles'}, {extend: 'excel', text: 'Excel'}];
		/*inicializacion de datatable general*/      
		$('.table').DataTable({
			"dom": "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
				"<'row'<'col-md-12'tr>>" +
				"<'row'<'col-md-6'i><'col-md-6'p>>",
			"scrollX": false,
			"autoWidth": true,
			// "select": true,
			"colReorder": true,
			"ordering": true,
			"order": [0, 'desc'],
			"searchHighlight": true,
			"responsive": true,
			"keys": true,
			"lengthChange": true,
			"searching": true,
			"buttons": [
				botoncito,
			],
			// "columns": [
			//     { "type": "date-uk" },
			//     ],
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
				},
				"colvis": 'Ajouté au presse-papiers'
			}
		});
	});
	/*funcion para actualizar elplugin responsive in chrome*/
	function recalcularwitdth() {
	var table = $('.table').DataTable();
	table.columns.adjust();
	table.responsive.recalc();
	// console.log('tabla recalculada');
	}
	$(document).ready(function () {
		var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
		// la funcion se ejecuta unicaente en chrome
		if(is_chrome)
		{
			setTimeout(recalcularwitdth, 100);
		}
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
{{-- script para deshabilitar los botones de los formularios al hacer submit --}}
<script>
	function envsubmit(){
		$('form').on('submit', function(){
			var buttonsubmit = $(this).find('[type="submit"]');
			var idbutton = buttonsubmit[0].id;
			if(buttonsubmit.hasClass('disabled')){
				return false;
			}
			else{
				if(idbutton != ''){
					var label = $('label[for="'+idbutton+'"]');
					$(label).empty();
					$(label).append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
					$(label).attr('disabled', true);
				}
				buttonsubmit.prop('disabled', true);
				buttonsubmit.empty();
				buttonsubmit.append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
				$(this).submit(function(){
					return false;
				});
				return true;
			}
		});
	}
	$(document).ready(function(){
		envsubmit();
	});
</script>
{{-- script para activar las funciones de los options --}}
<script>
	function ChangeSelect(){
		$('select').on('change', function(){
				var option="";
				option = $(this).find("option:selected");
				option.click();
			});
	}
	$(document).ready(function(){
		ChangeSelect();
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
@if(Route::currentRouteName() === 'generadores.show' || Route::currentRouteName() === 'sgeneradores.show')
<script>
	function deleteRespelGener(slug, RespelName, name){
		$('.deleterespelgener').empty();
		$('.deleterespelgener').append(`
			@if(Route::currentRouteName() === 'sgeneradores.show')
				<form action='/respelSGener/`+slug+`' method='POST' role="form">
			@else
				<form action='/respelGener/`+slug+`' method='POST' role="form">
			@endif
				@method('DELETE')
				@csrf
				<div class="modal modal-default fade in" id="eliminar`+slug+`" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: red; text-align: center; margin: auto;" class="textodeleteRespelsSGener">
									<i class="fas fa-exclamation-triangle"></i>
									<span style="font-size: 0.3em; color: black;">
										<p>{{ trans('adminlte_lang::message.modaldeletegener') }} <b><i>`+RespelName+`</i></b> 
										@if(Route::currentRouteName() === 'sgeneradores.show')
											{{ trans('adminlte_lang::message.modalsgener') }} <b>
										@else
											{{ trans('adminlte_lang::message.modalgener') }} <b>
										@endif
											<i> `+name+`</i></b>{{ trans('adminlte_lang::message.?') }} </p>
									</span>
								</div> 
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.modalexit') }}</button>
								<label for="delete`+slug+`" class='btn btn-danger'>{{ trans('adminlte_lang::message.modaldelete') }}</label>
							</div>
						</div>
					</div>
				</div>
				<input type="submit" id="delete`+slug+`" style="display: none;">
			</form>
		`);
	}
</script>
@endif
<script>
//	$(document).ready(function(){
//		$('input[type="email"]').prop('pattern', '[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+[.][a-zA-Z0-9_]{2,6}([.][a-z]{2})?');
//		$('input[type="email"]').attr('data-error', 'No es un e-mail valido');
//	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("form").attr("lang", "es");
	});
</script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#selectCategory").change(function(e){
				id=$("#selectCategory").val();
				e.preventDefault();
				$.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				  }
				});
				$.ajax({
					url: "{{url('/SubcategoriaDinamico')}}/"+id,
					method: 'GET',
					data:{},
					beforeSend: function(){
						$(".load").append('<i class="fas fa-sync-alt fa-spin"></i>');
						$("#subcategorycontainer").prop('disabled', true);
					},
					success: function(res){
						console.log(res);
						$("#subcategorycontainer").empty();
						var subcat = new Array();
						for(var i = res.length -1; i >= 0; i--){
							if ($.inArray(res[i].ID_SubCategoryRP, subcat) < 0) {
								$("#subcategorycontainer").append(`<option value="${res[i].ID_SubCategoryRP}">${res[i].SubCategoryRpName}</option>`);
								subcat.push(res[i].ID_SubCategoryRP);
							}
						}
					},
					complete: function(){
						$(".load").empty();
						$("#subcategorycontainer").prop('disabled', false);
					}
				})
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			/*var rol defino el rol del usuario*/
			var rol = "<?php echo Auth::user()->UsRol; ?>";
			/*var botoncito define los botones que se usaran si el usuario es programador*/
			var botoncito = (rol == 'Programador') ? [{extend: 'colvis', text: 'Columnas Visibles'}, {extend: 'copy', text: 'Copiar'}, {extend: 'excel', text: 'Excel'}, {extend: 'pdf', text: 'Pdf'}, {
						extend: 'collection',
						text: 'Selector',
						buttons: ['selectRows', 'selectCells']
					}] : [{extend: 'colvis', text: 'Columnas Visibles'}, {extend: 'excel', text: 'Excel'}];
			/*inicializacion de datatable general*/      
			$('.table-express').DataTable({
				"dom": "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
					"<'row'<'col-md-12'tr>>",
				"scrollX": false,
				"autoWidth": true,
				// "select": true,
				"colReorder": true,
				"ordering": true,
				"order": [0, 'desc'],
				"searchHighlight": true,
				"responsive": true,
				"keys": true,
				"lengthChange": false,
				"searching": false,
				"buttons": [
					// botoncito,
				],
				// "columns": [
				//     { "type": "date-uk" },
				//     ],
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
					},
					"colvis": 'Ajouté au presse-papiers'
				}
			});
		});
		/*funcion para actualizar elplugin responsive in chrome*/
		function recalcularwitdthExpress() {
		table = $('.table-express').DataTable();
		table.columns.adjust();
		table.responsive.recalc();
		// console.log('tabla recalculada');
		}
		$(document).ready(function () {
			var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
			// la funcion se ejecuta unicaente en chrome
			if(is_chrome)
			{
				setTimeout(recalcularwitdthExpress, 100);
			}
		});
	</script>
@yield('NewScript')
