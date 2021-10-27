<?php

    require_once('../database/db.php');

    function updateData($id, $name, $gender, $borndate, $email, $password)
    {
        if (!isset($id))
        {
            echo '
                <script>
                    alert("Terjadi kesalahan keamanan");
                    window.location = "./index.php";
                </script>';
            return;
        } 

        if (empty($name))
        {
            echo '
                <script>
                    alert("Nama harus memiliki isi");
                    window.location = "./profile.php";
                </script>';
            return;
        }

        if (!empty($gender))
        {
            if ($gender == "Pria") { $gender = 1; }
            if ($gender == "Wanita") { $gender = 0; }
        }
        else
        {
            echo '
                <script>
                    alert("Gender harus dipilih");
                    window.location = "./profile.php";
                </script>';
            return;
        }

        if (empty($borndate))
        {
            echo '
                <script>
                    alert("Tanggal lahir harus diisi");
                    window.location = "./profile.php";
                </script>';
            return;
        }

        if (empty($email))
        {
            echo '
                <script>
                    alert("Email harus diisi");
                    window.location = "./profile.php";
                </script>';
            return;
        }

        $con = connect();

        if (empty($password))
        {
            $query = mysqli_query($con,
            "UPDATE user_test SET 
            name = '$name', gender = '$gender', dateborn = '$borndate'
            , email = '$email' WHERE id = '$id'") or die(mysqli_error($con)); 
        } 
        else 
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = mysqli_query($con,
            "UPDATE user_test SET 
            name = '$name', password = '$password', gender = '$gender', dateborn = '$borndate'
            , email = '$email' WHERE id = '$id'") or die(mysqli_error($con));

        }

        refreshData();

        echo '
        <script>
            window.location = "./profile.php";
        </script>';
        return;

    }

    //Ditambahin untuk kedepannya kalau pengen ganti storage nya.
    function getUserProfile()
    {
        if (!isset($_SESSION['user']))
        {
            header("Location: index.php");
        }
        else
        {
            return $_SESSION['user'];
        }
    }

    function getUserProfileWithID($id)
    {
        $con = connect();
        $query1 = mysqli_query($con, "SELECT * FROM user_test WHERE `id` = '$id'") or die(mysqli_error($con));
        if (mysqli_num_rows($query1) == 0) {
            echo '
                <script>
                    alert("Pengguna tidak ditemukan :<");
                    window.location = "./homepage.php";
                </script>';
            return;
        }

        $data1 = mysqli_fetch_assoc($query1);
        return $data1;

    }

    function refreshData()
    {
        $id = $_SESSION['id'];
        $con = connect();
        $query = mysqli_query($con, "SELECT * FROM user_test WHERE id = '$id'") or die(mysqli_error($con));
        $con->close();
        
        //check ban
        if (mysqli_num_rows($query) == 0)
        {
            return;
        }
        $user = mysqli_fetch_assoc($query);

        $_SESSION['user'] = $user;
    }

    function getPostsForProfile($id, $profileOrang)
    {
        $con = connect();

        $query1 = mysqli_query($con, "SELECT * FROM posts WHERE id_user = $id") or die(mysqli_error($con));
        
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
                            <div class="followed d-flex mb-3">
                                <img src="'.getImagePath($id).'" width="50" height="50" class="me-3 rounded-circle" />
                                <h3>'.getName($id).'</h3>
                                <div class="ms-auto p-2">
                                    <form action="./profile.php" method="post">';
                                    if (!$profileOrang)
                                    {
                                        echo '
                                            <input type="hidden" value="'.$data1['id_post'].'" name="postid" />
                                            <input type="hidden" value="'.$data1['post_content'].'" name="postcontent" />
                                            <button id="updatePost" value="editPost" name="action" type="submit" class="btn btn-success" style="font-size:100%"><i class="fa fa-edit"></i></button>
                                            <button id="updatePost" value="deletePost" name="action" type="submit" class="btn btn-danger" style="font-size:100%"><i class="fa fa-trash"></i></button>
                                        ';
                                    }
                echo '
                                    </form>
                                </div>

                            </div>
                            '.$data1['post_content'].'
                        </div>
                    </div>
		</div></div>
                ';

                $no++;
            }
        }
        $con->close();

    }


    function createPost($id, $content)
    {

	if(!isset($content))
	{
	    echo '
                    <script>
                        window.location = "./profile.php";
                    </script>
                ';
            return;
	}

	if(empty($content))
        {
            echo '
                    <script>
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }

        $con = connect();
        $query = mysqli_query($con,
            "INSERT INTO posts(post_content, id_user) VALUES ('$content', '$id')") or die(mysqli_error($con));


        if($query)
        {
            echo '
                    <script>
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }
        else
        {
              echo '
                    <script>
                        alert("Post gagal dibuat");
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }
        return;
    }

    function updatePost($id, $content)
    {   

	        if(!isset($content))
        {
            echo '
                    <script>
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }

        if(empty($content))
        {
            echo '
                    <script>
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }

        $con = connect();
        $query = mysqli_query($con, "UPDATE posts SET post_content = '$content' WHERE id_post = '$id'") or die(mysqli_error($con));

        if($query)
        {
            echo '
                    <script>
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }
        else
        {
              echo '
                    <script>
                        alert("Post gagal diupdate");
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }
        return;
    }

    function deletePost($id)
    {
        $con = connect();
        $query = mysqli_query($con, "DELETE FROM posts WHERE id_post = '$id'") or die(mysqli_error($con));

        if($query)
        {
            echo '
                    <script>
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }
        else
        {
              echo '
                    <script>
                        alert("Post gagal dihapus");
                        window.location = "./profile.php";
                    </script>
                ';
            return;
        }
        return;
    }


?>
