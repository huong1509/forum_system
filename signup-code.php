<?php
$title = 'Sign Up';
session_start();
ob_start();

if(isset($_POST['btn_sign_up'])){
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseAccount.php';

    if (empty(trim($_POST['username'])) || empty(trim($_POST['email'])) || empty(trim($_POST['password'])) || empty(trim($_POST['confirm_password']))) {
        $_SESSION['status'] = 'All fields are mandatory!';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['status'] = 'Passwords do not match!';
    } else {
        $check_email = checkMail($pdo, $_POST['email']);
        if ($check_email > 0) {
            $_SESSION['status'] = 'Email already exist!';
        } else{
            $run = addAccount($pdo, $_POST['username'], $_POST['email'], $_POST['password']);

            if($run){
                $_SESSION['status'] = 'Sign up successful! Now, you can sign in.';
                
            } else{
                $_SESSION['status'] = 'Sign up failed!';
            }
        } 
    }
}

include 'templates/signup.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>