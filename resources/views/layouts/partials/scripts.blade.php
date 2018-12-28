<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
<!-- jQuery 3 -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
<!-- InputMask -->
{{-- <script src="js/inputmask/dist/jquery.inputmask.bundle.js"></script>
<script src="js/inputmask/dist/inputmask/jquery.inputmask.js"></script>
<script src="js/inputmask/dist/inputmask/jquery.inputmask.date.extensions.js"></script>
<script src="js/inputmask/dist/inputmask/jquery.inputmask.extensions.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<!-- DataTables -->
<script src="js/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="js/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- funcion para flitrado de tablas -->
<script>
  $(function () {
    $('#DeclarTable').DataTable({
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
    $('#example4').DataTable({
      "columnDefs": [ {
        "targets": 10,
        "data": "GSedeSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/sgeneradores/" + data + "' class='btn btn-primary'>Ver</a>";
        }  
      }]
    });
  });
</script> 
<script>
  $(function () {
    $('#example3').DataTable({
      "columnDefs": [ {
        "targets": 7,
        "data": "GenerSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/Generadores/" + data + "' class='btn btn-primary'>Ver</a>";
        }  
      }]
    });
  });
</script>
<script>
  $(function () {
    $('#example2').DataTable({
      "columnDefs": [ {
        "targets": 10,
        "data": "SedeSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/sclientes/" + data + "' class='btn btn-primary'>Ver</a>";
        }  
      }]
    });
  });
</script>
<script>
  $(function () {
    $('#example1').DataTable({
      "columnDefs": [ {
        "targets": 5,
        "data": "CliSlug",
        "render": function ( data, type, row, meta ) {
          return "<a method='get' href='/clientes/" + data + "' class='btn btn-primary'>Ver</a>";
        }  
      }]
    });
    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : false
    // })
    //<!-- checkin imput -->
    // $('input[name="CliAuditable"]').iCheck({
    //   checkboxClass: 'icheckbox_square-blue',
    //   radioClass: 'iradio_square-blue',
    //   increaseArea: '20%' // optional
    // });
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
    $('input').iCheck({
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



