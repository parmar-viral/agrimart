<?php
include 'error.php';
session_start();
// Include database connection file
include_once('admin/controller/database/db.php');
if (!isset($_SESSION['ID'])) {
  include 'logout.php';
  exit();
}
if (2 == $_SESSION['ROLE']) {
    $id=$_SESSION['ID'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="row d-flex justify-content-center mt-3 mb-3">
        <div class="row">
            <?php if ($msg) { ?>
            <div class="alert alert-info text-center">
                <?php echo $msg; ?>
            </div>
            <?php } ?>
            <div class="col-md-6 offset-md-3">
                <div class="card mb-2">
                    <div class="card-header text text-dark text-center">
                        <h4>My Profile</h4>
                    </div>
                    <div class="card-body text text-dark">
                        <form>
                            <!--begin::Body-->
                            <div class="card-body">
                                <?php
                $sql = "SELECT * FROM `users` WHERE `id`='$id'";
                $res = mysqli_query($conn, $sql);                
                while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                                <div class="row mb-3"> <label class="col-sm-3 col-2 col-form-label">Name:</label>
                                    <div class="col-sm-9"> <input type="text" class="form-control"
                                            value="<?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3"> <label class="col-sm-3  col-2 col-form-label">Username:</label>
                                    <div class="col-sm-9"> <input type="text" class="form-control"
                                            value="<?php echo $row["username"]; ?>" readonly></div>
                                </div>
                                <div class="row mb-3"> <label class="col-sm-3 col-2 col-form-label">Email:</label>
                                    <div class="col-sm-9"> <input type="text" class="form-control"
                                            value="<?php echo $row["email"]; ?>" readonly></div>
                                </div>

                                <?php } ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <?php include 'js.php'; ?>
</body>

</html>

<?php } else {
  include 'logout.php';
}

?>