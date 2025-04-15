<?php
$title = 'Add User';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

if(isset($_POST['btn_add_user'])){
    include BASE_PATH . '/includes/DatabaseConnection.php';
    include BASE_PATH . '/includes/DatabaseFunction.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty(trim($username)) || empty(trim($email)) || empty(trim($password))) {
        $_SESSION['status'] = 'All fields are mandatory!';
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one uppercase letter!';
    } elseif (!preg_match('/[a-z]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one lowercase letter!';
    } elseif (!preg_match('/[0-9]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one number!';
    } elseif (!preg_match('/[\W_]/', $password)) {
        $_SESSION['status'] = 'Password must contain at least one special character!';  
    }else {
        $check_email = checkMail($pdo, $email);
        if ($check_email > 0) {
            $_SESSION['status'] = 'Email already exist!';
        } else{
            $run = addAccount($pdo, $username, $email, $password);

            if($run){
                $_SESSION['status'] = 'Add user successfull!';
                header('location: user-manage-code.php');
                exit();
            } else{
                $_SESSION['status'] = 'Add user failed!';
            }
        } 
    }
}

include BASE_PATH . '/templates/admin-temp/user-add.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/admin-layout.html.php';
?>