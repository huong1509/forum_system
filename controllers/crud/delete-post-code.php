<?php
$title = 'Delete Post'; // Set page title
session_start(); // Start session

include dirname(__DIR__, 2) . '/includes/config.php'; // Load config
include BASE_PATH . '/includes/DatabaseConnection.php'; // Connect to database
include BASE_PATH . '/includes/DatabaseFunction.php'; // Load database functions

if(isset($_POST['btn_delete'])){ // If delete button clicked

    $image = getImage($pdo, $_POST['id']); // Get image by post ID
    if(!empty($image['post_image'])){
        $filePath = BASE_PATH . "/uploads/" . $image['post_image'];
        if (file_exists($filePath)) {
            unlink($filePath); // Delete image file
        }
    }

    $run = deletePost($pdo, $_POST['id']); // Delete post

    if($run) {
        $_SESSION['status'] = 'Delete post successful!';
        header('location: mypost-code.php');
        exit();
    } else {
        $_SESSION['status'] = 'Something went wrong!';
    }
}

include BASE_PATH . '/templates/layout.html.php'; // Load layout
?>
