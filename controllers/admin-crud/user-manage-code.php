<?php
$title = 'User Management'; // Set page title
session_start(); // Start the session

// Check if the user is authenticated and has admin role
if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to be admin to access this!'; // Show error message
    header('Location: ../auth/admin-login-code.php'); // Redirect to admin login page
    exit(0);
}

include dirname(__DIR__, 2) . '/includes/config.php'; // Include config file
include BASE_PATH . '/includes/DatabaseConnection.php'; // Include DB connection
include BASE_PATH . '/includes/DatabaseFunction.php'; // Include DB functions

// Fetch all accounts from the database
$accounts = allAccount($pdo);

ob_start(); // Start output buffering
include BASE_PATH . '/templates/admin-temp/user-manage.html.php'; // Include the user management template
$output = ob_get_clean(); // Get the buffered content
include BASE_PATH . '/templates/admin-layout.html.php'; // Include the admin layout template

?>
