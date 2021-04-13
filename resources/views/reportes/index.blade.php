@extends('layouts.appReportes')
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
                    </div>
                </div>
                <div class="box-body">
                    <table id="reporteTable" class=" table-compact table-bordered">
                        <thead>
                            <tr>
                                <th>Servicio</th>
                                <th>Status</th>
                                <th>Recepcion</th>
                                @if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                <th>ID_SolRes</th>
                                @endif
                                <th>RM</th>
                                <th>Residuo</th>
                                <th>Tratamiento</th>
                                <th>Precio</th>
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
                                        <td>#{{$servicio->ID_SolSer}}</td>
                                        <td>{{$servicio->SolSerStatus}}</td>
                                        <td>
                                        @if (!is_null($servicio->programacionesrecibidas))
                                        @foreach ($servicio->programacionesrecibidas as $programacion)
                                        {{date('Y/m/d', strtotime($programacion->ProgVehEntrada))}}
                                        @endforeach
                                        @endif
                                        </td>
                                        @if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                        <td>{{$solres->ID_SolRes}}</td>
                                        @endif
                                        <td>
                                            @if (isset($solres->SolResRM)&&is_array($solres->SolResRM))
                                            @foreach ($solres->SolResRM as $rm)
                                            {{$rm}} <br>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>{{$solres->generespel->respels->RespelName}}</td>
                                        <td>{{$solres->requerimiento->tratamiento->TratName}}</td>
                                        <td>{{$solres->SolResPrecio}}</td>
                                        <td>{{$servicio->cliente->CliName}} <br> ({{$servicio->cliente->CliCategoria}})</td>
                                        <td>{{$solres->generespel->gener_sedes->generadors->GenerName}} <br> ({{$solres->generespel->gener_sedes->GSedeName}})</td>
                                        <td>{{$solres->SolResKgConciliado}}</td>
                                        <td>{{$solres->SolResCantiUnidadConciliada}}</td>
                                        @if (isset($servicio->cliente->comercialAsignado)&& (!is_null($servicio->cliente->comercialAsignado)))
                                            <td>{{$servicio->cliente->comercialAsignado->PersEmail}}</td>
                                        @else
                                            <td>{{'sin comercial'}}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Servicio</th>
                                <th>Status</th>
                                <th>Recepcion</th>
                                @if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                <th>ID_SolRes</th>
                                @endif
                                <th>RM</th>
                                <th>Residuo</th>
                                <th>Tratamiento</th>
                                <th>Precio</th>
                                <th>Cliente</th>
                                <th>Generador</th>
                                <th>Cantidad Kg</th>
                                <th>Cantidad Unid</th>
                                <th>Comercial</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.3/js/dataTables.colReorder.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/keytable/2.6.1/js/dataTables.keyTable.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.3/js/dataTables.scroller.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.0.1/js/dataTables.searchBuilder.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/1.2.2/js/dataTables.searchPanes.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.js"></script>
<script src="{{asset('//cdn.datatables.net/plug-ins/1.10.24/api/sum().js')}}"></script>
<script>
    $(document).ready(function() {
		/*var rol defino el rol del usuario*/
		var rol = "<?php echo Auth::user()->fk_rol; ?>";
		/*var botoncito define los botones que se usaran si el usuario es programador*/
		var botoncito = (rol == 1) ? [{extend: 'colvis', text: 'Columnas'}, {extend: 'copy', text: 'Copiar'}, {extend: 'excel', text: 'Excel'}, {extend: 'pdf', text: 'Pdf'}, {extend: 'collection', text: 'Selector', buttons: ['selectRows', 'selectCells']}] : [{extend: 'colvis', text: 'Columnas'}, {extend: 'excel', text: 'Excel'}];
		/*inicializacion de datatable general*/
		$('#reporteTable').DataTable({
			"dom":"<'row'<'col-md-8'P><'col-md-4'<'card my-1'<'card-body'Q>>>>" +
				"<'row justify-content-between pt-3 pb-0'<l><'text-center d-none d-md-block'B><f>>" +
				"<'row'<'col-md-12'rt>>" +
				"<'row pt-0 pb-3 justify-content-center justify-content-md-between'<'align-self-center'i><''p>>",
			"searchPanes": {
				cascadePanes: true,
				layout: 'columns-2',
				// columns: [1,4],
				count: '{total}',
				countFiltered: '{shown} / {total}',
				viewTotal: true,
				dtOpts: {
					select: {
						style: 'multi'
					}
				}
			},
			"scrollX": false,
			"serverSide": false,
			"autoWidth": false,
			"select": true,
			"colReorder": true,
			"ordering": true,
			"order": [0, 'desc'],
			"searchHighlight": true,
			"responsive": true,
			"keys": true,
			"lengthChange": true,
			"searching": true,
			"buttons": [
				botoncito
			],
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "_MENU_ Filas",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "_START_ al _END_ de _TOTAL_",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "",
				"sInfoPostFix":    "",
				"sSearch":         "_INPUT_",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "->",
					"sPrevious": "<-"
				},

				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				},
				"colvis": 'Columnas Visibles'
			},
			"columnDefs": [
				{ "type": "num-fmt", "targets": [0,2,3]},
				{ "type": "date", "targets": [6,7]},
				{ "type": "html", "targets": '_all'},
				{ "orderable": false, "targets": [8] },
				// { "className": "text-right", "targets": [2,3,5]},
				// { "className": "text-left", "targets": [1]},
				// { "visible": false, "targets": [4]}
			],
			"drawCallback": function () {
				var api = this.api();
				$( api.table().footer() ).html(
					`<th  scope="col" colspan="2">TOTAL</th>
					<th  scope="col" class="text-right pr-3">`+formatter.format(api.column( 2, {filter:'applied'} ).data().sum())+`</th>
					<th  scope="col" colspan="6"></th>`
				);
			}
		});
	});
	var formatter = new Intl.NumberFormat('en-US', {
	style: 'currency',
	currency: 'USD',
	maximumFractionDigits: 2,
	//maximumFractionDigits: 0,
	});
	/*funcion para actualizar elplugin responsive in chrome*/
	function recalcularwitdth() {
	var table = $('#comprasTable').DataTable();
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