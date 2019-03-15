<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ url (mix('/js/app.js')) }}"></script>

{{-- CDNS de FullCalendar --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script> --}}

{{-- Dependencias Package.json --}}
<script src="/js/dependencias.js"></script>

{{-- plugins de datatables --}}
<script src="/js/datatable-plugins.js"></script>

<!-- DataTables -->
<script src="/js/datatable-depen.js"></script>


{{-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> --}}


{{-- script para formulario en smart-wizzard --}}
<script type="text/javascript">
  $(document).ready(function(){
    $('#smartwizard').smartWizard({
      theme: 'arrows',
      keyNavigation:true
    });
  });
</script>


<!-- funcion para flitrado de tablas -->
<script>
  // "columnDefs": [ {
  //       "targets": 11,
  //       "data": "RespelName",
  //       "render": function ( data, type, row, meta ) {
  //         return "<a method='get' href='/images/" + data + "' class='btn btn-primary'>Editar</a>";
  //       }  
  //   });
  // $(document).ready(function(){

  // });
  $(document).ready(function () {
    $('#RespelTable').DataTable({
       "scrollX": false,
        "autoWidth": true,
        "keys": true,       
       "responsive": true,
        "columnDefs": [ {
        "targets": 9,
        "data": "CliSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='#" + data + "' class='btn btn-success'>Ver</a>";}},
        {"targets": 10,
        "data": "RespelSlug",
        "render": function ( data, type, row, meta ) {
          return "<a href='/respels/" + data + "/edit' class='btn btn-warning'>Edit</a>";}},      
        {"targets": 5,
        "data": "RespelHojaSeguridad",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/images/" + data + "' target='_blank' class='btn btn-primary'>Mirar</a>";}},
        {"targets": 6,
        "data": "RespelTarj",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/images/" + data + "' target='_blank' class='btn btn-primary'>Mirar</a>";}}
      ]
    });
  });
</script>
<script>
  $(function () {

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
      "columnDefs": [
       {"targets": 5,
        "data": "id",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/permisos/" + data + "' class='btn btn-primary'>Ver</a>";}},
        {"targets": 6,
        "data": "id",
        "render": function ( data, type, row, meta ) {
          return "<a href='/permisos/" + data + "/edit' class='btn btn-warning'>Edit</a>";}}
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
    .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
  });

</script> 
<script>
  $(function () {
    $('#DeclarTable').DataTable({
      "scrollX": false,
      "autoWidth": true,
      "keys": true,
      "responsive": true,
      "columnDefs": [ {
        "targets": 11,
        "data": "GSedeSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/declaraciones/" + data + "' class='btn btn-primary'>Ver</a>";
        }  
      }]
    });
  });
</script> 
<script>
  $(function () {
    $('#UserTable').DataTable({
      "scrollX": false,
      "autoWidth": true,
      "responsive": true,
      "columnDefs": [ {
        "targets": 7,
        "data": "UsSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/permisos/" + data + "' class='btn btn-primary'>Ver</a>";
        }  
      }]
    });
  });
</script> 
{{-- <script>
  // funcion para da formato a la tabla
  $(function () {
    $('#example4').DataTable({
      "scrollX": false,
      "autoWidth": true,
      "keys": true,
      "responsive": true,
      "processing":true,
      "columnDefs": [ {
        "targets": 8,
        "data": "GSedeSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/sgeneradores/" + data + "' class='btn btn-primary'>Ver</a>";
        }  
      }]
    });
  });
</script>  --}}
{{-- <script>
  $(function () {
    $('#example3').DataTable({
      "scrollX": false,
      "autoWidth": true,
      "keys": true,
      "responsive": true,
      "columnDefs": [ {
        "targets": 6,
        "data": "GenerSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/generadores/" + data + "' class='btn btn-success btn-block'>Ver</a>";
        }  
      },{
        "targets": 7,
        "data": "GenerSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/generadores/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
        }  
      }]
    });
  });
</script> --}}
{{-- <script>
  $(function () {
    $('#example2').DataTable({
      "select": true,
      dom: 'Bfrtip',
      buttons: [
          'copy', 'excel', 'pdf'
      ],
      // "autoFill": true,
      "scrollX": true,
      // "scrollCollapse": true,
      // "autoWidth": true,
      "responsive": {
        "breakpoints": [
          {name: 'bigdesktop', width: Infinity},
          {name: 'meddesktop', width: 1480},
          {name: 'smalldesktop', width: 1280},
          {name: 'medium', width: 1188},
          {name: 'tabletl', width: 1024},
          {name: 'btwtabllandp', width: 848},
          {name: 'tabletp', width: 768},
          {name: 'mobilel', width: 480},
          {name: 'mobilep', width: 320}
        ]
      },
      "keys": true,
      "colReorder": true,
      "columnDefs": [ {
        "targets": 10,
        "data": "SedeSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/sclientes/" + data + "' class='btn btn-primary'>Ver</a>";
        }  
      }]
      // "fixedColumns": true
    });
  }); 
</script> --}}


<script>
  // $(document).ready(function(){

  // });
  $(document).ready(function () {
    $('#example1').DataTable({
      // "processing": true,
      // "language": {
      //     "processing": "Hang on. Waiting for response..." //add a loading image,simply putting <img src="loader.gif" /> tag.
      // },
      "scrollX": false,
          "autoWidth": true,
               "keys": true,
      "responsive": true,
                 "columnDefs": [ {
        "targets": 4,
        "data": "CliSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/clientes/" + data + "' class='btn btn-success btn-block'/>Ver</a>";}},
        {"targets": 5,
        "data": "CliSlug",
        "render": function ( data, type, row, meta ) {
          return "<a href='/clientes/" + data + "/edit' class='btn btn-warning btn-block'>Edit</a>";
        }  
      }]

    });
  });
</script>
  
<script>
$(document).ready(function(){
    $('input[name="CliNit"]').mask('999.999.999.999-9');
    $('input[name="cliente"]').mask('999.999.999.999-9');
    $('input[name="SedePhone2"]').mask('(999)-999 9999');
    $('input[name="SedePhone1"]').mask('(999)-999 9999');
    $('input[name="SedeCelular"]').mask('(999)-999 9999');
    $('input[name="GenerNit"]').mask('999.999.999.999-9');
    $('input[name="GSedePhone2"]').mask('(999)-999 9999');
    $('input[name="GSedePhone1"]').mask('(999)-999 9999');
    $('input[name="GSedeCelular"]').mask('(999)-999 9999');
    $('input[name="GSedeinputext1"]').mask('999-9');
    $('input[name="GSedeinputext2"]').mask('999-9');
    $('input[name="CargSalary"]').mask('000.000.000.000');
});
</script>
{{-- funcion para recargar lista de generadores de cada cliente mediante ajax--}}
<script type="text/javascript">
 {{-- $("select[name='DeclarSede']").change(function (){
    var DeclarSede_id = $("select[name='DeclarSede']").val();
    if (DeclarSede_id !== '' && DeclarSede_id !== null) {
      $("select[name='DeclarGenerSede']").prop('disabled', false).find('option[value]').remove();
      $ajax({
        type: 'GET',
        url: {{ url("/declaraciones/create") }},
        data: { id:DeclarSede_id },
      }).done(function (data) {
        $.each(data, function(key, value){
          $("select[name='DeclarGenerSede']")
          .apend($("<option></option>")
          .attr("value",key)
          .text(value));
        });
      }).fail(function(jqXHR, textStatus){
        console.log(jqXHR);
      });
    } else {
      $("select[name='DeclarGenerSede']").prop('disabled', false).find('option[value]').remove();
    }
  });--}}
      $('select[name="DeclarSede"]').on('change', function(e){
        console.log(e);
        var ID_Sede = e.target.value;

        $.POST('/declaraciones' + ID_Sede, function(data) {
            console.log(data);
            $('select[name="DeclarGenerSede"]').empty();
            $.each(data, function(index,subCatObj){
                $('select[name="DeclarGenerSede"]').append(''+subCatObj.name+'');
            });
        });
    });
</script>

<!-- checkin imput -->
<script>
  $(function () {
    $('#inputcheck').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>
  $(function () {
    $('#inputcheck1').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>
  $(function () {
    $('#inputcheck2').iCheck({
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
      height: ($(window).height()-$(Selector.mainHeader).height()) + 'px',
      color : 'rgba(0,0,0,0.2)',
      size  : '3px'
    })
</script>
{{-- bootstrap-switch  --}}
<script >
  $(".testswitch").bootstrapSwitch({
    animate: true,
    labelText: '<i class="fas fa-arrows-alt-h"></i>',
  });
</script>

<script >
  $(".fotoswitch").bootstrapSwitch({
    animate: true,
    labelText: '<i class="fas fa-camera"></i>',
    onText: '<i class="fas fa-check"></i>', 
    offText: '<i class="fas fa-times"></i>',
  });
</script>

<script >
  $(".videoswitch").bootstrapSwitch({
    animate: true,
    labelText: '<i class="fas fa-video"></i>',
    onText: '<i class="fas fa-check"></i>', 
    offText: '<i class="fas fa-times"></i>',
  });
</script>


<script >
  $(".AllowUncheck").bootstrapSwitch({
    animate: true,
    radioAllOff: true,
    labelText: '<i class="fas fa-eye"></i>',
    onText: '<i class="fas fa-check"></i>', 
    offText: '<i class="fas fa-times"></i>',
  });
</script>

<!-- script para botones del listado de usuarios -->
{{-- <script type="text/javascript">
  $('.radio1').on('switch-change', function () {
      $('.radio1').bootstrapSwitch('toggleRadioState');
  });
</script>
 --}}

{{-- funcion para renderizar la tabla antes de que se muestren los datos --}}
<script>
  $(document).ready(function renderTable(){
      var a = document.querySelector("#loadingTable");
      var b = document.querySelector("#readyTable");
      var c = document.querySelector("#readyHead");
      var d = document.querySelector("div.box-body");
      // b.setAttribute("name", "helloButton");  
      // alert('page loaded');  // alert to confirm the page is loaded    
      a.setAttribute("hidden", "true");
      b.removeAttribute("hidden"); //enter the class or id of the particular html element which you wish to hide. 
      c.removeAttribute("hidden");
      d.removeAttribute("hidden");
  });
</script>
{{-- renderizado datatable para tabla de auditorias --}}
{{-- <script>
  $(document).ready(function () {
    $('#auditstable').DataTable({
      "scrollX": false,
      "autoWidth": true,
      "keys": true,       
      "responsive": true,
      "columnDefs": [ {
        "targets": 5,
        "data": "id",
        "render": function ( data, type, row, meta ) {
          return "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target="+ data +'Modal>Ver</button>";}}
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
    $('#auditstable').DataTable( {
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
  $(document).ready(function () {
    $('#AreaTable').DataTable({
      "scrollX": false,
      "autoWidth": true,
      "keys": true,
      "responsive": true,
      "columnDefs": [ {
          "targets": 2,
          "data": "ID_Area",
          "render": function ( data, type, row, meta ) {
          return "<a href='/areas/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";}      
          }]
    });
  });
</script>
<script>
  $(document).ready(function () {
    $('#CargosTable').DataTable({
      "scrollX": false,
      "autoWidth": true,
      "keys": true,
      "responsive": true,
      "columnDefs": [ {
          "targets": 4,
          "data": "ID_Carg",
          "render": function ( data, type, row, meta ) {
          return "<a href='/cargos/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";}      
          }]
    });
  });
</script>  
<script>
    $(document).ready(function() {
      $('#departamentTable').DataTable( {
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
        $('#municipalityTable').DataTable( {
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
        $('#VehicleTable').DataTable( {
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
          "targets": 7,
          "data": "VehicPlaca",
          "render": function ( data, type, row, meta ) {
          return "<a href='/vehicle/" + data + "/edit' class='btn btn-warning btn-block'>Edit</a>";}      
          }]
        });
      });
    </script>
    <script>
      // $(document).ready(function() {
      //   $('#activoindexTable').DataTable( {
      $(document).ready(function () {
        $('#PersonalsTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 5,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a method='get' href='/personal/" + data + "' class='btn btn-success btn-block'>Ver</a>";
              }},
            {"targets": 6,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a method='get' href='/personal/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $('#TrainingsTable').DataTable( {
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 2,
            "data": "ID_Capa",
            "render": function ( data, type, row, meta ) {
                return "<a method='get' href='/capacitacion/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
                }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $('#TrainingPersonalsTable').DataTable( {
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 5,
            "data": "ID_CapPers",
            "render": function ( data, type, row, meta ) {
                return "<a method='get' href='/capacitacion-personal/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
                }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#Vigilante').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#AssistancesTable1').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 5,
            "data": "ID_Asis",
            "render": function ( data, type, row, meta ) {
              return "<a href='/asistencia/" + data + "/edit' class='btn btn-warning'>Edit</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#InventarioTechTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 4,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a method='get' href='/inventariotech/" + data + "' class='btn btn-success'/>Ver</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#ActivoTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
          "targets": 8,
          "data": "PersSlug",
          "render": function ( data, type, row, meta ) {
              return "<a method='get' href='#" + data + "' class='btn btn-success'/>Ver</a>";}},
          {"targets": 9,
          "data": "ID_Act",
          "render": function ( data, type, row, meta ) {
            return "<a href='/activos/" + data + "/edit' class='btn btn-warning'>Edit</a>";}
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#SolicitudresiduoTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 4,
            "data": "SolResSolSer",
            "render": function ( data, type, row, meta ) {
                return "<a href='solicitud-residu/" + data + "' class='btn btn-block btn-success'>Ver</a>";}
            },{
            "targets": 5,
            "data": "SolResRespel",
            "render": function ( data, type, row, meta ) {
                return "<a href='solicitud-residu/" + data + "' class='btn btn-block btn-success'>Ver</a>";}
            },{
            "targets": 6,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a href='solicitud-residu/" + data + "/edit' class='btn btn-block btn-warning'>Edit</a>";}
            }
          ]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#SolicitudservicioTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 8,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
              return "<a href='#" + data + "/edit' class='btn btn-warning'>Edit</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#ManifiestoTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 6,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a method='get' href='#" + data + "' class='btn btn-success'/>Ver</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#CertificadoTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 7,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a method='get' href='#" + data + "' class='btn btn-success'/>Ver</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#MovimientoActivoTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 4,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a href='#" + data + "/edit' class='btn btn-warning'>Edit</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#ArticuloXProveedor').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 7,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a href='#" + data + "/edit' class='btn btn-warning'>Edit</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#QrCodesTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 4,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a href='#" + data + "/edit' class='btn btn-warning'>Edit</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#HorarioTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 9,
            "data": "PersSlug",
            "render": function ( data, type, row, meta ) {
                return "<a href='#" + data + "/edit' class='btn btn-warning'>Edit</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#RecursosTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 5,
            "data": "FK_RecSol",
            "render": function ( data, type, row, meta ) {
                return "<a href='/solicitud-residuo/" + data + "' class='btn btn-block btn-success'>Ver</a>";
              }
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#RequerimientosTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [{
            "targets": 5,
            "data": "FK_RecSol",
            "render": function ( data, type, row, meta ) {
                return "<a href='/#/" + data + "' class='btn btn-block btn-success'>Ver</a>";}},
          {"targets": 6,
            "data": "ReqSlug",
            "render": function ( data, type, row, meta ) {
                return "<a href='/requerimientos/" + data + "/edit' class='btn btn-warning'>Edit</a>";}
          }]
        });
      });
    </script>
   
<script>
    var rol = "<?php
            echo Auth::user()->UsRol;
          ?>";
      botoncito = (rol=='Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];
      if (rol=='Programador') {
        console.log(botoncito);
      };
    $(document).ready(function () {
      $('#example2').DataTable({
          responsive: true,
          select: true,
          dom: 'Bfrtip',
          buttons: [
              botoncito,
              {
              extend: 'collection',
              text: 'Selector',
              buttons: [ 'selectRows', 'selectCells' ]
              }
          ],
          colReorder: true,
          ordering: true,
          autoWith: true,
          searchHighlight: true,
          columnDefs:{
            targets: 10,
            data: 'SedeSlug',
            render: function ( data, type, row, meta ) {
              return "<a method='get' href='/sclientes/" + data + "' class='btn btn-primary'>Ver</a>";
            }  
          }
      });
      /*funcion para resaltar las busquedas*/
      var table = $('#example2').DataTable();
 
      table.on( 'draw', function () {
          var body = $( table.table().body() );
        
          body.unhighlight();
          body.highlight( table.search() );  
      });
  }); 
</script>

    <script>
      $(function() {
        $('#calendar').fullCalendar({
          themeSystem: 'bootstrap4'
        });
      });

    {{-- 
          themeSystem: 'bootstrap4',
          height:"auto",
           header: {
               left:   'prevYear,nextYear',
               center: 'title',
               right:  'today prev,next'
            },
            buttonText: {
                today : 'Hoy'
            },
            aspectRatio : 2,
            windowResize: function(view) {
              alert('The calendar has adjusted to a window resize');
            }
          /*dayClick: function() {
            alert('a day has been clicked!');
          }*/
        },'option' , 'contentHeight' , 650) --}}
    </script>


     <script>
      $(document).ready(function () {
        $('#MantVehicleTable').DataTable({
          "scrollX": false,
          "autoWidth": true,
          "keys": true,
          "responsive": true,
          "columnDefs": [ {
            "targets": 6,
            "data": "ID_Mv",
            "render": function ( data, type, row, meta ) {
                return "<a href='/vehicle-mantenimiento/" + data + "/edit' class='btn btn-block btn-warning'>Editar</a>";
              }
          }]
        });
      });
    </script>

    <script>
        var rol = "<?php
                echo Auth::user()->UsRol;
              ?>";
          botoncito = (rol=='Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];
          if (rol=='Programador') {
            console.log(botoncito);
          };
        $(document).ready(function () {
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
                  buttons: [ 'selectRows', 'selectCells' ]
                  }
                ],
              colReorder: true,
              ordering: true,
              autoWith: true,
              searchHighlight: true,
              columnDefs: [ {
                  "targets": 6,
                  "data": "GenerSlug",
                  "render": function ( data, type, row, meta ) {
                    return "<a method='get' href='/generadores/" + data + "' class='btn btn-success btn-block'>Ver</a>";
                  }  
                },{
                  "targets": 7,
                  "data": "GenerSlug",
                  "render": function ( data, type, row, meta ) {
                    return "<a method='get' href='/generadores/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
                  }  
              }],
              fixedHeader: {
                  header: true
              }
          });

          var table = $('#generadores').DataTable();
     
          table.on( 'draw', function () {
              var body = $( table.table().body() );
       
              body.unhighlight();
              body.highlight( table.search() );  
          });
      }); 
    </script>
    
    <script>
        var rol = "<?php
                echo Auth::user()->UsRol;
              ?>";
          botoncito = (rol=='Programador') ? ['colvis', 'copy', 'excel', 'pdf'] : ['colvis', 'copy'];
          if (rol=='Programador') {
            console.log(botoncito);
          };
        $(document).ready(function () {
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
                  buttons: [ 'selectRows', 'selectCells' ]
                  }
                ],
              colReorder: true,
              ordering: true,
              autoWith: true,
              searchHighlight: true,
              "columnDefs": [ {
                "targets": 8,
                "data": "GSedeSlug",
                "render": function ( data, type, row, meta ) {
                  return "<a method='get' href='/sgeneradores/" + data + "/edit' class='btn btn-warning btn-block'>Editar</a>";
                }  
              }],
              fixedHeader: {
                  header: true
              }
          });

          var table = $('#sgeneradores').DataTable();
     
          table.on( 'draw', function () {
              var body = $( table.table().body() );
       
              body.unhighlight();
              body.highlight( table.search() );  
          });
      }); 
    </script>
