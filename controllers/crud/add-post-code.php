<?php
$title = 'Add Post';

session_start();

if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to login to write your post!';
    header('Location: ../auth/signin-code.php');
    exit(0);
}

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

if(isset($_POST['btn_add_post'])){
    
    if (empty(trim($_POST['post_text'])) || empty($_POST['module']) || $_POST['module'] === "Select a module") {
        $_SESSION['status'] = 'All fields are mandatory!';
    } else {
        $run = addPost($pdo, $_POST['post_text'], $_FILES['fileToUpload']['name'],$_POST['module'], $_SESSION['auth_account']['email']);
        include BASE_PATH . '/includes/uploadFile.php';
    
        if($run) {
            $_SESSION['status'] = 'Add new post successful!';
            header('Location: ../../index.php');
            exit();
        } else {
            $_SESSION['status'] = 'Something went wrong! ';
        }
    }
} else {
    $modules = allModule($pdo);
}

include BASE_PATH . '/templates/crud-temp/add-post.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';
?>