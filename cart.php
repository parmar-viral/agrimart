<?php
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 1); // Display errors

session_start();
$msg = null; // Set default value for msg

// Check if user is logged in
if (!isset($_SESSION['ID'])) {
    $loggedIn = false; // User is not logged in
} else {
    $loggedIn = true; // User is logged in
    $user_id = $_SESSION['ID'];

    // Check for a success or error message in session
    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']); // Clear the message from the session after it's been displayed
    }
    include_once('admin/controller/order_controller.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Cart</title>
    <style>
        /* Glassmorphism Style */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: rgba(0, 0, 0, 0.1);
            color: #333;
        }

        tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
    <?php include 'css.php'; ?>
</head>

<body>
    <?php include 'menu.php'; ?>

    <div class="row d-flex justify-content-center mt-3 mb-3">
        <div class="row">
            <?php if ($msg): ?>
            <div class="alert alert-info text-center">
                <?php echo $msg; ?>
            </div>
            <?php endif; ?>
            <div class="col-md-6 offset-md-3">
                <div class="card mb-2">
                    <div class="card-header text text-dark text-center">
                        <h4>Your Cart</h4>
                    </div>

                    <div class="card-body text text-dark">
                        <?php if (!$loggedIn): ?>
                        <div class='alert alert-danger text-center'>
                            You must be logged in to view your cart items. <a href="login.php">Log in here</a>
                        </div>
                        <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Include your order controller
                                include_once('admin/controller/cart_controller.php');
                                $res = $obj->view($user_id);
                                if (!$res) {
                                    echo '<div class="alert alert-danger">Error fetching cart items: ' . mysqli_error($conn) . '</div>';
                                } else if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
                                        echo '<td>$' . number_format($row['product_price'], 2) . '</td>';
                                        echo '<td>' . $row['quantity'] . '</td>';
                                        echo '<td>$' . number_format($row['total_price'], 2) . '</td>';
                                        echo '<td>
                                            <div class="btn-group">
                                                <form method="post" action="buy.php">
                                                    <input type="hidden" name="item_id" value="' . $row['product_id'] . '">
                                                    <button type="submit" class="btn">Buy</button>
                                                </form>
                                                <form method="post" action="">
                                                    <input type="hidden" name="item_id" value="' . $row['product_id'] . '">
                                                    <button type="submit" name="delete" class="btn ms-2" onclick="return confirm(\'Are you sure you want to delete this item?\');">Delete</button>
                                                </form>
                                            </div>
                                        </td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5">Your cart is empty.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <?php include 'js.php'; ?>
</body>

</html>
