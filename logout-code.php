<?php

session_start();
unset($_SESSION['authenticated']);
unset($_SESSION['auth_account']);

$_SESSION['status'] = 'You are log out successfully!';

header('location: index.php');
?>