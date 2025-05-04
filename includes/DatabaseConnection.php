<?php
// Set the database connection details
    $host = 'localhost';
    $dbname = 'forum_system';
    $username = 'root';
    $pw = '';

    try{
        // Try to establish a connection to the database using PDO (PHP Data Objects)
        // The PDO constructor uses the MySQL connection string format: "mysql:host=hostname;dbname=database"
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pw);
    } catch (PDOException $e) {
        // Catch any PDO exceptions (errors during database connection)
        // If an error occurs, set the page title and display a message indicating the error
        $title = 'An error has occurred';
        die('Database Connect Error: ' . $e->getMessage());
    }
?>
