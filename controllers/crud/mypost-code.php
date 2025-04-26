<?php 
$title = 'My Post'; // Set page title

session_start(); // Start session

if(!isset($_SESSION['authenticated'])){ // Check if user is logged in
    $_SESSION['status'] = 'You need to login to see your post!';
    header('Location: ../auth/signin-code.php'); // Redirect if not logged in
    exit(0);
}

include dirname(__DIR__, 2) . '/includes/config.php'; // Load config

include BASE_PATH . '/includes/DatabaseConnection.php'; // Connect to database
include BASE_PATH . '/includes/DatabaseFunction.php'; // Load database functions

$posts = selectPosts($pdo, $_SESSION['auth_account']['email']); // Get user's posts

ob_start(); // Start output buffering
include BASE_PATH . '/templates/crud-temp/mypost.html.php'; // Load post template
$output = ob_get_clean(); // Store buffered content

include BASE_PATH . '/templates/layout.html.php'; // Load layout
?>
