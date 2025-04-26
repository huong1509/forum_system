
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
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" value="<?=htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="mb-3">
                        <label for="post_title" class="form-label"><h4>Edit post title:</h4></label><br>
                        <input type="text" name="post_title" class="form-control" value="<?=htmlspecialchars($post['post_title'], ENT_QUOTES, 'UTF-8')?>"> 
                    </div>

                    <div class="mb-3">
                        <label for="post_text" class="form-label"><h4>Edit post content here:</h4></label><br>
                        <textarea name="post_text" class="form-control" id="post_text" rows="10" cols="40"><?=htmlspecialchars($post['post_text'], ENT_QUOTES, 'UTF-8')?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label"><h5>Change image here:</h5></label>
                        <input name="fileToUpload" class="form-control" type="file" id="formFileMultiple">
                        <?php if (!empty($post['post_image'])): ?>
                            <img class="post-image" src="../../uploads/<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" style="max-width:70%"/>
                            <input type="hidden" name="post_image" value="<?= htmlspecialchars($post['post_image']) ?>">
                        <?php endif; ?>
                    </div>

                    <select name="module" class="form-select">
                        <?php foreach ($modules as $module): ?>
                            <?php if ($module['id'] == $post['module_name']): ?>
                                <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>" selected><?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8'); ?></option>
                                
                            <?php else: ?>
                                <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select><br>

                    <button type="submit" name="btn_save"  class="btn btn-primary">Save Post</button>
                    <button type="button" name="btn_cancel"  class="btn btn-secondary" onclick="window.location.href='mypost-code.php'">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
