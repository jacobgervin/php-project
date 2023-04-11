<?php
require "db.php";
global $con;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    $sql = "UPDATE cars SET name='$name', price='$price', description='$description', type='$type' WHERE c_id='$id'";
    if (mysqli_query($con, $sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Error updating car details: " . mysqli_error($con);
    }
}
?>