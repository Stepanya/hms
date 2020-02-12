<?php 
include "../Include/header.php";
include "../Include/sidebar.php";

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");
$patients = $db_connect->query("SELECT * FROM patients");
$generic = $db_connect->query("SELECT genericname FROM $table");
$brand = $db_connect->query("SELECT brand FROM $table");
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Reports </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Reports</li>
    </ol>
  </section>
  <section class="content">
    <?php if($_SESSION['user_type'] != "Baranggay") { ?>
      <!-- Appointments -->
      
      <div class="col">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            Appointments
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i> Show
              </button>
            </div>
          </div>
          <div class="box-body">
            <form method="post" action="appointmentreport.php" target="_blank">
              <div class="row">
                <?php if($_SESSION['user_type'] != "Doctor") { ?>
                  <div class="col-xs-3">
                    <label>Patient</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="patient">
                      <option value="" selected>--Select Patient--</option>
                      <?php while ($row = $patients->fetch_assoc()) { ?>
                        <option value="<?=$row['id']?>" ><?=$row['name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                <?php } ?>
                <div class="col-xs-3">
                  <label>Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="date">
                  </div>
                </div>
                <div class="col-xs-3">
                  <label>Time</label>
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="time">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <h4>Vital Signs</h4>
              <br>
              <div class="form-group row">
                <div class="col-xs-3">
                  <label>Temperature <small>(Celsius)</small></label>
                  <input type="number" class="form-control" name="temp">
                </div>
                 <div class="col-xs-2">
                  <label>Pulse Rate</label>
                  <input type="number" class="form-control" name="pr">
                </div>
                <div class="col-xs-2">
                  <label>Respiratory Rate</label>
                  <input type="number" class="form-control" name="rr">
                </div>
                <div class="col-xs-2">
                  <label>Blood Pressure</label>
                  <input type="number" class="form-control" name="bp">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>Rows to print</label>
                  <select name="rows" class="form-control" required>
                    <option value="" selected>--Select rows--</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                    <option value="1500">1500</option>
                    <option value="2000">2000</option>
                    <option value="2500">2500</option> 
                  </select>
                </div>
              </div>
              <?php if($_SESSION['user_type'] == "Doctor") { ?>
                  <input type="hidden" name="doctor" value="<?=$_SESSION['id']?>">
                <?php } ?>
              <div class="row">
                <div class="text-center">
                  <hr>
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-print"></i> Print
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Patients -->
      <?php if ($_SESSION['user_type'] != "Doctor") { ?>
        <div class="col">
          <div class="box box-primary box-solid collapsed-box">
            <div class="box-header with-border">
              Patients
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-plus"></i> Show
                </button>
              </div>
            </div>
            <div class="box-body">
              <form method="post" action="patientreport.php" target="_blank">
                <div class="row">
                  <div class="col-xs-3">
                    <label>Blood Group</label>
                    <select name="bloodgroup" class="form-control">
                      <option value="" selected="selected"> ---Select Blood Group---</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                  </div>
                  <div class="col-xs-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                      <option value="" selected>--Select Gender--</option>
                      <option value="Male">Male</option> 
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="col-xs-3">
                    <label>Rows to print</label>
                    <select name="rows" class="form-control" required>
                      <option value="" selected>--Select rows--</option>
                      <option value="10">10</option>
                      <option value="20">20</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                      <option value="500">500</option>
                      <option value="1000">1000</option>
                      <option value="1500">1500</option>
                      <option value="2000">2000</option>
                      <option value="2500">2500</option> 
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="text-center">
                    <hr>
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-print"></i> Print
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Medicines -->
        
        <div class="col">
          <div class="box box-primary box-solid collapsed-box">
            <div class="box-header with-border">
              Medicines
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-plus"></i> Show
                </button>
              </div>
            </div>
            <div class="box-body">
              <form method="post" action="medicinereport.php" target="_blank">
                <div class="row">
                  <?php if($_SESSION['user_type'] != "Admin") { ?>
                    <div class="col-xs-3">
                      <label>Generic Name</label>
                      <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="generic">
                        <option value="" selected>--Select Generic Name--</option>
                        <?php while ($row = $generic->fetch_assoc()) { ?>
                          <option value="<?=$row['genericname']?>" ><?=$row['genericname']?></option>
                        <?php } ?>

                      </select>
                    </div>
                    <div class="col-xs-3">
                      <label>Brand</label>
                       <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="brand">
                        <option value="" selected>--Select Brand--</option>
                        <?php while ($row = $brand->fetch_assoc()) { ?>
                          <option value="<?=$row['brand']?>" ><?=$row['brand']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  <?php } ?>
                  <?php if ($_SESSION['user_type'] == "Admin") { ?>
                    <div class="col-xs-3">
                      <label>Branch</label>
                      <select name="branch" class="form-control">
                        <option value="" selected>--Select Branch--</option> 
                        <option value="Baranggay">Baranggay</option>
                        <option value="Health Center">Health Center</option>
                      </select>
                    </div>
                  <?php } ?>
                </div>
                <div class="row">
                  <div class="col-xs-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="" selected>--Select Status--</option>
                      <option value="In Stock">In Stock</option> 
                      <option value="Shipped">Shipped</option>
                      <option value="Ordered">Ordered</option>
                    </select>
                  </div>
                  <div class="col-xs-3">
                    <label>Mfr. Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control pull-right" name="expiry">
                    </div>
                  </div>
                  <div class="col-xs-3">
                    <label>Rows to print</label>
                    <select name="rows" class="form-control" required>
                      <option value="" selected>--Select rows--</option>
                      <option value="10">10</option>
                      <option value="20">20</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                      <option value="500">500</option>
                      <option value="1000">1000</option>
                      <option value="1500">1500</option>
                      <option value="2000">2000</option>
                      <option value="2500">2500</option> 
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="text-center">
                    <hr>
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-print"></i> Print
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>

      <!-- Users -->
      <?php if($_SESSION['user_type'] == "Admin") { ?>
      <div class="col">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            Users
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i> Show
              </button>
            </div>
          </div>
          <div class="box-body">
            <form method="post" action="usersreport.php" target="_blank">
              <div class="row">
                <div class="col-xs-3">
                  <label>User Type</label>
                  <select name="type" class="form-control">
                    <option value="" selected>--Select User Type--</option>
                    <option value="Admin">Admin</option> 
                    <option value="Baranggay">Baranggay</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Nurse">Nurse</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>Rows to print</label>
                  <select name="rows" class="form-control" required>
                    <option value="" selected>--Select rows--</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                    <option value="1500">1500</option>
                    <option value="2000">2000</option>
                    <option value="2500">2500</option> 
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="text-center">
                  <hr>
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-print"></i> Print
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
    <?php } ?>

    <!-- Medicine Deliveries -->
    
    <?php if($_SESSION['user_type'] == "Baranggay" || $_SESSION['user_type'] == "Admin") { ?>    
      <div class="col">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            Medicine Deliveries
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i> Show
              </button>
            </div>
          </div>
          <div class="box-body">
            <form method="post" action="deliveriesreport.php" target="_blank">
              <div class="row">
                <div class="col-xs-3">
                  <label>Generic Name</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="generic">
                    <option value="" selected>--Select Generic Name--</option>
                    <?php while ($row = $generic->fetch_assoc()) { ?>
                      <option value="<?=$row['genericname']?>" ><?=$row['genericname']?></option>
                    <?php } ?>

                  </select>
                </div>
                <div class="col-xs-3">
                  <label>Brand</label>
                   <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="brand">
                    <option value="" selected>--Select Brand--</option>
                    <?php while ($row = $brand->fetch_assoc()) { ?>
                      <option value="<?=$row['brand']?>" ><?=$row['brand']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>Rows to print</label>
                  <select name="rows" class="form-control" required>
                    <option value="" selected>--Select rows--</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                    <option value="1500">1500</option>
                    <option value="2000">2000</option>
                    <option value="2500">2500</option> 
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="text-center">
                  <hr>
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-print"></i> Print
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- Queueing  -->
    
    <?php if($_SESSION['user_type'] == "Admin") { ?>
      <div class="col">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            Queueing
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i> Show
              </button>
            </div>
          </div>
          <div class="box-body">
            <form method="post" action="queuereport.php" target="_blank">
              <div class="row">
                <div class="col-xs-3">
                  <label>Date</label>
                  <input type="date" class="form-control" name="date">
                </div>
                <div class="col-xs-3">
                  <label>Rows to print</label>
                  <select name="rows" class="form-control" required>
                    <option value="" selected>--Select rows--</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                    <option value="1500">1500</option>
                    <option value="2000">2000</option>
                    <option value="2500">2500</option> 
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="text-center">
                  <hr>
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-print"></i> Print
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  </section>
</div>
<?php include "../Include/footer.php";?>
