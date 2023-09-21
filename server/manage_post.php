<?php

    include "connection.php";

    $action = $_POST['action'];

    // If action iss save_post, then save the post data to the database
    if ($action == 'save_post'){
        $cat_id = $_POST['category_id'];
        $title = $_POST['title'];
        $body = $_POST['body'];
        // $cat_id = $_POST['cat_id'];

        $data_insertion = $conn->query("INSERT INTO tbl_posts(category_id, title, body) VALUES('$cat_id', '$title', '$body')");

        if ($data_insertion) {
            $response = [
                'status' => 'success',
                'message' => 'Post add successfully',
            ];
        }else{
            $response = [
                'status' => 'failed',
                'message' => "An error occurred. Please try again. " . $conn->error,
            ];
        }

        echo json_encode($response);
    }

?>