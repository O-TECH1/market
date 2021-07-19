<?php 
include 'inc/header.php';
?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="nav navbar-nav menu">
    <li class="nav-item">
      <a class="nav-link active" href="#.">All Products <span class="sr-only">(current)</span></a>
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
      <h2><i class="glyphicon glyphicon-user"></i> All Products </h2>
    </div>   
    <div class="col-md-12">
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
      </ol>
    </nav>
  </div>


  <br>

  <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
      <div class="col-md-10" style="min-width: 90%">
        <?php 
        session_start();
        session_regenerate_id();
        if (isset($_SESSION['user_id'])) {
          if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            $_SESSION['msg'] = '';
          }
          include 'conf.php';
          if (isset($_GET['delete'])) {
            $id = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_GET['delete']))) ), FILTER_SANITIZE_STRIPPED);
            $delQuery = mysqli_query($con,"DELETE FROM products WHERE id='$id'");
            if ($delQuery) {
              $msg = "<script>Swal.fire('Product Deleted Successfully!','','success')</script>";
              $_SESSION['msg'] = $msg;
              header('location:dashboard.php');
            }else{
              $msg = "<script>Swal.fire('Unable to delete product!','','success')</script>";
              $_SESSION['msg'] = $msg;
              header('location:dashboard.php');
            }
          }
          
          $pQuery = mysqli_query($con,"SELECT * FROM products");
          if (mysqli_num_rows($pQuery)>0) {
            $key = $_SESSION['user_id'];
            while ($product = mysqli_fetch_assoc($pQuery)) {
              if ($product['owner'] == $key) {

                ?>
                <div class="card card-body" style="width: 90vw">
                  <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0"> <img src="https://i.imgur.com/5Aqgz7o.jpg" width="150" height="150" alt=""> </div>
                    <div class="media-body">
                      <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true"><?=$product['name'] ?></a> </h6>
                      <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Phones</a></li>
                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Mobiles</a></li>
                      </ul>
                      <p class="mb-3"><?=$product['description'] ?></p>
                      <ul class="list-inline list-inline-dotted mb-0">
                        <li class="list-inline-item"><strong>Your product, <a href="update.php?productid=<?=$product['id'] ?>" data-abc="true">Edit</a></strong> </li>
                        <li class="list-inline-item"><strong> or <a href="?delete=<?=$product['id'] ?>" data-abc="true">Delete it</a></strong> </li>
                      </ul>
                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                      <h3 class="mb-0 font-weight-semibold">₦<?=$product['price'] ?></h3>
                      <div> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                      <div class="text-muted">1985 reviews</div> <button type="button" class="btn btn-warning mt-4 text-white"><i class="icon-cart-add mr-2"></i> Add to cart</button>
                    </div>
                  </div>
                </div>
                <?php  
              }else{

                ?>
                <div class="card card-body" style="width: 90vw">
                  <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0"> <img src="https://i.imgur.com/5Aqgz7o.jpg" width="150" height="150" alt=""> </div>
                    <div class="media-body">
                      <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true"><?=$product['name'] ?></a> </h6>
                      <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Phones</a></li>
                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Mobiles</a></li>
                      </ul>
                      <p class="mb-3"><?=$product['description'] ?></p>

                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                      <h3 class="mb-0 font-weight-semibold">₦<?=$product['price'] ?></h3>
                      <div> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                      <div class="text-muted">1985 reviews</div> <button type="button" class="btn btn-warning mt-4 text-white"><i class="icon-cart-add mr-2"></i> Add to cart</button>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
          }
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