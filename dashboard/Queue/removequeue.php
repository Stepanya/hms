<html>
<head>
	<title>DELETE</title>
	<!-- sweetalert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- sweetalert -->
</head>
</html>
<?php 
session_start();
date_default_timezone_set('Asia/Manila');
include("../inc/connect.php");


if(isset($_GET['remove']))
{	
	$sql = "DELETE FROM queue WHERE id = {$_GET['id']}";
	$write =mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

	if($write){
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "Appointment removed from queue",
					text: "Queue",
					icon: "success",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
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
					text: "Error",
					icon: "error",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
				})
			}, 200);
		</script>
		<?php
	}
} elseif (isset($_GET['all'])) {
	$sql = "DELETE FROM queue";
	$write =mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

	if($write){
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "all appointments removed from queue",
					text: "Queue",
					icon: "success",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
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
					text: "Error",
					icon: "error",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
				})
			}, 200);
		</script>
		<?php
	}
} elseif (isset($_GET['next'])) { 
	$sql = "DELETE FROM queue WHERE id = {$_GET['id']}";
	$write =mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

	if($write){
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "Current appointment removed",
					text: "Queue",
					icon: "success",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
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
					text: "Error",
					icon: "error",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
				})
			}, 200);
		</script>
		<?php
	}
} else {
	$queue = $db_connect->query("SELECT * FROM queue WHERE status = 'Sent'");
	if ($queue->num_rows != 0) {
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "There is currently a patient with the doctor",
					text: "Error",
					icon: "error",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
				})
			}, 200);
		</script>
		<?php
		exit();
	}
	$sql = "UPDATE queue SET status = 'Sent' WHERE id = {$_GET['id']}";
	$write =mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

	if($write){
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "Patient sent to the doctor",
					text: "Queue",
					icon: "success",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
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
					text: "Error",
					icon: "error",
					button: "Ok",
				}).then(function() {
					window.location = "queue.php";
				})
			}, 200);
		</script>
		<?php
	}
}
?>