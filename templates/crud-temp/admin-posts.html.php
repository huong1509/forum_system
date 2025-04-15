
<head>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
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

            <!-- <div class="d-grid gap-2">
            <button class="btn btn-light border border-lighgrey rounded-pill shadow-sm" onclick="window.location.href='add-post-code.php'">Write your post here....</button>
            </div> -->

            <div class="post-feed">
                <?php foreach ($posts as $post): ?>
                    <div class="post-card">
                        <!-- Header -->
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

                        <!-- Content -->
                        <div class="post-content">
                            <p><?= htmlspecialchars($post['post_text']) ?></p>
                            <?php if (!empty($post['post_image'])): ?>
                                <img class="post-image" src="../../uploads/<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" />
                            <?php endif; ?>
                        </div>

                        <!-- Meta & Actions -->
                        <div class="post-footer">
                            <div class="interaction-stats">
                                👍 1.2K • 💬 42 bình luận 
                            </div>
                            <div class="interaction-buttons">
                                <div class="d-grid gap-2 d-lg-block">
                                    <button class="btn btn-light btn-sm" type="button">👍 Like</button>
                                    <button class="btn btn-light btn-sm" type="button">💬 Comment</button>
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