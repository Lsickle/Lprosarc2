@extends('layouts.app')
@section('htmlheader_title','Reportes')
{{-- @endsection --}}
@section('contentheader_title', 'Reportes')
{{-- @endsection --}}
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <div class="box">
                <div class="box-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h3 class="box-title">reporte de cantidades</h3>
                                <a style="margin-right: 0px;" href="recurso/create" class="btn btn-primary pull-right">Buscar</a>
                                
                                <li style="margin-right: 5px;" class="btn btn-default pull-right dropdown ">
                                    <a class="nav-link dropdown-toggle py-0 px-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">Fechas</a>
                                
                                    <ul class="dropdown-menu">
                                
                                        {{-- <li role="separator" class="divider"></li> --}}
                                        <table>
                                            <tr>
                                                <td>
                                                    <h6 class="dropdown-header">Rangos Predefinidos.</h6>
                                                    <li><a class="dropdown-item px-3" href="#">Agosto</a></li>
                                                    <li><a class="dropdown-item px-3" href="#">Septiembre</a></li>
                                                    <li><a class="dropdown-item px-3" href="#">Octubre</a></li>
                                                    <li><a class="dropdown-item px-3 active" href="#">Noviembre</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a class="dropdown-item px-3" href="#">Ultimo Año </a></li>
                                                    <li><a class="dropdown-item px-3" href="#">Ultimo mes</a></li>
                                                    <li><a class="dropdown-item px-3" href="#">Ultimo Semana</a></li>
                                                </td>
                                            </tr>
                                        </table>
                                    </ul>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <form class="form">
                                <div class="col-md-6" style="margin-top:1em">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="inlineFormInputGroupDate1" placeholder="Desde" describedby="inputGroupPrepend" required>
                                        <span class="input-group-addon" id="basic-addon2"><i class="fas fa-calendar-day"></i> Desde</span>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:1em">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="inlineFormInputGroupDate1" placeholder="Hasta" describedby="inputGroupPrepend" required>
                                        <span class="input-group-addon" id="basic-addon2"><i class="fas fa-calendar-day"></i> Hasta</span>
                                    </div>
                                </div>
                                {{-- <button type="submit" class="btn btn-block btn-primary">Buscar</button> --}}
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:1em">
                                <select class="form-control select" id="Cliente" name="Cliente" required>
                                    <option value="">Cliente</option>
                                    @foreach ($clientes as $cliente)
                                    <option value="ID_Trat">{{$cliente->CliName}}</option>
                                    @endforeach
                                    <option value="">Todos</option>
                                </select>
                            </div>
                            <div class="col-md-6" style="margin-top:1em">
                                <select class="form-control select" id="Generador" name="Generador" required>
                                    <option value="">Generador</option>
                                    @foreach ($generadores as $generador)
                                    <option value="ID_Trat">{{$generador->GenerName}}</option>
                                    @endforeach
                                    <option value="">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:1em">
                                <select class="form-control select" id="Tratamiento" name="Tratamiento" required>
                                    <option value="">Tratamiento</option>
                                    @foreach ($tratamientos as $tratamiento)
                                    <option value="ID_Trat">{{$tratamiento->TratName}}</option>
                                    @endforeach
                                    <option value="ALL">Todos</option>
                                </select>
                            </div>
                            <div class="col-md-6" style="margin-top:1em">
                                <select class="form-control select" id="Residuo" name="Residuo" required>
                                    <option value="">Residuo</option>
                                    @foreach ($residuos as $residuo)
                                    <option value="ID_Trat">{{$residuo->RespelName}}</option>
                                    @endforeach
                                    <option value="">Todos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table id="reporteTable" class=" table-compact table-bordered">
                        <thead>
                            <tr>
                                <th>Servicio</th>
                                <th>Recepcion</th>
                                @if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                <th>ID_SolRes</th>
                                @endif
                                <th>RM</th>
                                <th>Residuo</th>
                                <th>Tretamiento</th>
                                <th>Cliente</th>
                                <th>Generador</th>
                                <th>Cantidad Kg</th>
                                <th>Cantidad Unid</th>
                                <th>Comercial</th>
                            </tr>
                        </thead>
                        <tbody id="readyTable">
                            @foreach ($servicios as $servicio)
                                @foreach ($servicio->SolicitudResiduo as $solres)
                                    <tr>
                                        <td><b>Servicio:#{{$servicio->ID_SolSer}}</b>  <br> ({{$servicio->SolSerStatus}})</td>
                                        <td>fecha rececpcion</td>
                                        @if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                        <td>{{$solres->ID_SolRes}}</td>
                                        @endif
                                        <td>
                                            @if (!is_null($solres->SolResRM))
                                            @foreach ($solres->SolResRM as $rm)
                                            {{$rm}} <br>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>{{$solres->generespel->respels->RespelName}}</td>
                                        <td><b>Tratamiento: {{$solres->requerimiento->tratamiento->TratName}}</b></td>
                                        <td>{{$servicio->cliente->CliName}}</td>
                                        <td>{{$solres->generespel->gener_sedes->generadors->GenerName}} <br> ({{$solres->generespel->gener_sedes->GSedeName}})</td>
                                        <td>{{$solres->SolResKgConciliado}}</td>
                                        <td>{{$solres->SolResCantiUnidadConciliada}}</td>
                                        <td>{{$servicio->cliente->comercialAsignado->PersEmail}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scripts')
<script type="text/javascript">
    function SelectCliente(){
		$('#Cliente').select2({
			placeholder: "Clientes...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
    function SelectGenerador(){
		$('#Generador').select2({
			placeholder: "Generadores...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
    function SelectTratamiento(){
		$('#Tratamiento').select2({
			placeholder: "Tratamientos...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
    function SelectResiduo(){
		$('#Residuo').select2({
			placeholder: "Residuos...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
    $(document).ready(function() {
        SelectCliente();
        SelectGenerador();
        SelectTratamiento();
        SelectResiduo();
    });
</script>
{{-- <script>
    $(document).ready(function() {
		$('#reporteTable').DataTable({
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
            "rowGroup": {
                endRender: null,
                startRender: function ( rows, group ) {
                    var subtotalTrat = rows
                        .data()
                        .pluck(7)
                        .reduce( function (a, b) {
                            return a + parseFloat(b);
                        }, 0);
    
                    return $('<tr/>')
                        .append( '<td colspan="5">'+group+'</td>' )
                        .append( '<td>'+subtotalTrat+' Kg.</td>' )
                        .append( '<td/>' );
                },
                className: 'rowgroup-servicio',
                dataSrc: [ 0, 4 ]
            },
            "columnDefs": [ {
                targets: [ 0, 4 ],
                visible: false
            } ]
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
</script> --}}
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
		$('#reporteTable').DataTable({
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
			"responsive": false,
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
			},
            "rowGroup": {
                endRender: null,
                startRender: function ( rows, group ) {
                    var subtotalTrat = rows
                        .data()
                        .pluck(8)
                        .reduce( function (a, b) {
                            return a + parseFloat(b);
                        }, 0);
    
                    return $('<tr/>')
                        .append( '<td colspan="6">'+group+'</td>' )
                        .append( '<td>'+subtotalTrat+' Kg.</td>' )
                        .append( '<td/>' )
                        .append( '<td/>' );
                },
                dataSrc: [ 0, 5 ]
            },
            "columnDefs": [ {
                targets: [ 0, 5 ],
                visible: false
            } ]
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
@endsection