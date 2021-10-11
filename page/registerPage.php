<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <title>Login Page</title>
</head>

<body style="height: 100vh;">
<!-- Navbar Component with Login Form -->
<div class="navbar navbar-light d-flex flex-row" style="background-color: #ffc43d">
    <div class="ms-4">
        <a class="navbar-brand" href="#">
            <span class="fs-1 fw-bolder">ConnectUs</span>
        </a>
    </div>
    <div class="me-4">
        <form action="../process/loginProcess.php" method="post" class="d-flex flex-row">
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label fw-bold">Username</label>
                <input class="form-control" id="username" name="username" aria-describedby="emailHelp" />
            </div>
            <div class="mb-3 ms-2">
                <label for="exampleInputPassword" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
            </div>
            <div class="ms-2">
                <button type="submit"
                        class="btn btn-primary btn-large fw-bold"
                        style="margin-top: 2rem"
                        name="login">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
<!-- End Of Navbar Component -->

<!-- Content of Register Page -->

<div class="container-fluid">
    <div class="row">
        <div class="col-6" style="overflow: hidden;">
            <img src="https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80"
                 alt="ConnectUs Illustration"
                 style="display: block;
                    max-height: 100%;
                    width: auto;">
        </div>
        <!-- Form for User Register -->
        <div class="col-6">
            <div class="container min-vh-100 d-flex align-items-center justify-content-center">
                <div class="card text-dark bg-light ma-5 shadow" style="min-width: 45rem;">
                    <!-- <div class="card-header fw-bold">Login</div> -->
                    <div class="card-body" style="margin: 2rem 3rem;">
                        <div>
                            <h1>Join and let it ConnectUs!</h1>
                        </div>
                        <form action="../process/registerProcess.php" method="post">
                            <div class="mb-3 row">
                                <label for="Name" class="col-2 form-label">Name</label>
                                <input type="text" class="col form-control" id="name" name="name">
                            </div>
                            <div class="mb-3 row">
                                <label for="gender" class="col-2 form-label">Gender</label>
                                <select class="col form-control form-select" id="gender" name="gender">
                                    <option selected>Select a Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3 row">
                                <label for="dateborn" class="col-2 form-label">Date Born</label>
                                <input type="date" class="col form-control" id="dateborn" name="dateborn">
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-2 form-label">Email</label>
                                <input type="text" class="col form-control" id="email" name="email"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3 row">
                                <label for="exampleInputPassword" class="col-2 form-label">Password</label>
                                <input type="password" class="col form-control" id="password" name="password">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name="register">Connect Us Now</button>
                            </div>
                        </form>
                    </div>
                    <!-- </div> -->
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