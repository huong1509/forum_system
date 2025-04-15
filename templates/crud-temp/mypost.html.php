<head>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-012">

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
                    <div class="card-header">
                        <h3>Welcome, <?=$_SESSION['auth_account']['username']; ?></h3>
                        <h4>You are a <?=$_SESSION['auth_account']['role'];?> of Greenwich.</h4>
                    </div>
                </div>
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
                                    <button class="edit" onclick="window.location.href='edit-post-code.php?id=<?=$post['id']?>'">Edit</button>
                                    
                                    <form action="delete-post-code.php" method="post">
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
                                <!-- <div class="interaction-stats">
                                    👍 1.2K • 💬 42 bình luận • 🔁 16 chia sẻ
                                </div> -->
                                <div class="interaction-buttons">
                                    <button>👍 Like</button>
                                    <button>💬 Comment</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
