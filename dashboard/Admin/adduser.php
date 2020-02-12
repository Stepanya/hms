<?php
include"../Include/header.php";
include"../Include/sidebar.php";

if ($_POST) {
  add($db_connect, $id);
}


function add($con, $id) {

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $user_type = $_POST['userType'];
  $password = $_POST['password'];
  $rpassword = $_POST['rpassword'];
  $username = $_POST['email'];
  $brgy = $_POST['brgy'];
  $branch = ($user_type == "Baranggay"? $user_type : "Health Center");
  // $profile = $_FILES['profile'];
  if ($password != $rpassword) {
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Password Does not match!",
          text: "Password failed",
          icon: "error",
          button: "Retry",
        })
      }, 200);
    </script>
    <?php
  }
  $password = md5($password);
  
  // $ext = ".".pathinfo($profile['name'], PATHINFO_EXTENSION);
  // move_uploaded_file($profile['tmp_name'],"../Upload/Adminprofile/".$username.$ext);

  $query = "
  INSERT INTO users (user_type, branch, profile,fname,lname,email,password, brgy)
  VALUES('$user_type','$branch','$username','$fname','$lname','$username','$password', '$brgy')
  ";

  if ($con->query($query)) {
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Profile successfully added!",
          text: "User Added",
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
          title: "Something went wrong, please try again!",
          text: "Error",
          icon: "error",
          button: "Ok",
        })
      }, 200);
    </script>
    <?php
  }   
}

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
     Add New User
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Add New User</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">User's Personal Info</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="col-xs-6">
            <label>First Name</label>
            <input type="text" class="form-control" name="fname" placeholder="Enter first name" required>
          </div>
          <div class="col-xs-6">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lname" placeholder="Enter last name" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-6">
            <label>Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
          </div>
          <div class="col-xs-6">
            <label>Password</label>
            <input 
            type="password" 
            class="form-control" 
            name="password" 
            placeholder="Enter password" 
            required
            pattern="[a-zA-Z0-9]{8,}" 
            title="Must contain at least 8 or more characters"
            >
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-6">
            <label>User Type</label>
            <select name="userType" class="form-control userType" required>
              <option value="" disabled selected="selected">--Select user type--</option>
              <option value="Admin">Admin</option> 
              <option value="Baranggay">Baranggay</option>
              <option value="Doctor">Doctor</option>
              <option value="Nurse">Nurse</option>
            </select>
          </div>
          <div class="col-xs-6">
            <label>Repeat Password</label>
            <input type="password" class="form-control" name="rpassword" placeholder="Enter password" required>
          </div>
        </div>
        <div class="row form-group brgy">
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
        <!-- <div class="form-group row">
          <div class="col-xs-4">
            <label>Profile Picture</label>
            <img src="https://blogtimenow.com/wp-content/uploads/2014/06/hide-facebook-profile-picture-notification.jpg">
            <input type="file" name="profile" required>
            <p class="help-block">Only ".jpeg .png" are accepted.</p>
          </div>
        </div> -->
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
            <i class="fa fa-times"></i> Cancel</button>
          </a>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<script>
$('.brgy').hide()
var brgy = $('.brgy')

$('.userType').change(function() {
  var val = $(this).val()
  if (val == 'Baranggay') brgy.show()
  else brgy.hide()  
})
</script>
<?php include "../Include/footer.php";?>

