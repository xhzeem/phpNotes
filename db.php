<?php

    ini_set('log_errors', 1);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);

    $host = 'localhost';
    $dbname = 'notes_app';
    $username = 'root';
    $password = '';

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("MySQL Connection failed: " . $conn->connect_error);
    }

?>
