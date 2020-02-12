<?php 
include "../Include/header.php";
include "../Include/sidebar.php";

$table = ($_SESSION['branch'] == "Baranggay"? "medicines_brgy": "medicines_hc");

$query = "
SELECT *, p.id AS presID FROM prescriptions AS p 
JOIN $table AS m 
ON m.id = p.medicine
JOIN patients AS pa
ON pa.id = p.patient
"; 

$result = mysqli_query($db_connect,$query);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Prescriptions </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Prescriptions</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <a href="addprescription.php" class="btn btn-primary"> 
              <i class="fa fa-plus"></i> Add Prescription 
            </a>
          </div>

          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>Patient</th>
                <th>Generic Name</th>
                <th>Brand</th>
                <th>Dosage</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($result)) { 
                  ?> 
                <tr>
                  <td> <?=$row["name"]?> </td>
                  <td> <?=$row["genericname"]?> </td>
                  <td> <?=$row["brand"]?></td>
                  <td> <?=$row["dosage"]?></td>
                  <td> <?=$row["qty"]?></td>
                  <td> <?=$row["date"]?></td>
                  <td>
                    <div class="btn-group-vertical">
                      <a class="btn btn-success btn-xs" href="editprescription.php?id=<?=$row["presID"]?>">
                        <i class="fa fa-edit"></i> Edit           
                      </a>
                      <a class="btn btn-danger btn-xs" href="delete.php?id=<?=$row["presID"]?>">
                        <i class="fa fa-trash-o"></i> Delete 
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
