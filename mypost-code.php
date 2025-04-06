<?php 
$title = 'My Post';
include('includes/Authentication.php');

ob_start();
include 'templates/mypost.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';
?>