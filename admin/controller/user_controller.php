<?php

class user
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
    function insert($fname, $lname, $email, $username, $pass, $confirm_password, $mobile, $address, $role)
    {
        $sql = "INSERT INTO `users`(`fname`,`lname`,`email`,`username`,`pass`,`confirm_password`,`mobile`,`address`,`user_role`) 
            VALUES ('$fname','$lname','$email','$username','$pass','$confirm_password','$mobile','$address','$role')";

        $res = mysqli_query($this->db, $sql);
        return $res;
    }
    /*
    function update()
    {
        $sql = "UPDATE `users` SET ``='' WHERE `id`=''";
        $res = mysqli_query($this->db, $sql);
        return $res;
    }*/
    function delete($id)
    {
        $sql = "DELETE FROM `users` WHERE `id`='$id'";
        $res = mysqli_query($this->db, $sql);
        return $res;
    }
    function view()
    {

        $sql = "SELECT * FROM `users`";
        $res = mysqli_query($this->db, $sql);
        return $res;
    }
}
$obj = new user();
if (isset($_POST['submit'])) {
    $fname = $obj->db->real_escape_string($_POST['fname']);
    $lname = $obj->db->real_escape_string($_POST['lname']);
    $email = $obj->db->real_escape_string($_POST['email']);
    $username = $obj->db->real_escape_string($_POST['username']);
    $pass = $obj->db->real_escape_string(md5($_POST['password']));
    $confirm_password = $obj->db->real_escape_string(md5($_POST['confirmpassword']));
    $mobile = $obj->db->real_escape_string($_POST['mobile']);
    $address = $obj->db->real_escape_string($_POST['address']);
    $role = $obj->db->real_escape_string($_POST['role']);

    if ($pass !== $confirm_password) {
        echo "Passwords do not match. Please try again.";
        exit();
    }

    $result = $obj->insert($fname, $lname, $email, $username, $pass, $confirm_password, $mobile, $address, $role);

    if ($result) {
        $_SESSION['message'] = "Registration successful!";
        header("Location: login.php");
        exit();
    } else {
        echo "You are not registered. Please try again.";
    }
}

/*
if (isset($_POST['update'])) {
    $id = $_POST['user_id'];
    $course = $_POST[''];

    $res = $obj->update();
    if ($res) {
        header("location:users.php");
    } else {
        echo "alert('data not updated successfully')";
    }
} */ elseif (isset($_POST['delete'])) {
    $id = $_POST['user_id'];
    $res = $obj->delete($id);
    if ($res) {
        header("location:users.php");
    } else {
        echo "not deleted";
    }
}
?>