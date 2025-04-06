<?php 
    $title = "Home Page";
session_start();
ob_start();
include 'templates/home.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';
?>
