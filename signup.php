<?php

    include 'includes/DatabaseConnection.php';

    if(empty($_POST['name'])) {
        die('Name is required');
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        die('Valid email is required.');
    }

    if(strlen($_POST['password']) < 8) {
        die('Password must be at least 8 characters.');
    } else{

    }
    if(!preg_match("/[a-z]/i", $_POST['password'])){
        die('Password must contain at least one letter.');
    }

    if(!preg_match("/[0-9]/", $_POST['password'])){
        die('Password must contain at least one number.');
    }

    if($_POST['password'] !== $_POST['repeat_password']) {
        die('Password is not match');
    }

    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt_check_email = $pdo->prepare("SELECT COUNT(*) FROM account WHERE email = :email");
    $stmt_check_email->execute([':email' => $_POST['email']]);
    
    if ($stmt_check_email->fetch() > 0) {
        die('Email already exists.');
    }

    $sql = "INSERT INTO account (username, email, `password`, password_hash) VALUES (:username,:email,:password, :password_hash)";

    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(':username', $_POST['name']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':password', $_POST['password']);
    $stmt->bindValue(':password_hash', $password_hash);

    $stmt->execute();


    echo'sign up successful';

var_dump($password_hash);
?>