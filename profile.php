<?php
    session_start();
    include('db.php');

    function getImagePath($id)
    {
        if(file_exists('./images/profile/'.$id.'.jpg')) {
            return "./images/profile/$id.jpg";
        }
        else
        {
            return "https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg";
        }
    }

    $id = $_GET['id'];
    $queryEdit = mysqli_query($con, "SELECT * FROM user_test WHERE id=$id") or die(mysqli_error($con));
    $data = mysqli_fetch_assoc($queryEdit)

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffc43d;">
        <div class="container-fluid ">
          <a class="navbar-brand" href="#">ConnectUS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h4>Profile</h4>
        </div>
      </nav>
      
    <div class="d-flex">
        <div class="side-bar">
        <img src="<?getImagePath($id)?>">
        
        <form action="./profileProcess.php?id=<?=$data['id']?>" method="POST">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label" style="font-family: Arial, Helvetica, sans-serif">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?=$data['name'];?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="gender" class="col-sm-2 col-form-label" style="font-family: Arial, Helvetica, sans-serif">Gender</label>
                <div class="col-sm-10">
                    <?php
                        if ($data['gender']) {
                            echo '
                            <input type="text" class="form-control" id="gender" name="gender" value="Pria">';
                        } else {
                            echo '
                            <input type="text" class="form-control" id="gender" name="gender" value="Wanita">';
                        }
                    ?>
                </div>
            </div>

            <div class="row mb-3">
                <label for="borndate" class="col-sm-2 col-form-label"  style="font-family: Arial, Helvetica, sans-serif">Borndate</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="borndate" name="borndate" value="<?=$data['dateborn'];?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email_user" class="col-sm-2 col-form-label"  style="font-family: Arial, Helvetica, sans-serif">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email_user" name="email" value="<?=$data['email'];?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label"  style="font-family: Arial, Helvetica, sans-serif">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Edit Profile</button>
        
        </form>
        </div>
        <div class="container p-3 m-4 h-100" style="float: right">
                <div class="card">
                        <h5 class="card-header">Featured</h5>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                </div>
        </div>
    </div>


   


        

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>