<?php
session_start();
include "../inc/connect.php";

function format_date($date) {
	return date_format(date_create($date),"M d, Y");
}

$user = $_SESSION['name'];
$rows = $_POST['rows'];

$type = (isset($_POST['type']) ? $_POST['type'] : "");
$type = ($type != "" ? "AND user_type = '$type'" : "");

$query = "
SELECT 
	*
FROM 
	users
WHERE 
	id != ''
	$type
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
  <title>HMS | Users Report</title>
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
				<h3> Users Report </h3>
				Prepared By: <?=$user?>
			</div>
		</div>
		<hr>
		<table class="table table-bordered table-striped">
			<thead class="thead-dark">
				<th>User Type</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Branch</th>
			</thead>
			<tbody>
				<?php while($row = $result->fetch_assoc()) {?>
					<tr>
						<td> <?=$row['user_type']?> </td>
						<td> <?=$row['fname']?> </td>
						<td> <?=$row['lname']?> </td>
						<td> <?=$row['email']?> </td>
						<td> <?=$row['branch']?> </td>
					</tr>
				<?php }?>
			</tbody>
		</table>
		<a href="#" onclick="window.print()">Print</a>
	</div>
</body>
</html>