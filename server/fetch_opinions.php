<?php 

    include "connection.php";
    // Decalre an empty array of opinions
    $opnionArray = [];

    // Query the database table for all opinions
    $sqlResult = $conn->query("SELECT * FROM tbl_opinions ORDER BY date_added DESC");

    // extract the opinions from the sql result into the opinion array
    while ($opinion = $sqlResult->fetch_assoc()) {
        array_push($opnionArray, $opinion);
    }

    if (count($opnionArray) > 0) {
        $response = [
            'status' => 'success',
            'opinions' => $opnionArray,
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