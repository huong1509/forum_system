<?php 

$title = "Reset Password"; // Page title
session_start(); // Start session

include dirname(__DIR__, 2) . '/includes/config.php'; // Include config

ob_start(); // Start output buffering

// Check if reset button is pressed
if(isset($_POST['btn_password_reset'])){
    include BASE_PATH . '/includes/DatabaseConnection.php'; // Include DB connection
    include BASE_PATH . '/includes/DatabaseFunction.php'; // Include DB functions

    $email = $_POST['email']; // Get email input

    // Check if email is not empty
    if (!empty(trim($email))) {
        $check_mail = checkMail($pdo, $email); // Check if email exists in DB
        if ($check_mail > 0) {
            header('location: password-change-code.php'); // Redirect if email exists
        } else {
            $_SESSION['status'] = 'Email is not found!'; // Show error if email not found
        }
    } else {
        $_SESSION['status'] = 'All fields are mandatory!'; // Show error if email is empty
    }
}

include BASE_PATH . '/templates/auth-temp/password-reset.html.php'; // Include password reset template
$output = ob_get_clean(); // Clean output buffer
include BASE_PATH . '/templates/layout.html.php'; // Include layout template

?>
