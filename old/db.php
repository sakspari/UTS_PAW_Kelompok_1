<?php
    $host = "sg.1-cluster-ap.luckynetwork.id";
    $user = "praktikum5";
    $pass = "@newS3cur3P44sw0rd0115";
    $name = "uts_web";

    $con = mysqli_connect($host,$user,$pass,$name);

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }

    function getUsername($con, $id)
    {
        $query1 = mysqli_query($con, "SELECT `username` FROM user_test WHERE id='$id'") or die(mysqli_error($con));
            if (mysqli_num_rows($query1) == 0) {
                return "No Username";
            }
            else
            {
                while($data1 = mysqli_fetch_assoc($query1)){
                    return $data1['username'];
                }
            }
    }

    //$_SESSION["userName"]
    function getId($con, $username)
    {
        $query1 = mysqli_query($con, "SELECT `id` FROM user_test WHERE username='$username'") or die(mysqli_error($con));
        if (mysqli_num_rows($query1) == 0) {
            return "No Username";
        }
        else
        {
            while($data1 = mysqli_fetch_assoc($query1)){
                return $data1['username'];
            }
        }
    }

?>