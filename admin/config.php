<?php
    $dbservername = 'localhost';
    $dbusername = 'root';
    $dbpassword = 'root';
    $dbname = 'project1';

    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die ($conn->connect_error);
    }
?>