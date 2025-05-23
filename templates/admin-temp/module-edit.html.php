
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
                        <h5>Edit Module</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post"> <!-- module edit form -->
                            <input type="hidden" name="module_id" value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>"> <!-- hidden module id-->


                            <div class="form-group mb-3">
                                <label for="new_module" class="form-label">Edit Module Name</label>
                                <input type="text" name="new_module" class="form-control" id="module" value="<?=htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8')?>"> <!-- module name input -->
                            </div>

                            <button type="submit" name="btn_edit_module"  class="btn btn-primary">Edit Module</button> <!-- edit button -->
                            <button type="button" name="btn_cancel"  class="btn btn-secondary" onclick="window.location.href='module-manage-code.php'">Cancel</button> <!--link to module management -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
