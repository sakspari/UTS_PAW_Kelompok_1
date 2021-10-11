<?php
if (isset($_POST['register'])) {

    include('../db.php');
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dateborn = $_POST['dateborn'];
    $email = $_POST['email'];
    $username=$_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Melakukan insert ke databse dengan query dibawah ini
    $query = mysqli_query($con,
        "INSERT INTO users(name, gender, dateborn, email, username, password)
 VALUES
 ('$name', '$gender', '$dateborn', '$email', '$username', '$password')")
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

} else {
    echo
    '<script>
 window.history.back()
 </script>';
}
?>