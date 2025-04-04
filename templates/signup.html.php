<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <h2><?=$title?></h2>

    <form action="signup.php" method="post" novalidate>
        <div>
            <label for="name">Username: </label>
            <input type="text" id="name" name="name">
        </div>

        <div>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <label for="repeat_password">Repeat Password: </label>
            <input type="password" id="repeat_password" name="repeat_password">
        </div>
        <button name="sign_up">Sign up</button>
    </form>
</body>
</html>