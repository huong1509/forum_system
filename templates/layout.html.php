<?php
// Declare the BASE_URL variable to use as the base for all links
$BASE_URL = '/forum_system';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(isset($title)) { echo"$title"; }?></title> <!-- Display the page title if $title is set -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Load Bootstrap 5 CSS -->
    
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
                                    <a class="nav-link active" href="<?=$BASE_URL?>/index.php">Home</a> <!-- Link to Home page -->
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?=$BASE_URL?>/controllers/crud/mypost-code.php">My Post</a> <!-- Link to My Post page -->
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?=$BASE_URL?>/mail/send-contact-code.php">Contact Us</a> <!-- Link to Contact Us page -->
                                </li>
                                <?php if(!isset($_SESSION['authenticated'])):?> <!-- If user is NOT authenticated, show Sign Up and Sign In links -->
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$BASE_URL?>/controllers/auth/signup-code.php">Sign Up</a> <!-- Link to Sign Up page -->
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$BASE_URL?>/controllers/auth/signin-code.php">Sign In</a> <!-- Link to Sign In page -->
                                </li>
                                <?php endif?>

                                <?php if(isset($_SESSION['authenticated'])):?> <!-- If user is authenticated, show Log Out link -->
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$BASE_URL?>/controllers/auth/signout-code.php">Log Out</a> <!-- Link to Sign In page -->
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

<main><?=$output?></main>  <!-- Main content area where $output will be displayed -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>   <!-- Load Bootstrap 5 JavaScript bundle -->
</body>
</html>