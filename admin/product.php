<?php
include 'error.php';

session_start();
// Include database connection file
include_once ('controller/database/db.php');
if (!isset($_SESSION['ID'])) {
    include 'logout.php';
    exit();
}
if (0 == $_SESSION['ROLE']) {
    include 'controller/product_controller.php';
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agrimart</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <?php include 'menu.php'; ?>

    <div class="container  ">

        <div class="row p-2 mt-1">

            <div class="user-card text-center">
                <form class="mt-3" action="" method="POST" enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <span class="input-group-text col-2" id="productname">
                            <h5><i class="bi bi-journal"></i>Product</h5>
                        </span>
                        <input type="text" name="product_name" class="p-2 col-8" placeholder="Add New Product">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text col-2" id="productdescription">
                            <h5><i class="bi bi-journal"></i>Description</h5>
                        </span>
                        <input type="text" name="product_description" class="p-2 col-8"
                            placeholder="Add Product Description">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text col-2" id="productprice">
                            <h5><i class="bi bi-journal"></i>Price</h5>
                        </span>
                        <input type="number" name="product_price" class="p-2 col-8" placeholder="Add Product Price">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text col-2" id="productimage">
                            <h5><i class="bi bi-journal"></i>Image</h5>
                        </span>
                        <input type="file" name="product_image" class="p-2 col-8" placeholder="Add Product Image">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text col-2" id="productprice">
                            <h5><i class="bi bi-journal"></i>Category</h5>
                        </span>
                        <input type="text" name="product_category" class="p-2 col-8" placeholder="Add Product Category">
                        <button type="submit" name="submit" class="btn p-2 col-2">submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-1">
            <h3 class="text text-center text-light mt-3 mb-3">Existing Products</h3>
        </div>
        <div class="row mt-1">
            <?php
                $data = $obj->view();
                while ($row = mysqli_fetch_assoc($data)) {
                    ?>
            <div class="col-lg-4 col-md-4 col-sm-12 ">

                <div class="user-card m-1 text-left p-1 mb-3">

                    <div>
                        <p class="text-center mt-3">
                            <img src="<?php echo $row["product_image"]; ?>" height="150px" width="150px">
                        </p>
                        <p>
                            <?php echo  htmlspecialchars($row['product_name']); ?>
                        </p>
                        
                        <p>$<?php echo number_format($row['product_price'], 2); ?></p>
                        <p>
                            <?php echo htmlspecialchars($row['created_at']); ?>
                        </p>
                        <form action="#" method="POST" class="text-center">
                            <input type="number" value="<?php echo $row['product_id']; ?>" name="product_id" hidden>

                            <button type="button" class="btn card-edit" data-bs-toggle="modal"
                                data-bs-target="#updatedata"><i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn card-delete" type="submit" name="delete"
                                onclick="return confirm('are you sure to delete')"><i class="bi bi-trash3"></i></button>
                        </form>
                    </div>

                </div>

                <!--                 
                <div class="modal fade" id="updatedata" tabindex="-1" aria-labelledby="forupdatemodal"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="forupdatemodal">update courses</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row p-2 mt-1">

                                    <div class=" viral-card text-center">

                                        <form class="mt-3" action="#" method="POST">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text  viral-card-2 col-3" id="course">
                                                    <h5><i class="bi bi-journal"></i> Course</h5>
                                                </span>
                                                <input type="number" value="<?php echo $row['course_id']; ?>" name="id"  hidden>
                                                <input type="text" name="course" class="viral-card-1  p-2 col-8"
                                                    value="<?php echo $row['course']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="update"
                                                    class="btn btn-primary">update</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>  -->
            </div>
            <?php }
                ?>

        </div>
    </div>
    <!-- <?php include 'footer.php'; ?> -->
    <?php include 'js.php'; ?>
</body>

</html>
<?php } else {
    include 'logout.php';
}
?>