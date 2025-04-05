<?php

session_start();
if(isset($_POST['btn_sign_up'])){
    include 'includes/DatabaseConnection.php';

    if (empty(trim($_POST['name'])) || empty(trim($_POST['email'])) || empty(trim($_POST['password'])) || empty(trim($_POST['confirm_password']))) {
        $_SESSION['status'] = 'All fields are mandatory!';
        header('Location: signup.html.php');
        exit();
    }

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['status'] = 'Passwords do not match!';
        header('Location: signup.html.php');
        exit();
    }
    
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    #check mailmail
    $stmt_check_email = $pdo->prepare("SELECT COUNT(*) FROM account WHERE email = :email LIMIT 1");
    $stmt_check_email->bindValue(':email', $_POST['email']);
    $stmt_check_email->execute();
    
    if ($stmt_check_email->fetchColumn() > 0) {
        
        $_SESSION['status'] = 'Email already exist!';
        header('Location:signup.html.php');

    } else{
        #add info user

        $stmt = $pdo->prepare("INSERT INTO account (username, email, `password`, password_hash) VALUES (:username,:email,:password, :password_hash)");

        $stmt->bindValue(':username', $_POST['name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':password', $_POST['password']);
        $stmt->bindValue(':password_hash', $password_hash);
    
        $stmt->execute();
        

        if($stmt){
            $_SESSION['status'] = 'Sign up successful! Now, you can sign in.';
            header('Location:signup.html.php');
        } else{
            $_SESSION['status'] = 'Sign up failed!';
            header('Location:signup.html.php');
        }
    } 
}
?>