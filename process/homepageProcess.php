<?php

    /**
     * Contains functions that are used in the homepageView
     */

    require_once '../database/db.php';
    require_once '../process/commonsProcess.php';

    function getFollowed($id)
    {
        $con = connect();
        $query1 = mysqli_query($con, "SELECT * FROM followers WHERE user_id_1 = $id") or die(mysqli_error($con));
        $con->close();
        if (mysqli_num_rows($query1) == 0) {
            return '0';
        }
        else
        {
            $itr = 1;

            //Initialize Followed IDs master list
            $followedID;
            while($data1 = mysqli_fetch_assoc($query1))
            {
                if ($itr > 1)
                {
                    //Append followed ID to the master list
                    $followedID .= ", '".$data1['user_id_2']."'";
                }
                else
                {
                    $followedID = "'".$data1['user_id_2']."'";
                }
                $itr++;
            }
            echo $followedID;
            return $followedID;
        }

    }

    function getPosts($id)
    {
        $con = connect();
        //Get ID's followers
        $followedID = getFollowed($id);
        
        if ($followedID == 0)
        {
            $followedID = $id;
        }
        else
        {
            $followedID .= ", '".$id."'";
        }

        $query1 = mysqli_query($con, "SELECT * FROM posts WHERE id_user IN (".$followedID.")") or die(mysqli_error($con));
        
        if (mysqli_num_rows($query1) == 0)
        {
            echo '<div class="row mt-4 p-2">
                <div class="col-lg-12 mb-lg-0 mb-4 pt-10">';
            
            echo '<div class="card">
                <div class="card-body">
                    <div class="followed">
                        Tidak ada posting untuk ditampilkan. Follow orang lain untuk melihat postingan orang itu
                    </div>
                </div>
                </div>';
        }
        else
        {
            $no = 1;
            while($data1 = mysqli_fetch_assoc($query1)){
                if ($no == 1)
                {
                    echo '<div class="row mt-4 p-2">
                        <div class="col-lg-12 mb-lg-0 mb-4 pt-10">';
                }
                else
                {
                    echo '<div class="row mt-4 p-2 pt-1">
                        <div class="col-lg-12 mb-lg-0 mb-4">';
                }
                echo '
                    <div class="card">
                        <div class="card-body">
                            <div class="followed">
                                <img src="'.getImagePath($data1['id_user']).'" width="50" height="50" class="me-3 rounded-circle" />
                                <a href="profile.php?id='.$data1['id_user'].'" class="publisher-name">'.getName($data1['id_user']).'</a>
                            </div>
                            '.$data1['post_content'].'
                            </div>
                        </div>
                        </div>
                    </div>
                ';
                $no++;
            }
        }
        $con->close();

    }

    function getFollowers($id)
    {
        $con = connect();
        $query1 = mysqli_query($con, "SELECT * FROM followers WHERE user_id_1 = $id") or die(mysqli_error($con));
    
        if (mysqli_num_rows($query1) == 0) {
            echo 'You currently not follow anyone!';
        }
        else
        {
            $no = 1;
            while($data1 = mysqli_fetch_assoc($query1)){                  
                echo'
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold" href="./profile.php?id='.$data1['user_id_2'].'">
                            <img src="'.getImagePath($data1['user_id_2']).'" width="50" height="50" class="me-1 rounded-circle" />
                            '.getName($data1['user_id_2']).'
                        </a>
                    </li> 
                    ';
                $no++;
            }
        }
    }

    function findUser($string)
    {
        $con = connect();
        $query1 = mysqli_query($con, "SELECT id FROM user_test WHERE `username` = '$string'") or die(mysqli_error($con));
        if (mysqli_num_rows($query1) == 0) {
            echo '
                <script>
                    alert("Pengguna tidak ditemukan :< \n Berikut beberapa tips untuk mencari user: \n 1. Masukan Username pengguna, bukan Nama \n 2. Cek kembali username yang dimasukan");
                    window.location = "./homepage.php";
                </script>';
            return;
        }

        $data1 = mysqli_fetch_assoc($query1);
        //var_dump($data1);
        header("Location: ./profile.php?id=".$data1['id']);
        return;
    }

?>