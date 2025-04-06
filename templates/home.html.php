
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
                        <h4>Welcome to the Forum System!</h4>
                        </div>
                        <div class="card-body">
                        <h4>This is your home page!</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
