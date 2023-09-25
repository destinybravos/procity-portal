<?php 

    $authorized = false;
    $authorized_user = null;

    include_once "connection.php";

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

            $authorized = true;
            $authorized_user = getUserById($user_id, $conn);
            
        } else {
            // If it doesn't exist
            header('HTTP/1.0 401 Unauthorized');
        }
    } else{
        header('HTTP/1.0 401 Unauthorized');
    }


     // Relationships functions
     function getUserById($id, $conn) {
        $userQuery = $conn->query("SELECT * FROM tbl_users WHERE id = '$id'");
        $user = $userQuery->fetch_assoc();
        return $user;
    }

?>