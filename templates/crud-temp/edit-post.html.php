<form action="" method="post">
    <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8'); ?>">

    <label for="post_text">Edit your joke here:</label>
    <textarea name="post_text" id="post_text" rows="3" cols="40"><?= htmlspecialchars($post['post_text'], ENT_QUOTES, 'UTF-8'); ?></textarea>

    <input type="submit" name="submit" value="Save">
</form>
