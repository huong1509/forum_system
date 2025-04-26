<?php 

$title = "UpdatePassword"; // Page title
session_start(); // Start session
include dirname(__DIR__, 2) . '/includes/config.php'; // Include config

ob_start(); // Start output buffering

// Check if password change button is pressed
if(isset($_POST['btn_password_change'])) {
    include BASE_PATH . '/includes/DatabaseConnection.php'; // Include DB connection
    include BASE_PATH . '/includes/DatabaseFunction.php'; // Include DB functions
    
    $email = $_POST['email']; // Get email input
    $password = $_POST['password']; // Get password input
    $confirm_password = $_POST['confirm_password']; // Get confirm password input

    // Validate input fields
    if (empty(trim($email)) || empty(trim($password)) || empty(trim($confirm_password))) {
        $_SESSION['status'] = 'All fields are mandatory!'; // Show error if any field is empty
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one uppercase letter!'; // Show error for no uppercase letter
    } elseif (!preg_match('/[a-z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one lowercase letter!'; // Show error for no lowercase letter
    } elseif (!preg_match('/[0-9]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one number!'; // Show error for no number
    } elseif (!preg_match('/[\W_]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one special character!'; // Show error for no special character
    } elseif ($password !== $confirm_password) {
        $_SESSION['status'] = 'Passwords do not match!'; // Show error if passwords don't match
    } else {
        // Check if email exists in the database
        $check_email = checkMail($pdo, $email);
        if ($check_email == 0) {
            $_SESSION['status'] = 'Email is not found!'; // Show error if email is not found
        } else {
            // Update password if email is found
            $run = updatePassword($pdo, $email, $password);
            
            if ($run) {
                $_SESSION['status'] = 'Update password complete!'; // Success message
                header('location: signin-code.php'); // Redirect to sign in page
                exit();
            } else {
                $_SESSION['status'] = 'Something went wrong!'; // Show error if password update fails
            }
        }
    }
}

include BASE_PATH . '/templates/auth-temp/password-change.html.php'; // Include password change template
$output = ob_get_clean(); // Clean output buffer
include BASE_PATH . '/templates/layout.html.php'; // Include layout template

?>
