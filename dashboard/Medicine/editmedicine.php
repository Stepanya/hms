<?php
include"../Include/header.php";
include"../Include/sidebar.php";
$id = $_GET["id"];
$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");

if ($_POST) { 
  $brand = $_POST["brand"];
  $qty = $_POST["stock"];
  $gname = $_POST["genName"];
  $expiry = $_POST["expDate"];
  $mfr_date = $_POST["mfrDate"];

  $query = "UPDATE $table
  SET 
  brand = '$brand',
  quantity = '$qty',
  genericname = '$gname',
  mfr_date = '$mfr_date', 
  expiry = '$expiry'
  WHERE 
  id = $id";
  $result = mysqli_query($db_connect,$query);
  if($result){
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Medicine Edited Successfully",
          text: "Edit",
          icon: "success",
          button: "Ok",
        })
      }, 200);
    </script>
    <?php
  }else{
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Something went wrong",
          text: "Error",
          icon: "error",
          button: "Ok",
        })
      }, 200);
    </script>
    <?php
  }
}

$result;

if ($_GET) {
  $query = "SELECT * FROM $table WHERE id = ".$_GET["id"];
  $result = $db_connect->query($query)->fetch_assoc();
}
?>
<!-- sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- sweetalert -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
     Edit Medicine
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Medicine</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Medicine Info</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="col-xs-6">
            <label>Generic Name</label>
            <input type="text" class="form-control" name="genName" value="<?=$result['genericname']?>" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-6">
            <label>Brand</label>
            <input type="text" class="form-control" name="brand" value="<?=$result['brand']?>" required>
          </div>
          <div class="col-xs-3">
            <label>Manufacuring Date</label>
            <input type="date" class="form-control" name="mfrDate" value="<?=$result['mfr_date']?>" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-3">
            <label>Stock</label>
            <input type="number" class="form-control" name="stock" value="<?=$result['quantity']?>" required>
          </div>
          <div class="col-xs-3">
            <label>Expiry Date</label>
            <input type="date" class="form-control" name="expDate" value="<?=$result['expiry']?>" required>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="text-center">
          <button type="submit" name="Save" class="btn btn-success bg-green" >
            <i class="fa fa-file-text"></i> Save
          </button>
          <a href="./medicinelist.php" class="btn btn-danger">
            <i class="fa fa-times"></i> Cancel</button>
          </a>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<script type="text/javascript">
  $('.receive').click(function() {
    $.ajax({
      type: "POST",
      url: "receive.php",
      data: {id : <?=$id?>},
      success: function(response) {
        swal({
            title: "Order Received.",
            icon: "success",
            button: "Ok",
          }).then(function() {
            window.location = "medicinelist.php";
          })
      }
    })
  })
</script>
<?php include "../Include/footer.php";?>

