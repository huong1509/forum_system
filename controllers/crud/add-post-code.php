<?php
$title = 'Add Post'; // Set page title
session_start(); // Start session

if(!isset($_SESSION['authenticated'])){ // Check login
    $_SESSION['status'] = 'You need to login to write your post!';
    header('Location: ../auth/signin-code.php');
    exit(0);
}

include dirname(__DIR__, 2) . '/includes/config.php'; // Load config

ob_start();
include BASE_PATH . '/includes/DatabaseConnection.php'; // Connect to database
include BASE_PATH . '/includes/DatabaseFunction.php'; // Load database functions

$modules = allModule($pdo); // Get available modules

if(isset($_POST['btn_add_post'])){ // If add post button clicked

    // Handle image upload
    $target_dir = BASE_PATH . "/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check file type
    if (!in_array($imageFileType, $allowed)) {
        $_SESSION['status'] = 'Only JPG, JPEG, PNG & GIF files are allowed!';
        header('location: add-post-code.php');
        exit();
    }

    // Check if required fields are empty
    if (empty($_POST['post_text']) || empty($_POST['module']) || $_POST['module'] === "Select a module") {
        $_SESSION['status'] = 'All fields are mandatory!';
        header('location: add-post-code.php');
        exit();
    } else {
        // Add post to database
        $run = addPost($pdo, $_POST['post_title'], $_POST['post_text'], $_FILES['fileToUpload']['name'], $_POST['module'], $_SESSION['auth_account']['email']);
        include BASE_PATH . '/includes/uploadFile.php'; // Handle file upload

        if($run) { // Check if post was successfully added
            $_SESSION['status'] = 'Add new post successful!';
            header('Location: ../../index.php');
            exit();
        } else {
            $_SESSION['status'] = 'Something went wrong!'; // Error message
        }
    }
} 

include BASE_PATH . '/templates/crud-temp/add-post.html.php'; // Load add post page
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php'; // Load layout
?>
