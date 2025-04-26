<?php
$title = 'Sign Up'; // Set page title
session_start(); // Start session

include dirname(__DIR__, 2) . '/includes/config.php'; // Include config

ob_start();

if(isset($_POST['btn_sign_up'])){ // If sign up button clicked
    include BASE_PATH . '/includes/DatabaseConnection.php'; // DB connection
    include BASE_PATH . '/includes/DatabaseFunction.php'; // DB functions

    // Get user input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty(trim($username)) || empty(trim($email)) || empty(trim($password)) || empty(trim($confirm_password))) {
        $_SESSION['status'] = 'All fields are mandatory!';
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one uppercase letter!';
    } elseif (!preg_match('/[0-9]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one number!';
    } elseif (!preg_match('/[\W_]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one special character!';
    } elseif ($password !== $confirm_password) {
        $_SESSION['status'] = 'Passwords do not match!';
    } else {
        $check_email = checkMail($pdo, $email); // Check if email exists
        if ($check_email > 0) {
            $_SESSION['status'] = 'Email already exist!';
        } else {
            $run = addAccount($pdo, $username, $email, $password); // Add account to DB

            if($run){ // Check if account creation was successful
                $_SESSION['status'] = 'Sign up successful! Now, you can sign in.';
                header('location: signin-code.php'); // Redirect to sign in page
                exit();
            } else{
                $_SESSION['status'] = 'Sign up failed!'; // Error message
            }
        } 
    }
}

include BASE_PATH . '/templates/auth-temp/signup.html.php'; // Include sign-up form template
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php'; // Load layout
?>
