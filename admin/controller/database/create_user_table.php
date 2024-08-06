<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="Agro";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
    // sql to create Users table
    $sql = "CREATE TABLE users 
    (
        id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(30) NOT NULL,
        lname VARCHAR(30) NOT NULL,
        email VARCHAR(255) NOT NULL,
        username VARCHAR(15) NOT NULL,
        pass VARCHAR(255) NOT NULL,
        confirm_password VARCHAR(255) NOT NULL,
        mobile VARCHAR(10) NOT NULL,
        address VARCHAR(300) NOT NULL,
        user_role INT(1) NOT NULL DEFAULT '2'
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "Table Users created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    
    
    mysqli_close($conn);

?>