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
include("../inc/connect.php");

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");

if(isset($_GET['id']))
{
	$sql="DELETE FROM $table WHERE  id=".$_GET['id']."";
      	//exit;
	$write =mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

	if($write){
		?>
		<script type="text/javascript">
			setTimeout(function() {
				swal({
					title: "Medicine Deleted",
					text: "Delete",
					icon: "success",
					button: "Ok",
				}).then(function() {
					window.location = "medicinelist.php";
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
					window.location = "medicinelist.php";
				})
			}, 200);
		</script>
		<?php
	}
}
else
	echo "Not Sucess";
?>