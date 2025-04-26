<?php

function query($pdo, $sql,$parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function checkMail($pdo, $email, $accountid = null) {
    if ($accountid) {
        $parameters =[':email' => $email, ':id' => $accountid];
        $query = query($pdo,"SELECT COUNT(*) FROM account WHERE email = :email AND id != :id LIMIT 1", $parameters);
    } else {
        $parameters = [':email' => $email];
        $query = query($pdo,"SELECT COUNT(*) FROM account WHERE email = :email LIMIT 1", $parameters);
    }
    return $query->fetchColumn();
}

function selectMail($pdo, $email) {
    $parameters = [':email' => $email];
    $query = query($pdo,"SELECT * FROM account WHERE email = :email", $parameters);
    return $query->fetch();
}


function addAccount($pdo, $username, $email, $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $parameters = [':username' => $username, ':email' => $email, 'password_hash' => $password_hash];
    $query = query($pdo,"INSERT INTO account (username, email, password_hash) VALUES (:username,:email, :password_hash)",$parameters);
    // query($pdo, $query, $parameters);
    return $query->rowCount() > 0;
}

function updatePassword($pdo, $email, $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $parameters = [':email' => $email ,'password_hash' => $password_hash];
    $query = query($pdo,'UPDATE account SET password_hash = :password_hash WHERE email = :email LIMIT 1', $parameters);
    return $query->rowCount() > 0; // query($pdo, $parameters, $query);
}   

function getPost($pdo, $postid) {
    $parameters = [':id'=> $postid];
    $query = query($pdo, 'SELECT post.id, post.post_title, post.post_text, post.post_date, post.post_image, account.username,module.module_name FROM post 
                            INNER JOIN account on account_id = account.id
                            INNER JOIN module on module_id = module.id
                            WHERE post.id =:id', $parameters);
    return $query->fetch();
}


function getAccount($pdo, $accountid) {
    $parameters = [':id'=> $accountid];
    $query = query($pdo, 'SELECT * FROM account WHERE id = :id', $parameters);
    return $query->fetch();
}

function updateAccount($pdo, $accountid, $username, $email, $role) {
    $parameters = [':id'=> $accountid, ':username' => $username, ':email' => $email, ':role' => $role];
    $query = query($pdo,'UPDATE account SET username = :username, email = :email, role = :role WHERE id = :id', $parameters);
    return $query->rowCount() > 0;
}

function checkModule($pdo, $module) {
    $parameters = [':module' => $module];
    $query = query($pdo,"SELECT COUNT(*) FROM module WHERE module_name = :module LIMIT 1", $parameters);
    return $query->fetchColumn();
}

function getModule($pdo, $moduleid) {
    $parameters = [':id'=> $moduleid];
    $query = query($pdo, 'SELECT * FROM module WHERE id = :id', $parameters);
    return $query->fetch();
}

function updateModule($pdo, $moduleid, $module) {
    $parameters = [':id'=> $moduleid, ':module_name' => $module];
    $query = query($pdo,'UPDATE module SET module_name = :module_name WHERE id = :id', $parameters);
    return $query->rowCount() > 0;
}

function getImage($pdo, $postid) {
    $parameters = [':id' => $postid];
    $query = query($pdo, "SELECT post_image FROM post WHERE id = :id", $parameters);
    return $query->fetch();
}

function deletePost($pdo, $postid){
    $parameters = [':id' =>$postid];
    $query = query($pdo,"DELETE FROM post WHERE id = :id", $parameters);
    return $query->rowCount() > 0;
}

function deleteAccount($pdo, $accountid){
    $parameters = [':id' =>$accountid];
    $query = query($pdo,"DELETE FROM account WHERE id = :id", $parameters);
    return $query->rowCount() > 0;
}

function deleteModule($pdo, $moduleid){
    $parameters = [':id' =>$moduleid];
    $query = query($pdo,"DELETE FROM module WHERE id = :id", $parameters);
    return $query->rowCount() > 0;
}

function addPost($pdo, $posttitle, $posttext, $postimage, $moduleid, $email) {
    $parameters = [':post_title' => $posttitle ,':post_text' => $posttext,':post_image' => $postimage ,':module_id' => $moduleid, ':email' => $email];
    $query = query($pdo,'INSERT INTO post (post_title, post_text, post_date, post_image, account_id, module_id)
            SELECT :post_title, :post_text, CURDATE(),:post_image, account.id, :module_id
            FROM account 
            WHERE account.email = :email', $parameters);
    return $query->rowCount() > 0;
}

function updatePost($pdo, $postid, $posttitle, $posttext, $postimage, $moduleid) {
    $parameters = [':id'=> $postid, ':post_title' => $posttitle ,':post_text' => $posttext, ':post_image' => $postimage, ':module_id' => $moduleid];
    $query = query($pdo,'UPDATE post SET post_title = :post_title, post_text = :post_text, post_image = :post_image , module_id = :module_id WHERE post.id = :id', $parameters);
    return true;
}

function allAccount($pdo){
    $authors = query($pdo, 'SELECT * FROM account');
    return $authors->fetchAll();
}

function allModule($pdo){
    $modules = query($pdo, 'SELECT * FROM module');
    return $modules->fetchAll();
}

function allPosts($pdo) {
    $query = query($pdo, 'SELECT post.id, post.post_title, post.post_text, post.post_date, post.post_image, account.username, module.module_name FROM post
                        INNER JOIN account ON account_id = account.id
                        INNER JOIN module on module_id = module.id
                        ORDER BY post.id DESC'
                );
    return $query->fetchAll();
}

function allComments($pdo, $postid) {
    $parameters = [':post_id' => $postid];
    $query = query($pdo, 'SELECT comment.id, comment.comment_text, comment.comment_date, account.username, account.email FROM comment
                        INNER JOIN account ON account_id = account.id
                        INNER JOIN post on post_id = post.id
                        WHERE post_id = :post_id
                        ORDER BY comment.id DESC', $parameters
                );
    return $query->fetchAll();
}

function addComment($pdo, $commenttext, $postid, $email) {
    $parameters = [':comment_text' => $commenttext,':post_id' => $postid, ':email' => $email];
    $query = query($pdo,'INSERT INTO comment (comment_text, comment_date, post_id, account_id)
            SELECT :comment_text, CURDATE(),:post_id, account.id
            FROM account 
            WHERE account.email = :email', $parameters);
    return $query->rowCount() > 0;
}

function selectPosts($pdo, $email) {
    $parameters = [':email' => $email];
    $query = query($pdo, 'SELECT post.id, post.post_title, post.post_text, post.post_date, post.post_image, account.username, module.module_name FROM post 
                        INNER JOIN account ON account_id = account.id
                        INNER JOIN module on module_id = module.id
                        WHERE email = :email
                        ORDER BY post.id DESC' , $parameters
                        );
    return $query->fetchAll();
}

function addModule($pdo, $module) {

    $parameters = [':module' => $module];
    $query = query($pdo,"INSERT INTO module (module_name) VALUES (:module)", $parameters);
    // query($pdo, $query, $parameters);
    return $query->rowCount() > 0;
}

?>

