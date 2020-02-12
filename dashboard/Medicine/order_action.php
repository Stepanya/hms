<?php
include "../inc/connect.php";
session_start();

if (isset($_GET['approve'])) {
	$db_connect->query("UPDATE orders SET status = 'Approved' WHERE id =".$_GET['id']);
	alert("Request Approved");
	redirect("orders.php");
} elseif (isset($_GET['deny'])) {
	$db_connect->query("UPDATE orders SET status = 'Denied' WHERE id =".$_GET['id']);
	alert("Request Denied");
	redirect("orders.php");
} elseif (isset($_GET['deny'])) {
	$db_connect->query("UPDATE orders SET status = 'Denied' WHERE id =".$_GET['id']);
	alert("Request Denied");
	redirect("orders.php");
} elseif (isset($_GET['withdraw'])) {
	$result = $db_connect->query("SELECT status FROM orders WHERE id =".$_GET['id'])->fetch_assoc();
	if ($result['status'] == "Deny") {
		alert("Order is already denied");
		redirect("orders.php");
	} elseif ($result['status'] == "Approved") {
		alert("Order is already approved");
		redirect("orders.php");
	} elseif ($result['status'] == "Shipped") {
		alert("Order is already shipped");
		redirect("orders.php");
	} else {
		$db_connect->query("DELETE FROM orders WHERE id =".$_GET['id']);
		alert("Order Withdrawn");
		redirect("orders.php");
	}
	
} elseif (isset($_GET['ship'])) {
	$db_connect->query("UPDATE orders SET status = 'Shipped' WHERE id =".$_GET['id']);
	alert("Order Shipped");
	redirect("shipping.php");
} elseif (isset($_GET['receive'])) {
	$branch = $_GET['branch'];
	$medID = $_GET['medID'];
	$tb_add = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy" : "medicines_hc");
	$tb_minus = ($_SESSION['branch'] == "Baranggay"? "medicines_hc" : "medicines_brgy");

	$from = $db_connect->query("SELECT * FROM $tb_minus WHERE id = $medID")->fetch_assoc();

	if ($from != NULL) { 
		$qty = $_GET['qty'];

		$db_connect->query("INSERT INTO $tb_add SELECT * FROM $tb_minus WHERE id = ".$_GET['medID']);
		$db_connect->query("UPDATE $tb_minus SET quantity = (quantity - $qty) WHERE id = $medID");
		$db_connect->query("UPDATE $tb_add SET quantity = $qty WHERE id = $medID");
	} else {
		$db_connect->query("UPDATE $tb_minus SET quantity = (quantity - $qty) WHERE id = $medID");
		$db_connect->query("UPDATE $tb_add SET quantity = $qty WHERE id = $medID");
	}

	$from = $db_connect->query("SELECT * FROM $tb_minus WHERE id = $medID")->fetch_assoc();

	if ($from['quantity'] == 0) {
		$db_connect->query("DELETE FROM $tb_minus WHERE id = $medID");
	}

	$db_connect->query("UPDATE orders SET status = 'Received' WHERE id =".$_GET['id']);
	alert("Order received and added to inventory");
	redirect("shipping.php");
} 


function redirect($loc) {
	echo "<script>window.location.href = '$loc'</script>";
}
function alert($msg) {
	echo "<script>alert('$msg')</script>";
}
?>