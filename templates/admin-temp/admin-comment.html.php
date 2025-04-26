
<head>
    <link rel="stylesheet" href="../../assets/css/style1.css">
</head>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
            <br>

                <div class="post-feed">
                        <div class="post-card">
                            <div class="post-header">
                                <div class="user-info">
                                    <div class="username"><?= htmlspecialchars($post['username']) ?></div>
                                    <div class="post-time"><?= htmlspecialchars($post['post_date']) ?></div>
                                    <div class="post-module"><?= htmlspecialchars($post['module_name']) ?></div>
                                </div>
                            </div> 

                            <div class="post-content">
                                <h4 style="color: blue;"><b><?= htmlspecialchars($post['post_title']) ?></b></h4>
                                <?= nl2br(trim(htmlspecialchars($post['post_text']))) ?>
                                <?php if (!empty($post['post_image'])): ?>
                                    <img class="post-image" src="/forum_system/uploads/<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" />
                                <?php endif; ?>
                            </div>
                        </div>
                    <hr>
                </div>

                <div class="comment">
                    <div class="mb-3">
                        <form action="" method="post">
                            <textarea name="comment_text" class="form-control" placeholder="Write your comment here..." id="comment_text" rows="5" cols="40"></textarea><br>
                            <button type="submit" name="btn_comment" class="btn btn-primary">Comment</button>
                        </form>
                    </div>
                </div>
                    <div class="post-comment">
                        <?php foreach ($comments as $comment): ?>
                        <div class="comment-card">
                            <div class="comment-header">
                                <div class="comment-info">
                                    <div class="username"><?= htmlspecialchars($comment['username']) ?></div>
                                    <div class="comment-time"><?= htmlspecialchars($comment['comment_date']) ?></div>
                                </div>
                            </div>

                            <div class="comment-content">
                                <?= nl2br(trim(htmlspecialchars($comment['comment_text']))) ?>
                            </div>
                        </div>
                        <hr>
                        <?php endforeach; ?>
                    </div>
            </div>
        </div>
    </div>
</div>

