<?php

    include "connection.php";

    // Actual Data from Frontend
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = $_POST['confirm_password'];
    $terms = filter_var($_POST['terms'], FILTER_VALIDATE_BOOL);

    // Check the database if the user with this crerdentials already exists.
    $sqlCheckQuery = "SELECT * FROM tbl_users WHERE email = '$email' AND password = '$password'";
    $execQuery = $conn->query($sqlCheckQuery);

    // Check How many rows have the data. If it greater than 0, that means it exists already.
    if ($execQuery->num_rows > 0) {
        header('HTTP/1.1 422 Account already exists');
        $response = [
            'status' => 'failed',
            'message' => "Account already exists. Please try again with a different credentials or kindly login" ,
        ];
    } else {
        $sqlQuery = "INSERT INTO tbl_users(uname, email, password, terms) VALUES('$uname', '$email', '$password', '$terms')";

        $data_insertion = $conn->query($sqlQuery);

        if ($data_insertion) {
            header('HTTP/1.1 200');
            $response = [
                'status' => 'success',
                'message' => 'Registration successful. You can now proceed to login.',
            ];
        }else{
            header('HTTP/1.1 500');
            $response = [
                'status' => 'failed',
                'message' => "An error occurred. Please try again. " . $conn->error,
            ];
        }
    }
    

    // Echo the response
    echo json_encode($response);

?>