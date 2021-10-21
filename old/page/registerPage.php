<?php
//import php mailer disini
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
    
    <title>Login Page</title>
</head>

<body style="height: 100vh; background-color: #ffd77d">
<!-- Navbar Component with Login Form -->
<div style="background-color: #ffc43d">
    <div class="navbar navbar-expand-lg navbar-light w-75 mx-auto">
        <a class="navbar-brand ms-5" href="#">
            <span class="fs-1 fw-bolder">ConnectUs</span>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar nav d-flex flex-sm-column justify-content-center ms-auto me-lg-5">
                <form action="../process/loginProcess.php" method="post"
                      class="d-flex flex-lg-row flex-sm-column flex-md-column">
                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label fw-bold">Username</label>
                        <input class="form-control" id="username" name="username" aria-describedby="emailHelp" required/>
                    </div>
                    <div class="mb-3 ms-lg-2">
                        <label for="exampleInputPassword" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required/>
                    </div>
                    <div class="ms-lg-2 mx-auto my-md-auto">
                        <button type="submit"
                                class="btn btn-primary btn-large fw-bold mt-3"
                                name="login">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--    </div>-->
    </div>
</div>
<!-- End Of Navbar Component -->

<!-- Content of Register Page -->

<div class="container-fluid">
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
                <div class="card w-auto container-fluid text-dark bg-light ma-5 shadow w-50">
                    <div class="card-body mx-md-5 mx-sm-0 my-5">
                        <div>
                            <h1>Join and let it ConnectUs!</h1>
                        </div>
                        <form action="../process/verifyEmail.php" method="post" class="needs-validation">
                            <div class="mb-3 row">
                                <label for="Name" class=" col-lg-3 form-label">Name</label>
                                <input type="text" class="col-md col-sm-auto form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3 row">
                                <label for="gender" class="col-lg-3 form-label">Gender</label>
                                <select class="col-md col-sm-auto form-control form-select" id="gender" name="gender" aria-required="true">
                                    <option selected aria-invalid="true">Select a Gender</option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                                <div class="invalid-feedback text-danger">
                                    invalid State
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="dateborn" class="col-lg-3 form-label">Date Born</label>
                                <input type="date" class="col-md col-sm-auto form-control" id="dateborn"
                                       name="dateborn" required>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-lg-3 form-label">Email</label>
                                <input type="text" class="col-md col-sm-auto form-control" id="email" name="email"
                                       aria-describedby="emailHelp" onkeydown="validateEmail()" required>
                            </div>
                            <div class="mb-3 row">
                                <label for="username" class="col-lg-3 form-label">Username</label>
                                <input type="text" class="col-md col-sm-auto form-control" id="email" name="username"
                                       aria-describedby="emailHelp" required>
                                <div id="email-validation" class="invalid-feedback">Invalid email format</div>
                            </div>
                            <div class="mb-3 row">
                                <label for="exampleInputPassword" class="col-lg-3 form-label">Password</label>
                                <input type="password" class="col-md col-sm-auto form-control" id="password"
                                       name="password" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name="register">Connect Us Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>