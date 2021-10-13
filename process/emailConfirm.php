<?php

if (isset($_POST["verify_email"]))
{
    include('../db.php');
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    // connect with database
//    $conn = mysqli_connect("localhost:8889", "root", "root", "test");

    // mark email as verified
    $sql = "UPDATE user_test SET verify_at = NOW() WHERE email = ' $email ' AND verification_code = ' $verification_code '";
    $result  = mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) == 0)
    {
        die("Verification code failed.");
    }

    echo "<p>You can login now.</p>";
    exit();
}

?>