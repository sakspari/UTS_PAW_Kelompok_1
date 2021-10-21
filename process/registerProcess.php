<?php

    function register($name, $gender, $borndate, $email, $username, $password)
    {
        if (!isset($name))
        {
            echo '
                <script>
                    alert("Nama harus memiliki isi");
                    window.location = "../public/welcome.php";
                </script>';
            return;
        }

        if (isset($gender))
        {
            if (!is_numeric($gender))
            {
                echo '
                <script>
                    alert("Gender harus dipilih");
                    window.location = "../public/welcome.php";
                </script>';
            return;  
            }
        }
        else
        {
            echo '
                <script>
                    alert("Gender harus dipilih");
                    window.location = "../public/welcome.php";
                </script>';
            return;
        }

        if (!isset($borndate))
        {
            echo '
                <script>
                    alert("Tanggal lahir harus diisi");
                    window.location = "../public/welcome.php";
                </script>';
            return;
        }

        if (!isset($email))
        {
            echo '
                <script>
                    alert("Email harus diisi");
                    window.location = "../public/welcome.php";
                </script>';
            return;
        }

        if (!isset($password))
        {
            echo '
                <script>
                    alert("Password harus diisi");
                    window.location = "../public/welcome.php";
                </script>';
            return;
        } 
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        include_once('../database/db.php');
        include_once('../process/verifyEmailProcess.php');

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $con = connect();
        $query = mysqli_query($con, "INSERT INTO user_test(name, gender, dateborn, email, username, password, verification_code, verify_at) VALUES ('$name', '$gender', '$borndate', '$email', '$username', '$password', '$verification_code', NULL)") or die(mysqli_error($con));        
        if (!$query)
        {
            echo '
                <script>
                    alert("Registrasi Gagal, coba lagi");
                    window.location = "../public/welcome.php";
                </script>
                ';
            return;
        }
        sendVerifyEmail($email, $username, $verification_code);
        $_SESSION['half-logged'] = mysqli_insert_id($con);
        header("Location: http://localhost/public/verify.php");
    }

?>