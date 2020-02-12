<?php
include"../Include/header.php";
include"../Include/sidebar.php";
include "../inc/connect.php";

if($_POST) {
  $category = $_POST['category'];
  $desc = $_POST['desc'];

  $db_connect->query("UPDATE categories SET category = '$category', description = '$desc'");
  $_POST = "";
  echo "<script>alert('Changes have been saved.')</script>";
}

$result = $db_connect->query("SELECT * FROM categories WHERE id = ".$_GET['id'])->fetch_assoc();
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
     Edit Medicine Category
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Medicine Category</li>
  </ol>
  </section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Category Info</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="col-xs-6">
            <label>Category</label>
            <input type="text" class="form-control" name="category" placeholder="Enter category name" required value="<?=$result['category']?>">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-12">
            <label>Description</label>
            <textarea 
              rows="5" 
              class="form-control"
              name="desc"
              placeholder="Enter category description">
                <?=$result['description']?>
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
          <a href="./medicinelist.php" class="btn btn-danger">
            <i class="fa fa-times"></i> Cancel</button>
          </a>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<?php include "../Include/footer.php";?>

