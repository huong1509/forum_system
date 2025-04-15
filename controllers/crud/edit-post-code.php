<?php
$title = 'Edit Post';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

if(isset($_POST['btn_save'])){

    if (empty($_POST['module']) || $_POST['module'] === "Select a module") {
        $_SESSION['status'] = 'All fields are mandatory!';
    } else {

        $run = updatePost($pdo,$_POST['post_id'] ,$_POST['post_text'], $_POST['image'], $_POST['module']);
        if($run) {
            $_SESSION['status'] = 'Update post successful!';
            header('location: mypost-code.php');
            exit();
        } else {
            $_SESSION['status'] = 'Something went wrong!';
        }
    }
} else {
    $modules = allModule($pdo);
    $post = getPost($pdo, $_GET['id']);
}

include BASE_PATH . '/templates/crud-temp/edit-post.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';
?>