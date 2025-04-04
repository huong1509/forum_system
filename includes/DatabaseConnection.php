<?php
    $host = 'localhost';
    $dbname = 'forum_system';
    $username = 'root';
    $pw = '';

    try{
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pw);
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        die('Database Connect Error: ' . $e->getMessage());
    }
?>