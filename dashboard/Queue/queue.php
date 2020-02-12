<?php 
include "../Include/header.php";
include "../Include/sidebar.php";
include "../inc/connect.php";

$date_now = date('Y-m-d');

$cur = "None";
$cur_id = "None";

$current = $db_connect->query("
  SELECT *, q.id AS qID FROM queue AS q
  JOIN appointments AS a
  ON q.appointment = a.id
  JOIN patients AS p 
  ON p.id = a.patient
  JOIN users AS u
  ON a.doctor = u.id
  WHERE q.status = 'Sent'
  GROUP BY p.name
")->fetch_assoc();
if ($current) {
  $cur = $current['name'];
  $cur_id = $current['qID'];
}

$result = $db_connect->query("
  SELECT *, a.id AS ap_id FROM appointments AS a
  JOIN patients AS p 
  ON p.id = a.patient
  JOIN users AS u
  ON a.doctor = u.id
  WHERE date = '$date_now'
");

$queue = $db_connect->query("
  SELECT *, q.id AS qID FROM queue AS q
  JOIN appointments AS a
  ON q.appointment = a.id
  JOIN patients AS p 
  ON p.id = a.patient
  JOIN users AS u
  ON a.doctor = u.id
  WHERE q.date = '$date_now'
  AND q.status = 'Queued'
  GROUP BY p.name
");

$patients = array();

function formatdate($date) {
  $date = date_create($date);
  return date_format($date, "g:i A");
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Queueing </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Queueing</li>
    </ol>
  </section>
  <section class="content">
    <?php if($_SESSION['user_type'] != "Doctor") { ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h4>Today's Appointments</h4>
            </div>
            <div class="box-body">
              <table id="patients" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Number</th>
                    <th>Doctor</th>
                    <th>Patient</th>
                    <th>Time</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $c = 1; 
                    while ($row = $result->fetch_assoc()) { ?> 
                  <tr>
                    <td> <?=$c++?> </td>
                    <td> <?=$row['fname']?> <?=$row['lname']?> </td>
                    <td> <?=$row['name']?></td>
                    <td> <?=formatdate($row['time'])?> </td>
                    <td> <a href="addqueue.php?id=<?=$row['ap_id']?>" role="button" class="btn btn-success btn-sm add">Add to Queue</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h4>Queue</h4>
            <h3>Current Patient: <?=$cur?></h3>
            <?php if($_SESSION['user_type'] != "Doctor") { ?>
              <a href="removequeue.php?all" class="btn btn-danger btn-xs">Remove all from queue</a>
              <a href="removequeue.php?id=<?=$cur_id?>&next" class="btn btn-warning btn-xs">Remove current patient</a>
            <?php }?>
          </div>
          <div class="box-body">
            <table id="queue" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>Number</th>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Time</th>
                <?php if($_SESSION['user_type'] != "Doctor") { ?><th></th><?php }?>
              </tr>
              </thead>
              <tbody>
                <?php 
                  $c = 1; 
                  while ($row = $queue->fetch_assoc()) { ?> 
                  <tr>
                    <td> <?=$c++?> </td>
                    <td> <?=$row['fname']?> <?=$row['lname']?> </td>
                    <td> <?=$row['name']?></td>
                    <td> <?=formatdate($row['time'])?> </td>
                    <?php if($_SESSION['user_type'] != "Doctor") { ?>
                      <td> 
                        <div class="btn-group-vertical">
                          <a href="removequeue.php?id=<?=$row['qID']?>&remove" class="btn btn-danger btn-xs">Remove from Queue</a>
                          <a href="removequeue.php?id=<?=$row['qID']?>" class="btn btn-primary btn-xs">Send to Doctor</a>
                        </div>
                      </td>
                    <?php } ?>
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
<script type="text/javascript">
var patients = $('#patients').dataTable();
var queue = $('#queue').dataTable();
</script>

