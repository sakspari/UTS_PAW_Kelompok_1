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

        if (isset($_POST['search']))
        {
            
            if (isset($_POST['search']))
            {
                include('../process/homepageProcess.php');
                findUser($_POST['search']);
            }
            else
            {
                include('../page/homepageView.php');
            }

        }
        include('../page/homepageView.php');
    }

?>