<?php 
$title = "UpdatePassword";
session_start();
include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

if(isset($_POST['btn_password_change'] )){
    include BASE_PATH . '/includes/DatabaseConnection.php';
    include BASE_PATH . '/includes/DatabaseFunction.php';
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty(trim($email)) || empty(trim($password)) || empty(trim($confirm_password))) {
        $_SESSION['status'] = 'All fields are mandatory!';
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one uppercase letter!';
    } elseif (!preg_match('/[a-z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one lowercase letter!';
    } elseif (!preg_match('/[0-9]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one number!';
    } elseif (!preg_match('/[\W_]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one special character!';
    } elseif ($password !== $confirm_password) {
        $_SESSION['status'] = 'Passwords do not match!';

    } else{
        $check_email = checkMail($pdo, $email);
        if ($check_email == 0) {
            $_SESSION['status'] = 'Email is not found!';
        } else{
            $run = updatePassword($pdo, $email,$password);

            if($run) {
                $_SESSION['status'] = 'Update password complete!';
                header('location: signin-code.php');
                exit();
            } else {
                $_SESSION['status'] = 'Something went wrong!';
            }
        }
    }
} 
include BASE_PATH . '/templates/auth-temp/password-change.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';
?>
