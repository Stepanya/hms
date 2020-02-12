<?php
session_start();
include "../inc/connect.php";

function format_date($date) {
	return date_format(date_create($date),"M d, Y @ h:i A");
}

$user = $_SESSION['name'];
$rows = $_POST['rows'];
$patient = (isset($_POST['patient']) ? $_POST['patient'] : "");
$date = (isset($_POST['date']) ? $_POST['date'] : "");
$time = (isset($_POST['time']) ? $_POST['time'] : "");
$temp = (isset($_POST['temp']) ? $_POST['temp'] : "");
$pr = (isset($_POST['pr']) ? $_POST['pr'] : "");
$rr = (isset($_POST['rr']) ? $_POST['rr'] : "");
$bp = (isset($_POST['bp']) ? $_POST['bp'] : "");

$patient = ($patient != "" ? "AND patient = '$patient'" : "");
$date = ($date != "" ? "AND date = '$date'" : "");
$time = ($time != "" ? "AND time = '$time'" : "");
$temp = ($temp != "" ? "AND temp = '$temp'" : "");
$pr = ($pr != "" ? "AND pr = '$pr'" : "");
$rr = ($rr != "" ? "AND rr = '$rr'" : "");
$bp = ($bp != "" ? "AND bp = '$bp'" : "");

$doctor = ($_SESSION['user_type'] == "Doctor" ? "AND doctor = '{$_SESSION['id']}'" : "");
$query = "
SELECT 
	*
FROM 
	appointments AS a
JOIN 
	patients AS p
ON 
	a.patient = p.id
JOIN 
	users AS u 
ON 
	a.doctor = u.id
WHERE 
	a.id != ''
	$patient	
	$date
	$time
	$temp
	$pr
	$rr
	$bp	
	$doctor
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
  <title>HMS | Appointment Report</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
</head>
<body onload="">
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
				<h3> Appointment Report </h3>
				Prepared By: <?=$user?>
			</div>
		</div>
		<hr>
		<table class="table table-sm table-bordered table-striped text-center small">
			<thead class="thead-dark">
				<th>Patient</th>
				<th>Doctor</th>
				<th>Date & Time</th>
				<th>Temperature</th>
				<th>Pulse Rate</th>
				<th>Respiratory Rate</th>
				<th>Blood Pressure</th>
				<th>Complaints</th>
				<th>Treatment</th>
			</thead>
			<tbody>
				<?php while($row = $result->fetch_assoc()) {?>
					<tr>
						<td> <?=$row['name']?> </td>
						<td> <?=$row['fname']?> <?=$row['lname']?></td>
						<td> <small><?=format_date($row['date']." ".$row['time'])?></small> </td>
						<td> <?=$row['temp']?> </td>
						<td> <?=$row['pr']?> </td>
						<td> <?=$row['rr']?> </td>
						<td> <?=$row['bp']?> </td>
						<td> <small><?=$row['complaints']?></small> </td>
						<td> <small><?=$row['treatment']?></small> </td>
					</tr>
				<?php }?>
			</tbody>
		</table>
		<a href="#" onclick="window.print()">Print</a>
	</div>
</body>
</html>