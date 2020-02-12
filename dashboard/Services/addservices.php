<?php 
include "../Include/header.php";
include "../Include/sidebar.php";
include "../inc/connect.php";

$query = mysqli_query($db_connect, "SELECT * FROM mainservices") or die (mysqli_error());
$numrows = mysqli_num_rows($query)or die (mysqli_error());

if (isset($_POST['submit'])) {

  $id=$_POST['id'];
  $mainservicename=$_POST['mainservicename'];

  $write = mysqli_query($db_connect, "INSERT INTO mainservices(`mainservicename`) VALUES ('$mainservicename')") or die(mysqli_error($db_connect));

   // echo "<script>alert('Records Successfully Inserted..');</script>";
  echo " <script>setTimeout(\"location.href='../Services/addservices.php';\",150);</script>";
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Add Main Services </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add Main Services</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <a href="mainservices.php">
              <button type="submit" name="submit" class="btn btn-primary">Add Services</button>
            </a>
          </div>
          <div class="text-center">
            <a href="./exceladdscervice.php">
             <button type="button" class="btn btn-default">Excel</button>
            </a>
            <a href="csvaddservice.php">
              <button type="button" class="btn btn-default">CSV</button>
            </a>
            <a href="./PDF/addmainser_pdf.php">
              <button type="button" class="btn btn-default">PDF</button>
            </a>
            <button type="button" onclick="window.print();" class="btn btn-default">Print</button>
          </div>

          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>id</th>
                <th>Main Service Name</th>
                <th>Option</th>
              </tr>
              </thead>
              <tbody>
                <?php while ($row = $query->fetch_assoc()) { ?> 
                <tr>
                  <td><?=$row['id'];?></td>
                  <td><?=$row['mainservicename'];?></td>
                  <td>
                    <a href="editmainservices.php?id=<?=$row['id'];?>">
                      <span class="btn btn-success bg-green"><i class="fa fa-edit"></i> Edit </span>
                    </a>
                    <a href="delete.php?id=<?=$row['id'];?>">
                      <span class="btn btn-danger">
                        <i class="fa fa-trash-o"></i> Delete 
                      </span>
                    </a>
                  </td>
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
