<?php
    // Create connection to db
    $conn = new mysqli("localhost", "root", "", "table");

    // Check conn to db
    if ($conn->connect_error) {
        die("COULD NOT CONNECT TO THE DATABASE: " . $conn->connect_error);
    }
    ?>