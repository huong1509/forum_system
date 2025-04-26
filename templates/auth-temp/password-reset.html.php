
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Check if there is a status message in the session and display it -->
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
                        <h5>Reset Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post"> <!-- reset password form -->
                            <div class="form-group mb-3">
                                <label for="email">Email address: </label>
                                <input type="text" name="email" class="form-control" placeholder="Enter your email address"> <!-- email input-->
                            </div>

                            <div class="form-group">
                                <button type="submit" name="btn_password_reset" class="btn btn-primary">Reset password</button> <!-- link to change password page -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

