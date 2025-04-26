<?php
$title = 'Comment Post'; // Set page title
session_start(); // Start session

if(!isset($_SESSION['authenticated'])){ // Check login
    $_SESSION['status'] = 'You need to login to comment this post!';
    header('Location: ../auth/signin-code.php');
    exit(0);
}

include dirname(__DIR__, 2) . '/includes/config.php'; // Load config

ob_start();

include BASE_PATH . '/includes/DatabaseConnection.php'; // Connect to database
include BASE_PATH . '/includes/DatabaseFunction.php'; // Load database functions

$post = getPost($pdo, $_GET['id']); // Get post details
$comments = allComments($pdo, $_GET['id']); // Get comments

if(isset($_POST['btn_comment'])){ // If comment button clicked
    $run = addComment($pdo,$_POST['comment_text'],$_GET['id'], $_SESSION['auth_account']['email']);
    header('location: comment-code.php?id=' . $post['id']);
} 

include BASE_PATH . '/templates/crud-temp/comment.html.php'; // Load comment page
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php'; // Load layout
?>
