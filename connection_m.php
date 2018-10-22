<?php

    ini_set('default_charset', 'utf-8');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    //ini_set('display_errors', '1');

    $servername   = "localhost";
    $username     = "root";
    $password     = "secret";
    $dbname       = "drivefly";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");

    // Change character set to utf8
    mysqli_set_charset($conn,"utf8");

    // Check connection
    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

        echo json_encode(Array("process" => "fail", "message" => "Not up"));
        exit();
    }

?>
