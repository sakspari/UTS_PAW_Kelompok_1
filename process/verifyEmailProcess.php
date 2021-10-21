<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';
    require_once '../database/db.php';

    function sendVerifyEmail($recipentEmail, $recipentName, $verificationCode)
    {
        //Untuk testing dan debugging, credentials email di hardcode dulu.
        // Setelah itu bakal diganti menggunakan config.
        $username = 'baptistaforpaw@gmail.com';
        $password = 'BuckyGeming123';

        $mail = new PHPMailer(true);

        try
        {
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom($username, 'ConnectUs');
            $mail->addAddress($recipentEmail, $recipentAddress);
            $mail->isHTML(true);

            $mail->Subject = 'Email verification';
            $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verificationCode . '</b></p>';

            $mail->send();

        }
        catch (Exception $e)
        {
            echo "Message could not be sent $e";
        }
    }

    function verifyAccount($id, $verificationCode)
    {
        $con = connect();
        $query = mysqli_query($con, "SELECT *  FROM user_test WHERE id = '$id'") or die(mysqli_error($con));
        
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

        if ($user['verify_at'] != null)
        {
            echo '<script>
                window.location = "../public/welcome.php";
            </script>';
            return;
        }

        if ($user['verification_code'] == null || empty($user['verification_code']))
        {
            echo '
                <script>
                    alert("Terjadi Kesalahan. Harap hubungi support@connectus.id");
                    window.location = "../public/welcome.php";
                </script>';
            return;
        }

        if ($user['verification_code'] != $verificationCode)
        {
            echo '
                <script>
                    alert("Kode yang dimasukan salah!");
                    window.location = "../public/verify.php";
                </script>';
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

        unset($_SESSION['email']);
        unset($_SESSION['half-logged']);
        
        $_SESSION['isLogin'] = true;
        $_SESSION['user'] = $user;

        //Kebanyakan fungsi backend mengunakan ID
        $_SESSION['id'] = $user['id'];

        $sql = "UPDATE user_test SET verify_at = NOW() WHERE id = '$id'";
        $result  = mysqli_query($con, $sql);

        header('Location: https://localhost/public/index.php');
        return;

    }

?>