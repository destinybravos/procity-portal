<?php

    include "connection.php";
    
    header('Access-Control-Allow-Origin: *');

    // Check the database if the user with this crerdentials already exists.
    $sqlCheckQuery = "SELECT * FROM tbl_category ORDER BY category ASC";
    $execQuery = $conn->query($sqlCheckQuery);


    $categories = []; // Delare an Empty array for categories


    // Loop through all the available categories in the database ussing a while loop
    while ($category = $execQuery->fetch_assoc()) {
        // Push the category into the categories array
        array_push($categories, $category);
    }


    $response = [
        'status' => 'success',
        'categories' => $categories // Pass the user information with the response
    ];

    // Echo the response
    echo json_encode($response);

?>