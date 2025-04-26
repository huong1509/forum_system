<?php

$title = 'Sign in'; // Page title
session_start(); // Start session

include dirname(__DIR__, 2) . '/includes/config.php'; // Include config

ob_start(); // Start output buffering

// Check if sign-in button is pressed
if(isset($_POST['btn_sign_in'])){

    $email = $_POST['email']; // Get email input
    $password = $_POST['password']; // Get password input

    // Check if email and password are not empty
    if(!empty(trim($email)) && !empty(trim($password))) {
        include BASE_PATH . '/includes/DatabaseConnection.php'; // Include DB connection
        include BASE_PATH . '/includes/DatabaseFunction.php'; // Include DB functions

        $account = selectMail($pdo, $email); // Get account details

        // Verify password with stored hash
        if (password_verify($password, $account["password_hash"])) {
            $_SESSION['authenticated'] = TRUE; // Set authentication flag
            $_SESSION['auth_account'] = [ // Store account data in session
                'username' => $account['username'],
                'role' => $account['role'],
                'email' => $account['email']
            ];

            $_SESSION['status'] = 'Sign In successful!'; // Set success message

            // Redirect based on user role
            switch ($account['role']) {
                case 'admin':
                    header('Location: /forum_system/controllers/admin-crud/admin-posts-code.php');
                    break;
                default:
                    header('Location: /forum_system/index.php');
            }
            exit(); // Exit after redirect
        } else {
            $_SESSION['status'] = 'Invalid email or password!'; // Invalid credentials
        }
    } else {
        $_SESSION['status'] = 'All fields are mandatory!'; // Missing input
    }
}

include BASE_PATH . '/templates/auth-temp/signin.html.php'; // Include sign-in template
$output = ob_get_clean(); // Clean output buffer
include BASE_PATH . '/templates/layout.html.php'; // Include layout template

?>
