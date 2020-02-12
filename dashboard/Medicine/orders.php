<?php 
include "../Include/header.php";
include "../Include/sidebar.php";

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_hc" : "medicines_brgy");

$query = "
  SELECT *, c.category AS cat, o.id AS orderID FROM $table AS m 
  JOIN categories AS c 
  ON m.category = c.id 
  JOIN orders AS o
  ON o.medicine = m.id
  WHERE branch = '{$_SESSION['branch']}'
"; 

$orders = mysqli_query($db_connect,$query);

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy" : "medicines_hc");

$query = "
  SELECT *, c.category AS cat, o.id AS orderID FROM $table AS m 
  JOIN categories AS c 
  ON m.category = c.id 
  JOIN orders AS o
  ON o.medicine = m.id
  WHERE branch = '".($_SESSION['branch'] == "Baranggay"? "Health Center" : "Baranggay")."'
  AND status = 'Order Placed'
"; 
$requests = mysqli_query($db_connect,$query);

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Orders </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="box-header with-border">
              <h2 class="box-title">Orders</h2>
            </div>
          </div>

          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Generic Name</th>
                <th>Brand</th>
                <th>Expiry</th>
                <th>Qty Ordered</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($orders)) { 
                  ?> 
                <tr>
                  <td> <?=$row["id"]?></td>
                  <td> <?=$row["cat"]?></td>
                  <td> <?=$row["genericname"]?> </td>
                  <td> <?=$row["brand"]?></td>
                  <td> <?=$row["expiry"]?></td>
                  <td> <?=$row["qty"]?></td>
                  <td> <?=$row["date"]?></td>
                  <td> <?=$row["status"]?></td>
                  <td>
                    <div class="btn-group-vertical">
                      <a class="btn btn-danger btn-xs" href="order_action.php?id=<?=$row["orderID"]?>&withdraw"> 
                        <i class="fa fa-trash-o"></i> Withdraw
                      </a>
                    </div>
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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="box-header with-border">
              <h2 class="box-title">Order Requests</h2>
            </div>
          </div>

          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Generic Name</th>
                <th>Brand</th>
                <th>Expiry</th>
                <th>Qty Ordered</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($requests)) { 
                  ?> 
                <tr>
                  <td> <?=$row["id"]?></td>
                  <td> <?=$row["cat"]?></td>
                  <td> <?=$row["genericname"]?> </td>
                  <td> <?=$row["brand"]?></td>
                  <td> <?=$row["expiry"]?></td>
                  <td> <?=$row["qty"]?></td>
                  <td> <?=$row["date"]?></td>
                  <td> <?=$row["status"]?></td>
                  <td>
                    <div class="btn-group-vertical">
                      <a class="btn btn-success btn-xs" href="order_action.php?id=<?=$row["orderID"]?>&approve">
                        <i class="fa fa-check"></i> Approve           
                      </a>
                      <a class="btn btn-danger btn-xs" href="order_action.php?id=<?=$row["orderID"]?>&deny"> 
                        <i class="fa fa-times"></i> Deny 
                      </a>
                    </div>
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
