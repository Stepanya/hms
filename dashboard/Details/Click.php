 <?php include"../Include/header.php";?>
 <?php include"../Include/sidebar.php"; ?>
<?php
include("../inc/connect.php") ;

$sql="SELECT * FROM addappointment WHERE `app_date` = '".date('Y-m-d')."'";
//echo $sql;
$q=mysql_query($sql)or die (mysql_error($db_connect));
$q_row=mysql_fetch_all($q);
function mysql_fetch_all($query) 
{
  $temp='';
$all = array();
while ($all[] = mysql_fetch_assoc($query)) {
  $temp=$all;
}
return $temp;
}
//echo $sql;
//print_r($q_row); exit();
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Appointment Details
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Appointment Details</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class=""></i>
           <h3 class="box-title ">Appointment Details</h3>
           </div>
           <?php
     foreach ($q_row as $row)
      {
        $sql1=" SELECT name FROM patientregister WHERE id='".$row['patient']."'";
$write1 =mysql_query($sql1) or die(mysql_error($db_connect));
//print_r($sql); exit;
$row2=mysql_fetch_array($write1)or die (mysql_error($db_connect));

?>  <center><font size="5">
           
            <label>Patient Name:</label>
            <?php echo $row2['name'];?><br>
             <label>Appointment Date:</label>
             <?php echo $row['app_date'];?><br>
              <label>Start Time:</label>
               <?php echo $row['starttime'];?><br>
               <label>End Time:</label>
                <?php echo $row['endtime'];?><br>
               </font>
               
               <?php } ?>

<a href="../Index/index.php"><button type="submit" name="submit" class="btn btn-primary">Back</button></a><br><br>
       </center>
   </div>

</section>
</div>

<?php include "../Include/footer.php";?>
