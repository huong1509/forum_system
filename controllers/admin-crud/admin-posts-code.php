<?php
$title = 'Public Post';
session_start();

if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to be admin to access this!';
    header('Location: ../auth/admin-login-code.php');
    exit(0);
}

include dirname(__DIR__, 2) . '/includes/config.php';

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

$posts = allPosts($pdo);

ob_start();
include BASE_PATH . '/templates/crud-temp/admin-posts.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/admin-layout.html.php';

?>
