<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-20">
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
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <button class="btn btn-success border shadow-sm" onclick="window.location.href='add-user-code.php'">Add User</button> <!-- link to add user page -->
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr> 
                                    <th> <?= htmlspecialchars('ID') ?> </th>
                                    <th> <?= htmlspecialchars('Username') ?> </th>
                                    <th> <?= htmlspecialchars('Email') ?> </th>
                                    <th> <?= htmlspecialchars('Role') ?> </th>
                                    <th> <?= htmlspecialchars('Edit') ?> </th>
                                    <th> <?= htmlspecialchars('Action') ?> </th>
                                </tr>
                            </thead>

                            <tbody class="table-group-divider">
                            <?php foreach ($accounts as $account):?>
                                <tr>
                                <blockquote>
                                    <td> <?= htmlspecialchars($account['id']) ?> </td>
                                    <td> <?= htmlspecialchars($account['username']) ?> </td>
                                    <td> <?= htmlspecialchars($account['email']) ?> </td>
                                    <td> <?= htmlspecialchars($account['role']) ?> </td>
        
                                    <td><button class="btn btn-info btn-sm" onclick="window.location.href='edit-user-code.php?id=<?=$account['id']?>'">Edit</button></td> <!-- link to edit user page -->

                                    <td>
                                        <form action="delete-user-code.php" method="post">
                                            <input type="hidden" name="id" value="<?= $account['id'] ?>">
                                            <button type="submit" name="btn_delete_user" class="btn btn-danger btn-sm">Delete</button> <!-- delete user button -->
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