<?php 
include "../Include/header.php";
include "../Include/sidebar.php";

$brgy = ($_SESSION['brgy'] != ''? "WHERE brgy = '{$_SESSION['brgy']}'" : '');

$result = $db_connect->query("SELECT * FROM patients $brgy");

function format_date($date) {
  return date_format(date_create($date),"M d, Y");
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Patient list </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Patient list</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <table id="patients" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Birthdate</th>
                  <th>Baranggay</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $result->fetch_assoc()) {?> 
                <tr>
                  <td> <?=$row['name']?> </td>
                  <td> <?=$row['gender']?> </td>
                  <td> <?=format_date($row['birthdate'])?> </td>
                  <td> <?=$row['brgy']?> </td>
                  <td>
                    <div class="btn-group-vertical">
                      <a 
                      class="btn btn-success btn-xs" 
                      href="editpatient.php?id=<?=$row['id']?>"> 
                        <i class="fa fa-edit"></i> Edit           
                      </a>
                      <a 
                      class="btn btn-primary btn-xs" 
                      href="viewpatient.php?id=<?=$row['id']?>"> 
                        <i class="fa fa-eye"></i> View           
                      </a>
                      <!-- <a 
                      class="btn btn-danger btn-xs" 
                      href="deletepatient.php?id=$row['id']?>"> 
                        <i class="fa fa-trash-o"></i> Delete 
                      </a> -->
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Birthdate</th>
                  <th>Baranggay</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>


$(document).ready(function() {
  var table = $('#patients').DataTable();
  
  buildSelect( table );
  table.on( 'draw', function () {
    buildSelect( table );
  } );
} );

function buildSelect( table ) {
  table.columns().every( function () {

    var column = table.column( this, {search: 'applied'} );
    var select = $('<select><option value=""></option></select>')
    .appendTo( $(column.footer()).empty() )
    .on( 'change', function () {
      var val = $.fn.dataTable.util.escapeRegex(
        $(this).val()
      );

      column
      .search( val ? '^'+val+'$' : '', true, false )
      .draw();
    } );

    column.data().unique().sort().each( function ( d, j ) {
      select.append( '<option value="'+d+'">'+d+'</option>' );
    } );
    
    // The rebuild will clear the exisiting select, so it needs to be repopulated
    var currSearch = column.search();
    if ( currSearch ) {
      select.val( currSearch.substring(1, currSearch.length-1) );
    }
  } );
}
</script>
<?php include "../Include/footer.php";?>