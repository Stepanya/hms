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


if(isset($_GET['id']))
{	
	$queue = $db_connect->query("SELECT * FROM queue WHERE appointment = {$_GET['id']} AND status = 'Queued'");
	if ($queue->num_rows != 0) {
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "This patient is already in queue",
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

	$queue = $db_connect->query("SELECT * FROM queue WHERE appointment = {$_GET['id']} AND status = 'Sent'");
	if ($queue->num_rows != 0) {
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "This patient is already with the doctor",
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

	$date = date('Y-m-d');
	$sql = "INSERT INTO queue (appointment, date, status) VALUES ({$_GET['id']}, '$date', 'Queued')";
	$write =mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

	if($write){
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "Appointment added to queue",
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
else
	echo "Not Sucess";
?>