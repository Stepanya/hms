<?php
include"../Include/header.php";
include"../Include/sidebar.php";
include "../inc/connect.php";

function trimmsg($msg) {
  if(strlen($msg) > 50) {
    return substr($msg, 0, 50)."...";
  }
  return $msg;
}

$result = $db_connect->query("SELECT * FROM categories");

?>
<div class="content-wrapper">
  <section class="content-header">
    <ol class="breadcrumb">
    <h1> Medicine Categories </h1>
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Medicine Categories</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <a href="addcategory.php" class="btn btn-primary"> 
              <i class="fa fa-plus"></i> Add Category 
            </a>
          </div>

          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
               <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?> 
                <tr>
                  <td> <?=$row['id']?></td>
                  <td> <?=$row['category']?></td>
                  <td>
                    <div class='popover1' data-toggle='popover' data-placement='left' data-content='<?=$row['description']?>'>
                      <?=trimmsg($row['description'])?>
                    </div>
                  </td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-success btn-sm" href="editcategory.php?id=<?=$row['id']?>"> <i class="fa fa-edit"></i> Edit           
                      </a>
                      <a class="btn btn-primary btn-sm" href="medicinelist.php?catid=<?=$row['id']?>"> <i class="fa fa-eye"></i> View Drugs 
                      </a>
                      <a class="btn btn-danger btn-sm" href="deletecat.php?id=<?=$row['id']?>"> <i class="fa fa-trash-o"></i> Delete 
                      </a>
                    </div>
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
