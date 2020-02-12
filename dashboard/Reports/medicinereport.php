<?php
session_start();
include "../inc/connect.php";

function format_date($date) {
	return date_format(date_create($date),"M d, Y");
}

$user = $_SESSION['name'];
$rows = $_POST['rows'];
$generic = (isset($_POST['generic']) ? $_POST['generic'] : "");
$brand = (isset($_POST['brand']) ? $_POST['brand'] : "");
$status = (isset($_POST['status']) ? $_POST['status'] : "");
$expiry = (isset($_POST['expiry']) ? $_POST['expiry'] : "");
$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");

$generic = ($generic != "" ? "AND generic = '$generic'" : "");
$brand = ($brand != "" ? "AND brand = '$brand'" : "");
$status = ($status != "" ? "AND status = '$status'" : "");
$expiry = ($expiry != "" ? "AND mfr_date = '$expiry'" : "");

$query = "
SELECT 
	*
FROM 
	$table AS m
WHERE 
	m.id != ''
	$generic
	$brand
	$status
	$expiry	
LIMIT 
	$rows
";

$result = $db_connect->query($query);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HMS | Medicine Report</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
</head>
<body>
	<div style="margin: 20px;">
		<div class="row">
			<div class="text-center">
				<div class="widget-user-image">
	        <img 
	        	class="img-circle"
	        	src="../Upload/Adminprofile/BRHU.jpg" 
	        	style="width: 100px; height: 100px">
	      </div>
	      <h4> Baras Rizal Health Unit </h4>
				<h3> Medicine Report </h3>
				Prepared By: <?=$user?>
			</div>
		</div>
		<hr>
		<table class="table table-bordered table-striped">
			<thead class="thead-dark">
				<th>Generic Name</th>
				<th>Brand</th>
				<th>Price</th>
				<th>Qty</th>
				<th>Expiry</th>
				<th>mfr. Date</th>
			</thead>
			<tbody>
				<?php while($row = $result->fetch_assoc()) {?>
					<tr>
						<td> <?=$row['genericname']?> </td>
						<td> <?=$row['brand']?> </td>
						<td> <?=$row['price']?> </td>
						<td> <?=$row['quantity']?> </td>
						<td> <?=format_date($row['mfr_date'])?> </td>
						<td> <?=format_date($row['expiry'])?> </td>
					</tr>
				<?php }?>
			</tbody>
		</table>
		<a href="#" onclick="window.print()">Print</a>
	</div>
</body>
</html>