<?php

    include "connection.php";

    $action = $_POST['action'];

    // If action iss save_post, then save the post data to the database
    if ($action == 'save_post'){
        $cat_id = $_POST['category_id'];
        $title = $_POST['title'];
        $body = $_POST['body'];
        $image = null;
        // Call the Image Uploader if image is available on the request
        if (isset($_FILES['ft_image']) && $_FILES['ft_image'] != null) {
            $image = ImageUploader($_FILES['ft_image']);
        }
        
        // Adding the author manually
        $user_id = 2;

        $data_insertion = $conn->query("INSERT INTO tbl_posts(category_id, title, body, user_id, image) VALUES('$cat_id', '$title', '$body', $user_id, '$image')");

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

    // If action iss fetch_post, then query database and fetch all posts
    if ($action == 'fetch_post'){

        $sqlQuery = "SELECT * FROM tbl_posts ORDER BY posted_on DESC";
        $execQuery = $conn->query($sqlQuery);


        $posts = []; // Delare an Empty array for all post


        // Loop through all the available post in the database using a while loop
        while ($postRecord = $execQuery->fetch_assoc()) {
            // Store the user_id from the post record into a variable
            $user_id = $postRecord['user_id'];
            // Call the getUser method to fetch the author using the user_id
            $postRecord['author'] = getUserById($user_id, $conn);
            // Store the category_id from the post record into a variable
            $cat_id = $postRecord['category_id'];
            // Call the getCategory method to fetch the category using the category_id
            $postRecord['cat'] = getCategoryById($cat_id, $conn);
            // Push the post into the posts array
            array_push($posts, $postRecord);
        }

        $response = [
            'status' => 'success',
            'posts' => $posts // Pass the array of posts with the response
        ];

        // Echo the response
        echo json_encode($response);
    }









    // Functions
    function ImageUploader($file) {
        $name = $file['name'];
        $tmp_loc = $file['tmp_name'];
        $size = $file['size'];

        $filename =  time() . $name;
        $path = '../public/images/blogs/' . $filename;

        if (move_uploaded_file($tmp_loc, $path)) {
            return $filename;
        } else {
            return null;
        }
    }


    // Relationships functions
    function getUserById($id, $conn) {
        $userQuery = $conn->query("SELECT * FROM tbl_users WHERE id = '$id'");
        $user = $userQuery->fetch_assoc();
        return $user;
    }

    function getCategoryById($id, $conn) {
        $catQuery = $conn->query("SELECT * FROM tbl_category  WHERE id = '$id'");
        $category = $catQuery->fetch_assoc();
        return $category;
    }

?>