<?php 
$title = "Home Page"; // Set page title
session_start(); // Start session

include ('includes/config.php'); // Load config
include ('includes/DatabaseConnection.php'); // Connect to database
include ('includes/DatabaseFunction.php'); // Load database functions

$posts = allPosts($pdo); // Get all posts

ob_start(); // Start output buffering
include ('templates/home.html.php'); // Load home template
$output = ob_get_clean(); // Store buffered content

include ('templates/layout.html.php'); // Load layout
?>
