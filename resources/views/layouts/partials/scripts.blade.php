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
