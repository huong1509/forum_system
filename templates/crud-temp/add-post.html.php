<form action="" method="post">
    <label for="post_text">Write your post here:</label><br><br>  
    <textarea name="post_text" rows="3" cols="40"></textarea>

    <select name="account">
        <option value="">Select an username</option>
        <?php foreach ($accounts as $account):?>
            <option value="<?=htmlspecialchars($account['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?=htmlspecialchars($account['username'], ENT_QUOTES, 'UTF-8'); ?>    
            </option>
            <?php endforeach;?>
    </select> 

    <select name="Module">
        <option value="">Select an module </option>
        <?php foreach ($modules as $module):?>
            <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?=htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8'); ?>    
            </option>
            <?php endforeach;?>
    </select> 
    <br><input type="submit" name="submit" value="Add">
</form>
