<?php
include"../Include/header.php";
include"../Include/sidebar.php";


function update($con, $id) {
  
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $user_type = $_POST['userType'];
  $username = $_POST['email'];
  $brgy_query = (isset($_POST['brgy'])? ", brgy = '{$_POST['brgy']}'" : "");
  // $profile = $_FILES['profile'];

  $profile_query = "";
  $psw_query = "";

  // if ($profile['error'] != 4) {
  //   $ext = ".".pathinfo($profile['name'], PATHINFO_EXTENSION);
  //   move_uploaded_file($profile['tmp_name'],"../Upload/Adminprofile/".$username.$ext);

  //   $profile_query = ", profile = '$username$ext' ";
  // }

  $query = "
  UPDATE users
  SET user_type = '$user_type',
      email = '$username',
      fname = '$fname',
      lname = '$lname'
      $brgy_query
      $profile_query
  WHERE id = '$id'
  ";
  if ($con->query($query)) {
    echo "<script>alert('Profile successfully updated')</script>";
  } else {
    echo "<script>alert('Something went wrong try again later')</script>";
  }   
}

if ($_POST) {
  update($db_connect, $_GET['id']);
}
if ($_GET) {
  $id = $_GET['id'];
  $query = "SELECT * FROM users WHERE id = $id";
  $result = $db_connect->query($query)->fetch_assoc();
}

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Edit User
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit User</li>
  </ol>
  </section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title"><?=$result['fname']?>'s Personal Info</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="col-xs-6">
            <label>First Name</label>
            <input type="text" class="form-control" name="fname" placeholder="Enter first name" required value="<?=$result['fname']?>">
          </div>
          <div class="col-xs-6">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lname" placeholder="Enter last name" required value="<?=$result['lname']?>">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-6">
            <label>Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required value="<?=$result['email']?>">
          </div>
          <div class="col-xs-6">
            <label>User Type</label>
            <select name="userType" class="form-control" >
              <option value="<?=$result['user_type']?>" readonly selected><?=$result['user_type']?></option>
              <option value="Admin">Admin</option> 
              <option value="Barangay">Barangay</option>
              <option value="Doctor">Doctor</option>
              <option value="Nurse">Nurse</option>
            </select>
          </div>
        </div>
        <?php if ($result['user_type'] == "Baranggay") {?>
          <div class="form-group row">
            <div class="form-group col-xs-4">
              <label>Baranggay (Optional)</label>
              <select class="form-control" name="brgy">
                <option selected value="<?=$result['brgy']?>"><?=$result['brgy']?></option>
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
        <?php } ?>
      </div>
      <div class="box-footer">
        <div class="text-center">
          <button name="Save" class="btn btn-success bg-green" >
            <i class="fa fa-file-text"></i> Save
          </button>
          <button type="reset" class="btn btn-primary" value="reset">
            <i class="f fa fa-undo"></i> Reset
          </button>
          <a href="./users.php" class="btn btn-danger">
            <i class="fa fa-times"></i> Cancel</button>
          </a>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<?php include "../Include/footer.php";?>

