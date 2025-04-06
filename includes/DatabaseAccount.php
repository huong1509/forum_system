<?php

function query($pdo, $sql,$parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function checkMail($pdo, $email) {
    $parameters = [':email' => $email];
    $query = query($pdo,"SELECT COUNT(*) FROM account WHERE email = :email LIMIT 1", $parameters);
    return $query->fetchColumn();
}

function selectMail($pdo, $email) {
    $parameters = [':email' => $email];
    $query = query($pdo,"SELECT * FROM account WHERE email = :email", $parameters);
    return $query->fetch();
}

function addAccount($pdo, $username, $email, $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $parameters = [':username' => $username, ':email' => $email, 'password' => $password, 'password_hash' => $password_hash];
    $query = query($pdo,"INSERT INTO account (username, email, password, password_hash) VALUES (:username,:email,:password, :password_hash)",$parameters);
    // query($pdo, $query, $parameters);
    return $query->rowCount() > 0;
}

function updatePassword($pdo, $email, $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $parameters = [':email' => $email, ':password' => $password ,'password_hash' => $password_hash];
    $query = query($pdo,'UPDATE account SET password =:password ,  password_hash = :password_hash WHERE email = :email LIMIT 1', $parameters);
    return $query->rowCount() > 0; // query($pdo, $parameters, $query);
}   

?>

