<?php 
include 'inc/header.php';

session_start();
session_regenerate_id();
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  $_SESSION['msg'] = '';
}
if (isset($_SESSION['user_id'])) {

  include 'conf.php';
  $key = $_SESSION['user_id'];
  if (isset($_POST['addproduct'])) {
    $pname = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['pname']))) ), FILTER_SANITIZE_STRIPPED);
    $pprice = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['price']))) ), FILTER_SANITIZE_STRIPPED);
    $pdesc = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['desc']))) ), FILTER_SANITIZE_STRIPPED);
    if (empty($pname) || empty($pprice) || empty($pdesc)) {
      $msg = "<script>Swal.fire('All the feilds must be filled!','','error')</script>";
      $_SESSION['msg'] = $msg;
      header('location:add-product.php');
    }else{
      $stmt = $con->prepare("INSERT INTO products (name,price,description,owner) VALUES (?,?,?,?)");
      $stmt->bind_param('ssss',$pname,$pprice,$pdesc,$key);
      if ($stmt->execute()) {
        $msg = "<script>Swal.fire('Product Added Successfully!','','success')</script>";
        $_SESSION['msg'] = $msg;
        header('location:add-product.php');
      }else{
        $msg = "<script>Swal.fire('An error occured while trying to add product!','','error')</script>";
        $_SESSION['msg'] = $msg;
        header('location:add-product.php');
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
        <a class="nav-link active" href="add-product.php">Add Product</a>
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
      <h2><i class="glyphicon glyphicon-user"></i> Add Product </h2>
    </div>   
    <div class="col-md-12">
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
      </ol>
    </nav>
  </div>


  <br>
  
  <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
      <div class="col-md-10" style="min-width: 90%">

        <div class="card card-body" style="width: 90vw">
          <form method="post">
            <input type="text" class="form-control" name="pname" placeholder="Product Name ">
            <input type="number" class="form-control" name="price" placeholder="Price ">
            <input type="text" class="form-control" name="desc" placeholder="Description">
            <button class="btn btn-primary" name="addproduct">Add</button>
          </form>
        </div>
        <?php  



      }else{
        header('location:index.php');
      }

      ?>
    </div>
  </div>
</div>

<?php 
include 'inc/footer.php';
?>