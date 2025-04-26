<?php
$BASE_URL = '/forum_system';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(isset($title)) { echo"$title"; }?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>
    <div class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Forum System</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?=$BASE_URL?>/index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?=$BASE_URL?>/controllers/crud/mypost-code.php">My Post</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?=$BASE_URL?>/mail/send-contact-code.php">Contact Us</a>
                                </li>
                                <?php if(!isset($_SESSION['authenticated'])):?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$BASE_URL?>/controllers/auth/signup-code.php">Sign Up</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$BASE_URL?>/controllers/auth/signin-code.php">Sign In</a>
                                </li>
                                <?php endif?>

                                <?php if(isset($_SESSION['authenticated'])):?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$BASE_URL?>/controllers/auth/signout-code.php">Log Out</a>
                                </li>
                                <?php endif?>

                            </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<main><?=$output?></main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>