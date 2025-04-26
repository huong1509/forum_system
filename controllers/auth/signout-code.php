<?php

session_start(); // Start session
unset($_SESSION['authenticated']); // Remove authentication flag
unset($_SESSION['auth_account']); // Remove user account data

$_SESSION['status'] = 'Sign out successfully!'; // Set sign out message

header('location: signin-code.php'); // Redirect to sign-in page
exit(); // Exit script
?>
