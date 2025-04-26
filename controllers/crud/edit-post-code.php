<?php
$title = 'Edit Post'; // Set page title
session_start(); // Start session

include dirname(__DIR__, 2) . '/includes/config.php'; // Load config
ob_start(); // Start output buffering

include BASE_PATH . '/includes/DatabaseConnection.php'; // Connect to database
include BASE_PATH . '/includes/DatabaseFunction.php'; // Load database functions

$post = getPost($pdo, $_GET['id']); // Get post by ID
$modules = allModule($pdo); // Get all modules

if(isset($_POST['btn_save'])){ // If save button clicked
    $old_image = $_POST['post_image'];
    $new_image = $_FILES['fileToUpload']['name'];

    // Check for new image
    if($new_image != ''){
        $update_image = $new_image;
    } else {
        $update_image = $old_image;
    }

    // Validate and upload new image
    if($new_image != '') {
        if(file_exists(BASE_PATH . "/uploads/" . $new_image)){
            $_SESSION['status'] = 'Image already exist!';
            header('location: mypost-code.php');
            exit();
        }

        $target_dir = BASE_PATH . "/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if (!in_array($imageFileType, $allowed)) {
            $_SESSION['status'] = 'Only image files allowed!';
            header('location: edit-post-code.php?id=' . $post['id']);
            exit();
        }
    }

    // Update post
    $run = updatePost($pdo, $_POST['post_id'], $_POST['post_title'], $_POST['post_text'], $update_image, $_POST['module']);

    if($run) {
        if($new_image != ''){
            include BASE_PATH . '/includes/uploadFile.php'; // Upload file
            $image = BASE_PATH . "/uploads/" . $old_image;
            if (file_exists($image)) {
                unlink($image); // Delete old image
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

include BASE_PATH . '/templates/crud-temp/edit-post.html.php'; // Load edit post template
$output = ob_get_clean(); // Store buffered content
include BASE_PATH . '/templates/layout.html.php'; // Load layout
?>
