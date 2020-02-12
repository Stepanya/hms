<?php 
include "../Include/header.php";
include "../Include/sidebar.php";

$query = "SELECT * FROM users";
$result = $db_connect->query($query);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Users </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Users</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <?php if($_SESSION['user_type'] == "Admin" || $_SESSION['user_type'] == "Nurse") { ?>
            <div class="box-header with-border">
              <a href="adduser.php" class="btn btn-primary"> 
                <i class="fa fa-plus"></i> Add User 
              </a>
            </div>
          <?php } ?>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>User Type</th>
                <!-- <th>Profile Picture</th> -->
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                  while ($row = $result->fetch_assoc()) {
                ?> 
                <tr>
                  <td> <?=$row['user_type']?></td>
                  <!-- <td> //$row['profile']?> </td> -->
                  <td> <?=$row['fname']." ".$row['lname']?></td>
                  <td> <?=$row['email']?></td>
                  <td>
                    <a href="edituser.php?id=<?=$row['id']?>">
                      <span class="btn btn-success bg-green">
                        <i class="fa fa-edit"></i> Edit 
                      </span>
                    </a>
                    <a href="deleteuser.php?id=<?=$row['id']?>">
                      <span class="btn btn-danger">
                        <i class="fa fa-trash-o"></i> Delete 
                      </span>
                    </a>
                  </td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include "../Include/footer.php";?>
