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
  if (isset($_POST['reset'])) {

    $opass = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['opass']))) ), FILTER_SANITIZE_STRIPPED);
    $npass = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['npass']))) ), FILTER_SANITIZE_STRIPPED);
    if (empty($opass) || empty($npass)) {
      $msg = "<script>Swal.fire('All the feilds must be filled!','','error')</script>";
      $_SESSION['msg'] = $msg;
      header('location:reset-password.php');
    }else{
      $raw = mysqli_fetch_assoc(mysqli_query($con,"SELECT password FROM users WHERE id = '$key'"));
      if (password_verify($opass, $raw['password'])) {
        $newPassword = password_hash($npass, PASSWORD_DEFAULT);
        $stmt = $con->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param('si',$newPassword,$key);
        if ($stmt->execute()) {
          $msg = "<script>Swal.fire('Password Successfully Reset!','','success')</script>";
          $_SESSION['msg'] = $msg;
          header('location:reset-password.php');
        }else{
          $msg = "<script>Swal.fire('An error occured while trying to reset password!','','error')</script>";
          $_SESSION['msg'] = $msg;
          header('location:reset-password.php');
        }
      }else{
        $msg = "<script>Swal.fire('Old Password is not correct!','','error')</script>";
        $_SESSION['msg'] = $msg;
        header('location:reset-password.php');
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
        <a class="nav-link active" href="reset-password.php">Reset Password</a>
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
      <h2><i class="glyphicon glyphicon-user"></i> Password Reset </h2>
    </div>   
    <div class="col-md-12">
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Setting</a></li>
        <li class="breadcrumb-item active" aria-current="page">Password Reset</li>
      </ol>
    </nav>
  </div>


  <br>
  
  <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
      <div class="col-md-10" style="min-width: 90%">

        <div class="card card-body" style="width: 90vw">
          <form method="post">
            <input type="password" class="form-control" name="opass" placeholder="Old Password" required="">
            <input type="password" class="form-control" name="npass" placeholder="New Password" required="">
            <button class="btn btn-primary" name="reset">Reset</button>
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