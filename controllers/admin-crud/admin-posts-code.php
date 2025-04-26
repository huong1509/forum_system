<?php
$title = 'Public Post'; // Title of the page
session_start(); // Start the session

// Check if the user is authenticated (admin role)
if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to be admin to access this!'; // Set a session status if not authenticated
    header('Location: ../auth/admin-login-code.php'); // Redirect to admin login page
    exit(0); // Stop further script execution
}

include dirname(__DIR__, 2) . '/includes/config.php'; // Include the config file for global settings

include BASE_PATH . '/includes/DatabaseConnection.php'; // Include database connection
include BASE_PATH . '/includes/DatabaseFunction.php'; // Include database functions

// Fetch all posts using the function `allPosts()` defined in DatabaseFunction.php
$posts = allPosts($pdo);

// Start output buffering to capture the page content
ob_start();

// Include the template for displaying the posts in the admin layout
include BASE_PATH . '/templates/crud-temp/admin-posts.html.php';

// Capture the output and store it in the `$output` variable
$output = ob_get_clean();

// Include the main layout template that will wrap the content (header, footer, etc.)
include BASE_PATH . '/templates/admin-layout.html.php';
?>
