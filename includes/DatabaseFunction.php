<?php

function query($pdo, $sql,$parameters = []){ // Function to execute an SQL query with optional parameters
    $query = $pdo->prepare($sql); // Prepare the SQL query
    $query->execute($parameters);  // Execute the query with the provided parameters
    return $query; // Return the query object
}

function checkMail($pdo, $email, $accountid = null) { // Function to check if an email already exists in the account table
    if ($accountid) { // If an account ID is provided, exclude it from the query
        $parameters =[':email' => $email, ':id' => $accountid]; 
        $query = query($pdo,"SELECT COUNT(*) FROM account WHERE email = :email AND id != :id LIMIT 1", $parameters);
    } else {
        $parameters = [':email' => $email];
        $query = query($pdo,"SELECT COUNT(*) FROM account WHERE email = :email LIMIT 1", $parameters);
    }
    return $query->fetchColumn(); // Return the count of rows with the specified email
}

function selectMail($pdo, $email) { // Function to retrieve a user's account details based on their email
    $parameters = [':email' => $email];
    $query = query($pdo,"SELECT * FROM account WHERE email = :email", $parameters);
    return $query->fetch();
}

function addAccount($pdo, $username, $email, $password) { // Function to add a new account to the database
    $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    $parameters = [':username' => $username, ':email' => $email, 'password_hash' => $password_hash];
    $query = query($pdo,"INSERT INTO account (username, email, password_hash) VALUES (:username,:email, :password_hash)",$parameters);
    return $query->rowCount() > 0; // Return true if the row was inserted
}

function updatePassword($pdo, $email, $password) { // Function to update the password for a given email
    $password_hash = password_hash($password, PASSWORD_DEFAULT);  // Hash the new password

    $parameters = [':email' => $email ,'password_hash' => $password_hash];
    $query = query($pdo,'UPDATE account SET password_hash = :password_hash WHERE email = :email LIMIT 1', $parameters);
    return $query->rowCount() > 0;  // Return true if the password was updated
}   

function getPost($pdo, $postid) { // Function to get post details based on post ID
    $parameters = [':id'=> $postid];
    $query = query($pdo, 'SELECT post.id, post.post_title, post.post_text, post.post_date, post.post_image, account.username,module.module_name FROM post 
                            INNER JOIN account on account_id = account.id
                            INNER JOIN module on module_id = module.id
                            WHERE post.id =:id', $parameters);
    return $query->fetch(); // Return the post details
}


function getAccount($pdo, $accountid) { // Function to retrieve account information by account ID
    $parameters = [':id'=> $accountid];
    $query = query($pdo, 'SELECT * FROM account WHERE id = :id', $parameters);
    return $query->fetch(); // Return the account information
}

function updateAccount($pdo, $accountid, $username, $email, $role) { // Function to update account details (username, email, role) by account ID
    $parameters = [':id'=> $accountid, ':username' => $username, ':email' => $email, ':role' => $role];
    $query = query($pdo,'UPDATE account SET username = :username, email = :email, role = :role WHERE id = :id', $parameters);
    return $query->rowCount() > 0; // Return true if the account was updated
}

function checkModule($pdo, $module) { // Function to check if a module exists based on module name
    $parameters = [':module' => $module];
    $query = query($pdo,"SELECT COUNT(*) FROM module WHERE module_name = :module LIMIT 1", $parameters);
    return $query->fetchColumn(); // Return the count of modules with the specified name
}

function getModule($pdo, $moduleid) { // Function to get module details by module ID
    $parameters = [':id'=> $moduleid];
    $query = query($pdo, 'SELECT * FROM module WHERE id = :id', $parameters);
    return $query->fetch(); // Return the module details
}

function updateModule($pdo, $moduleid, $module) { // Function to update module name by module ID
    $parameters = [':id'=> $moduleid, ':module_name' => $module];
    $query = query($pdo,'UPDATE module SET module_name = :module_name WHERE id = :id', $parameters);
    return $query->rowCount() > 0; // Return true if the module was updated
}

function getImage($pdo, $postid) { // Function to retrieve post image by post ID
    $parameters = [':id' => $postid];
    $query = query($pdo, "SELECT post_image FROM post WHERE id = :id", $parameters);
    return $query->fetch(); // Return the post image
}

function deletePost($pdo, $postid){ // Function to delete a post by post ID
    $parameters = [':id' =>$postid];
    $query = query($pdo,"DELETE FROM post WHERE id = :id", $parameters);
    return $query->rowCount() > 0; // Return true if the post was deleted
}

function deleteAccount($pdo, $accountid){ // Function to delete an account by account ID
    $parameters = [':id' =>$accountid];
    $query = query($pdo,"DELETE FROM account WHERE id = :id", $parameters);
    return $query->rowCount() > 0; // Return true if the account was deleted
}

function deleteModule($pdo, $moduleid){ // Function to delete a module by module ID
    $parameters = [':id' =>$moduleid];
    $query = query($pdo,"DELETE FROM module WHERE id = :id", $parameters);
    return $query->rowCount() > 0; // Return true if the module was deleted
}

function addPost($pdo, $posttitle, $posttext, $postimage, $moduleid, $email) { // Function to add a new post
    $parameters = [':post_title' => $posttitle ,':post_text' => $posttext,':post_image' => $postimage ,':module_id' => $moduleid, ':email' => $email];
    $query = query($pdo,'INSERT INTO post (post_title, post_text, post_date, post_image, account_id, module_id)
            SELECT :post_title, :post_text, CURDATE(),:post_image, account.id, :module_id
            FROM account 
            WHERE account.email = :email', $parameters);
    return $query->rowCount() > 0; // Return true if the post was added
}

function updatePost($pdo, $postid, $posttitle, $posttext, $postimage, $moduleid) { // Function to update an existing post
    $parameters = [':id'=> $postid, ':post_title' => $posttitle ,':post_text' => $posttext, ':post_image' => $postimage, ':module_id' => $moduleid];
    $query = query($pdo,'UPDATE post SET post_title = :post_title, post_text = :post_text, post_image = :post_image , module_id = :module_id WHERE post.id = :id', $parameters);
    return true; // Post is updated
}

function allAccount($pdo){ // Function to retrieve all accounts from the database
    $authors = query($pdo, 'SELECT * FROM account');
    return $authors->fetchAll(); // Return all accounts
}

function allModule($pdo){ // Function to retrieve all modules from the database
    $modules = query($pdo, 'SELECT * FROM module');
    return $modules->fetchAll();  // Return all modules
}

function allPosts($pdo) { // Function to retrieve all posts from the database
    $query = query($pdo, 'SELECT post.id, post.post_title, post.post_text, post.post_date, post.post_image, account.username, module.module_name FROM post
                        INNER JOIN account ON account_id = account.id
                        INNER JOIN module on module_id = module.id
                        ORDER BY post.id DESC'
                );
    return $query->fetchAll();  // Return all posts
}

function allComments($pdo, $postid) { // Function to retrieve all comments for a specific post
    $parameters = [':post_id' => $postid];
    $query = query($pdo, 'SELECT comment.id, comment.comment_text, comment.comment_date, account.username, account.email FROM comment
                        INNER JOIN account ON account_id = account.id
                        INNER JOIN post on post_id = post.id
                        WHERE post_id = :post_id
                        ORDER BY comment.id DESC', $parameters
                );
    return $query->fetchAll(); // Return all comments for the given post
}

function addComment($pdo, $commenttext, $postid, $email) { // Function to add a comment to a specific post by a user (identified by email)
    $parameters = [':comment_text' => $commenttext,':post_id' => $postid, ':email' => $email];
    $query = query($pdo,'INSERT INTO comment (comment_text, comment_date, post_id, account_id)
            SELECT :comment_text, CURDATE(),:post_id, account.id
            FROM account 
            WHERE account.email = :email', $parameters);
    return $query->rowCount() > 0; // Return true if comment successfully
}

function selectPosts($pdo, $email) { // Function to select (retrieve) all posts created by a specific user (identified by email)
    $parameters = [':email' => $email];
    $query = query($pdo, 'SELECT post.id, post.post_title, post.post_text, post.post_date, post.post_image, account.username, module.module_name FROM post 
                        INNER JOIN account ON account_id = account.id
                        INNER JOIN module on module_id = module.id
                        WHERE email = :email
                        ORDER BY post.id DESC' , $parameters
                        );
    return $query->fetchAll(); // Fetch and return all matching posts
}

function addModule($pdo, $module) { // Function to add a new module to the system
    $parameters = [':module' => $module];
    $query = query($pdo,"INSERT INTO module (module_name) VALUES (:module)", $parameters);
    return $query->rowCount() > 0; // Return true if the module was added successfully
}

?>

