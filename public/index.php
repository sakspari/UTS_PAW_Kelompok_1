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
        header('Location: homepage.php');
    }
    else
    {
        header('Location: welcome.php');
    }
?>