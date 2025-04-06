<?php 
$title = "Reset Password";
session_start();

ob_start();

if(isset($_POST['btn_password_reset'])){
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseAccount.php';

    if (!empty(trim($_POST['email']))) {
        $check_mail = checkMail($pdo, $_POST['email']);
        if ($check_mail > 0) {
            header('location:password-change-code.php');
        } else{
            $_SESSION['status'] = 'Email is not found!';
        }
    } else {
        $_SESSION['status'] = 'All fields are mandatory!';
    }
}
include 'templates/password-reset.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
