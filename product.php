<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Snippet - BBBootstrap</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <style>body {
        margin: 0;
        font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: .8125rem;
        font-weight: 400;
        line-height: 1.5385;
        color: #333;
        text-align: left;
        background-color: #f5f5f5
    }

    .mt-50 {
        margin-top: 50px
    }

    .mb-50 {
        margin-bottom: 50px
    }

    .bg-teal-400 {
        background-color: #26a69a
    }

    a {
        text-decoration: none !important
    }

    .fa {
        color: red
    }</style>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<!-- https://i.imgur.com/5Aqgz7o.jpg
https://i.imgur.com/Aj0L4Wa.jpg
https://i.imgur.com/5Aqgz7o.jpg
https://i.imgur.com/Aj0L4Wa.jpg -->
<body oncontextmenu='return false' class='snippet-body'>
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
                    $pQuery = mysqli_query($con,"SELECT * FROM products");
                    if (mysqli_num_rows($pQuery)>0) {
                        while ($product = mysqli_fetch_assoc($pQuery)) {
                            if ($product['owner'] == $_SESSION['user_id']) {

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
                                                <li class="list-inline-item"><strong>Your product, <a href="#" data-abc="true">Edit</a></strong> </li>
                                                <li class="list-inline-item"><strong> You can Also <a href="#" data-abc="true">Delete it</a></strong> </li>
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
                header('location:index');
            }

            ?>
        </div>
    </div>
</div>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<script type='text/javascript'></script>
</body>
</html>