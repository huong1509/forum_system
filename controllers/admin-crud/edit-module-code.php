<?php
$title = 'Edit Module'; // Title of the page
session_start(); // Start the session

include dirname(__DIR__, 2) . '/includes/config.php'; // Include configuration settings

ob_start(); // Start output buffering

include BASE_PATH . '/includes/DatabaseConnection.php'; // Include the database connection file
include BASE_PATH . '/includes/DatabaseFunction.php'; // Include the database functions file

// Check if the form is submitted to edit the module
if(isset($_POST['btn_edit_module'])){

    // Validate that the new module name is not empty
    if (empty(trim($_POST['new_module']))) {
        $_SESSION['status'] = 'All fields are mandatory!'; // Set error message if fields are empty
        header('location: module-manage-code.php'); // Redirect back to the module management page
        exit(); // Exit the script
    } else {
        // Check if the module already exists in the database
        $check_module = checkModule($pdo, $_POST['new_module']);
        
        if ($check_module > 0) {
            $_SESSION['status'] = 'Module already exist!'; // Set error message if module already exists
            header('location: module-manage-code.php'); // Redirect back
            exit(); // Exit the script
        } else {
            // Proceed to update the module in the database
            $run = updateModule($pdo, $_POST['module_id'], $_POST['new_module']);
            
            if($run) {
                $_SESSION['status'] = 'Edit module successful!'; // Success message
                header('location: module-manage-code.php'); // Redirect to module management page
                exit(); // Exit the script
            } else {
                $_SESSION['status'] = 'Something went wrong!'; // Error message
                header('location: module-manage-code.php'); // Redirect back
                exit(); // Exit the script
            }
        }
    }
} else {
    // If the form is not submitted, fetch the module details to display in the form
    $module = getModule($pdo, $_GET['id']);
}

// Include the module edit form template
include BASE_PATH . '/templates/admin-temp/module-edit.html.php';
$output = ob_get_clean(); // Get the buffered content
include BASE_PATH . '/templates/admin-layout.html.php'; // Include the admin layout template
?>
