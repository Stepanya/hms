<?php

include"../Include/header.php";
include"../Include/sidebar.php";

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");

$query = "
SELECT
  (SELECT count(*) FROM patients) AS patients,
  (SELECT count(*) FROM appointments) AS appointments,
  (SELECT count(*) FROM $table) AS medicines
";

$result = $db_connect->query($query)->fetch_assoc();
$patients = $result['patients'];
$appointments = $result['appointments'];
$medicines = $result['medicines'];
// $prescriptions = $result['prescriptions'];

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1> Dashboard </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="container">
      <div class="col-lg-2">
        <div class="row">
          <div class="col">
            <div class="small-box bg-aqua">
              <div class="inner">
               <h3><?=$patients?></h3>

               <p>Patients</p>
             </div>
              <div class="icon">
                <i class="fa fa-wheelchair"></i>
              </div>
              <a href="../Patient/patientlist.php" class="small-box-footer">More info 
                <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?=$appointments?></h3>

                <p>Appointments</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar-check-o"></i>
              </div>
              <a href="../Appointment/allappointment.php" class="small-box-footer">More info 
                <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner"> 
               <h3><?=$medicines?></h3>

               <p>Medicines</p>
             </div>
             <div class="icon">
              <i class="fa fa-medkit"></i>
              </div>
              <a href="../Medicine/medicinelist.php" class="small-box-footer">More info 
                <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col">
            <div class="small-box bg-red">
              <div class="inner">
               <h3>$prescriptions?></h3>

               <p>Prescriptions</p>
             </div>
             <div class="icon">
              <i class="fa fa-pencil-square-o"></i>
              </div>
              <a href="../Prescription/prescription.php" class="small-box-footer">More info 
                <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div> -->
      </div>
      <div class="col-lg-8">
        <div class="box box-primary">
          <div class="box-body no-padding" >
            <!-- THE CALENDAR -->
            <div class="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
<?php include"../Include/footer.php";?>