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

$modules = allModule($pdo);

if(isset($_POST['btn_add_post'])){

    $target_dir = BASE_PATH . "/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if (!in_array($imageFileType, $allowed)) {
            $_SESSION['status'] = 'Only JPG, JPEG, PNG & GIF files are allowed!';
            header('location: add-post-code.php');
            exit();
        }
    
    if (empty($_POST['post_text']) || empty($_POST['module']) || $_POST['module'] === "Select a module") {
        $_SESSION['status'] = 'All fields are mandatory!';
        header('location: add-post-code.php');
        exit();
    } else {
        $run = addPost($pdo, $_POST['post_title'], $_POST['post_text'], $_FILES['fileToUpload']['name'], $_POST['module'], $_SESSION['auth_account']['email']);
        include BASE_PATH . '/includes/uploadFile.php';
    
        if($run) {
            $_SESSION['status'] = 'Add new post successful!';
            header('Location: ../../index.php');
            exit();
        } else {
            $_SESSION['status'] = 'Something went wrong! ';
        }
    }
} 


include BASE_PATH . '/templates/crud-temp/add-post.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';
?>