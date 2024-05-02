<?php
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
