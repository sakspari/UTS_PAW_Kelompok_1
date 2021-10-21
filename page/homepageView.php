<?php

    require '../process/homepageProcess.php';

    $id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ConnectUs</title>

    <!-- Vendor: Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  </head>
  <body>
    <!-- Navbar -->

    <header class="navbar navbar-expand-lg navbar-dark bg-yellow fixed-top flex-md-nowrap shadow">
      <a class="ps-4 font-Akronim navbar-brand" href="#">ConnectUs</a>

      <button class="navbar-toggler mt-4 position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-nav ms-auto">
          <div class="p-1 bg-light rounded rounded-pill shadow-sm me-4">
            <div class="navbar-nav">
              <form action="../public/homepage.php" method="post">
                  <div class="input-group">
                      <input class="bg-light rounded form-control rounded-pill shadow-sm me-2" name="search" type="text" placeholder="Search people" aria-label="Search people" aria-describedby="button-search1" border-0 bg-light />
                      <div class="input-group-append">
                          <button id="button-addon1" type="submit" class="mt-1 btn btn-link text-dark"><i class="fa fa-search"></i></button>
                      </div>
                  </div>
                </form>
            </div>
          </div>
      </div>

      <div class="navbar-nav">
        <a href="./profile.php?id=mine">
          <div class="nav-item text-nowrap">
            <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="50" height="50" class="me-4 rounded-circle" />
          </div>
        </a>
      </div>
    </header>

    <!-- End Navbar -->

    <!-- Sidebar -->
    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-yellow-1 sidebar collapse">
          <div class="position-sticky pt-10">
            <ul class="nav flex-column" id="sideCol">
              <li class="nav-item">
                <a class="nav-link text-dark fw-bolder" href="#">Follows</a>
              </li>
              <!-- Followers Card
              <li class="nav-item">
                <a class="nav-link text-dark fw-bold" href="#">
                  <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="50" height="50" class="me-1 rounded-circle" />
                  Followed1
                </a>
              </li> -->
              <?php
                getFollowers($id);
              ?>
            </ul>
          </div>
        </nav>
        <!-- End sidebar -->

        <!-- Card -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

          <!-- Post cards
          <div class="row mt-4 p-2">
            <div class="col-lg-12 mb-lg-0 mb-4 pt-10">
              <div class="card">
                <div class="card-body">
                  <div class="followed">
                    <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="50" height="50" class="me-3 rounded-circle" />
                    <a href="" class="publisher-name">Followed1</a>
                  </div>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptatem deserunt laboriosam doloremque atque, quasi aut cupiditate aperiam minima hic odit eos distinctio ducimus vel tempore quisquam totam
                  perferendis. Aliquid iusto tenetur, dolor beatae odit laboriosam fugiat tempora iure expedita! Quibusdam ab ipsa illo. Sint nobis ad ducimus quibusdam. Dolore laborum atque reprehenderit tempora saepe tenetur alias placeat
                  quibusdam deserunt voluptatem sint ipsa ipsum quis eligendi totam sit architecto, libero optio consequatur animi dolor. Sint dolores vero velit omnis laboriosam, libero reprehenderit cum voluptas. Assumenda rem a aperiam
                  porro ipsum minus iste ex quo rerum, doloremque officiis sunt repellat cupiditate.
                </div>
              </div>
            </div>
          </div>
          -->

          <?php
            getPosts($id);
          ?>

        </main>
      </div>
    </div>
  </body>
  <!-- Vendor: Bootstrap JS-->
  <script type="text/javascript" src="../assets/js/script.js"></script>
  <script type="text/javascript" src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</html>