<?php 
date_default_timezone_set('Asia/Manila');
session_start();

include "../inc/connect.php";
include "notifs.php";

if(!isset($_SESSION['email'])) {
  header("location:../../index.php");
}

$id = $_SESSION['id'];
$row = $db_connect->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HMS | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Pace -->
  <link rel="stylesheet" href="../plugins/pace/pace.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="../bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body class="hold-transition skin-black-light sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini">HMS</span>
        <span class="logo-lg"><b>BR</b>HU</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php if($_SESSION['user_type'] != "Admin" && $_SESSION['user_type'] != "Doctor") { ?>
              <?php if($_SESSION['user_type'] == "Baranggay") { ?>
                <li class="dropdown notifications-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning"><?=$n_count?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have <?=$n_count?> notifications</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <?php while($order = $orders->fetch_assoc()) {?>
                          <li>
                            <a href="order_action.php?id=<?=$order["orderID"]?>&branch=<?=$order['branch']?>&medID=<?=$order['medID']?>&qty=<?=$order['qty']?>&receive">
                              <i class="fa fa-truck text-green"></i> Your order: ID(<?=$order['orderID']?>) was shipped. Click this to mark it as received.
                            </a>
                          </li>
                        <?php }?>
                      </ul>
                    </li>
                    <li class="footer"><a href="../medicine/shipping.php">View all</a></li>
                  </ul>
                </li>
              <?php }?>
              <?php if($_SESSION['user_type'] == "Nurse") { ?>
                <li class="dropdown notifications-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-truck"></i>
                    <span class="label label-danger"><?=$r_count?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have <?=$r_count?> orders that were received</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <?php while($receive = $received->fetch_assoc()) {?>
                          <li>
                            <a href="#">
                              <i class="fa fa-truck text-green"></i> The order: ID(<?=$receive['orderID']?>) was received.
                            </a>
                          </li>
                        <?php }?>
                      </ul>
                    </li>
                  </ul>
                </li>
              <?php }?>
            <?php }?>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">
                  <?=$row['fname']?>&nbsp;
                  <?=$row['lname']?>
                </span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <!-- <img src="../../dashboard/Upload/Adminprofile/$row['profile']?>" class="img-circle" alt="User Image"> -->
                  <br><br>
                  <div>
                    <b>User Type: </b><?=$row['user_type']?>
                    <br>
                    <b>Email: </b><?=$row['email']?>
                  </div>    
                </li>

                <li class="user-footer">
                  <div class="pull-left">
                    <a href="../../dashboard/Admin/index.php" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="../../?logout" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

<style>
.notifications-menu>.dropdown-menu {
  width: auto!important;
}
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 220px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
.logo, .sidebar-toggle, .navbar, .nav, .dropdown-toggle {
  background-color: #333!important;
  color:#fff!important;
}
.sidebar-toggle {
  border-width: 0, 1px, 0, 1px!important;
}
.sidebar-toggle:hover, .dropdown-toggle:hover {
  background-color: #555!important;
}
.user-image {
  border: .8px solid white;
  /*width: 30px!important;*/
  /*height: 30px!important;*/
}
.img-circle {
  /*border: .5px solid #333;*/
}
body {
  font-family: "Trebuchet MS", Helvetica, sans-serif!important;
}
  </style>