<?php

    //$config = parse_ini_file("../../config.ini");

    function connect()
    {

        $hostname = "sg.1-cluster-ap.luckynetwork.id";
        $username = "praktikum5";
        $password = "@newS3cur3P44sw0rd0115";
        $database = "uts_web";

        $con = mysqli_connect($hostname,$username,$password,$database);
        if (!$con)
        {
            die("Unable to connect to the Backend!");
        }
        return $con;
    }

    function disconnect($con)
    {
        $con->close();
    }


?>