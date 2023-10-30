<?php 
    // Online hosted database
    $host = 'yamesy.com:3306';
    $database = 'lvrukr54_csci4140_assn2_partsrus771';
    // $database = 'lvrukr54_partsrus';
    $username = 'lvrukr54_admin';
    $password = 'js?MFDwx*Ap?';

    // For local testing
    // $host = 'localhost';
    // $database = 'parts_r_us';
    // $username = 'root';
    // $password = 'root';

    //Connects to database
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed!" . mysqli_connect_error());
    }
?>