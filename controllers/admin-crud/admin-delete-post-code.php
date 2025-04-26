<?php
$title = 'Delete Post'; // Set the page title
session_start(); // Start the session to handle session data

// Include the necessary configuration and database connection files
include dirname(__DIR__, 2) . '/includes/config.php';
include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

// Check if the delete button is clicked
if(isset($_POST['btn_delete'])){

    // Call the deletePost function to delete the post from the database
    $run = deletePost($pdo, $_POST['id']); // Assuming the post ID is sent in the POST request

    // Check if the delete operation was successful
    if($run) {
        $_SESSION['status'] = 'Delete successful!'; // Set a session message indicating success
        header('location: admin-posts-code.php'); // Redirect back to the posts management page
        exit();
    } else {
        $_SESSION['status'] = 'Something went wrong!'; // Set a session message indicating failure
    }
}

// Include the main layout template (this might include header, footer, etc.)
include BASE_PATH . '/templates/admin-layout.html.php';
?>
