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
        header('HTTP/1.1 200 OK');

        // Generate a token & and Save the tokken
        $token = generateToken(); // Generate the token
        saveToken($user['id'], $token, $conn); // Save the token into the database

        // HTTP Response
        $response = [
            'status' => 'success',
            'message' => 'Login successful.',
            'user' => $user, // Pass the user information with the response
            'access_token' => $token
        ];
    } else {
        header('HTTP/1.1 500');
        $response = [
            'status' => 'failed',
            'message' => "Invalid email address or password. Please try again" ,
        ];
    }
    

    // Echo the response
    echo json_encode($response);




    // Function to generate token
    function generateToken() {
        return md5(rand(000000,999999)) . time();
    }

    // Function to save user access token
    function saveToken($user_id, $token, $conn) {

        $sqlCheckQuery = "SELECT * FROM tbl_access_token WHERE user_id = '$user_id'";
        $execQuery = $conn->query($sqlCheckQuery);

        // Check How many rows have the data. If it greater than 0, that means it exists already.
        if ($execQuery->num_rows > 0) {
            $data_insertion = $conn->query("UPDATE tbl_access_token SET token='$token' WHERE user_id='$user_id'");
        } else {
            // If it doesn't exist
            $data_insertion = $conn->query("INSERT INTO tbl_access_token(user_id, token) VALUES('$user_id', '$token')");
        }

        // return status 
        if ($data_insertion) {
            return true;
        } else {
            return false;
        }
    }

?>