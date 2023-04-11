<?php
session_start();
require "db.php";
global $con;

if($con === false){
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}

// Taking all 5 values from the form data(input)
$name =  $_REQUEST['full_name'];
$number =  $_REQUEST['phone'];
$address = $_REQUEST['address'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

// Performing insert query execution
// here our table name is college
if (!preg_match('/^[a-zA-Z\s]+$/u', $name)) {
echo "Invalid name";
    exit();
}
if(!preg_match('/^\d{8}$/', $number)){
    echo "Invalid phone number";
    exit();
}
if(!preg_match('/^[a-zA-Z0-9,\s]+$/u', $address)){
    echo "Invalid address";
    exit();
}
if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i', $email)) {
    echo "Invalid email";
    exit();
}

    $sql = "INSERT INTO users ( name, number, adress, email, password) VALUES ('$name','$number','$address','$email','$password')";
    if(mysqli_query($con, $sql)){
        echo '<script>alert("You are now signed up")</script>';
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    } else{
        echo '<script>alert("Something went wrong.")</script>';
    }




// Close connection
mysqli_close($con);
?>