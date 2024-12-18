<?php
session_start();
$msg = null;
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
    include_once ('admin/controller/order_controller.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Orders</title>
    <?php include 'css.php';?>
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
</head>

<body>
    <?php include 'menu.php';?>
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
                        <h4>My Orders</h4>
                    </div>
                    <?php if (isset($_SESSION['message'])): ?>
                            <div class='alert alert-success text-center'>
                                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                            </div>
                        <?php endif; ?>
                    <div class="card-body text text-dark">
                       
                        <?php if (!$loggedIn): ?>
                        <div class='alert alert-danger text-center'>
                            You must be logged in to view your order. <a href="login.php">Log in here</a>
                        </div>
                        <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $res=$obj->userorderview($user_id);
                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['product_name']}</td>
                                            <td>{$row['quantity']}</td>
                                            <td>{$row['total_price']}</td>
                                            <td>{$row['order_date']}</td>
                                            <td>
                                                <form method='POST' action='' style='display:inline;'>
                                                    <input type='hidden' name='order_id' value='{$row['id']}'>
                                                    <button type='submit' name='delete' class='btn' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</button>
                                                </form>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center no-orders'>No orders found.</td></tr>";
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
    <?php include 'footer.php';?>
    <?php include 'js.php';?>
</body>
</html>
