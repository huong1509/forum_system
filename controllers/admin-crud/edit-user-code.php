<?php
$title = 'Edit Post';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

$account = getAccount($pdo, $_GET['id']);

if(isset($_POST['btn_edit_user'])){

    if (empty(trim($_POST['new_username'])) || empty(trim($_POST['new_email'])) || empty(trim($_POST['new_role']))) {
        $_SESSION['status'] = 'All fields are mandatory!';
        header('location: user-manage-code.php');
        exit();
    } else {
        
        $check_email = checkMail($pdo, $_POST['new_email'], $_GET['id']);

        if ($check_email > 0) {
            $_SESSION['status'] = 'Email already exist!';
            header('location: user-manage-code.php');
            exit();
        } else{

        $run = updateAccount($pdo,$_POST['account_id'] ,$_POST['new_username'], $_POST['new_email'], $_POST['new_role']);

        if($run) {
            $_SESSION['status'] = 'Update account successful!';
            header('location: user-manage-code.php');
            exit();
        } else {
            $_SESSION['status'] = 'Something went wrong!';
            header('location: user-manage-code.php');
            exit();
            }
        }
    }
}



include BASE_PATH . '/templates/admin-temp/user-edit.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/admin-layout.html.php';
?>