<?php 

    include "connection.php";

    $name = $_POST['name'];
    $message = $_POST['message'];
    $avatar = $_POST['avatar_url'];

    $data_insertion = $conn->query("INSERT INTO tbl_opinions(name, opinion, avatar) VALUES('$name', '$message', '$avatar')");

    if ($data_insertion) {
        $response = [
            'status' => 'success',
            'message' => 'Your opinion was saved successfully',
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