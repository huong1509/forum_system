<?php

session_start();
unset($_SESSION['authenticated']);
unset($_SESSION['auth_account']);

$_SESSION['status'] = 'Sign out successfully!';

header('location: signin-code.php');
exit();
?>