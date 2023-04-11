<?php

require "db.php";
global $con;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    $sql = "DELETE FROM cars WHERE c_id = $id";

    if (mysqli_query($con, $sql)) {
        header("Location: dashboard.php");
        exit;
    } else {

        echo "Error deleting car: " . mysqli_error($con);
    }
}


mysqli_close($con);
?>