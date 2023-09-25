<?php
    include "connection.php";

    $headers = getallheaders();
    // Check headers has Authorization parameter
    if (isset($headers['Authorization']) && $headers['Authorization'] !== '' && $headers['Authorization'] !== null) {
        // If the Authorization header exists, extract the token from the Authorization header
        $token = $headers['Authorization'];
        // Check if the token exists on the database
        $sqlCheckQuery = "SELECT * FROM tbl_access_token WHERE token = '$token'";
        $execQuery = $conn->query($sqlCheckQuery);

        // Check How many rows have the data. If it greater than 0, that means it exists already.
        if ($execQuery->num_rows > 0) {
            // get the user id from the query result
            $queryResult = $execQuery->fetch_assoc();
            $user_id = $queryResult['user_id'];
            $user = getUserById($user_id, $conn);

            // Get the dashboard statistics
            header('HTTP/1.0 200');
            $response = [
                'status' => 'success',
                'user' => $user,
                'no_user' => getNoUsers($conn),
                'no_categories' => getNoCategories($conn),
                'no_posts' => getNoPost($conn),
            ];
        } else {
            // If it doesn't exist
            header('HTTP/1.0 401 Unauthorized');
            $response = [
                'status' => 'failed',
                'message' => "Unauthorized access! ",
            ];
        }
    } else{
        header('HTTP/1.0 401 Unauthorized');
        $response = [
            'status' => 'failed',
            'message' => "Unauthorized access! ",
        ];
    }

    echo json_encode($response);


     // Relationships functions
     function getUserById($id, $conn) {
        $userQuery = $conn->query("SELECT * FROM tbl_users WHERE id = '$id'");
        $user = $userQuery->fetch_assoc();
        return $user;
    }

    // Fetch number of users
    function getNoUsers($conn) {
        $userQuery = $conn->query("SELECT * FROM tbl_users");
        return $userQuery->num_rows;
    }

    function getNoCategories($conn) {
        $userQuery = $conn->query("SELECT * FROM tbl_category");
        return $userQuery->num_rows;
    }

    function getNoPost($conn) {
        $userQuery = $conn->query("SELECT * FROM tbl_posts");
        return $userQuery->num_rows;
    }

?>