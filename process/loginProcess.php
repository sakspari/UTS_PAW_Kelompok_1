<?php

    require_once('../database/db.php');

    function login($username, $password)
    {
        $con = connect();
        $query = mysqli_query($con, "SELECT * FROM user_test WHERE username = '$username'") or die(mysqli_error($con));
        $con->close();
        
        //check ban
        if (mysqli_num_rows($query) == 0)
        {
            /**echo '
                <script>
                    alert("Akun tidak ditemukan");
                </script>';*/

            //Untuk mencegah username discovery, pesan invalid username dan password harus sama
            echo '<script>
                alert("Username atau Password salah");
                window.location = "../public/welcome.php";
            </script>';
            return;
        }
        $user = mysqli_fetch_assoc($query);

        if (!password_verify($password, $user['password']))
        {
            echo '
                <script>
                    alert("Username atau Password salah");
                    window.location = "../public/welcome.php";
                </script>';
            return;
        }

        if ($user['verify_at'] == null)
        {
            $_SESSION['email'] = $user['email'];
            $_SESSION['half-logged'] = $user['id'];
            header('Location: http://localhost/public/verify.php');
            return;
        }

        /**if($user['isBanned'])
        {
            echo '
                <script>
                    alert("Akun diblokir");
                </script>';
            return;
        }*/

        $_SESSION['isLogin'] = true;
        $_SESSION['user'] = $user;

        //Kebanyakan fungsi backend mengunakan ID
        $_SESSION['id'] = $user['id'];

        header('Location: https://localhost/public/index.php');
        return;

    }

?>