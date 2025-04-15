<?php
$title = 'Sign in';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

if(isset($_POST['btn_sign_in'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty(trim($email)) && !empty(trim($password))) {
        include BASE_PATH . '/includes/DatabaseConnection.php';
        include BASE_PATH . '/includes/DatabaseFunction.php';

        $account = selectMail($pdo, $email);

        if (password_verify($password, $account["password_hash"])) {
            $_SESSION['authenticated'] = TRUE;
            $_SESSION['auth_account'] = [
                'username' => $account['username'],
                'role' => $account['role'],
                'email' => $account['email']
                ];
            
            $_SESSION['status'] = 'Sign In successful!';

            switch ($account['role']) {
                case 'admin':
                    header('Location: /forum_system/controllers/admin-crud/admin-posts-code.php');
                    break;
                default:
                    header('Location: /forum_system/index.php');
            }
            exit();
        } else {
            $_SESSION['status'] = 'Invalid email or password!';
        }
    } else{
    $_SESSION['status'] = 'All field are mandetory!';
    }
}

include BASE_PATH . '/templates/auth-temp/signin.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';
?>