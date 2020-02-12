

<footer class="main-footer">
  <div class="pull-right">
    <b>InfDev</b> 1.0
  </div>
  <strong>
    Copyright &copy; 2019 
    <a href="http://facebook.com/ThirdSalinga">RSBO</a>
  </strong> 
  All rights reserved.
</footer>

</div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- Pace -->
<script src="../plugins/pace/pace.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- fullCalendar -->
<script src="../bower_components/moment/moment.js"></script>
<script src="../bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
<!-- Page script -->
<script>
$(function () { 

  if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
  }

  $('.calendar').fullCalendar();

  $('.editor').wysihtml5({
    toolbar: {
    "font-styles": false, // Font styling, e.g. h1, h2, etc.
    "emphasis": false, // Italics, bold, etc.
    "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
    "html": false, // Button which allows you to edit the generated HTML.
    "link": false, // Button to insert a link.
    "image": false, // Button to insert an image.
    "color": false, // Button to change color of font
    "blockquote": false, // Blockquote
    "size": '<buttonsize>' // options are xs, sm, lg
  }
  })
  //Initialize Select2 Elements
  $('.select2').select2()

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })

  //Date picker
  $('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker').attr("autocomplete", "off"); 
  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false,
    showMeridian: false
  })
  $('.timepicker').val("")
  $('.popover1').popover({ trigger: "hover", html:true })

  $('#example1, .example1').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : true
  })
})
</script>
</body>
</html>
