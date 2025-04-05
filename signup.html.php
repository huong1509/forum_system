<?php 
    $title = 'Sign Up Form';
    include('includes/header.php');
    include('includes/nav.php');
    session_start();
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert">
                    <?php
                        if(isset($_SESSION['status'])){

                            echo "<h4 style='color: red;'>" .$_SESSION['status']. "</h4>";
                            unset($_SESSION['status']);
                        }
                    ?>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Sign Up </h5>
                    </div>
                    <div class="card-body">
                        <form action="signupcode.php" method="post">
                            <div class="form-group mb-3">
                                <label for="name">Username: </label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Email: </label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Password: </label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Confirm Password: </label>
                                <input type="password" name="confirm_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_sign_up" class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>