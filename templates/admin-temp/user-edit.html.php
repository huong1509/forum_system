
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
                        <h5>Edit User</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="account_id" value="<?=htmlspecialchars($account['id'], ENT_QUOTES, 'UTF-8'); ?>">

                            <div class="form-group mb-3">
                                <label for="new_username" class="form-label">Edit Username</label>
                                <input type="text" name="new_username" class="form-control" id="username" value= "<?=htmlspecialchars($account['username'], ENT_QUOTES, 'UTF-8')?>">
                            </div>

                            <div class="form-group mb-3">
                                <label for="new_email" class="form-label">Edit Email Address</label>
                                <input type="email" name="new_email" class="form-control" id="email" value = "<?=htmlspecialchars($account['email'], ENT_QUOTES, 'UTF-8')?>">
                            </div>

                            <div class="form-group mb-3">
                                <label for="new_role" class="form-label">Edit Role</label>
                                <input type="text" name="new_role" class="form-control" id="email" value = "<?=htmlspecialchars($account['role'], ENT_QUOTES, 'UTF-8')?>">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="btn_edit_user"  class="btn btn-primary">Edit User</button>
                                <button type="button" name="btn_cancel"  class="btn btn-secondary" onclick="window.location.href='user-manage-code.php'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
