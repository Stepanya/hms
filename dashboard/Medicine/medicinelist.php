<?php 
include "../Include/header.php";
include "../Include/sidebar.php";

$btn = "<button class='btn btn-primary change'>Change Branch</button>";
if (isset($_GET['branch'])) {
  $_SESSION['branch'] = $_GET['branch'];
}

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");

$query = "SELECT *, m.id AS medID FROM $table AS m";

$result = mysqli_query($db_connect,$query);

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Medicine List (<?=$_SESSION['branch']?>) <?=($_SESSION['user_type'] == "Admin"? $btn : "")?></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Medicine List</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <a href="addmedicine.php" class="btn btn-primary"> 
              <i class="fa fa-plus"></i> Add Medicine 
            </a>
          </div>

          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>Generic Name</th>
                <th>Brand</th>
                <th>Stock</th>
                <th>Mfr. Date</th>
                <th>Expiry</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($result)) { 
                  ?> 
                <tr>
                  <td> <?=$row["genericname"]?> </td>
                  <td> <?=$row["brand"]?></td>
                  <td> <?=$row["quantity"]?></td>
                  <td> <?=$row["mfr_date"]?></td>
                  <td> <?=$row["expiry"]?></td>
                  <td>
                    <div class="btn-group-vertical">
                      <a class="btn btn-success btn-xs" href="editmedicine.php?id=<?=$row["medID"]?>"> 
                        <i class="fa fa-edit"></i> Edit           
                      </a>
                      <a class="btn btn-danger btn-xs" href="delete.php?id=<?=$row["medID"]?>">
                        <i class="fa fa-trash-o"></i> Delete 
                      </a>
                    </div>
                  </td>
                </tr>
                <?php 
                }
                 ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  var branch = "<?=$_SESSION['branch']?>";
  var change = (branch == "Baranggay" ? "Health Center" : "Baranggay");

  $('.change').click(function() {
    window.location.replace("medicinelist.php?branch="+change);
  })

</script>
<?php include "../Include/footer.php";?>
