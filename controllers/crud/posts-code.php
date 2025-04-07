<?php
$title = 'All Post';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabasePost.php';

$posts = allPosts($pdo);

ob_start();
include BASE_PATH . '/templates/crud-temp/posts.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';

?>
