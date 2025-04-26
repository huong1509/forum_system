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

                <div class="mb-3">
                    <label for="post_title" class="form-label"><h4>Post title:</h4></label><br>
                    <input type="text" name="post_title" class="form-control" id="post_title">
                </div>

                <div class="mb-3">
                    <label for="post_text" class="form-label"><h5>Post content:</h5></label>
                    <textarea name="post_text" class="form-control" id="exampleFormControlTextarea1" rows="10" cols="40"></textarea>
                </div>

                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label"><h5>Add image here:</h5></label>
                    <input name="fileToUpload" class="form-control" type="file" id="formFileMultiple" multiple>
                </div>

                <select name="module" class="form-select">
                    <option selected>Select a module</option>
                    <?php foreach ($modules as $module):?>
                        <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?=htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8'); ?>    
                        </option>
                        <?php endforeach;?>
                </select><br>

                <button type="submit" name="btn_add_post"  class="btn btn-primary">Add Post</button>
            </form>

            </div>
        </div>
    </div>
</div>