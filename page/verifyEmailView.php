<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Verification Code</title>

    </head>
    <body class="h-100" style="background-color: #ffd77d">
    <div class="card shadow my-auto mx-sm-0 mx-md-5  mx-lg-5 mt-5" style="background-color: #ffc43d">
        <div class="card-body mx-auto w-75 h-25">
            <form action="../public/verify.php" method="POST" class="mx-auto my-auto row">
                <input type="hidden" name="id" value="<?php echo $_SESSION['half-logged']; ?>" required>
                <input type="text" name="verificationCode" placeholder="Enter verification code" required/>

                <input type="submit" name="verify_email" value="Verify Email" class="mx-auto mt-3 border-0 px-2 px-sm-2">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    </body>
</html>