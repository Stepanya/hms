<?php
include "../inc/connect.php";

$db_connect->query("UPDATE medicines SET status = 'In Stock' WHERE id = ".$_POST['id']);

?>