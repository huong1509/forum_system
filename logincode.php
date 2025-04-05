<?php
session_start();

if(isset($_POST['btn_login'])){
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        include 'includes/DatabaseConnection.php';
    
        $sql = "SELECT * FROM account WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();
    
        $account = $stmt->fetch();
    
        if (password_verify($_POST["password"], $account["password_hash"])) {
            $_SESSION['status'] = 'Login successful!';
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['status'] = 'Invalid email or password!';
            header('Location: login.html.php');
            exit();
        }
    } else{
    $_SESSION['status'] = 'All field are mandetory!';
    header('Location:login.html.php');
}
}
?>