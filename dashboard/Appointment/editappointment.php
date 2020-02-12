<?php
include"../Include/header.php";
include"../Include/sidebar.php";
include "../inc/connect.php";

$result;
$id = $_GET['id'];

if($_POST) { 
  $patient = $_POST['patient'];
  $doctor = $_POST['doctor'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $temp = $_POST['temp'];
  $pr = $_POST['pr'];
  $rr = $_POST['rr'];
  $bp = $_POST['bp'];
  $bp = $_POST['bp'];
  $complaints = $_POST['complaints'];
  $treatment = $_POST['treatment'];

  $db_connect->query("
    UPDATE appointments 
    SET
      patient = $patient,
      doctor = $doctor,
      date = '$date',
      time = '$time',
      temp = $temp,
      pr = $pr,
      rr = $rr,
      bp = $bp,
      complaints = '$complaints',
      treatment = '$treatment'
    WHERE
      id = $id
  ");

  $_POST = array();
  echo " <script>alert('Changes has been saved.')</script>";
}

$result = $db_connect->query("
  SELECT *, p.id AS p_id, u.id AS u_id FROM appointments AS a 
  JOIN patients AS p
  ON a.patient = p.id
  JOIN users AS u
  ON a.doctor = u.id
  WHERE a.id = $id
")->fetch_assoc();

$patients = $db_connect->query("SELECT * FROM patients");
$doctors = $db_connect->query("SELECT * FROM users WHERE user_type = 'Doctor'");

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
     <?=$result['name']?>'s Appointment
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Appointment</li>
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
          <div class="form-group col-xs-3">
            <label>Patient's Name</label>
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="patient" required>
              <option selected value="<?=$result['p_id']?>"><?=$result['name']?></option>
              <?php while ($row = $patients->fetch_assoc()) { ?>
                <option value="<?=$row['id']?>"><?=$row['name']?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-xs-3">
            <label>Doctor's Name</label>
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="doctor" required>
              <option selected value="<?=$result['u_id']?>"><?=$result['fname']?> <?=$result['lname']?></option>
              <?php while ($row = $doctors->fetch_assoc()) { ?>
                <option value="<?=$row['id']?>"><?=$row['fname']?> <?=$row['lname']?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-xs-3">
            <label>Date</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="date" value="<?=$result['date']?>">
            </div>
          </div>
          <div class="bootstrap-timepicker col-xs-3">
            <div class="form-group">
              <label>Time</label>
              <div class="input-group">
                <input type="text" class="form-control timepicker" name="time" autocomplete="off"value="<?=$result['time']?>">
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h4>Vital Signs</h4>
        <hr>
        <div class="form-group row">
          <div class="col-xs-3">
            <label>Temperature <small>(Celsius)</small></label>
            <input type="number" class="form-control" name="temp" step="0.01" value="<?=$result['temp']?>" required>
          </div>
           <div class="col-xs-2">
            <label>Pulse Rate</label>
            <input type="number" class="form-control" name="pr" step="0.01" value="<?=$result['pr']?>">
          </div>
          <div class="col-xs-2">
            <label>Respiratory Rate</label>
            <input type="number" class="form-control" name="rr" step="0.01" value="<?=$result['rr']?>">
          </div>
          <div class="col-xs-2">
            <label>Blood Pressure</label>
            <input type="number" class="form-control" name="bp" step="0.01" value="<?=$result['bp']?>" required>
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
              placeholder="Describe the patient's complaints here.">
              <?=$result['complaints']?>
            </textarea>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-lg-10">
            <h4>Treatment</h4>
            <textarea 
              class="editor form-control" 
              name="treatment" 
              rows="10" 
              placeholder="Describe the patient's treatment here.">
              <?=$result['treatment']?>
            </textarea>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="text-center">
          <button type="submit" name="Save" class="btn btn-success bg-green" >
            <i class="fa fa-file-text"></i> Save
          </button>
          <button type="reset" class="btn btn-primary" value="reset">
            <i class="f fa fa-undo"></i> Reset
          </button>
          <a href="allappointment.php" class="btn btn-danger">
            <i class="fa fa-times"></i> Cancel</button>
          </a>
        </div>
      </div>
    </form>
  </div>
</section>
</div>

<?php include "../Include/footer.php";?>

