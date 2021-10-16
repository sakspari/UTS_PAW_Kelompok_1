<?php
if (isset($_POST['login'])) {

    include('../db.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysqli_query($con, "SELECT * FROM user_test WHERE username = '$username'") or die(mysqli_error($con));
    if (mysqli_num_rows($query) == 0) {
        echo
        '<script>
     alert("Username not found!"); window.location = "../page/registerPage.php"
     </script>';
    } else {
        $user = mysqli_fetch_assoc($query);
        if($user['verify_at']==null){
            echo
                '<script>
                alert("Email belum di verifikasi"); window.location = "../page/registerPage.php"
                 </script>';
        }else{

            if (password_verify($password, $user['password'])) {
                session_start();

                //isLogin ini temp variable yang gunanya buat ngecek nanti apakah sdh login ato belum
                $_SESSION['isLogin'] = true;
                $_SESSION['user'] = $user;
                echo
                    '<script>
            alert("Login Success"); window.location = "../homepage.php?id='.$user.'"
             </script>';
            } else {
                echo
                '<script>
                alert("Username or Password Invalid");
                 window.location = "../page/registerPage.php"
                 </script>';
            }
        }
    }
} else {
    echo
    '<script>
 window.history.back()
 </script>';
}
?>