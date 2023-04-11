<?php
session_start();
if ($_SESSION['role'] == 'admin') {
} else {
    header('Location: products.php');
}

require "db.php";
global $con;

if($con === false){
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}

// Taking all 5 values from the form data(input)
$c_name =  $_REQUEST['car_name'];
$c_imgpath =  $_REQUEST['img_path'];
$c_price = $_REQUEST['car_price'];
$c_desc = $_REQUEST['car_description'];
$c_type = $_REQUEST['car_type'];

$sql_insert = "INSERT INTO cars ( name, imagepath, price, description, type) VALUES ('$c_name','$c_imgpath','$c_price','$c_desc','$c_type')";

if(mysqli_query($con, $sql_insert)){
    echo "<script>alert('Car added!');</script>";
    header('Location: dashboard.php');

} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($con);
}