<?php
$title = 'Comment Post';
session_start();

if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to login to comment this post!';
    header('Location: ../auth/signin-code.php');
    exit(0);
}

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

$post = getPost($pdo, $_GET['id']);
$comments = allComments($pdo, $_GET['id']);

if(isset($_POST['btn_comment'])){
    $run = addComment($pdo,$_POST['comment_text'],$_GET['id'], $_SESSION['auth_account']['email']);
    header('location: admin-comment-code.php?id=' . $post['id']);
} 


include BASE_PATH . '/templates/admin-temp/admin-comment.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/admin-layout.html.php';
?>