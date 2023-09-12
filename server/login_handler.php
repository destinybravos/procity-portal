<?php

    include "connection.php";

    // Actual Data from Frontend
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Check the database if the user with this crerdentials already exists.
    $sqlCheckQuery = "SELECT * FROM tbl_users WHERE email = '$email' AND password = '$password'";
    $execQuery = $conn->query($sqlCheckQuery);

    // Check How many rows have the data. If it greater than 0, that means it exists already.
    if ($execQuery->num_rows > 0) {
        $user = $execQuery->fetch_assoc(); // Get the user information
        $response = [
            'status' => 'success',
            'message' => 'Login successful.',
            'user' => $user // Pass the user information with the response
        ];
    } else {
        $response = [
            'status' => 'failed',
            'message' => "Invalid email address or password. Please try again" ,
        ];
    }
    

    // Echo the response
    echo json_encode($response);

?>