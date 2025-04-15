<?php 
$title = 'My Post';

session_start();

if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to login to see your post!';
    header('Location: ../auth/signin-code.php');
    exit(0);
}

include dirname(__DIR__, 2) . '/includes/config.php';

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

$posts = selectPosts($pdo, $_SESSION['auth_account']['email']);

ob_start();
include BASE_PATH . '/templates/crud-temp/mypost.html.php';
$output = ob_get_clean();

include BASE_PATH . '/templates/layout.html.php';
?>