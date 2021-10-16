<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

if (isset($_POST["register"])) {
    include('./db.php');
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dateborn = $_POST['dateborn'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $inputVerifyStatus = true;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $inputVerifyStatus = false;
        echo
        '<script>
         alert("Email invalid"); window.location = "../page/registerPage.php"
         </script>';
    }

    $query = mysqli_query($con, "SELECT * FROM user_test WHERE username = '$username'") or die(mysqli_error($con));
    // ini buat ngecek kalo misalnya hasil dari querynya == 0 berarti usernamenya tdk ditemukan
    if (mysqli_num_rows($query) != 0) {
        $inputVerifyStatus = false;
        echo
        '<script>
         alert("Username Sudah digunakan"); window.location = "../page/registerPage.php"
         </script>';
    }

    $query = mysqli_query($con, "SELECT * FROM user_test WHERE email = '$email'") or die(mysqli_error($con));
    // ini buat ngecek kalo misalnya hasil dari querynya == 0 berarti emailnya tdk ditemukan
    if (mysqli_num_rows($query) != 0) {
        $inputVerifyStatus = false;
        echo
        '<script>
         alert("Email Sudah digunakan"); window.location = "../page/registerPage.php"
         </script>';
    }


    // verify email and username

    //Instantiation and passing `true` enables exceptions
    if ($inputVerifyStatus) {
        $mail = new PHPMailer(true);

        try {
            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

            //Send using SMTP
            $mail->isSMTP();

            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';

            //Enable SMTP authentication
            $mail->SMTPAuth = true;

            //SMTP username
            $mail->Username = 'baptistaforpaw@gmail.com';

            //SMTP password
            $mail->Password = 'BuckyGeming123';

            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('baptistaforpaw@gmail.com', 'ConnectUs');

            //Add a recipient
            $mail->addAddress($email, $name);

            //Set email format to HTML
            $mail->isHTML(true);

            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

            $mail->Subject = 'Email verification';
            $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

            $mail->send();
            // echo 'Message has been sent';

//        ---------------------------------------
            $query = mysqli_query($con,
                "INSERT INTO user_test(name, gender, dateborn, email, username, password, verification_code, verify_at)
             VALUES
             ('$name', '$gender','$dateborn','$email', '$username','$password', '$verification_code', NULL)")
            or die(mysqli_error($con)); // perintah mysql yang gagal dijalankan ditangani oleh perintah “or die”

            if ($query) {
                echo
                '<script>
             alert("Register Success"); window.location = "../page/registerPage.php"
             </script>';
            } else {
                echo
                '<script>
             alert("Register Failed");
             </script>';
            }


            header("Location: ../page/email-verification.php?email=" . $email);
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>