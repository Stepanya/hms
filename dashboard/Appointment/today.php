<?php 
include "../Include/header.php";
include "../Include/sidebar.php";
include "../inc/connect.php";

$doctor = ($_SESSION['user_type'] == "Doctor"? "AND a.doctor = ".$_SESSION['id']:"");

$result = $db_connect->query("
  SELECT *, a.id AS ap_id FROM appointments AS a
  JOIN patients AS p 
  ON p.id = a.patient
  JOIN users AS u
  ON a.doctor = u.id
  WHERE date = CURDATE()
  $doctor
");

function trimmsg($msg) {
  if(strlen($msg) > 50) {
    return substr($msg, 0, 50)."...";
  }
  return $msg;
}

function formatdate($date) {
  $date = date_create($date);
  return date_format($date, "M j, Y @ g:i A");
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Today's Appointments </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Appoinments</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <a href="addappointment.php" class="btn btn-primary"> 
              <i class="fa fa-plus"></i> Add Appointment 
            </a>
          </div>

          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Date & Time</th>
                <th>Complaints</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?> 
                <tr>
                  <td> <?=$row['fname']?> <?=$row['lname']?> </td>
                  <td> <?=$row['name']?></td>
                  <td> <?=formatdate($row['date']." ".$row['time'])?> </td>
                  <td> 
                    <div class='popover1' data-toggle='popover' data-placement='left' data-content='<?=$row['complaints']?>'>
                      <?=trimmsg($row['complaints'])?>
                    </div>
                  </td>
                  <td>
                    <div class="btn-group-vertical">
                      <a 
                      class="btn btn-success btn-xs" 
                      href="editappointment.php?id=<?=$row['ap_id']?>">
                        <i class="fa fa-edit"></i> Edit           
                      </a>
                      <a 
                      class="btn btn-primary btn-xs" 
                      href="viewappointment.php?id=<?=$row['ap_id']?>">
                        <i class="fa fa-eye"></i> View           
                      </a>
                      <a 
                      class="btn btn-danger btn-xs" 
                      href="deleteappointment.php?id=<?=$row['ap_id']?>">
                        <i class="fa fa-trash-o"></i> Delete 
                      </a>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include "../Include/footer.php";?>