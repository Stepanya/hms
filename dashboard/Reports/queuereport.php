<?php
session_start();
include "../inc/connect.php";

function format_date($date) {
	return date_format(date_create($date),"M d, Y");
}
function format_time($time) {
	return date_format(date_create($time),"h:i A");
}

$user = $_SESSION['name'];
$rows = $_POST['rows'];

$date = (isset($_POST['date']) ? $_POST['date'] : "");
$date = ($date != "" ? "AND q.date = '$date'" : "");

$result = $db_connect->query("
  SELECT *, q.id AS qID, q.status AS stat FROM queue AS q
  JOIN appointments AS a
  ON q.appointment = a.id
  JOIN patients AS p 
  ON p.id = a.patient
  JOIN users AS u
  ON a.doctor = u.id
  WHERE 1
  $date
  GROUP BY p.name
  LIMIT $rows
");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HMS | Queue Report</title>
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
				<th>Date</th>
				<th>Time</th>
				<th>Patient</th>
				<th>Doctor</th>
				<th>Status</th>
			</thead>
			<tbody>
				<?php while($row = $result->fetch_assoc()) {?>
					<tr>
						<td> <?=format_date($row['date'])?> </td>
						<td> <?=format_time($row['time'])?> </td>
						<td> <?=$row['name']?> </td>
						<td> <?=$row['fname']?> <?=$row['lname']?></td>
						<td> <?=$row['stat']?> </td>
					</tr>
				<?php }?>
			</tbody>
		</table>
		<a href="#" onclick="window.print()">Print</a>
	</div>
</body>
</html>