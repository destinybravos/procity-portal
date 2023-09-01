<?php

    include "connection.php";

    // Dummy variables and Data
    // $subject = "Testing Subject";
    // $email = "test@example.com";
    // $name = "Test User";
    // $message = "Lorem ipsum dolor sit amet, consectetur adip e fits in diam euismod";

    // Actual Data from Frontend
    $fname = $_GET['fullname'];
    $subject = $_GET['subject'];
    $message = $_GET['message'];
    $email = $_GET['email'];


    $data_insertion = $conn->query("INSERT INTO tbl_contact(username, email, subject, message) VALUES('$fname', '$email', '$subject', '$message')");

    if ($data_insertion) {
        $response = [
            'status' => 'success',
            'message' => 'Your request was successfully recieved and our support team are currently working on it.',
        ];
    }else{
        $response = [
            'status' => 'failed',
            'message' => "An error occurred. Please try again. " . $conn->error,
        ];
    }

    // Echo the response
    echo json_encode($response);

?>