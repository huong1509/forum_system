<?php 
    $title = 'My Post';
    include('includes/header.php');
    include('includes/nav.php');
    session_start();
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-012">
                <h4>You need to login to see your post!</h4>
                <a href="login.html.php">Log in now</a>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>