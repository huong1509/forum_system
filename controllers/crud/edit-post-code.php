<?php
$title = 'Edit Post';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

if(isset($_POST['btn_sign_up'])){
    include BASE_PATH . '/includes/DatabaseConnection.php';
    include BASE_PATH . '/includes/DatabasePost.php';


}

include BASE_PATH . '/templates/crud-temp/edit-post.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/layout.html.php';
?>