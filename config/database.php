<?php

//session_start();
// $_SESSION['user_id'] = 2;
$con = new mysqli("localhost", "tributekeeper_tributekeeper", "-@NQ!NLK,n4=", "tributekeeper_tributekeeper");
$connect = $con;
if(!$con->connect_error){

    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

} else {
    
    die("Unable to connect with database! Please try again...");
    
} 
