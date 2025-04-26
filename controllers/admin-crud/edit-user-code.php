<?php
$title = 'Edit Post'; // Title of the page
session_start(); // Start the session

include dirname(__DIR__, 2) . '/includes/config.php'; // Include configuration settings

ob_start(); // Start output buffering

include BASE_PATH . '/includes/DatabaseConnection.php'; // Include the database connection file
include BASE_PATH . '/includes/DatabaseFunction.php'; // Include the database functions file

// Retrieve the account details based on the user ID passed through the URL
$account = getAccount($pdo, $_GET['id']);

// Check if the form is submitted to edit the user
if(isset($_POST['btn_edit_user'])){

    // Validate that all necessary fields are filled
    if (empty(trim($_POST['new_username'])) || empty(trim($_POST['new_email'])) || empty(trim($_POST['new_role']))) {
        $_SESSION['status'] = 'All fields are mandatory!'; // Set an error message
        header('location: user-manage-code.php'); // Redirect back to the user management page
        exit(); // Exit the script
    } else {
        
        // Check if the new email already exists in the system for a different user
        $check_email = checkMail($pdo, $_POST['new_email'], $_GET['id']);
        if ($check_email > 0) {
            $_SESSION['status'] = 'Email already exist!'; // Set error message if email already exists
            header('location: user-manage-code.php'); // Redirect back to the user management page
            exit(); // Exit the script
        } else {
            // Proceed to update the user account in the database
            $run = updateAccount($pdo, $_POST['account_id'], $_POST['new_username'], $_POST['new_email'], $_POST['new_role']);
            
            if($run) {
                $_SESSION['status'] = 'Update account successful!'; // Success message
                header('location: user-manage-code.php'); // Redirect to the user management page
                exit(); // Exit the script
            } else {
                $_SESSION['status'] = 'Something went wrong!'; // Error message
                header('location: user-manage-code.php'); // Redirect back
                exit();
            }
        }
    }
}

// Include the user edit form template
include BASE_PATH . '/templates/admin-temp/user-edit.html.php';
$output = ob_get_clean(); // Get the buffered content
include BASE_PATH . '/templates/admin-layout.html.php'; // Include the admin layout template
?>
