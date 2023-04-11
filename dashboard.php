<?php
session_start();
if ($_SESSION['role'] == 'admin') {
} else {
    echo '<script>alert("Restricted Area: requires authentication")</script>';
    echo '<meta http-equiv="refresh" content="0; url=login.php">';
}
require "db.php";
global $con;


?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>CARS</title>
</head>
<body class="bg-dark">
<?php require "navbar.php"; ?>
<div class="flex-column container">
    <div class="container"><h2 class="text-white">Add new car</h2></div>
<form action="add_car.php" method="post">
    <div class="row">

        <div class="form-floating mb-3 col-6">
            <input type="text" name="car_name" class="form-control" id="floatingInput" placeholder="Car name">
            <label for="floatingInput">Car Name</label>
        </div>

        <div class="form-floating mb-3 col-6">
            <input type="url" name="img_path" class="form-control" id="floatingInput" placeholder="Image path">
            <label for="floatingInput">Image url</label>
        </div>

        <div class="form-floating mb-3 col-6">
            <input type="number" name="car_price" class="form-control" id="floatingInput" placeholder="Price">
            <label for="floatingInput">Price</label>
        </div>

        <div class="col-6 h-100">
        <select class="form-select" name="car_type" aria-label=".form-select-sm example">
            <option selected>Select a type</option>
            <option value="Sport">Sport</option>
            <option value="Family">Family</option>
            <option value="Retro">Retro</option>
        </select>
        </div>

        <div class="form-floating mb-3 col-12">
            <input type="text" name="car_description" class="form-control" id="floatingInput" placeholder="Description" >
            <label for="floatingInput">Description</label>
        </div>
        <div class="col-4">
            <input type="submit" value="Add Car" class="btn btn-primary btn-block mb-4">
        </div>

    </div>
</form>
</div>
<div class="container"><h2 class="text-white">All cars in database</h2></div>
    <?php
    $cars = "SELECT * FROM cars";
    $result = mysqli_query($con, $cars);
    if (mysqli_num_rows($result) > 0)
    {
    while ($row = mysqli_fetch_array($result))
    {
        ?>

        <div class="bg-dark text-white container d-flex flex-md-row flex-column mb-2 table table-dark table-striped">
            <div class="col d-flex flex-row flex-md-column p-3 justify-content-md-between">
                <p>ID</p>
                <p><?php echo $row['c_id']; ?></p>
            </div>
            <div class="col d-flex flex-row flex-md-column p-3 justify-content-between">
                <p>Name</p>
                <p><?php echo $row['name']; ?></p>
            </div>
            <div class="col d-flex flex-row flex-md-column p-3 justify-content-between">
                <p>Price</p>
                <p><?php echo $row['price']; ?></p>
            </div>
            <div class="col d-flex flex-row flex-md-column p-3 justify-content-between">
                <p>Description</p>
                <p><?php echo $row['description']; ?></p>
            </div>
            <div class="col d-flex flex-row flex-md-column p-3 justify-content-between">
                <p>Type</p>
                <p><?php echo $row['type']; ?></p>
            </div>
            <div class="col d-flex flex-row  p-3">
                <form action="delete_car.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['c_id']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <form class="mx-2" action="edit_car.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['c_id']; ?>">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row['c_id']; ?>">Edit</button>
                </form>
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop<?php echo $row['c_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit car data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_car.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['c_id']; ?>">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description"><?php echo $row['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="type">Type:</label>
                                <input type="text" class="form-control" id="type" name="type" value="<?php echo $row['type']; ?>">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Apply changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    }
    ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>