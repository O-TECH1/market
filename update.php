<?php 
include 'inc/header.php';
if (!isset($_GET['productid'])) {
  header('location:dashboard.php');
}else{
session_start();
session_regenerate_id();
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  $_SESSION['msg'] = '';
}
if (isset($_SESSION['user_id'])) {

  include 'conf.php';
  $key = $_SESSION['user_id'];
  if (isset($_POST['updateprod'])) {
    $ids = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['id']))) ), FILTER_SANITIZE_STRIPPED);
    $pname = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['pname']))) ), FILTER_SANITIZE_STRIPPED);
    $pprice = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['price']))) ), FILTER_SANITIZE_STRIPPED);
    $pdesc = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['desc']))) ), FILTER_SANITIZE_STRIPPED);
    if (empty($pname) || empty($pprice) || empty($pdesc) || empty($ids)) {
      $msg = "<script>Swal.fire('All the feilds must be filled!','','error')</script>";
      $_SESSION['msg'] = $msg;
      header('location:myproduct.php');
    }else{
      $stmt = $con->prepare("UPDATE products SET name = ?,price = ?,description = ? WHERE id = ?");
      $stmt->bind_param('sssi',$pname,$pprice,$pdesc,$ids);
      if ($stmt->execute()) {
        $msg = "<script>Swal.fire('Product Updated Successfully!','','success')</script>";
        $_SESSION['msg'] = $msg;
        header('location:myproduct.php');
      }else{
        $msg = "<script>Swal.fire('An error occured while trying to update product!','','error')</script>";
        $_SESSION['msg'] = $msg;
        header('location:myproduct.php');
      }
    }
  }
  ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav navbar-nav menu">
      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">All Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add-product.php">Add Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myproduct.php">My Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reset-password.php">Reset Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-md-12">
      <h2><i class="glyphicon glyphicon-user"></i> Update Product </h2>
    </div>   
    <div class="col-md-12">
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products Update</li>
      </ol>
    </nav>
  </div>


  <br>
  
  <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
      <div class="col-md-10" style="min-width: 90%">

        <div class="card card-body" style="width: 90vw">
          <form method="post">
            <?php 
            $id = $_GET['productid'];
            $raw = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM products WHERE id = '$id'"));
             ?>
            <input type="text" class="form-control" value="<?=$raw['name']?>" name="pname" placeholder="Product Name ">
            <input type="text" class="form-control" value="<?=$raw['price']?>" name="price" placeholder="Price ">
            <input type="text" class="form-control" name="desc"  value="<?=$raw['description']?>" placeholder="Description">
            <input type="text"  value="<?=$raw['id']?>" name="id" hidden>
            <button class="btn btn-primary" name="updateprod">Update</button>
          </form>
        </div>
        <?php  



      }else{
        header('location:index.php');
      }
}
      ?>
    </div>
  </div>
</div>

<?php 
include 'inc/footer.php';
?>