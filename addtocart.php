<?php
session_start();

// Ensure 'ROLE' is set in the session before accessing it
if (isset($_SESSION['ROLE'])) {
    $role = $_SESSION['ROLE'];
} else {
    $role = null; // Or set a default value, or handle the case when the role is not set
}

// Include other necessary files and handle other logic
include 'admin/error.php';
include_once('admin/controller/database/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <?php include 'css.php';?>

</head>

<body>
    <?php
        // Check the user's role and include the appropriate menu
        if ($role == 2) {
            include 'menu2.php';
        } else {
            include 'menu.php';
        }
    ?>
    <div class="container">
        <div class="card mt-3 p-2 mb-3 text text-center">
            <div class="card-header text text-dark text-center mb-3">
                <h3>Shopping Cart</h3>
            </div>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            if (isset($_SESSION["cart"])) {
                foreach ($_SESSION["cart"] as $item) {
                    echo "<tr><td>" . $item["name"] . "</td><td>$" . $item["price"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Cart is empty</td></tr>";
            }
            ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php include 'footer.php';?>
    <?php include 'js.php';?>
</body>

</html>