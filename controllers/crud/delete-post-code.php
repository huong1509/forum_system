<?php
$title = 'Delete Post';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

if(isset($_POST['btn_delete'])){

    $image = getImage($pdo, $_POST['id']);
    if(!empty($image['post_image'])){
        $filePath = BASE_PATH . "/uploads/" . $image['post_image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $run = deletePost($pdo, $_POST['id']);

    if($run) {
        $_SESSION['status'] = 'Delete post successful!';
        header('location: mypost-code.php');
        exit();
    } else {
        $_SESSION['status'] = 'Something went wrong!';
    }
}

include BASE_PATH . '/templates/layout.html.php';
?>