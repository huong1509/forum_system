
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
                    <input type="hidden" name="post_id" value="<?=htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="mb-3">
                        <label for="post_text" class="form-label"><h4>Edit your joke here:</h4></label><br>
                        <textarea name="post_text" class="form-control" id="post_text" rows="5" cols="40"><?=htmlspecialchars($post['post_text'], ENT_QUOTES, 'UTF-8')?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label"><h5>Add image here:</h5></label>
                        <input name="image" class="form-control" type="file" id="formFileMultiple" <?=htmlspecialchars($post['post_image'], ENT_QUOTES, 'UTF-8')?> multiple>
                    </div>

                    <select name="module" class="form-select">
                        <?php foreach ($modules as $module):?>
                            <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>"
                                <?=$module['id'] == $post['module_name'] ? 'selected' : '' ?>>
                                <?=htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8'); ?>    </option>
                            <?php endforeach;?>
                    </select><br>

                    <button type="submit" name="btn_save"  class="btn btn-primary">Save Post</button>
                </form>
            </div>
        </div>
    </div>
</div>
