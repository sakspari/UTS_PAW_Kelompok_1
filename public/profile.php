<?php

    /**
     * This is the initial routing page.
     * 
     * This page serves as a buffer between the webserver and the user
     * In an event of the PHP fpm failed for any reason, this page will be shown
     * instead of the inner pages to reduce attack surfaces.
     * 
     * 
     * IF YOU ARE A VISITOR AND YOU SEE THIS PAGE, THAT MEANS THAT THE SERVER
     * ARE CURRENTLY UNABLE TO PROCESS YOUR REQUEST. PLEASE CONTACT THE ADMINISTRATOR.
     * 
     */
    if (!isset($_SESSION))
    {
        session_start();
    }

    //Do not process unlogged in users to avoid security breach
    if (!isset($_SESSION['id']))
    {
        header('Location: http://localhost/public/welcome.php');
    }
    else
    {

        if (isset($_POST['name']))
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
        }

        else if (isset($_POST['createPost']))
        {
            if (isset($_POST['content']))
            {
                include_once('../process/profileProcess.php');
                createPost($_SESSION['id'], $_POST['content']);
            }
            else
            {
                include('../page/profileView2.php');
            }
        }

        else if (isset($_POST['action']))
        {
            if ($_POST['action'] == 'editPost')
            {
                include_once('../page/editPostView.php');
                //updatePost($_POST['postid']);
            }
            else if ($_POST['action'] == 'deletePost')
            {
                include('../process/profileProcess.php');
                deletePost($_POST['postid']);
            }
        }
        else if (isset($_POST['editPostSubmit']))
        {
            include_once('../process/profileProcess.php');
            updatePost($_POST['postid'], $_POST['postcontent']);
        }
        else
        {
            include('../page/profileView2.php');
        }

    }

?>