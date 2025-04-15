<?php
$title = 'Delete Module';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

if(isset($_POST['btn_delete_module'])){

    $run = deleteModule($pdo, $_POST['id']);

    if($run) {
        $_SESSION['status'] = 'Delete Module successful!';
        header('location: module-manage-code.php');
        exit();
    } else {
        $_SESSION['status'] = 'Something went wrong!';
    }
}

include BASE_PATH . '/templates/layout.html.php';
?>