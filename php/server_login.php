<?php 
    //Sign in and page array variables
    $host = 'yamesy.com:3306';
    $database = 'lvrukr54_partsrus';
    $username = 'lvrukr54_admin';
    $password = 'js?MFDwx*Ap?';
    //Connects to database
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed!" . mysqli_connect_error());
    }
?>