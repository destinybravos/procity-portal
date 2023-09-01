<?php
    try {
        // Database Access Credentials
        $db_hostname = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "procity_portal";

        // Connect to the database
        $conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            // echo "Connection failed: " . $conn->connect_error;
        }
    } catch (\Throwable $th) {
        echo "Exception: " . $th->getMessage();
    } 
?>