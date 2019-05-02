<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ url (mix('/js/app.js')) }}"></script>

{{-- Dependencias Package.json --}}
<script src="{{ url (mix('/js/dependencias.js')) }}"></script>

{{-- plugins de datatables --}}
<script src="{{ url (mix('/js/datatable-plugins.js')) }}"></script>

<!-- DataTables -->
<script src="{{ url (mix('/js/datatable-depen.js')) }}"></script>

{{-- fullcalendar --}}
<script src="{{ url (mix('/js/fullcalendar.js')) }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

{{-- script de tabla de cotizaciones --}}
@if(Route::currentRouteName()=='cotizacion.index')
<script>
$(document).ready(function() {

    /*var rol defino el rol del usuario*/
    var rol = "<?php echo Auth::user()->UsRol; ?>";

    /*var botoncito define los botones que se usaran si el usuario es programador*/
    var botoncito = (rol == 'Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];

    /*funcion para renderizar la tabla de cotizacion.index*/
    $('#cotizacionesTable').DataTable({
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
            "targets": 13,
            "data": "ID_Coti",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/cotizacion/" + data + "/' class='btn btn-primary btn-block'>Mas información</a>";
            }
        }]
    });

    /*funcion para resaltar las busquedas*/
    var table = $('#cotizacionesTable').DataTable();

    table.on('draw', function redibujar() {
        var body = $(table.table().body());
        body.unhighlight();
        body.highlight(table.search());
    });
    // alert('ready');
    // function redibujar(){ 
    //  alert('redibujar');
    //  table.responsive.recalc(); 
    // }; 
    // document.setTimeout(redibujar, 10000); // 5 seconds 
});
</script>
@endif
{{-- script para tabla de tratamientos --}}
@if(Route::currentRouteName()=='tratamiento.index')
<script>
$(document).ready(function() {

    /*var rol defino el rol del usuario*/
    var rol = "<?php echo Auth::user()->UsRol; ?>";

    /*var botoncito define los botones que se usaran si el usuario es programador*/
    var botoncito = (rol == 'Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];

    /*funcion para renderizar la tabla de cotizacion.index*/
    $('#tratamientosTable').DataTable({
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
            "targets": 6,
            "data": "ID_Trat",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/tratamiento/" + data + "/' class='btn btn-primary btn-block'>Mas información</a>";
            }
        }]
    });

    /*funcion para resaltar las busquedas*/
    table.on('draw', function() {
        var body = $(table.table().body());
        body.unhighlight();
        body.highlight(table.search());
    });
});

</script>
@endif
{{-- <script>
//Date range as a button
$('#daterange-btn').daterangepicker({
        ranges: {
            '1 Meses': [moment(), moment().add(1, 'month')],
            '2 Meses': [moment(), moment().add(2, 'months')],
            '3 Meses': [moment(), moment().add(3, 'months')],
            '6 Meses': [moment(), moment().add(6, 'months')],
            '1 Año': [moment(), moment().add(1, 'year')]
        },
        startDate: moment(),
        endDate: moment().moment()
    },
    function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
)

</script> --}}
{{-- select 2 --}}
<script>
$(document).ready(function() {
    $('#SGenerRespel').select2({
        placeholder: "Seleccione el residuo",
        allowClear: true,
        width: 'resolve'
    });
});

</script>

<script>
$(document).ready(function() {
    $('#select2sedes').select2({
        placeholder: "Seleccione el gestor",
        allowClear: true,
        width: 'resolve'
    });
});

</script>

<script>
$(document).ready(function() {
    $('#SolicitudResiduo').select2({
        placeholder: "Seleccione el residuo",
        allowClear: true,
        width: 'resolve'
    });
});

</script>
<script>
$(document).ready(function() {
    $('.select').select2({
        placeholder: "Seleccione...",
        allowClear: true,
        width: 'resolve',
        width: '100%',
    });
});

</script>
{{-- script para formulario en smart-wizzard --}}
<script type="text/javascript">
$(document).ready(function() {
    $('#smartwizard').smartWizard({
        theme: 'arrows',
        keyNavigation: true
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
                    // Form validation failed
                    return false;
                }
            }
            return true;
        });
    });
</script>
<!-- funcion para tabla de residuos -->
@if(Route::currentRouteName()=='respels.index')
<script>
$(document).ready(function() {
    /*var rol defino el rol del usuario*/
    var rol = "<?php echo Auth::user()->UsRol; ?>";

    /*var define los botones que se usaran segun el rol de usuario*/
    if (rol == 'JefeOperacion'||rol == 'admin'||rol == 'Programador') {
        $('#RespelTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [
            {
                "targets": 8,
                "data": "RespelSlug",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='/respels/" + data + "/edit' target='_blank' class='btn btn-warning'><i class='fab fa-hotjar'></i></a>";
                }
            },
            {
                "targets": 4,
                "data": "RespelHojaSeguridad",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='/img/HojaSeguridad/" + data + "' target='_blank' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></i></a>";
                }
            },
            {
                "targets": 5,
                "data": "RespelTarj",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='/img/TarjetaEmergencia/" + data + "' target='_blank' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></i></a>";
                }
            }]
        });
    }else{
        $('#RespelTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [
            {
                "targets": 8,
                "data": "RespelSlug",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='/respels/" + data + "' target='_blank' class='btn btn-primary'><i class='fab fa-search'></i></a>";
                }
            },
            {
                "targets": 4,
                "data": "RespelHojaSeguridad",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='/img/HojaSeguridad/" + data + "' target='_blank' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></a>";
                }
            },
            {
                "targets": 5,
                "data": "RespelTarj",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='/img/TarjetaEmergencia/" + data + "' target='_blank' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></a>";
                }
            }]
        });
    }

    
        /*funcion para resaltar las busquedas*/
        var bod = $(table.table().body());
        table.on('draw', function redibujar() {
            bod.unhighlight();
            bod.highlight(table.search());
            bod.parent().style("color: black; border-color:black;");
        });
        bod.parent().style("color: black; border-color:black;");
    });
</script>
@endif
<script>
$(function() {

    // $('#UsersTable').DataTable({
    //   "scrollX": false,
    //   "autoWidth": true,
    //   "select": true,
    //   "keys": true,
    //   "responsive": true,
    //   // "buttons": [
    //   //     'copy', 'excel', 'pdf'
    //   // ],
    //   "columnDefs": [ {
    //     "targets": 5,
    //     "data": "UsSlug",
    //     "render": function ( data, type, row, meta ) {
    //       return "<a method='get' href='/permisos/" + data + "' class='btn btn-primary'>Ver</a>";
    //     }  
    //   }]
    // });
    var table = $('#UsersTable').DataTable({
        // "processing": true,
        "language": {
            "processing": "Hang on. Waiting for response..." //add a loading image,simply putting <img src="loader.gif" /> tag.
        },
        "scrollX": false,
        "autoWidth": true,
        "select": true,
        "keys": true,
        "responsive": true,
        // "buttons": [
        //     'copy', 'excel', 'pdf'
        // ],
        "columnDefs": [{
                "targets": 7,
                "data": "id",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='/permisos/" + data + "' class='btn btn-primary'>Ver</a>";
                }
            },
            {
                "targets": 8,
                "data": "id",
                "render": function(data, type, row, meta) {
                    return "<a href='/permisos/" + data + "/edit' class='btn btn-warning'>Edit</a>";
                }
            }
        ]
    });

    /*new $.fn.dataTable.Buttons( table, {
        buttons: [
            'copy', 'pdf'
        ]
    } );*/
    // $('#UsersTable').DataTable( {
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'copy', 'excel', 'pdf'
    //     ]
    // } );
    table.buttons().container()
        .appendTo($('.col-sm-6:eq(0)', table.table().container()));
});

</script>
<script>
$(function() {
    $('#DeclarTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 11,
            "data": "GSedeSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/declaraciones/" + data + "' class='btn btn-primary'>Ver</a>";
            }
        }]
    });
});

</script>
<script>
$(function() {
    $('#UserTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 7,
            "data": "UsSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/permisos/" + data + "' class='btn btn-primary'>Ver</a>";
            }
        }]
    });
});

</script>
@if(Route::currentRouteName()=='clientes.index')
    <script>
    $(document).ready(function() {

        /*var rol defino el rol del usuario*/
        var rol = "<?php echo Auth::user()->UsRol; ?>";

        /*var botoncito define los botones que se usaran si el usuario es programador*/
        var botoncito = (rol == 'Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];

        /*funcion para renderizar la tabla de cotizacion.index*/
        $('#clientesTable').DataTable({
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
                    targets: 4,
                    data: "CliSlug",
                    "render": function(data, type, row, meta) {
                        return "<a method='get' href='/clientes/" + data + "' class='btn btn-success btn-block' />Ver</a>";
                    }
                },
                {
                    targets: 5,
                    data: "CliSlug",
                    "render": function(data, type, row, meta) {
                        return "<a href='/clientes/" + data + "/edit' class='btn btn-warning btn-block'>Edit</a>";
                    }
                }
            ]
        });

        /*funcion para resaltar las busquedas*/
        var table = $('#cotizacionesTable').DataTable();

        table.on('draw', function redibujar() {
            var body = $(table.table().body());
            body.unhighlight();
            body.highlight(table.search());
        });
        // alert('ready');
        // function redibujar(){ 
        //  alert('redibujar');
        //  table.responsive.recalc(); 
        // }; 
        // document.setTimeout(redibujar, 10000); // 5 seconds 
        // inputEventOnly: true
    });
    $(window).load(function() {
        function show_popup() {
            $("#clientesTable").slideUp();
        };
        window.setTimeout(show_popup, 5000); // 5 seconds 
    })
    </script>
@endif
{{-- Mascaras del cliente --}}
<script>
    $(document).ready(function() {
        $('.nit').inputmask({mask:"[9][9][9.][9][9][9.][9][9][9-][9]"});
        $('.phone').inputmask({mask: "03[9 ][9][9][9][9][9][9][9]"});
        $('.mobile').inputmask({mask: "3[9][9 ][9][9][9 ][9][9][9][9]"});
        $('.extension').inputmask({mask: "[9][9][9][9][9]"});
        $('.document').inputmask({mask: "[9][9][9][9][9][9][9][9][9][9][9]"});
        $('.bank').inputmask({mask: "[9][9][9][9 ][9][9][9][9 ][9][9][9][9 ][9][9][9][9]"});
        $('.inputText').inputmask({mask: "[a{0,20}] [a{0,20}] [a{0,20}] [a{0,20}] [a{0,20}]"});
        $('.nombres').inputmask({mask: "[a{0,20}] [a{0,20}] [a{0,20}]"});
        $('.fechas').inputmask({ alias: "datetime", inputFormat: "yyyy-mm-dd"});
    });
    </script>
<script>
$(function() {
    $('.inputcheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});

</script>
<script>
$(function() {
    $('#inputcheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script type="text/javascript">
$(Selector.sidebar).slimScroll({
    height: ($(window).height() - $(Selector.mainHeader).height()) + 'px',
    color: 'rgba(0,0,0,0.2)',
    size: '3px'
})

</script>
{{-- bootstrap-switch --}}
<script>
$(".testswitch").bootstrapSwitch({
    animate: true,
    labelText: '<i class="fas fa-arrows-alt-h"></i>',
});

</script>
<script>
$(".fotoswitch").bootstrapSwitch({
    animate: true,
    labelText: '<i class="fas fa-camera"></i>',
    onText: '<i class="fas fa-check"></i>',
    offText: '<i class="fas fa-times"></i>',
});

</script>
<script>
$(".videoswitch").bootstrapSwitch({
    animate: true,
    labelText: '<i class="fas fa-video"></i>',
    onText: '<i class="fas fa-check"></i>',
    offText: '<i class="fas fa-times"></i>',
});

</script>
<script>
$(".AllowUncheck").bootstrapSwitch({
    animate: true,
    radioAllOff: true,
    labelText: '<i class="fas fa-eye"></i>',
    onText: '<i class="fas fa-check"></i>',
    offText: '<i class="fas fa-times"></i>',
});

</script>
<script>
$(".CalendarSwitch").bootstrapSwitch({
    animate: true,
    radioAllOff: true,
    labelText: '<i class="fas fa-calendar-alt"></i>',
    onText: '<i class="fas fa-check"></i>',
    offText: '<i class="fas fa-times"></i>',
});

</script>
<script>
$(".CheckMin").bootstrapSwitch({
    size: "mini",
    animate: true,
    radioAllOff: true,
    labelText: '<i class="fas fa-calendar-alt"></i>',
    onText: '<i class="fas fa-check"></i>',
    offText: '<i class="fas fa-times"></i>',
});

</script>
<!-- script para botones del listado de usuarios -->
{{-- <script type="text/javascript">
$('.radio1').on('switch-change', function() {
    $('.radio1').bootstrapSwitch('toggleRadioState');
});

</script>
--}}


{{-- funcion para renderizar la tabla antes de que se muestren los datos --}}
<script>
$(document).ready(function renderTable() {
    var a = document.querySelector("#loadingTable");
    var b = document.querySelector("#readyTable");
    // b.setAttribute("name", "helloButton");  
    // alert('page loaded');  // alert to confirm the page is loaded    
    a.setAttribute("hidden", "true");
    b.removeAttribute("hidden"); //enter the class or id of the particular html element which you wish to hide. 
});

</script>
{{-- renderizado datatable para tabla de auditorias --}}
{{-- <script>
$(document).ready(function() {
            $('#auditstable').DataTable({
                "scrollX": false,
                "autoWidth": true,
                "keys": true,
                "responsive": true,
                "columnDefs": [{
                    "targets": 5,
                    "data": "id",
                    "render": function(data, type, row, meta) {
                        return "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target=" + data + 'Modal>Ver</button>";}}
                        //   {"targets": 6,
                        //   "data": "CliSlug",
                        //   "render": function ( data, type, row, meta ) {
                        //     return "<a href='/clientes/" + data + "/edit' class='btn btn-warning'>Edit</a>";
                        //   }  
                        // }
                    ]
                });
            });

</script> --}}
<script>
$(document).ready(function() {
    $('#auditstable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true
        // "columnDefs": [ {
        //   "targets": 5,
        //   "data": "id",
        //   "render": function ( data, type, row, meta ) {
        //     return "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target="+ data +"Modal>Ver</button>";
        //   }
        // }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#AreaTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 2,
            "data": "ID_Area",
            "render": function(data, type, row, meta) {
                return "<a href='/areas/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#CargosTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 4,
            "data": "ID_Carg",
            "render": function(data, type, row, meta) {
                return "<a href='/cargos/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#departamentTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true
        // "columnDefs": [ {
        //   "targets": 5,
        //   "data": "id",
        //   "render": function ( data, type, row, meta ) {
        //     return "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target="+ data +"Modal>Ver</button>";
        //   }
        // }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#municipalityTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true
        // "columnDefs": [ {
        //   "targets": 5,
        //   "data": "id",
        //   "render": function ( data, type, row, meta ) {
        //     return "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target="+ data +"Modal>Ver</button>";
        //   }
        // }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#VehicleTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 7,
            "data": "VehicPlaca",
            "render": function(data, type, row, meta) {
                return "<a href='/vehicle/" + data + "/edit' class='btn btn-warning btn-block'>Edit</a>";
            }
        }]
    });
});

</script>
<script>
// $(document).ready(function() {
//   $('#activoindexTable').DataTable( {
$(document).ready(function() {
    $('#PersonalsTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true
    });
});
$(document).ready(function() {
    $('#PersonalsInternoTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
                "targets": 6,
                "data": "PersSlug",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='/personalInterno/" + data + "' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a>";
                }
            }
        ]
    });
});
</script>
<script>
$(document).ready(function() {
    $('#TrainingsTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 2,
            "data": "ID_Capa",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/capacitacion/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#TrainingPersonalsTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 5,
            "data": "ID_CapPers",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/capacitacion-personal/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#Vigilante').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
    });
});

</script>
<script>
$(document).ready(function() {
    $('#AssistancesTable1').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 5,
            "data": "ID_Asis",
            "render": function(data, type, row, meta) {
                return "<a href='/asistencia/" + data + "/edit' class='btn btn-warning'>Edit</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#InventarioTechTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 4,
            "data": "PersSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/inventariotech/" + data + "' class='btn btn-success'/>Ver</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#ActivoTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
                "targets": 8,
                "data": "PersSlug",
                "render": function(data, type, row, meta) {
                    return "<a method='get' href='#" + data + "' class='btn btn-success'/>Ver</a>";
                }
            },
            {
                "targets": 9,
                "data": "ID_Act",
                "render": function(data, type, row, meta) {
                    return "<a href='/activos/" + data + "/edit' class='btn btn-warning'>Edit</a>";
                }
            }
        ]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#SolicitudresiduoTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 8,
            "data": "SolResRespel",
            "render": function(data, type, row, meta) {
                return "<a href='solicitud-residuo/" + data + "' class='btn btn-block btn-success'>Ver</a>";
            }
        }, {
            "targets": 9,
            "data": "SolResSlug",
            "render": function(data, type, row, meta) {
                return "<a href='solicitud-residuo/" + data + "/edit' class='btn btn-block btn-warning'>Edit</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#SolicitudservicioTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 6,
            "data": "SolSerSlug",
            "render": function(data, type, row, meta) {
                return "<a href='/solicitud-servicio/" + data + "' class='btn btn-success'>Ver</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#ManifiestoTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 6,
            "data": "PersSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='#" + data + "' class='btn btn-success'/>Ver</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#CertificadoTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 7,
            "data": "PersSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='#" + data + "' class='btn btn-success'/>Ver</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#MovimientoActivoTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 6,
            "data": "ID_MovAct",
            "render": function(data, type, row, meta) {
                return "<a href='movimiento-activos/" + data + "/edit' class='btn btn-warning'>Edit</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#ArticuloXProveedor').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 5,
            "data": "ID_ArtiProve",
            "render": function(data, type, row, meta) {
                return "<a href='articulos-proveedor/" + data + "/edit' class='btn btn-warning'>Edit</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#QrCodesTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 4,
            "data": "PersSlug",
            "render": function(data, type, row, meta) {
                return "<a href='#" + data + "/edit' class='btn btn-warning'>Edit</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#HorarioTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 9,
            "data": "PersSlug",
            "render": function(data, type, row, meta) {
                return "<a href='#" + data + "/edit' class='btn btn-warning'>Edit</a>";
            }
        }]
    });
});

</script>
<script>
$(document).ready(function() {
    $('#RecursosTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        // "columnDefs": [ {
        //   "targets": 5,
        //   "data": "RecSrc",
        //   "render": function ( data, type, row, meta ) {
        //       return "<a href='" + data + "'  target='_blank' class='btn btn-block btn-success'>Ver</a>";}},
        "columnDefs": [{
                "targets": 2,
                "data": "SolResSlug",
                "render": function(data, type, row, meta) {
                    return "<a href='recurso/" + data + "' class='btn btn-block btn-success'>Ver</a>";
                }
            },
            {
                "targets": 3,
                "data": "SolResSlug",
                "render": function(data, type, row, meta) {
                    return "<a href='recurso/" + data + "/edit' class='btn btn-warning'>Edit</a>";
                }
            }
        ]
    });
});

</script>
<script>
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
@if(Route::currentRouteName() === 'sclientes.index')
<script>
var rol = "<?php echo Auth::user()->UsRol; ?>";

botoncito = (rol == 'Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];

$(document).ready(function() {
    $('#sedes').DataTable({
        responsive: true,
        select: true,
        dom: 'Bfrtip',
        buttons: [
            botoncito,
            {
                extend: 'collection',
                text: 'Selector',
                buttons: ['selectRows', 'selectCells']
            }
        ],
        colReorder: true,
        ordering: true,
        autoWith: true,
        searchHighlight: true,
        columnDefs: [
            {"targets": 5,
            "data": "SedeSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/sclientes/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
            }},
            {"targets": 4,
            "data": "SedeSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/sclientes/" + data + "' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a>";
            }},
        ]
    });
    /*funcion para resaltar las busquedas*/
    var table = $('#sedes').DataTable();

    table.on('draw', function() {
        var body = $(table.table().body());

        body.unhighlight();
        body.highlight(table.search());
    });
});
</script>
@endif
<script>
$(document).ready(function() {
    $('#MantVehicleTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true,
        "columnDefs": [{
            "targets": 6,
            "data": "ID_Mv",
            "render": function(data, type, row, meta) {
                return "<a href='/vehicle-mantenimiento/" + data + "/edit' class='btn btn-block btn-warning'>Editar</a>";
            }
        }]
    });
});

</script>
<script>
var rol = "<?php echo Auth::user()->UsRol ?>";
botoncito = (rol == 'Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];

$(document).ready(function() {
    $('#generadores').DataTable({
        // pagingType: 'scrolling',
        // scrollY: 300,
        responsive: true,
        // keys: true,
        select: true,
        dom: 'Bfrtip',
        buttons: [
            botoncito,
            {
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
            "targets": 6,
            "data": "GenerSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/generadores/" + data + "' class='btn btn-success btn-block'>Ver</a>";
            }
        }, {
            "targets": 7,
            "data": "GenerSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/generadores/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
            }
        }],
        fixedHeader: {
            header: true
        }
    });

    var table = $('#generadores').DataTable();

    table.on('draw', function() {
        var body = $(table.table().body());

        body.unhighlight();
        body.highlight(table.search());
    });
});

</script>
<script>
var rol = "<?php echo Auth::user()->UsRol; ?> ";
botoncito = (rol == 'Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];

$(document).ready(function() {
    $('#sgeneradores').DataTable({
        // pagingType: 'scrolling',
        // scrollY: 300,
        responsive: true,
        // keys: true,
        select: true,
        dom: 'Bfrtip',
        buttons: [
            botoncito,
            {
                extend: 'collection',
                text: 'Selector',
                buttons: ['selectRows', 'selectCells']
            }
        ],
        colReorder: true,
        ordering: true,
        autoWith: true,
        searchHighlight: true,
        "columnDefs": [{
            "targets": 8,
            "data": "GSedeSlug",
            "render": function(data, type, row, meta) {
                return "<a method='get' href='/sgeneradores/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
            }
        }],
        fixedHeader: {
            header: true
        }
    });

    var table = $('#sgeneradores').DataTable();

    table.on('draw', function() {
        var body = $(table.table().body());

        body.unhighlight();
        body.highlight(table.search());
    });
});

</script>
<script>
$(document).ready(function() {
    $('#selectconfiltro').select2({});
});
$(window).resize(function() {
    $('.select2').css('width', '100%');
});

</script>
{{-- script para evitar el envio multiple de formularios --}}
{{-- <script>
  $(':submit').click(function() {
        $(this).attr('disabled','disabled');
  });
</script> --}}
@if(
Route::currentRouteName()=='tarifas.index'
)
<script>
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
<script>
$(document).ready(function() {
    $('.SolResTable').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "keys": true,
        "responsive": true
    });
});

</script>

{{-- <script>
    $('#departamento').on('change', function() { 
        var id = $('#departamento').val();
        // var id = $(this).children("option:selected").val();
        // alert(id);
        $.ajax({
          url: "sclientes/"+id,
          type: "GET",
          dataType: "json",
          error: function(element){
            console.log(element);
          }, 
          success: function(response){
            $('#GSedemunicipio').html('<option value="" selected="true"> Seleccione una opción </option>');
            response.forEach(element => {
              $("#GSedemunicipio").append('<option value="'+element.ID_Mun +'"> ' + element.MunName + ' </option>')
            });
          }
        });

    });
</script> --}}
<script>
$(document).ready(function() {
    $('#Clasificacion').DataTable({
        "scrollX": false,
        "autoWidth": true,
        "responsive": true,
        "ordering":  false
    });
});
</script>
<script>
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
@if(Route::currentRouteName() === 'clientes.create' || Route::currentRouteName() === 'sclientes.create' ||  Route::currentRouteName() === 'sclientes.edit')
<script>
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
<script>
    $(document).ready(function(){    
        if({{old('SedeExt2')}} !== null){
            $('#sedeinputext2').prop('disabled', false);
        };
        
    });
</script>
<script>
    $(document).ready(function(){    
    if({{old('SedeExt1')}} !== null){
            $('#sedeinputext1').prop('disabled', false);
        };
    });
</script>
<script>
    $(document).ready(function(){  
        if($('#sedeinputphone1').val()){
            $('#sedeinputext1').prop('disabled', false);
        }
    });
</script>
<script>
    $(document).ready(function(){  
        if($('#sedeinputphone2').val()){
            $('#sedeinputext2').prop('disabled', false);
        }
    });
</script>
<script>
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

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>
@yield('NewScript')