<?php

    /**
     * This is the initial routing page.
     * 
     * This page serves as a buffer between the webserver and the user to reduce the attack vector
     * 
     * IF YOU ARE A VISITOR AND YOU SEE THIS PAGE, THAT MEANS THAT THE SERVER
     * ARE CURRENTLY UNABLE TO PROCESS YOUR REQUEST. PLEASE CONTACT THE ADMINISTRATOR.
     * 
     */
    if (!isset($_SESSION))
    {
        session_start();
    }

    
    if (!isset($_SESSION['id']))
    {
        header('Location: welcome.php');
        return;
    }

    //Handle updateProfile request
    if (isset($_POST['updateProfile']))
    {
        if (!isset($_POST['name']))
        {
            $name = "";
        }
        else 
        {
            $name = $_POST['name'];
        }
        if (!isset($_POST['gender']))
        {
            $gender = "";
        }
        else 
        {
            $gender = $_POST['gender'];
        }
        if (!isset($_POST['borndate']))
        {
                $borndate = "";
        }
        else 
        {
            $borndate = $_POST['borndate'];
        }
        if (!isset($_POST['email']))
        {
           $email = "";
        }
        else 
        {
            $email = $_POST['email'];
        }
        if (!isset($_POST['password']))
        {
            $password = "";
        }
        else 
        {
           $password = $_POST['password'];
        }

        include_once('../process/profileProcess.php');
        updateData($_SESSION['id'], $name, $gender, $borndate, $email, $password);
        return;
    }

    //Handle createPost
    if (isset($_POST['createPost']))
    {
        if (isset($_POST['content']))
        {
            include_once('../process/profileProcess.php');
            createPost($_SESSION['id'], $_POST['content']);
            return;
        }
        else
        {
            include_once('../page/profileView2.php');
            return;
        }
    }

    //Handle edit or Delete post
    if (isset($_POST['action']))
    {
        if ($_POST['action'] == 'editPost')
        {
            include_once('../page/editPostView.php');
            return;
        }
        else if ($_POST['action'] == 'deletePost')
        {
            include('../process/profileProcess.php');
            deletePost($_POST['postid']);
            return;
        }
        else
        {
            include_once('../page/profileView2.php');
            return;
        }
    }

    //Handle edit Post from editPostView
    if (isset($_POST['editPostSubmit']))
    {
        include_once('../process/profileProcess.php');
        updatePost($_POST['postid'], $_POST['postcontent']);
        return;
    }

    //Handle follow
    if (isset($_POST['follow']))
    {
        include_once('../process/commonsProcess.php');
        addFollower($_SESSION['id'], $_POST['target_id']);
        //echo 'a';
	return;
    }

    if (isset($_POST['unfollow']))
    {
        include_once('../process/commonsProcess.php');
        removeFollower($_SESSION['id'], $_POST['target_id']);
	//echo 'b';
        return;
    }

    if (isset($_POST['logout']))
    {
        include_once('../process/loginProcess.php');
        logout();
        return;
    }

    include_once('../page/profileView2.php');


?>
