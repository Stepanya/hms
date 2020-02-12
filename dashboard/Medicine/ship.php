<?php
include"../Include/header.php";
include"../Include/sidebar.php";
include "../inc/connect.php";

$table_order = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy" : "medicines_hc");

$meds_order = $db_connect->query("
  SELECT *, c.category AS cat, m.id AS medID FROM $table_order AS m JOIN categories AS c ON m.category = c.id
");

if(isset($_POST['order'])) { 

  $id= $_POST["id"];
  $qty = $_POST["qty"];
  $date = date("Y-m-d");
  $branch = 'Baranggay';
  $status = "Shipped";

  $result = $db_connect->query("SELECT * FROM $table_order WHERE quantity < $qty AND id = $id");

  if($result->num_rows == 0) {
    $query = "
      INSERT INTO 
      orders(medicine,qty,date,branch,status)
      VALUES
      ('$id','$qty','$date','$branch','$status')
    ";
    mysqli_query($db_connect,$query);
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Medicine Shipped Successsfully",
          icon: "success",
          button: "Ok",
        })
      }, 200);
    </script>
    <?php
  } else {
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "There are not enough medicine to order",
          icon: "error",
          button: "Ok",
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
     Ship Medicine
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Ship Medicine</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Ship Medicine</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="col-xs-10">
            <label>Medicine</label>
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="id" required>
              <option selected disabled>--Select Medicine--</option>
              <?php 
                while ($row = $meds_order->fetch_assoc()) {
                  $info = "{$row['genericname']} {$row['name']}({$row['brand']}) {$row['cat']} Stock - {$row['quantity']}";
              ?>
                <option value="<?=$row['medID']?>" ><?=$info?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-xs-2">
            <label>Quantity</label>
            <input type="number" class="form-control" name="qty" placeholder="Enter quantity" required>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="text-center">
          <button type="submit" name="order" class="btn btn-success bg-green" >
            <i class="fa fa-truck"></i> Ship
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

