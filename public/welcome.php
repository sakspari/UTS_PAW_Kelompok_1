<?php

    /**
     * This is the initial routing page.
     * 
     * This page serves as a buffer between the webserver and the user
     */


    //Do not process unlogged in users to avoid security breach
    if (!isset($_SESSION))
    {
        session_start();
    }
    
    if (isset($_POST['login']))
    {
        if (!isset($_POST['username']))
        {
            gotoRegister();
        }

        $username = $_POST['username'];

        if (!isset($_POST['password']))
        {
            gotoRegister();
        }

        $password = $_POST['password'];

        include('../process/loginProcess.php');
        login($username, $password);
    }
    else if (isset($_POST['register']))
    {
        if (!isset($_POST['name']))
        {
            gotoRegister();
        }
        $name = $_POST['name'];

        if (!isset($_POST['gender']))
        {
            gotoRegister();
        }
        $gender = $_POST['gender'];

        if (!isset($_POST['dateborn']))
        {
            gotoRegister();
        }
        $dateborn = $_POST['dateborn'];

        if (!isset($_POST['email']))
        {
            gotoRegister();
        }
        $email = $_POST['email'];

        if (!isset($_POST['username']))
        {
            gotoRegister();
        }
        $username = $_POST['username'];

        if (!isset($_POST['password']))
        {
            gotoRegister();
        }
        $password = $_POST['password'];

        include('../process/registerProcess.php');
        register($name, $gender, $dateborn, $email, $username, $password);
    }
    else if (isset($_SESSION['id']))
    {
        header('Location: homepage.php');
    }
    else
    {

        gotoRegister();

    }

    function gotoRegister()
    {
        include('../page/registerView.php');
    }

?>