<?php

function query($pdo, $sql,$parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

// function totalPosts($pdo){
//     $query = query($pdo,'SELECT COUNT(*)FROM post ');
//     $row = $query->fetch();
//     return $row[0];
// }

function getPost($pdo, $postid) {
    $parameters = [':id'=> $postid];
    $query = query($pdo, 'SELECT * FROM post WHERE id =:id', $parameters);
    return $query->fetch();
}

function updatePost($pdo, $postid, $posttext) {
    $query = 'UPDATE post SET post_text = :post_text WHERE id = :id';
    $parameters = [':id'=> $postid, ':post_text' => $posttext];
    query($pdo,$query, $parameters);
}

function deletePost($pdo, $postid){
    $query = "DELETE FROM post WHERE id = :id";
    $parameters = [':id' =>$postid];
    query($pdo, $query, $parameters);
}

function addPost($pdo, $posttext, $accountid, $moduleid) {
    $query = 'INSERT INTO post SET
            post_text = :post_text,
            post_date = CURDATE(),
            account_id = :account_id,
            module_id = :module_id';
    $parameters = [':post_text' => $posttext, ':account_id' => $accountid, ':module_id' => $moduleid];
    query($pdo, $query, $parameters);
}

// function allAuthors($pdo){
//     $authors = query($pdo, 'SELECT * FROM author');
//     return $authors->fetchAll();
// }

// function allCategories($pdo){
//     $categories = query($pdo, 'SELECT * FROM categories');
//     return $categories->fetchAll();
// }

function allPosts($pdo) {
    $query = query($pdo, 'SELECT post.id, post.post_text, post.post_date, post.post_image, account.username, module.module_name FROM post
            INNER JOIN account ON account_id = account.id
            INNER JOIN module on module_id = module.id'
            );
    return $query->fetchAll();
}

?>

