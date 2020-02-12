<?php
include"../Include/header.php";
include"../Include/sidebar.php";
include "../inc/connect.php";

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");

if($_POST) { 

  $brand = $_POST["brand"];
  $qty = $_POST["stock"];
  $gname = $_POST["genName"];
  $expiry = $_POST["expDate"];
  $mfr_date = $_POST["mfrDate"];

  $query = "
  INSERT INTO 
  $table(brand,quantity,genericname,expiry, mfr_date)
  VALUES
  ('$brand','$qty','$gname','$expiry', '$mfr_date')
  ";
  $result = mysqli_query($db_connect,$query);

  if($result){
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Medicine Added Successsfully",
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
          title: "Somthing went wrong",
          icon: "error",
          button: "Ok",
        }).then(function() {
          window.location = "addmedicine.php";
        })
      }, 200);
    </script>
    <?php
  }
}

?>
<!-- sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- sweetalert -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>
     Add New Medicine
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Add New Medicine</li>
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
            <input type="text" class="form-control" name="genName" placeholder="Enter generic name" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-6">
            <label>Brand</label>
            <input type="text" class="form-control" name="brand" placeholder="Enter Brand" required>
          </div>
          <div class="col-xs-3">
            <label>Manufacuring Date</label>
            <input type="date" class="form-control" name="mfrDate" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-3">
            <label>Stock</label>
            <input type="number" class="form-control" name="stock" placeholder="Enter stock count" required>
          </div>
          <div class="col-xs-3">
            <label>Expiry Date</label>
            <input type="date" class="form-control" name="expDate" required>
          </div>
        </div>
      </div>
    <div class="box-footer">
      <div class="text-center">
        <button type="submit" name="Save" class="btn btn-success bg-green" >
          <i class="fa fa-file-text"></i> Save
        </button>
        <button type="reset" class="btn btn-primary" value="reset">
          <i class="f fa fa-undo"></i> Reset
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
<?php include "../Include/footer.php";?>

