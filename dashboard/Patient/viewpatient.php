<?php
include"../Include/header.php";
include"../Include/sidebar.php";

$row;

if ($_GET) {
  $id = $_GET['id'];
  $query = "SELECT * FROM patients WHERE id = $id";
  $row = $db_connect->query($query)->fetch_assoc(); 
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
     <?=$row['name']?>'s Record
   </h1>
   <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard"></i> Home
      </a>
    </li>
    <li class="active"><?=$row['name']?>'s Record</li>
  </ol>
  </section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Patient Personal Info</h2>
    </div>
    <div class="box-body">
      <div class="form-group row">
        <div class="col-xs-6">
          <label>Name</label>
          <input type="text" class="form-control" readonly value="<?=$row['name']?>">
        </div>
        <div class="col-xs-6">
          <label>Email</label>
          <input type="text" class="form-control" readonly value="<?=$row['email']?>">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xs-3">
          <label>Gender</label>
          <input type="text" class="form-control" readonly value="<?=$row['gender']?>">
        </div>
        <div class="col-xs-3">
          <label>Blood group</label>
          <input type="text" class="form-control" readonly value="<?=$row['bloodgroup']?>">
        </div>
        <div class="col-xs-3">
          <label>Birthdate</label>
          <input type="text" class="form-control" readonly value="<?=$row['birthdate']?>">
        </div>
        <div class="col-xs-3">
          <label>Phone Number</label>
          <input type="text" class="form-control" readonly value="<?=$row['phone']?>">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xs-9">
          <label>Address</label>
          <input type="text" class="form-control" readonly value="<?=$row['address']?>">
        </div>
        <div class="col-xs-3">
          <label>Status</label>
          <input 
          type="text"
          class="form-control"
          readonly 
          value="<?=($row['status'] == 1 ? 'Active' : 'Inactive')?>">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <label>Patient's Photo</label><br>
          <img 
          style="width: 200px; height: 200px;"
          src="../Upload/<?=$row['profile']?>"
          alt="Patient's Photo"
          class="img-thumbnail">
        </div>
      </div>
    </div>
    <div class="box-footer">
      <?php if ($_SESSION['user_type'] == 'Doctor') { ?>
        <a href="history.php?id=<?=$_GET['id']?>" class="btn btn-primary"><i class="fa fa-book"></i> View History</button></a>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<?php include "../Include/footer.php";?>

