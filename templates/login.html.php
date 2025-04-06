<?php
if(isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You are already login!';
    header('Location: index.php');
    exit(0);
}
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                    if (isset($_SESSION['status'])) {
                        ?>
                        <div class="alert alert-success">
                            <h5><?php echo $_SESSION['status']; ?></h5>
                        </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Login</h5>
                    </div>
                    <div class="card-body">
                        <form action="login-code.php" method="post">

                            <div class="form-group mb-3">
                                <label for="name">Email: </label>
                                <input type="email" name="email" class="form-control" placeholder="abc@gmail.com">
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Password: </label>
                                <input type="password" name="password" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="btn_login" class="btn btn-primary">Login Now</button>

                                <a href="password-reset-code.php" class="float-end">Forgot your password?</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



