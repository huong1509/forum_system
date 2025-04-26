<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-20">
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
                    <div class="card-body">
                        <div class="mb-3">
                            <button class="btn btn-success border shadow-sm" onclick="window.location.href='add-module-code.php'">Add Module</button>
                        </div>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> <?= htmlspecialchars('ID') ?> </th>
                                    <th> <?= htmlspecialchars('Module') ?> </th>
                                    <th> <?= htmlspecialchars('Edit') ?> </th>
                                    <th> <?= htmlspecialchars('Action') ?> </th>
                                </tr>
                            </thead>

                            <tbody class="table-group-divider">
                            <?php foreach ($modules as $module):?>
                                <tr>
                                <blockquote>
                                    <td> <?= htmlspecialchars($module['id']) ?> </td>
                                    <td> <?= htmlspecialchars($module['module_name']) ?> </td>

                                    <td><button class="btn btn-info btn-sm" onclick="window.location.href='edit-module-code.php?id=<?=$module['id']?>?'">Edit</button></td>

                                    <td>
                                        <form action="delete-module-code.php" method="post">
                                            <input type="hidden" name="id" value="<?= $module['id'] ?>">
                                            <button type="submit" name="btn_delete_module" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </blockquote>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>