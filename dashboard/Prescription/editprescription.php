<?php
include"../Include/header.php";
include"../Include/sidebar.php";
include "../inc/connect.php";

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");

$pres = $db_connect->query("
  SELECT *, m.id AS medID, pa.id AS paID FROM prescriptions AS p
  JOIN $table AS m
  ON p.medicine = m.id
  JOIN patients AS pa
  ON p.patient = pa.id
  JOIN categories AS c 
  ON m.category = c.id
  WHERE {$_GET['id']}
")->fetch_assoc();
$patients = $db_connect->query("SELECT * FROM patients");
$meds = $db_connect->query("
  SELECT *, c.category AS cat, m.id AS medID FROM $table AS m JOIN categories AS c ON m.category = c.id
");

if($_POST) { 

  $patient = $_POST["patient"];
  $med = $_POST["med"];
  $dosage = $_POST["dosage"];
  $qty = $_POST["qty"];
  $date = $_POST['date'];

  $query = "
  UPDATE prescriptions SET 
    patient = '$patient',
    medicine = '$med',
    dosage = '$dosage',
    qty = '$qty',
    date = '$date'
  ";
  $result = mysqli_query($db_connect,$query);

  if($result){
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Prescription Updated Successsfully",
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
     Edit Prescription
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Prescription</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Prescription Info</h2>
    </div>
    <form role="form" method="POST">
      <div class="box-body">
        <div class="form-group row">
          <div class="form-group col-xs-10">
            <label>Patient</label>
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="patient" required>
              <option selected value="<?=$pres['paID']?>"><?=$pres['name']?></option>
              <?php while ($row = $patients->fetch_assoc()) { ?>
                <option value="<?=$row['id']?>" ><?=$row['name']?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
         <div class="col-xs-10">
            <label>Medicine</label>
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="med" required>
              <option selected value="<?=$pres['medID']?>"><?="{$pres['genericname']} {$pres['name']}({$pres['brand']}) {$pres['category']} Stock - {$pres['quantity']}"?></option>
              <?php 
                while ($row = $meds->fetch_assoc()) {
                  $info = "{$row['genericname']} {$row['name']}({$row['brand']}) {$row['cat']} Stock - {$row['quantity']}";
              ?>
                <option value="<?=$row['medID']?>" ><?=$info?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-3">
            <label>Dosage (mg)</label>
            <input type="number" class="form-control" name="dosage" placeholder="Enter dosage" required value="<?=$pres['dosage']?>">
          </div>
          <div class="col-xs-3">
            <label>Quantity</label>
            <input type="number" class="form-control" name="qty" placeholder="Enter quantity" required value="<?=$pres['qty']?>">
          </div>
          <div class="col-xs-3">
            <label>Date</label>
            <input type="date" class="form-control" name="date" required value="<?=$pres['date']?>">
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

