<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Market - Ecommerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style type="text/css">
        .register{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            margin-top: 3%;
            padding: 3%;
        }
        .register-left{
            text-align: center;
            color: #fff;
            margin-top: 4%;
        }

        .register-left input{
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            width: 100%;
            background: #f8f9fa;
            font-weight: bold;
            color: #383d41;
            margin-top: 30%;
            margin-bottom: 3%;
            cursor: pointer;
        }
        .register-right{
            background: #f8f9fa;
            border-top-left-radius: 10% 50%;
            border-bottom-left-radius: 10% 50%;
        }
        .register-left img{
            margin-top: 15%;
            margin-bottom: 5%;
            width: 25%;
            -webkit-animation: mover 2s infinite  alternate;
            animation: mover 1s infinite  alternate;
        }
        @-webkit-keyframes mover {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }
        @keyframes mover {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }
        .register-left p{
            font-weight: lighter;
            padding: 12%;
            margin-top: -9%;
        }
        .register .register-form{
            padding: 10%;
            margin-top: 10%;
        }
        .btnRegister{
            float: right;
            margin-top: 10%;
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            background: #0062cc;
            color: #fff;
            font-weight: 600;
            width: 50%;
            cursor: pointer;
        }
        .register .nav-tabs{
            margin-top: 3%;
            border: none;
            background: #0062cc;
            border-radius: 1.5rem;
            width: 28%;
            float: right;
        }
        .register .nav-tabs .nav-link{
            padding: 2%;
            height: 34px;
            font-weight: 600;
            color: #fff;
            border-top-right-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
        }
        .register .nav-tabs .nav-link:hover{
            border: none;
        }
        .register .nav-tabs .nav-link.active{
            width: 100px;
            color: #0062cc;
            border: 2px solid #0062cc;
            border-top-left-radius: 1.5rem;
            border-bottom-left-radius: 1.5rem;
        }
        .register-heading{
            text-align: center;
            margin-top: 8%;
            margin-bottom: -15%;
            color: #495057;
        }
        input{
            width: 15em !important;
        }
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
    session_start();
    if (isset($_SESSION['user_id'])) {
        header('location:dashboard.php');
    }else{
        if (isset($_POST['regbtn'])) {
            include 'conf.php';
            $username = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['username']))) ), FILTER_SANITIZE_STRIPPED);
            $fullname = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['fullname']))) ), FILTER_SANITIZE_STRIPPED);
            $password = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['password']))) ), FILTER_SANITIZE_STRIPPED);
            $cpassword = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['cpassword']))) ), FILTER_SANITIZE_STRIPPED);
            $phone = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['phone']))) ), FILTER_SANITIZE_STRIPPED);
            $email = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['email']))) ), FILTER_SANITIZE_STRIPPED);
            if (empty($username) || empty($fullname) || empty($password) || empty($cpassword) || empty($phone) || empty($email)) {
                echo "<script>Swal.fire('Some feild(s) are left unfilled!','','error')</script>";
            }else{
                if ($password !== $cpassword) {
                    echo "<script>Swal.fire('Passwords are not matched!','','error')</script>";
                }else{
                    if (mysqli_num_rows(mysqli_query($con,"SELECT id FROM users WHERE username = '$username'"))>0) {
                        echo "<script>Swal.fire('User Already Exist With This Username','','error')</script>";
                    }else{
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $con->prepare("INSERT INTO users (fullname,username,phone,email,password) VALUES (?,?,?,?,?)");
                        $stmt->bind_param('sssss',$fullname,$username,$phone,$email,$hashed_password);
                        if ($stmt->execute()) {
                            echo "<script>Swal.fire('Registered Successfully!','','success')</script>";
                        }else{
                            echo "<script>Swal.fire('Some error occured while registring!','','error')</script>";
                        }
                    }
                }
            }
        }else if (isset($_POST['loginbtn'])) {
            include 'conf.php';
            $username = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['username']))) ), FILTER_SANITIZE_STRIPPED);
            $password = filter_var(strip_tags(mysqli_real_escape_string($con,trim(preg_replace('/[\t\n\r\s]+/', ' ', $_POST['password']))) ), FILTER_SANITIZE_STRIPPED);
            if (empty($username) || empty($password)) {
                echo "<script>Swal.fire('Some feild(s) are left unfilled!','','error')</script>";
            }else{
                $loginQuery = mysqli_query($con,"SELECT * FROM users WHERE username = '$username'");
                if (mysqli_num_rows($loginQuery)>0) {
                    $user = mysqli_fetch_assoc($loginQuery);
                    if (password_verify($password, $user['password'])) {
                        $msg = "<script>Swal.fire('Login Successfully!','','success')</script>";

                        $_SESSION['msg'] = $msg;
                        $_SESSION['fullname'] = $user['fullname'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['phone'] = $user['phone'];
                        $_SESSION['email'] = $user['email'];
                        header('location:dashboard.php');
                    }else{
                        echo "<script>Swal.fire('Invalid User Credential!','','error')</script>";
                    }
                }else{
                    echo "<script>Swal.fire('Invalid User Credential!','','error')</script>";
                }
            }
        }
    }
    ?>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                <h3>Welcome</h3>
                <p>You are 30 seconds away from shopping at ease!</p>

            </div>
            <div class="col-md-9 register-right">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Login</h3>
                        <form method="post" class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="inputs" name="username" style="margin-top: 20px" class="form-control" placeholder=" Username" required="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder=" Password" required="" />
                                </div>
                                <button name="loginbtn" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h3  class="register-heading">Register</h3>
                        <form method="post" class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="fullname" class="form-control" style="margin-top: 20px" placeholder="Full Name *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Username *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="number" name="phone" class="form-control" placeholder="Phone Number *" value="" />
                                </div>


                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" style="margin-top: 20px" placeholder="Password *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password *" value="" />
                                </div>

                                <button name="regbtn" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">

    </script>
</body>
</html>
