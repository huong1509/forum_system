<?php
$title = 'Add Module'; // Set the page title
session_start(); // Start the session to manage session data

// Include the configuration file and start output buffering
include dirname(__DIR__, 2) . '/includes/config.php';
ob_start(); // Start output buffering

// Check if the form is submitted to add a module
if(isset($_POST['btn_add_module'])){
    // Include necessary database connection and functions
    include BASE_PATH . '/includes/DatabaseConnection.php';
    include BASE_PATH . '/includes/DatabaseFunction.php';

    // Retrieve the module name from the form input
    $module = $_POST['module_name'];

    // Validate the form field
    if (empty(trim($module))) {
        $_SESSION['status'] = 'All fields are mandatory!'; // Set a session message if the field is empty
    } else {
        // Check if the module already exists in the database
        $check_module = checkModule($pdo, $module);
        if ($check_module > 0) {
            $_SESSION['status'] = 'Module already exist!'; // If the module exists, set a session message
        } else {
            // Add the new module to the database
            $run = addModule($pdo, $module);

            if($run){
                $_SESSION['status'] = 'Add module successful!'; // Set a success message if the module is added
                header('location: module-manage-code.php'); // Redirect to the module management page
                exit(); // Stop further code execution
            } else{
                $_SESSION['status'] = 'Add module failed!'; // Set a failure message if the module could not be added
            }
        } 
    }
}

// Include the module-add template to display the form
include BASE_PATH . '/templates/admin-temp/module-add.html.php';
$output = ob_get_clean(); // Capture the output of the template

// Include the admin layout template to render the page
include BASE_PATH . '/templates/admin-layout.html.php';
?>
