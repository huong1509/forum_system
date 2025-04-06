
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-012">

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
                
                <div class="card">
                    <div class="card-header">
                        <h3>Welcome, <?=$_SESSION['auth_account']['username']; ?></h3>
                        <h4>You are a <?=$_SESSION['auth_account']['role'];?> of Greenwich.</h4>
                    </div>
                    <div class="card-body">
                        <h4>Here is your post!</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
