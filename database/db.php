<?php

    //$config = parse_ini_file("../../config.ini");

    function connect()
    {

        $hostname = "localhost";
        $username = "username";
        $password = "password";
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