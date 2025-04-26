<?php
$title = 'Comment Post'; // Set the page title
session_start(); // Start the session to manage session data

// Check if the user is logged in (authenticated)
if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to login to comment this post!'; // Set session message for non-logged-in users
    header('Location: ../auth/signin-code.php'); // Redirect to login page
    exit(0);
}

// Include necessary configuration and database connection files
include dirname(__DIR__, 2) . '/includes/config.php';

ob_start(); // Start output buffering

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

// Get the post and its associated comments
$post = getPost($pdo, $_GET['id']);
$comments = allComments($pdo, $_GET['id']);

// Handle the comment form submission
if(isset($_POST['btn_comment'])){
    // Add the comment using the `addComment` function
    $run = addComment($pdo, $_POST['comment_text'], $_GET['id'], $_SESSION['auth_account']['email']);
    
    // After adding the comment, redirect back to the comment management page for this post
    header('location: admin-comment-code.php?id=' . $post['id']);
    exit(); // Ensure no further code is executed after the redirect
}

// Include the template for the comment management page
include BASE_PATH . '/templates/admin-temp/admin-comment.html.php';

// Capture the output of the template and store it in `$output`
$output = ob_get_clean();

// Include the admin layout template
include BASE_PATH . '/templates/admin-layout.html.php';
?>
