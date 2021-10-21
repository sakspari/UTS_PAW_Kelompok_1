<?php

    /**
     * Contains common functions that is reused between multiple pages
     */

    require_once("../database/db.php");

    function getUsername($id)
    {
        $con = connect();
        $query1 = mysqli_query($con, "SELECT `username` FROM user_test WHERE id='$id'") or die(mysqli_error($con));
        $con->close();

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

    function getName($id)
    {
        $con = connect();
        $query1 = mysqli_query($con, "SELECT `name` FROM user_test WHERE id='$id'") or die(mysqli_error($con));
        $con->close();

        if (mysqli_num_rows($query1) == 0) {
            return "No Name";
        }
        else
        {
            while($data1 = mysqli_fetch_assoc($query1)){
                return $data1['name'];
            }
        }
    }

    function getImagePath($id)
    {
        if(file_exists('./images/profile/'.$id.'.jpg')) {
            return "./images/profile/$id.jpg";
        }
        else
        {
            return "https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg";
        }
    }

    function isStringSafe($string, $default)
    {
        if (is_numeric($string))
        {
            return $string;
        }
        // More checks to be added
        else 
        {
            return $default;
        }
    }

?>