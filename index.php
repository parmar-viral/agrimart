<?php 
include 'breadcrumb.php'; 
session_start();
include 'admin/error.php';
include_once ('admin/controller/product_controller.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrimart</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <div class="row mt-1">
            <img src="asset/css/images/intro.jpeg" alt="" height="500px" class="intro-img mt-3">
        </div>
        <div class="card mt-3 p-2 mb-3 text text-center">
            <div class="card-header text text-dark text-center">
                <h4>Popular Products</h4>
            </div>
        </div>
        <div class="row mt-1">
            <?php
            $res = $obj->productview();
            while ($row = mysqli_fetch_assoc($res)) {
                $product_id = htmlspecialchars($row['product_id']);
                $product_name = htmlspecialchars($row['product_name']);
                $product_price = number_format($row['product_price'], 2);
                $product_image = htmlspecialchars($row['product_image']);
                $created_at = htmlspecialchars($row['created_at']);
                $role = $_SESSION['ROLE'] ?? null; // Check if ROLE is set in the session
            ?>
            <div class="col-lg-4 col-md-4 col-sm-12 ">
                <div class="card m-1 text-left p-1 ms-2 mb-3">
                    <p class="text-center mt-2">
                        <img src="admin/<?php echo $product_image; ?>" class="card-img-top mb-2" alt="Product Image"
                            style="height: 220px; object-fit: cover; width: 100%; border-radius:10px">
                    </p>

                    <h5><?php echo $product_name; ?></h5>
                    <h5>$<?php echo $product_price; ?></h5>
                    <h5><?php echo $created_at; ?></h5>

                    <?php if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 2) { ?>
                    <form class="text-center" method="POST" action="addtocart.php">
                        <input type="hidden" name="role" value="<?php echo $role; ?>">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                        <button class="btn m-3" type="submit" name="addtocart">Add-to-Cart</button>
                        <button type="button" class="btn" data-bs-target="#display-<?php echo $product_id; ?>"
                            data-bs-toggle="modal">Details</button>
                    </form>
                    <?php } else { ?>
                    <form class="text-center" method="POST" action="login.php">
                        <input type="hidden" name="role" value="<?php echo $role; ?>">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                        <button class="btn m-3" type="submit" name="addtocart">Add-to-Cart</button>
                        <button type="button" class="btn" data-bs-target="#display-<?php echo $product_id; ?>"
                            data-bs-toggle="modal">Details</button>
                    </form>
                    <?php } ?>
                </div>
            </div>

            <!-- The modal for product details -->
            <div class="modal fade" id="display-<?php echo $product_id; ?>" tabindex="-1"
                aria-labelledby="fordisplaymodal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-center" id="forupdatemodal">Product Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row p-2 mt-1">
                                <div class="card col text-left ms-2">
                                    <div class="input-group mb-3">
                                        <img src="admin/<?php echo $product_image; ?>" height="200px" width="150px"
                                            alt="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <h5>Name:</h5>
                                        <?php echo $product_name; ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <h5>Description: </h5>
                                        <?php echo htmlspecialchars($row['description']); ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <h5>Price:</h5>
                                        <?php echo '$' . $product_price; ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <h5>Created At: </h5>
                                        <?php echo $created_at; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="buy.php">
                                            <input type="hidden" name="item_id" value=<?php $product_id; ?>>
                                            <button type="submit" class="btn">Buy</button>
                                        </form>
                                        <form method="POST" action="addtocart.php">
                                            <input type="hidden" name="role" value="<?php echo $role; ?>">
                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                            <input type="hidden" name="product_name"
                                                value="<?php echo $product_name; ?>">
                                            <input type="hidden" name="product_price"
                                                value="<?php echo $row['product_price']; ?>">
                                            <button class="btn" type="submit" name="addtocart">Add-to-Cart</button>
                                        </form>
                                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            }
            ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <?php include 'js.php'; ?>
</body>

</html>