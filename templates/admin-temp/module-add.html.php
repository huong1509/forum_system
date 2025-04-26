
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Add Module</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post"> <!-- add module form -->
                            <div class="form-group mb-3">
                                <label for="module_name">Module Name: </label>
                                <input type="text" name="module_name" class="form-control"> <!-- module name input -->
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" name="btn_add_module" class="btn btn-primary">Add New Module</button> <!-- add module button -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

