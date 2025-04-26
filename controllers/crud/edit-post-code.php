<?php
$title = 'Edit Post';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

$post = getPost($pdo, $_GET['id']);
$modules = allModule($pdo);

if(isset($_POST['btn_save'])){
    $old_image = $_POST['post_image'];
    $new_image = $_FILES['fileToUpload']['name'];

    if($new_image != ''){
        $update_image = $new_image;
    } else {
        $update_image = $old_image;
    }

    if($new_image != '') {
        if(file_exists(BASE_PATH . "/uploads/" . $new_image)){
            $filename = $new_image;
            $_SESSION['status'] = 'Image already exist!' . $filename;
            header('location: mypost-code.php');
            exit();
        }

        $target_dir = BASE_PATH . "/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if (!in_array($imageFileType, $allowed)) {
            $_SESSION['status'] = 'Only JPG, JPEG, PNG & GIF files are allowed!';
            header('location: edit-post-code.php?id=' . $post['id']);
            exit();
        }
    } 

        $run = updatePost($pdo, $_POST['post_id'] , $_POST['post_title'], $_POST['post_text'], $update_image, $_POST['module']);

        if($run) {

            if($new_image != ''){
                include BASE_PATH . '/includes/uploadFile.php';
                $image = BASE_PATH . "/uploads/" . $old_image;
                if (file_exists($image)) {
                unlink($image);
                }
            }

            $_SESSION['status'] = 'Update post successful!';
            header('location: mypost-code.php');
            exit();
        } else {
            $_SESSION['status'] = 'Something went wrong!';
            header('location: edit-post-code.php?id=' . $post['id']);
            exit();
        }
    }


include BASE_PATH . '/templates/crud-temp/edit-post.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';
?>