<?php
    $host = "%%HIDDEN%%";
    $user = "%%HIDDEN%%";
    $pass = "%%HIDDEN%%";
    $name = "uts_web";

    $con = mysqli_connect($host,$user,$pass,$name);

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }

    function getUsername($con, $id)
    {
        $query1 = mysqli_query($con, "SELECT `username_user` FROM users WHERE id_user='$id'") or die(mysqli_error($con));
            if (mysqli_num_rows($query1) == 0) {
                return "No Username";
            }
            else
            {
                while($data1 = mysqli_fetch_assoc($query1)){
                    return $data1['username_user'];
                }
            }
    }

?>