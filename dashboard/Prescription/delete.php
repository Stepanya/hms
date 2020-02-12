<html>
<head>
	<title>DELETE</title>
	<!-- sweetalert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- sweetalert -->
</head>
</html>
<?php 
include("../inc/connect.php");

if(isset($_GET['id']))
{
	$sql="DELETE FROM prescriptions WHERE id=".$_GET['id']."";
	$write = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

	if($write){
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "Prescription Deleted",
					text: "Delete",
					icon: "success",
					button: "Ok",
				}).then(function() {
					window.location = "prescriptions.php";
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
					window.location = "prescriptions.php";
				})
			}, 200);
		</script>
		<?php
	}
}
else
	echo "Not Sucess";
?>