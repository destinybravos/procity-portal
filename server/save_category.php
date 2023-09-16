<?php

    include "connection.php";

    // Actual Data from Frontend
    $category = $_POST['category'];
    $description = $_POST['description'];


    $data_insertion = $conn->query("INSERT INTO tbl_category(category, description) VALUES('$category', '$description')");

    if ($data_insertion) {
        $response = [
            'status' => 'success',
            'message' => 'Category saved successfully',
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