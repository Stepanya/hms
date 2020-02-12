<?php
include"../Include/header.php";
include"../Include/sidebar.php";
include "../inc/connect.php";

$categories = $db_connect->query("SELECT * FROM categories");

if($_POST) { 

  $desc = $_POST["desc"];
  $category = $_POST["category"];

  $query = "
  INSERT INTO 
    categories (category, description)
  VALUES
    ('$category', '$desc')
  ";
  $result = mysqli_query($db_connect,$query);
  

  if($result){
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Category Added Successsfully",
          text: "Category Added",
          icon: "success",
          button: "Ok",
        }).then(function() {
          window.location = "medicinecategory.php";
        })
      }, 200);
    </script>
    <?php
  }else{
    ?>
    <script type="text/javascript">
      setTimeout(function() {
        swal({
          title: "Somthing went wrong",
          text: "Error",
          icon: "error",
          button: "Ok",
        }).then(function() {
          window.location = "medicinecategory.php";
        })
      }, 200);
    </script>
    <?php
  }
}

?>
<!-- sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- sweetalert -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>
     Add New Category
   </h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Add New Category</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Medicine Info</h2>
    </div>
    <form role="form" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group row">
          <div class="col-xs-12">
            <label>Category</label>
            <input type="text" class="form-control" name="category" placeholder="Enter category" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs-12">
            <label>Description</label>
            <textarea class="form-control" name="desc" placeholder="Enter description"></textarea>
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

