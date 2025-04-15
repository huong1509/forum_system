

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
                <form action="" method="post">
                    <h4>What do you need help, <?=$_SESSION['auth_account']['username']?>?</h4><br>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input class="form-control" type="text" name="subject" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="15" cols="40"></textarea>
                    </div>

                    <button type="submit" name="btn_send_contact" class="btn btn-primary">Send Contact</button>
                </form>
            </div>
        </div>
    </div>
</div>
