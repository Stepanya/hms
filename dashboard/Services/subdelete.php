<?php 
include("../inc/connect.php") ;
if(isset($_GET['id']))
      {
      	$sql="DELETE FROM subservices WHERE  service_id=".$_GET['id']."";
      	//exit;
      	$write =mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));
            
              header("location:services.php");
      }
      else
      	echo "Not Sucess";
   ?>