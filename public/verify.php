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

    //Do not process unlogged in users to avoid security breach
    if (isset($_SESSION['id']))
    {
        //echo "id";
        header('Location: index.php');
    }
    else if (isset($_SESSION['half-logged']))
    {
        if (isset($_POST['verificationCode']))
        {
            include('../process/verifyEmailProcess.php');
            verifyAccount($_POST['id'], $_POST['verificationCode']);
        }
        else
        {
            include('../page/verifyEmailView.php');
        }

    }
    else
    {
        //echo 'else';
        header('Location: welcome.php');
    }

?>