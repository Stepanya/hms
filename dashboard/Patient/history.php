<?php 
include "../Include/header.php";
include "../Include/sidebar.php";
include "../inc/connect.php";

$id = $_GET['id'];

$patient = $db_connect->query("SELECT * FROM patients WHERE id = ".$id)->fetch_assoc();

$result = $db_connect->query("
  SELECT *, a.id AS ap_id FROM appointments AS a
  JOIN patients AS p 
  ON p.id = a.patient
  JOIN users AS u
  ON a.doctor = u.id
  WHERE p.id = $id
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
    <h1> <?=$patient['name']?>'s History </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?=$patient['name']?>'s History</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
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
                    <a class="btn btn-primary btn-sm" href="../appointment/viewappointment.php?id=<?=$row['ap_id']?>"><i class="fa fa-eye"></i> View </a>
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