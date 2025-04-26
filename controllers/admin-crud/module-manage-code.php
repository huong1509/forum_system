<?php
$title = 'Module Management'; // Set the page title
session_start(); // Start the session

// Check if the user is authenticated as an admin
if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to be admin to access this!'; // Set an error message if not authenticated
    header('Location: ../auth/admin-login-code.php'); // Redirect to the admin login page
    exit(0); // Exit the script
}

include dirname(__DIR__, 2) . '/includes/config.php'; // Include the configuration file
include BASE_PATH . '/includes/DatabaseConnection.php'; // Include the database connection file
include BASE_PATH . '/includes/DatabaseFunction.php'; // Include the database functions file

// Fetch all modules from the database
$modules = allModule($pdo);

ob_start(); // Start output buffering
include BASE_PATH . '/templates/admin-temp/module-manage.html.php'; // Include the module management template
$output = ob_get_clean(); // Get the buffered content
include BASE_PATH . '/templates/admin-layout.html.php'; // Include the admin layout template

?>
