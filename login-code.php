<?php
$title = 'Sign in';
session_start();


ob_start();

if(isset($_POST['btn_login'])){
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseAccount.php';

        $account = selectMail($pdo, $_POST['email']);

        if (password_verify($_POST["password"], $account["password_hash"])) {
            $_SESSION['authenticated'] = TRUE;
            $_SESSION['auth_account'] = [
                'username' => $account['username'],
                'role' => $account['role']
                ];
            
            $_SESSION['status'] = 'Login successful!';
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['status'] = 'Invalid email or password!';
        }
    } else{
    $_SESSION['status'] = 'All field are mandetory!';
    }
}
include 'templates/login.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>