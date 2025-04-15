<?php
$title = 'Delete Post';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

if(isset($_POST['btn_delete'])){

    $run = deletePost($pdo, $_POST['id']);

    if($run) {
        $_SESSION['status'] = 'Delete successful!';
        header('location: admin-posts-code.php');
        exit();
    } else {
        $_SESSION['status'] = 'Something went wrong!';
    }
}

include BASE_PATH . '/templates/admin-layout.html.php';
?>