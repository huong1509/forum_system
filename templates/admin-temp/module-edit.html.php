
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
                <form action="" method="post">
                    <input type="text" name="module_id" value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="mb-3">
                        <label for="new_module" class="form-label">Edit Module</label>
                        <input type="text" name="new_module" class="form-control" id="module" value= "<?=htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8')?>">
                    </div>

                    <button type="submit" name="btn_edit_module"  class="btn btn-primary">Edit Module</button>
                </form>
            </div>
        </div>
    </div>
</div>
