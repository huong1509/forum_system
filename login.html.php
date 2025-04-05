<?php 
    $title = 'Login Form';
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
                        <h5>Login</h5>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="post">

                            <div class="form-group mb-3">
                                <label for="name">Email: </label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Password: </label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="btn_login" class="btn btn-primary">Login</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include('includes/footer.php');?>