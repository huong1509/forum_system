
<head>
    <link rel="stylesheet" href="../../assets/css/style1.css">
</head>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
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

            <div class="post-feed">
                <?php foreach ($posts as $post): ?>
                    <div class="post-card">
                        
                        <div class="post-header">
                            <div class="user-info">
                                <div class="username"><?= htmlspecialchars($post['username']) ?></div>
                                <div class="post-time"><?= htmlspecialchars($post['post_date']) ?></div>
                                <div class="post-module"><?= htmlspecialchars($post['module_name']) ?></div>
                            </div>
                                <form action="admin-delete-post-code.php" method="post">
                                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                    <button type="submit" name="btn_delete" class="delete">Delete</button>
                                </form>
                        </div>

                        <div class="post-content">
                            <h5 style="color: blue;"><b><?= htmlspecialchars($post['post_title']) ?></b></h5>
                            <?= nl2br(trim(htmlspecialchars($post['post_text']))) ?>
                            <?php if (!empty($post['post_image'])): ?>
                                <img class="post-image" src="../../uploads/<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" />
                            <?php endif; ?>
                        </div>

                        <div class="post-footer">
                            <div class="interaction-buttons">
                                <div class="d-grid gap-2 d-lg-block">
                                    <button class="btn btn-light btn-sm" type="button">0 Like</button>
                                    <button class="btn btn-light btn-sm" type="button" onclick="window.location.href='admin-comment-code.php?id=<?=$post['id']?>'">💬 Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>
        </div>
    </div>
</div>