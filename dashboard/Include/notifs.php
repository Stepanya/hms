<?php
include "../inc/connect.php";

$n_count = $db_connect->query("SELECT count(id) AS c FROM orders WHERE status = 'Shipped' AND branch = '{$_SESSION['branch']}'")->fetch_assoc();
$n_count = $n_count['c'];

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_hc" : "medicines_brgy");

$query = "
  SELECT *, c.category AS cat, o.id AS orderID, m.id AS medID FROM $table AS m 
  JOIN categories AS c 
  ON m.category = c.id 
  JOIN orders AS o
  ON o.medicine = m.id
  WHERE branch = '{$_SESSION['branch']}'
  AND status = 'Shipped'
"; 

$orders = mysqli_query($db_connect,$query);

$r_count = $db_connect->query("SELECT count(id) AS c FROM orders WHERE status = 'Received' AND branch = '{$_SESSION['branch']}'")->fetch_assoc();
$r_count = $r_count['c'];

$query = "
  SELECT *, c.category AS cat, o.id AS orderID, m.id AS medID FROM $table AS m 
  JOIN categories AS c 
  ON m.category = c.id 
  JOIN orders AS o
  ON o.medicine = m.id
  WHERE branch = '{$_SESSION['branch']}'
  AND status = 'Received'
"; 

$received = mysqli_query($db_connect,$query);
?>