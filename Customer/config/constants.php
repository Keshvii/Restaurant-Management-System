<?php 

session_start();

define('SITEURL', 'http://localhost/RMS/'); 
define("HOST","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DB","rms");

$conn = new mysqli("localhost","root","","rms");

if($conn === false){
    die("ERROR: Could not connect. ". mysqli_connect_error());
}

?>