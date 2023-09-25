<?php
    $arr = array();
    foreach (getallheaders() as $name => $value) {
        array_push($arr, [$name ."" => "$value\n"]);
    }


    header('HTTP/ 422 Unprocessed entity');
    echo json_encode($arr);
?>