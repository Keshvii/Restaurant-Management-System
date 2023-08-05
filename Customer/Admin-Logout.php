<?php



        // 1. destroy the session
    session_destroy();  // unset $_session['user'] and logout from system


        //  2. redirect to admin login page
    header('location:admin-login.php');

?>