@extends('layouts.appReportes')
@section('htmlheader_title','audits')
{{-- @endsection --}}
@section('contentheader_title', 'audits')
{{-- @endsection --}}
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<h3 class="box-title">auditoria (last month)</h3>
								<button class="btn btn-primary pull-right" type="button" data-toggle="collapse" data-target=".panels" aria-expanded="false" aria-controls="collapseExample">
									<div class="text-nowrap bd-highlight">
										<i class="fas fa-filter"></i> Segmentacion
									</div>
								</button>
								<button style="margin-right: 5px; color:#3c8dbc;" class="btn btn-default pull-right" type="button" data-toggle="collapse" data-target=".filters" aria-expanded="false" aria-controls="collapseExample">
									<div class="text-nowrap bd-highlight">
										<i class="fas fa-filter"></i> Filtros
									</div>
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="auditstable" class="table table-compact table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>TIPO</th>
								<th>Tabla</th>
								<th>Registro</th>
								<th>Usuario</th>
								<th>LOG</th>
								<th>tipo de log</th>
								<th>Creado</th>
							</tr>
						</thead>
						<tbody id="readyTable">
							@php
								function desmenusar($variable)
								{
									$tipo = gettype($variable);
									$respuesta = 'el tipo de dato es '.$tipo;

									switch ($tipo) {
										case 'boolean':
											$respuesta = $variable;
											break;

										case 'integer':
											$respuesta = $variable;
											break;

										case 'double':
											$respuesta = $variable;
											break;

										case 'string':
											$subtipo = json_decode($variable);

											// $tipo = gettype($subtipo);

											// $respuesta = 'json decode result is'.$tipo;

											$respuesta = $subtipo;

											break;

										case 'array':
											$respuesta = $variable;
											break;

										case 'object':
											$respuesta = $variable;
											break;

										case 'resource':
											$respuesta = $variable;
											break;

										case 'NULL':
											$respuesta = $variable;
											break;

										case 'unknown type':
											$respuesta = 'unknown type';
											break;
										
										default:
											$respuesta = 'variable indefinida';
											break;
									}
									return $respuesta;
								}
							@endphp
							@foreach($auditorias as $auditoria)
							<tr>
								<td>{{$auditoria->id}}</td>
								<td>{{$auditoria->AuditType}}</td>
								<td>{{$auditoria->AuditTabla}}</td>
								<td>{{$auditoria->AuditRegistro}}</td>
								<td>{{$auditoria->AuditUser}}</td>
								<td>
									{{-- {{gettype ( $auditoria->Auditlog )}} --}}
									
									@switch(gettype($auditoria->Auditlog))
										@case('boolean')
										{{$auditoria->Auditlog}}
											@break

										@case('integer')
										{{$auditoria->Auditlog}}
											@break

										@case('double')
										{{$auditoria->Auditlog}}
											@break

										@case('string')
										{{$auditoria->Auditlog}}
											@break

										@case('array')
											@foreach ($auditoria->Auditlog as $key => $value)
												<b>{{$key}}:</b>
												@if(is_array($value))
													@foreach ($value as $key2 => $value2)
														<b>{{$key2}}:</b>
														@if(is_array($value2))
															@foreach ($value2 as $key3 => $value3)
																<b>{{$key3}}:</b>
																@if(is_array($value3))
																	{{'array de 3er nivel'}}
																@else
																	{{$value3}}</br>
																@endif
															@endforeach
														@else
															{{$value2}}</br>
														@endif
													@endforeach
												@else
													{{$value}}</br>
												@endif
											@endforeach
											{{-- @foreach ($auditoria->Auditlog as $key => $value)
												clave:{{$key}} valor:{{$value}}
											@endforeach
											@break--}}

										@case('object')
										{{-- {{$auditoria->Auditlog}} --}}
											{{-- @foreach ($auditoria->Auditlog as $key => $value)
												clave:{{$key}} valor:{{$value}}
											@endforeach --}}
											@break

										@case('resource')
										{{$auditoria->Auditlog}}
											@break

										@case('NULL')
										{{$auditoria->Auditlog}}
											@break

										@case('unknown type')
										{{$auditoria->Auditlog}}
											@break

										@default
											
									@endswitch
								</td>
								<td>{{$auditoria->tipo}}</td>
								<td>{{$auditoria->created_at}}</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>TIPO</th>
								<th>Tabla</th>
								<th>Registro</th>
								<th>Usuario</th>
								<th>LOG</th>
								<th>tipo de log</th>
								<th>Creado</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.3/kt-2.6.1/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js"></script>
<script src="{{asset('//cdn.datatables.net/plug-ins/1.10.24/api/sum().js')}}"></script>
<script>
	@switch(Auth::user()->UsRol)
        @case('Programador')
        @case('AdministradorBogota')
        @case('AdministradorPlanta')
        @case('AsistenteComercial')
        @case('JefeOperaciones')
        @case('Supervisor')
        @case('Tesorería')
        @case('AsistenteLogistica')
        @case('JefeLogistica')
            $(document).ready(function() {
                /*var rol defino el rol del usuario*/
                var rol = "<?php echo Auth::user()->fk_rol; ?>";
                /*var botoncito define los botones que se usaran si el usuario es programador*/
                var botoncito = (rol == 1) ? [{extend: 'colvis', text: 'Columnas'}, {extend: 'copy', text: 'Copiar'}, {extend: 'excel', text: 'Excel'}, {extend: 'pdf', text: 'Pdf'}, {extend: 'collection', text: 'Selector', buttons: ['selectRows', 'selectCells']}] : [{extend: 'colvis', text: 'Columnas'}, {extend: 'excel', text: 'Excel'}];
                /*inicializacion de datatable general*/
                $('#auditstable').DataTable({
                    "dom":"<'row'<'col-md-12 collapse panels'P><'col-md-12 collapse filters'<'card'<'card-body'Q>>>>" +
                        "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                        "<'row'<'col-md-12'<'pre-x-scrollable'rt>>>" +
                        "<'row justify-content-center justify-content-md-between'<'col-md-12'<'align-self-center'i><''p>>>",
                    "searchPanes": {
                        cascadePanes: true,
                        layout: 'columns-4',
                        columns: [1,2,4,6,7],
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
                    "autoWidth": true,
                    "select": true,
                    "colReorder": true,
                    "ordering": true,
                    "order": [0, 'desc'],
                    "searchHighlight": true,
                    "responsive": false,
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
						{ "type": "num-fmt", "targets": [0,3]},
                        { "type": "date", "targets": [7]},
                        { "type": "html", "targets": '_all'},
                        { "orderable": false, "targets": [5,6]},
                    ]
                });
            });
		@break
        @default
    
    @endswitch
	var formattermoney = new Intl.NumberFormat('es-CO', {
		style: 'currency',
		currency: 'COP',
		maximumFractionDigits: 2,
		//maximumFractionDigits: 0,
	});
    var formatternumber = new Intl.NumberFormat('es-CO', {
    	maximumFractionDigits: 2,
    	//maximumFractionDigits: 0,
    });

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