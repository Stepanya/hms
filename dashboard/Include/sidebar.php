<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img 
          src="../../dashboard/Upload/Adminprofile/BRHU.jpg" 
          class="img-circle" 
          alt="User Image"
        >
      </div>
      <div class="pull-left info">
        <p style="margin-left: -10px;">Municipal Health Center</p>
        <a href="#">
          <i class="fa fa-circle text-success"></i> 
          <?=$row['user_type']?>
        </a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href=".././Index/index.php">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bed"></i> <span>Patient</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="../Patient/patientlist.php">
              <i class="fa fa-user"></i> Patient List
            </a>
          </li>
          <?php if($_SESSION['user_type'] != "Doctor") { ?>
            <li>
              <a href="../Patient/addpatient.php">
                <i class="fa fa-plus"></i> Add New Patient
              </a>
            </li>
          <?php } ?>
        </ul>
      </li>
      <?php if($_SESSION['user_type'] != "Baranggay" && $_SESSION['user_type'] != "Doctor") { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i> <span>Appointment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="../Appointment/addappointment.php">
                <i class="fa fa-plus"></i> Add Appointment
              </a>
            </li>
            <li>
              <a href="../Appointment/allappointment.php">
                <i class="fa fa-list"></i> All Appointment
              </a>
            </li>
            <!-- <li>
              <a href="../Appointment/today.php">
                <i class="fa fa-laptop"></i> Today's Appointment
              </a>
            </li>
            <li>
              <a href="../Appointment/upcomming.php">
                <i class="fa fa-calendar-plus-o"></i> Upcomming Appointment
              </a>
            </li> -->
          </ul>
        </li>
      <?php }?>
      <?php if($_SESSION['user_type'] != "Doctor") { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Prescriptions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="../prescription/addprescription.php">
                <i class="fa fa-plus-circle"></i> Add Prescription
              </a>
            </li>
            <li>
              <a href="../Prescription/prescriptions.php">
                <i class="fa fa-edit"></i> Prescriptions
              </a>
            </li>
          </ul>
        </li>
      <?php }?>
      <?php if($_SESSION['user_type'] != "Doctor") { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-medkit"></i> <span>Medicine</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="../Medicine/addmedicine.php">
                <i class="fa fa-plus-circle"></i> Add Medicine
              </a>
            </li>
            <!-- <li>
              <a href="../Medicine/medicinecategory.php">
                <i class="fa fa-edit"></i>  Medicine Category
              </a>
            </li> -->
            <li>
              <a href="../Medicine/medicinelist.php">
                <i class="fa fa-medkit"></i>  Medicine List
              </a>
            </li>
            <?php if($_SESSION['user_type'] != "Admin" && $_SESSION['user_type'] != "Baranggay") { ?>
              <li>
                <a href="../Medicine/order.php">
                  <i class="fa fa-truck"></i> Order Medicine
                </a>
              </li>
              <li>
                <a href="../Medicine/ship.php">
                  <i class="fa fa-truck"></i> Ship Medicine
                </a>
              </li>
            <?php }?>
            <li>
              <a href="../Medicine/orders.php">
                <i class="fa fa-truck"></i>  Orders
              </a>
            </li>
            <?php if($_SESSION['user_type'] != "Baranggay" ) { ?>
              <li>
                <a href="../Medicine/shipping.php">
                  <i class="fa fa-truck"></i>  Shipping
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>
      <li>
        <a href="../Admin/index.php">
          <i class="fa fa-user"></i> <span>Profile</span>
        </a>
      </li>
      <?php if($_SESSION['user_type'] == "Admin" || $_SESSION['user_type'] == "Baranggay") { ?>
        <li>
          <a href="../Admin/users.php">
            <i class="fa fa-users"></i> <span>Users</span>
          </a>
        </li>
      <?php } ?>
      <?php if($_SESSION['user_type'] == "Nurse" || $_SESSION['user_type'] == "Doctor") { ?>
        <li>
          <a href="../Queue/queue.php">
            <i class="fa fa-list-ol"></i> <span>Queueing</span>
          </a>
        </li>
      <?php } ?>
      <li>
        <a href="../Reports/reports.php">
          <i class="fa fa-clipboard"></i> <span>Reports</span>
        </a>
      </li>
    </ul>
  </section>
</aside>