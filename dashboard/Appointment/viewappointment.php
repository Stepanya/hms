<?php
include"../Include/header.php";
include"../Include/sidebar.php";
include "../inc/connect.php";

$result = "";

if ($_GET) {
  $id = $_GET['id'];
  $result = $db_connect->query("
    SELECT *, p.id AS pID FROM appointments AS a 
    JOIN patients AS p
    ON a.patient = p.id
    JOIN users AS u
    ON a.doctor = u.id
    WHERE a.id = $id
  ")->fetch_assoc();
}

function formatdate($date) {
  $date = date_create($date);
  return date_format($date, "M j, Y @ g:i A");
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
     <?=$result['name']?>'s Appointment
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">View Appointment</li>
  </ol>
  </section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Appointment Info</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="form-group col-xs-4">
            <label>Patient's Name</label>
            <p> <?=$result['name']?> </p>
          </div>
          <div class="form-group col-xs-4">
            <label>Doctor's Name</label>
            <p> <?=$result['fname']?> <?=$result['lname']?> </p>
          </div>
          <div class="form-group col-xs-4">
            <label>Date & Time</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" value="<?=formatdate($result['date']." ".$result['time'])?>" readonly>
            </div>
          </div>
        </div>
        <h4>Vital Signs</h4>
        <hr>
        <div class="form-group row">
          <div class="col-xs-3">
            <label>Temperature <small>(Celsius)</small>:</label>
            <input type="text" class="form-control" value="<?=$result['temp']?>"readonly>
          </div>
           <div class="col-xs-2">
            <label>Pulse Rate:</label>
            <input type="text" class="form-control" value="<?=$result['pr']?>"readonly>
          </div>
          <div class="col-xs-2">
            <label>Respiratory Rate:</label>
            <input type="text" class="form-control" value="<?=$result['rr']?>"readonly>
          </div>
          <div class="col-xs-2">
            <label>Blood Pressure:</label>
            <input type="text" class="form-control" value="<?=$result['bp']?>"readonly>
          </div>
        </div>
        <hr>
        <div class="form-group row">
          <div class="col-lg-10">
            <h4>Complaints</h4>
            <textarea 
              class="editor form-control" 
              name="complaints" 
              rows="10" 
              readonly>
              <?=$result['complaints']?>
            </textarea>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-lg-10">
            <h4>Treatment</h4>
            <textarea 
              class="editor form-control" 
              name="complaints" 
              rows="10" 
              readonly>
              <?=$result['treatment']?>
            </textarea>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="text-center">
          <a href="allappointment.php" class="btn btn-primary">
            <i class="fa fa-reply"></i> Return</button>
          </a>
          <?php if ($_SESSION['user_type'] == 'Doctor') { ?>
            <a href="../patient/history.php?id=<?=$result['pID']?>" class="btn btn-primary"><i class="fa fa-book"></i> View History</button></a>
          <?php } ?>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<?php include "../Include/footer.php";?>

