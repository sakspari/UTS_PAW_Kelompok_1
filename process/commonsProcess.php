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
        if(file_exists('../images/profile/'.$id.'.jpg')) {
            return "../images/profile/$id.jpg";
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


    function isFollowed($user_id_1, $user_id_2)
    {
	//echo 'ab';
        $con = connect();
        $query1 = mysqli_query($con, "SELECT * FROM followers WHERE user_id_1 = $user_id_1 AND user_id_2 = $user_id_2") or die(mysqli_error($con));
        $con->close();
        if (mysqli_num_rows($query1) == 0) {
            return false;
        }
        else
        {
            return true;
        }
    }


    function addFollower($user_id_1, $user_id_2)
    {
	//echo 'a.2';
        if (isFollowed($user_id_1, $user_id_2))
        {
            return;
        }
        $con = connect();
        $query = mysqli_query($con, "INSERT INTO followers(user_id_1, user_id_2) VALUES ('$user_id_1', '$user_id_2')") or die(mysqli_error($con));        
        if (!$query)
        {
            echo '
                <script>
                    alert("Add follower gagal, coba lagi");
                    window.location = "./profile.php?id='.$user_id_2.'";
                </script>
                ';
            return;
        }
        $con->close();
        echo '
                <script>
                    window.location = "./profile.php?id='.$user_id_2.'";
                </script>';
        return;
    }

    function removeFollower($user_id_1, $user_id_2)
    {
	//echo 'b.2';
        if (!isFollowed($user_id_1, $user_id_2))
        {
            return;
        }
        //DELETE FROM `uts_web`.`followers` WHERE (`id_followersrelationship` = '1');
        $con = connect();
        $query = mysqli_query($con, "DELETE FROM followers WHERE user_id_1 = $user_id_1 AND user_id_2 = $user_id_2") or die(mysqli_error($con));        
        if (!$query)
        {
            echo '
                <script>
                    alert("Remove follower gagal, coba lagi");
                    window.location = "./profile.php?id='.$user_id_2.'";
                </script>
                ';
            return;
        }
        $con->close();
        echo '
        <script>
            window.location = "./profile.php?id='.$user_id_2.'";
        </script>';
return;

    }

?>
