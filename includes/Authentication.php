<?php
session_start();

if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to login to see your post!';
    header('Location: ../auth/login-code.php');
    exit(0);
}
?>