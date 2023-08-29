<?php

// Supposing we are using Javascript; The commented code below is correct
// let stats = {
//     rating : {
//         icon : "<i class='fa fa-plus'></i>",
//         data : 40.9,
//         message : "lorem ipsum dolor sit amet, consectetur adipis"
//     }
// }

// But in PHP, We used an associative array instead. Example below shows it;
    $stats = [
        "rating" => [
            "icon" => "<i class='fa fa-plus'></i>",
            "data" => 40.9,
            "message" => "lorem ipsum dolor sit amet, consectetur adipis"
        ],
        "courses" => [
            "icon" => "<i class='fa fa-plus'></i>",
            "data" => 23,
            "message" => "lorem ipsum dolor sit amet, consectetur adipis"
        ],
        "students" => [
            "icon" => "<i class='fa fa-plus'></i>",
            "data" => 250,
            "message" => "lorem ipsum dolor sit amet, consectetur adipis"
        ]
    ];

    // Coverting to a Json String before returning it to the caller|frontend
    echo json_encode($stats);

?>