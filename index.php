<?php
session_start();
include("inc/connect.php") ;

if($_POST) {

	$username=$_POST['username'];
	$password=$_POST['password'];
	//$passwordenc=md5($_POST['password']);
	//echo$password; exit();
	if($username && $password) {
		
		$query=mysqli_query($db_connect, "SELECT * FROM users WHERE email = '$username'");
		$numrows=mysqli_num_rows($query);
		//echo $numrows;
		if ($numrows!=0) {

			$row=mysqli_fetch_assoc($query);
			$dbusername = $row['email'];
			$dbpassword = $row['password'];
			$dbtype = $row['user_type'];
			$name = "{$row['fname']} {$row['lname']}";
			
			if($username==$dbusername && md5($password)==$dbpassword) {
				//echo"You are in !. ";
				//$_SESSION['userid'] =$row['id'];
				$_SESSION['id'] = $row['id'];
				$_SESSION['email'] = $dbusername;
				$_SESSION['user_type'] = $dbtype;
				$_SESSION['branch'] = ($dbtype == "Baranggay"? $dbtype : "Health Center");
				$_SESSION['name'] = $name;
				$_SESSION['brgy'] = $row['brgy'];
				
				header("location:dashboard/Index/");
				exit();
			} else
				echo " <script>alert('Incorrect Password...');</script>";
		} else
			echo " <script>alert('That user does not exist!');</script>";
	} else 
		echo " <script>alert('Please enter a username and password...');</script>";

} elseif ($_GET && isset($_SESSION['email'])) {
	echo " <script>alert('Logged Out!')</script>";	
	session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>HMS | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<!-- <span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span> -->
					<div class="gradient">
						<img src="login/images/baras.png" class="login100-form-logo" style="background-color: transparent;">
					</div>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-10">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>