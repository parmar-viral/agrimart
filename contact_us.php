<?php
// Include other necessary files and handle other logic
include 'admin/error.php';
include_once('admin/controller/database/db.php');
include 'breadcrumb.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <?php include 'menu.php'; ?>

    <div class="row d-flex justify-content-center mt-3 mb-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-2">
                    <div class="card-header text text-dark text-center">
                        <h4>Contact Us</h4>
                    </div>

                    <div class="card-body text text-dark">
                        <div class="contact">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="name" class="mb-2">Name</label>
                                    <input type="text" class="form-control mb-3" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="mb-2">Email</label>
                                    <input type="email" class="form-control mb-3" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="mobileno" class="mb-2">Mobile No</label>
                                    <input type="number" class="form-control mb-3" id="mobileno" name="mobileno" required>
                                </div>
                                <div class="form-group">
                                    <label for="message" class="mb-2">Message</label>
                                    <textarea class="form-control mb-3" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-center m-3 col-3 p-2">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php';?>
        <?php include 'js.php'; ?>

</body>
</html>
