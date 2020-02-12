<?php
include"../Include/header.php";
include"../Include/sidebar.php";

$id;
$row;
$active="";
$inactive="";

if($_POST) { 

  $id = $_GET['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $birthdate = $_POST['birthdate'];
  $bloodgroup = $_POST['bloodgroup'];
  $status = $_POST['status'];
  $brgy = $_POST['brgy'];
  $profile = $_FILES['profile_pic'];
  $profile_query = "";

  if ($profile['error'] != 4) {
    $ext = ".".pathinfo($profile['name'], PATHINFO_EXTENSION);
    move_uploaded_file($profile['tmp_name'],"../Upload/".$email.$ext);

    $profile_query = ", profile = '$email$ext' ";
  }
  $query = "
  UPDATE 
    patients 
  SET
    name = '$name', 
    email = '$email', 
    address = '$address',
    phone = '$phone',
    gender = '$gender',
    birthdate = '$birthdate',
    bloodgroup = '$bloodgroup',
    status = '$status',
    brgy = '$brgy'
    $profile_query
  WHERE 
    id = $id 
  ";

  $db_connect->query($query);    
  unset($_POST);
  echo " <script>alert('Record successfully updated')</script>";
}

if ($_GET) {
  $id = $_GET['id'];
  $query = "SELECT * FROM patients WHERE id = $id";
  $row = $db_connect->query($query)->fetch_assoc(); 
  
  if ($row['status'] == 1) 
    $active = "checked";
  else
    $inactive = "checked";
}
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>
   Edit <?=$row['name']?>'s Info
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit <?=$row['name']?>'s Info</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Patient's Personal Info</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="col-xs-6">
            <label>Full Name</label>
            <input 
              type="text"
              class="form-control"
              name="name"
              placeholder="Enter name"
              value="<?=$row['name']?>" 
            >
          </div>
          <div class="col-xs-6">
            <label>Email address</label>
            <input 
              type="email" 
              class="form-control" 
              name="email" 
              placeholder="Enter email"
              value="<?=$row['email']?>" 
            >
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-3">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
              <option 
                value="<?=$row['gender']?>"
                selected="selected"
              >
                <?=$row['gender']?>
              </option>
              <option value="Male">Male</option> 
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-xs-3">
            <label>Blood Group</label>
            <select name="bloodgroup" class="form-control" required>
              <option 
                value="<?=$row['bloodgroup']?>"
                selected="selected"
              >
                <?=$row['bloodgroup']?>
              </option>
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
            <input 
              type="date" 
              name="birthdate" 
              class="form-control" 
              required
              value="<?=$row['birthdate']?>" 
            >
          </div>
          <div class="col-xs-3">
            <label>Phone Number</label>
            <input
              type="text"
              name="phone" 
              class="form-control" 
              placeholder="Enter phone number" 
              required
              value="<?=$row['phone']?>"
            >
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-8">
            <label>Address</label>
            <input
              type="text" 
              name="address" 
              class="form-control" 
              placeholder="Enter Address" 
              required
              value="<?=$row['address']?>"
            ><br>
          </div>
          <div class="col-xs-4">
            <label>Status</label><br>
            <input type="radio" name="status" value="1" <?=$active?>>Active
            <input type="radio" name="status" value="0" <?=$inactive?>>Inactive
          </div>
        </div>
        <div class="form-group row">
          <div class="form-group col-xs-4">
            <label>Baranggay (Optional)</label>
            <select class="form-control" name="brgy">
              <option value="<?=$row['brgy']?>" selected><?=$row['brgy']?>
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
        <div class="form-group row">
          <div class="col-xs-4">
            <label>Profile Picture</label><br>
            <img 
              style="width: 200px; height: 200px;"
              src="../Upload/<?=$row['profile']?>"
              alt="Patient's Photo"
              class="img-thumbnail"
            >
            <input type="file" name="profile_pic">
            <p class="help-block">Only ".jpeg .png" are accepted.</p>
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
          <a href="patientlist.php" class="btn btn-danger">
            <i class="fa fa-times"></i> Cancel
          </a>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
<?php include "../Include/footer.php";?>

