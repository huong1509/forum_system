<?php 
$title = "UpdatePassword";
session_start();
ob_start();

if(isset($_POST['btn_password_change'] )){
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseAccount.php';
    
    if (empty(trim($_POST['email'])) || empty(trim($_POST['password'])) || empty(trim($_POST['confirm_password']))) {
        $_SESSION['status'] = 'All fields are mandatory!';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['status'] = 'Passwords do not match!';
    } else{
        $check_email = checkMail($pdo, $_POST['email']);
        if ($check_email == 0) {
            $_SESSION['status'] = 'Email is not found!';
        } else{
            $run = updatePassword($pdo, $_POST['email'],$_POST['password']);

            if($run) {
                $_SESSION['status'] = 'Update password complete!';
                header('location: login-code.php');
                exit();
            } else {
                $_SESSION['status'] = 'Something went wrong!';
            }
        }
    }
} 
include 'templates/password-change.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
