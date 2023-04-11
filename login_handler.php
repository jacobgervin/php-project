<?php
session_start();

require_once "db.php";
global $con;

// check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['authenticated'] = true;
    $role = $row['role'];

    // Store the user's role in a session variable
    $_SESSION['role'] = $role;

    // Redirect the user to the appropriate page based on their role
    if ($role == 'admin') {
        header('Location: dashboard.php');
    } else {
        header('Location: products.php');
    }
} else {
    // If the query returns no rows, the login failed
    echo 'Login failed';
}

mysqli_close($con);
?>
