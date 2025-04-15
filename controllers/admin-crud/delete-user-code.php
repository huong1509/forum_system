<?php
$title = 'Delete User';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

if(isset($_POST['btn_delete_user'])){

    $run = deleteAccount($pdo, $_POST['id']);

    if($run) {
        $_SESSION['status'] = 'Delete user successful!';
        header('location: user-manage-code.php');
        exit();
    } else {
        $_SESSION['status'] = 'Something went wrong!';
    }
}

include BASE_PATH . '/templates/layout.html.php';
?>