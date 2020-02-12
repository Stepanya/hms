<?php
include"../Include/header.php";
include"../Include/sidebar.php";

$id = $_SESSION['id'];

if ($_POST) {
  update($db_connect, $id);
}

$query = "SELECT * FROM users WHERE id = $id";
$result = $db_connect->query($query);
$userinfo = $result->fetch_assoc();

$fname = $userinfo['fname'];
$lname = $userinfo['lname'];
$user_type = $userinfo['user_type'];
$username = $userinfo['email'];
$profile = $userinfo['profile'];

function update($con, $id) {
  
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $user_type = $_POST['userType'];
  $password = $_POST['password'];
  $rpassword = $_POST['rpassword'];
  $username = $_POST['email'];
  // $profile = $_FILES['profile'];

  $profile_query = "";
  $psw_query = "";

  if ($password != $rpassword) {
    echo "<script>alert('Passwords do not match')</script>";
    return;
  }

  // if ($profile['error'] != 4) {
  //   $ext = ".".pathinfo($profile['name'], PATHINFO_EXTENSION);
  //   move_uploaded_file($profile['tmp_name'],"../Upload/Adminprofile/".$username.$ext);

  //   $profile_query = ", profile = '$username$ext' ";
  // }

  if ($password != "") {
    $psw_query = ", password = '".md5($password)."' ";
  }

  $query = "
  UPDATE users
  SET user_type = '$user_type',
      email = '$username',
      fname = '$fname',
      lname = '$lname'
      $profile_query
      $psw_query
  WHERE id = '$id'
  ";
  if ($con->query($query)) {
    echo "<script>alert('Profile successfully updated')</script>";
  } else {
    echo "<script>alert('Something went wrong try again later')</script>";
  }   
}

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
     <?="$fname $lname"?>'s Profile
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?="$fname $lname"?>'s Profile</li>
  </ol>
  </section>
<section class="content">
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <h3 class="profile-username text-center"><?="$fname $lname"?></h3>
        <p class="text-muted text-center"><?=$user_type?></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Email</b> <a class="pull-right"><?=$username?></a>
          </li>
        </ul>
      </div>
    </div>  
  </div>
  <div class="col-md-9">
    <div class="box">
      <div class="box-header with-border">
        <h2 class="box-title">Update <?="$fname $lname"?>'s Profile</h2>  
      </div>
      <form role="form" method="POST" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group row">
            <div class="col-xs-6">
              <label>First Name</label>
              <input type="text" class="form-control" name="fname" placeholder="Enter first name" required value="<?=$fname?>">
            </div>
            <div class="col-xs-6">
              <label>Last Name</label>
              <input type="text" class="form-control" name="lname" placeholder="Enter last name" required value="<?=$lname?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-xs-6">
              <label>Email address/Username</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email" required value="<?=$username?>">
            </div>
             <div class="col-xs-6">
              <label>Password</label>
              <input 
                type="password" 
                class="form-control" 
                name="password" 
                placeholder="Enter password" 
                pattern="[a-zA-Z0-9]{8,}" 
                title="Must contain at least 8 or more characters"
              >
            </div>
          </div>
          <div class="form-group row">
            <div class="col-xs-6">
              <label>User Type</label>
              <select name="userType" class="form-control" required>
                <option value="<?=$user_type?>" readonly selected><?=$user_type?></option>
                <option value="Admin">Admin</option> 
                <option value="Barangay">Barangay</option>
                <option value="Doctor">Doctor</option>
                <option value="Nurse">Nurse</option>
              </select>
            </div>
            <div class="col-xs-6">
              <label>Repeat Password</label>
              <input 
                type="password"
                class="form-control"
                name="rpassword"
                placeholder="Repeat password"
                pattern="[a-zA-Z0-9]{8,}" 
                title="Must contain at least 8 or more characters">
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
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
</div>
<?php include "../Include/footer.php";?>
