<?php
$title = 'Add User'; // Set the page title
session_start(); // Start the session to manage session data

// Include the configuration file and start output buffering
include dirname(__DIR__, 2) . '/includes/config.php';
ob_start(); // Start output buffering

// Check if the form is submitted to add a user
if(isset($_POST['btn_add_user'])){
    // Include the necessary database connection and functions
    include BASE_PATH . '/includes/DatabaseConnection.php';
    include BASE_PATH . '/includes/DatabaseFunction.php';

    // Retrieve the form input data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form fields
    if (empty(trim($username)) || empty(trim($email)) || empty(trim($password))) {
        $_SESSION['status'] = 'All fields are mandatory!'; // Set a session message if fields are empty
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one uppercase letter!'; // Password strength check
    } elseif (!preg_match('/[a-z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one lowercase letter!'; // Password strength check
    } elseif (!preg_match('/[0-9]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one number!'; // Password strength check
    } elseif (!preg_match('/[\W_]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one special character!'; // Password strength check
    } else {
        // Check if the email already exists in the database
        $check_email = checkMail($pdo, $email);
        if ($check_email > 0) {
            $_SESSION['status'] = 'Email already exist!'; // If email already exists, set a session message
        } else{
            // Add the new account to the database
            $run = addAccount($pdo, $username, $email, $password);

            if($run){
                $_SESSION['status'] = 'Add user successful!'; // Set a success message if the user is added
                header('location: user-manage-code.php'); // Redirect to the user management page
                exit(); // Stop further code execution
            } else{
                $_SESSION['status'] = 'Add user failed!'; // Set a failure message if the user could not be added
            }
        } 
    }
}

// Include the user-add template to display the form
include BASE_PATH . '/templates/admin-temp/user-add.html.php';
$output = ob_get_clean(); // Capture the output of the template

// Include the admin layout template to render the page
include BASE_PATH . '/templates/admin-layout.html.php';
?>
