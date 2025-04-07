
<head>
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>


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
                <div class="edit">Edit</div>
                <div class="delete">Delete</div>
            </div>

            <!-- Content -->
            <div class="post-content">
                <p><?= htmlspecialchars($post['post_text']) ?></p>
                <?php if (!empty($post['post_image'])): ?>
                    <img class="post-image" src="../../assets/image/<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" />
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