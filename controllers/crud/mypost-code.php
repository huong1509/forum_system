<?php 
$title = 'My Post';
include dirname(__DIR__, 2) . '/includes/Authentication.php';

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();
include BASE_PATH . '/templates/mypost.html.php';
$output = ob_get_clean();

include BASE_PATH . '/templates/layout.html.php';
?>