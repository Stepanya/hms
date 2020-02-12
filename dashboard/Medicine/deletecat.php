<?php 
include("../inc/connect.php");
if(isset($_GET['id']))
      {
      	$sql="DELETE FROM categories WHERE  id=".$_GET['id']."";

      	$write =mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));
            
              header("location:medicinecategory.php");
      }
      else
      	echo "Not Sucess";
   ?>