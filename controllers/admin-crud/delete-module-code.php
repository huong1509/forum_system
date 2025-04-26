<?php
$title = 'Delete Module'; // Title of the page
session_start(); // Start the session

include dirname(__DIR__, 2) . '/includes/config.php'; // Include the configuration settings

include BASE_PATH . '/includes/DatabaseConnection.php'; // Include the database connection file
include BASE_PATH . '/includes/DatabaseFunction.php'; // Include the database functions file

// Check if the form is submitted to delete a module
if(isset($_POST['btn_delete_module'])){
    
    // Call the deleteModule function to remove the module from the database
    $run = deleteModule($pdo, $_POST['id']);
    
    if($run) {
        $_SESSION['status'] = 'Delete Module successful!'; // Success message
        header('location: module-manage-code.php'); // Redirect to module management page
        exit(); // Exit the script
    } else {
        $_SESSION['status'] = 'Something went wrong!'; // Error message if deletion fails
    }
}

// Include the layout template
include BASE_PATH . '/templates/layout.html.php';
?>
