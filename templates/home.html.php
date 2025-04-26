
<head>
    <link rel="stylesheet" href="assets/css/style1.css">
</head>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                <div class="card-header text-center">
                    <h3>Welcome, This is home page</h3>
                </div>
            </div>
            <br>
            <div class="d-grid gap-2">
            <button class="btn btn-light border border-lighgrey rounded-pill shadow-sm" onclick="window.location.href='controllers/crud/add-post-code.php'">Write your post here....</button>
            </div>

                
            <div class="post-feed"> <!-- Section for displaying posts -->
                <?php foreach ($posts as $post): ?>  <!-- Loop through each post and display its content -->
                    <div class="post-card">

                        <div class="post-header"> 
                            <div class="user-info">
                                <!-- Display username, post time, and module -->
                                <div class="username"><?= htmlspecialchars($post['username']) ?></div> 
                                <div class="post-time"><?= htmlspecialchars($post['post_date']) ?></div> 
                                <div class="post-module"><?= htmlspecialchars($post['module_name']) ?></div> 
                            </div>
                        </div>

                        <div class="post-content">  
                            <!-- Display pót title, post text and post image -->
                            <h4 style="color: blue;"><b><?= htmlspecialchars($post['post_title']) ?></b></h4> 
                            <?= nl2br(trim(htmlspecialchars($post['post_text']))) ?> 

                            <?php if (!empty($post['post_image'])): ?>  <!-- Display the post image if it exists -->
                                <img class="post-image" src="/forum_system/uploads/<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" /> 
                            <?php endif; ?>
                        </div>

                        <div class="post-footer">  
                            <div class="interaction-buttons">
                                <div class="d-grid gap-2 d-lg-block">
                                    <button class="btn btn-light btn-sm" type="button">0 Like</button> <!-- Like button -->
                                    <button class="btn btn-light btn-sm" type="button" onclick="window.location.href='controllers/crud/comment-code.php?id=<?=$post['id']?>'">💬 Comment</button> <!-- Comment button -->
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

