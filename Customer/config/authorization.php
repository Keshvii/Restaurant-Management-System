<?php

    //   AUTHORIZATION or ACCESS CONTROL:   check whether user is logged in or not
    if(!isset($_SESSION['user']))           // if user session is not set
    {

        echo "abcdefghijklmnopqrstuvwxyz";
        // user is not logged in 
        //redirect to login page with msg
        $_SESSION['no-login-message'] = "<div style='color:red;'> Pleasse login to access admin panel </div>";

        // redirect to login page
        header('location:../admin-login.php');
    }

?>