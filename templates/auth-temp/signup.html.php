
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
                        <h5>Sign Up </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post"> <!-- Sign Up form -->
                            <div class="form-group mb-3">
                                <label for="username">Username: </label> 
                                <input type="text" name="username" class="form-control" placeholder="Huong"> <!-- username input -->
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Email: </label>
                                <input type="email" name="email" class="form-control" placeholder="abc@gmail.com"> <!-- email input -->
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Password: </label>
                                <input type="password" name="password" class="form-control" placeholder=""> <!-- password input -->
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Confirm Password: </label>
                                <input type="password" name="confirm_password" class="form-control" placeholder=""> <!-- confirm password input -->
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_sign_up" class="btn btn-primary">Sign Up</button> <!-- sign up button -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

