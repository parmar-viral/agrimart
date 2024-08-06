<?php
class feedback
{
    public $db;  // Declare the property

    function __construct()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'Agro');
        $this->db = $conn;  //Initialize the property
        if (mysqli_connect_error()) {
            echo 'failed to connect' . mysqli_connect_error();
        }
    }
    function insert($name, $email, $message)
    {
        $sql = "INSERT INTO `feedback`(`name`,`email`,`message`) 
            VALUES ('$name','$email','$message')";

        $res = mysqli_query($this->db, $sql);
        return $res;
    }
    function view()
    {

        $sql = "SELECT * FROM `feedback`";
        $res = mysqli_query($this->db, $sql);
        return $res;
    }
}
$obj = new feedback();
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $result = $obj->insert($name, $email, $message);
    if ($result == true) {
        // echo "<script>alert('thanks for submit data');</script>";
         header("Location:dashboard.php");
        die();
    } else {
        $errorMsg = "You are not Registred..Please Try again";
        echo $errorMsg;
    }
}

?>