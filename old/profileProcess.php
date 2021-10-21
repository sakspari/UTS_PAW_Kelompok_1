<?php
    // untuk ngecek tombol yang namenya 'edit' sudah di pencet atau belum
    // $_POST itu method di formnya

        include('./db.php');

        $id = $_GET['id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $borndate = $_POST['borndate'];
        $email_user = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
        if ($gender == "Pria")
        {
            $gender = 1;
        }
        else if ($gender == "Wanita")
        {
            $gender = 0;
        }
        else
        {
            echo "Error";
        }

        if (empty($password))
        {
            $query = mysqli_query($con,
            "UPDATE user_test SET 
            name = '$name', gender = '$gender', dateborn = '$borndate'
            , email = '$email_user' WHERE id = '$id'") or die(mysqli_error($con)); 
        } 
        else 
        {

            $query = mysqli_query($con,
            "UPDATE user_test SET 
            name = '$name', password = '$password', gender = '$gender', dateborn = '$borndate'
            , email = '$email_user' WHERE id = '$id'") or die(mysqli_error($con));

        }


        if($query){
            echo
            '<script>
            alert("Change Success"); window.location = "./profile.php?id='.$id.'"
            </script>';
        }else{
            echo
                '<script>
                alert("change Data Failed");
                </script>';
        }
?>