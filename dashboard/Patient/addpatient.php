<?php
include"../Include/header.php";
include"../Include/sidebar.php";

if($_POST) { 

  $name=$_POST['name'];
  $address=$_POST['address'];
  $brgy=$_POST['brgy'];
  $phone=$_POST['phone'];
  $gender=$_POST['gender'];
  $birthdate=$_POST['birthdate'];
  $bloodgroup=$_POST['bloodgroup'];
  

  $result = mysqli_query($db_connect, "
    INSERT INTO 
    patients(name,address,brgy,phone,gender,birthdate,bloodgroup) 
    VALUES 
    ('$name','$address','$brgy','$phone','$gender','$birthdate','$bloodgroup')
    ");

  if($result){
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Patient  has been added",
          text: "Patient Added",
          icon: "success",
          button: "Ok",
        }).then(function() {
          window.location = "patientlist.php";
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
          text: "Error",
          icon: "error",
          button: "Ok",
        }).then(function() {
          window.location = "addpatient.php";
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
     Add New Patient
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Add New Patient</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Patient Personal Info</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="col-xs-6">
            <label>Full Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-3">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
              <option value="" disabled selected="selected">--Select Gender--</option>
              <option value="Male">Male</option> 
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-xs-3">
            <label>Blood Group</label>
            <select name="bloodgroup" class="form-control" required>
              <option value="" disabled selected="selected"> ---Select Blood Group---</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
            </select>
          </div>
          <div class="col-xs-3">
            <label>Birthdate</label>
            <input type="date" name="birthdate" class="form-control" required>
          </div>
          <div class="col-xs-3">
            <label>Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-8">
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter Address" required><br>
          </div>
          <div class="form-group col-xs-4">
            <label>Baranggay (Optional)</label>
            <select class="form-control" name="brgy">
              <option selected disabled>--Select Baranggay--</option>
              <option value="Conception">Conception</option>
              <option value="Evangelista">Evangelista</option>
              <option value="Mabini">Mabini</option>
              <option value="Pinugay">Pinugay</option>
              <option value="Rizal">Rizal</option>
              <option value="San Jose">San Jose</option>
              <option value="San Juan">San Juan</option>
              <option value="San Miguel">San Miguel</option>
              <option value="San Salvador">San Salvador</option>
              <option value="Santiago">Santiago</option>
            </select>
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
          <a href="./patient.php" class="btn btn-danger">
            <i class="fa fa-times"></i> Cancel
          </a>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<?php include "../Include/footer.php";?>

