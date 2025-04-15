<?php 
$title = "Home Page";
session_start();


include ('includes/config.php');

include ('includes/DatabaseConnection.php') ;
include ('includes/DatabaseFunction.php') ;

$posts = allPosts($pdo);

ob_start();

include ('templates/home.html.php');
$output = ob_get_clean();
include ('templates/layout.html.php' );

?>
