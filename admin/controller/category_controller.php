<?php 
class products
    {
        public $db;  // Declare the property

        function __construct(){        
            $conn=mysqli_connect('localhost','root','','Agro');
            $this->db=$conn; //Initialize the property
            if(mysqli_connect_error()){
                echo 'failed to connect'.mysqli_connect_error();
            }
        }
        function insert($category_name)
        {
            $sql  = "INSERT INTO `categories` (`category_name`) VALUES ('$category_name')";       
            $res=mysqli_query($this->db,$sql);
            return $res;
        }
        /*
        function update($category_id,$category_name)
        {
            $sql = "UPDATE `categories` SET `category_name`='$category_name' WHERE `category_id`='$category_id'";
            $res = mysqli_query($this->db, $sql);
            return $res;
        }*/
        function delete($category_id)
        {
            $sql = "DELETE FROM `categories` WHERE `category_id`='$category_id'";
            $res = mysqli_query($this->db, $sql);
            return $res;
        }
        function view()
        {
                
            $sql = "SELECT * FROM `categories`";
            $res = mysqli_query($this->db,$sql);
            return $res;
        }
    }
    $obj = new products();
    if (isset($_POST['submit'])) {
        $category_name=$_POST['category_name'];
       
        $result=$obj->insert($category_name);
        
        if ($result==true) {
          header("Location:category.php");
          die();
        }else{
          $errorMsg  = "You are not Registred..Please Try again";
          echo $errorMsg;
        }   
    }/*
    if (isset($_POST['update'])) {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
    
        $res = $obj->update($category_id, $category_name);
        if ($res) {
            header("location:category.php");
        } else {
            echo "alert('data not updated successfully')";
        }
    } 
    else*/if (isset($_POST['delete'])) {
        $category_id=$_POST['category_id'];
        $res = $obj->delete($category_id);
        if ($res) {
            header("location:category.php");
        } else {
            echo "not deleted";
        }
    }
?>