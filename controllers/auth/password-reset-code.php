<?php 
$title = "Reset Password";
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

if(isset($_POST['btn_password_reset'])){
    include BASE_PATH . '/includes/DatabaseConnection.php';
    include BASE_PATH . '/includes/DatabaseAccount.php';

    $email = $_POST['email'];

    if (!empty(trim($email))) {
        $check_mail = checkMail($pdo, $email);
        if ($check_mail > 0) {
            header('location: password-change-code.php');
        } else{
            $_SESSION['status'] = 'Email is not found!';
        }
    } else {
        $_SESSION['status'] = 'All fields are mandatory!';
    }
}
include BASE_PATH . '/templates/auth-temp/password-reset.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';
?>
