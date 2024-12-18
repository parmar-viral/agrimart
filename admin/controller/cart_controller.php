<?php
class cart
{
    public $db;  // Declare the property

    function __construct() {
        $conn = mysqli_connect('localhost', 'root', '', 'Agro');
        $this->db = $conn; // Initialize the property
        if (mysqli_connect_error()) {
            echo 'failed to connect' . mysqli_connect_error();
        }
    }

    function checkproduct($user_id, $product_id) {
        // Check if the product is already in the cart
        $check_sql = "SELECT * FROM cart_items WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $check_res = mysqli_query($this->db, $check_sql);
        return $check_res;   
    }

    function update_quentyandprice($user_id, $product_id, $product_price) {
        // If product already exists in the cart, update quantity and total price
        $update_sql = "UPDATE cart_items 
                       SET quantity = quantity + 1, 
                           total_price = total_price + $product_price 
                       WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $update_res = mysqli_query($this->db, $update_sql);
        return $update_res;   
    }

    function insert($user_id, $product_id, $product_name, $product_price, $quantity, $total_price) {
        $insert_sql = "INSERT INTO cart_items (user_id, product_id, product_name, product_price, quantity, total_price)
                       VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$quantity', '$total_price')";
        $res = mysqli_query($this->db, $insert_sql);
        return $res;
    }

    function delete($product_id) {
        $sql = "DELETE FROM cart_items WHERE product_id='$product_id'";
        $res = mysqli_query($this->db, $sql);
        return $res;
    }

    function view($user_id) {
        $sql = "SELECT * FROM cart_items WHERE user_id = '$user_id'";
        $res = mysqli_query($this->db, $sql);
        return $res;
    }
}

$obj = new cart();

// Handling form submissions for adding to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['ID']; // Assuming user ID is stored in the session
    $product_id = $_POST['product_id'] ?? null;
    $product_name = $_POST['product_name'] ?? null;
    $product_price = $_POST['product_price'] ?? null;

    if ($product_id && $product_name && $product_price) {
        $check_res = $obj->checkproduct($user_id, $product_id);        

        if (mysqli_num_rows($check_res) > 0) {
            $res = $obj->update_quentyandprice($user_id, $product_id, $product_price);
            $_SESSION['msg'] = $res ? "Product quantity updated in your cart!" : "Failed to update product quantity!";
        } else {
            // Insert new product into the cart
            $total_price = $product_price * 1; // Assuming quantity is 1
            $res = $obj->insert($user_id, $product_id, $product_name, $product_price, 1, $total_price);
            $_SESSION['msg'] = $res ? "Product added to cart successfully!" : "Failed to add product to cart!";
        }    
        header('Location: cart.php'); // Redirect to the cart page
        exit();
    } else {
        $_SESSION['msg'] = "Invalid product details!";
    }
}

// Handling deletion of cart items
if (isset($_POST['delete'])) {
    $product_id = $_POST['item_id'];
    $res = $obj->delete($product_id);
    if ($res) {
        $_SESSION['msg'] = "Product deleted from cart successfully.";
        header("location: cart.php");
        exit();
    } else {
        $_SESSION['msg'] = "Failed to delete product.";
    }
}
