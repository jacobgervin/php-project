<?php
session_start();
require "db.php";
global $con;

if (isset($_POST["add_to_cart"]))
{
   if(isset($_SESSION["shopping_cart"]))
   {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if (!in_array($_GET["c_id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'   => $_GET["c_id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => floatval($_POST['hidden_price']),
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script> alert("Item already added to cart") </script>';
            echo '<script>window.location="products.php"</script>';
        }
   }
   else
   {
       $item_array = array(
                'item_id' => $_GET["c_id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => floatval($_POST['hidden_price']),
                'item_quantity' => $_POST["quantity"]
       );
       $_SESSION["shopping_cart"][0] = $item_array;
   }
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["c_id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="products.php"</script>';
            }
        }
    }
}
?>

<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Carshop - Products</title>
</head>
<body class="bg-dark">

<?php require "navbar.php"?>


<div class="container-fluid row">
    <h3 class="text-white">Cars</h3>
<?php
if (isset($_GET['type']))
{

    $type = $_GET['type'];


    $query = "SELECT * FROM cars WHERE type = '".mysqli_real_escape_string($con, $type)."'";
}
else
{

    $query = "SELECT * FROM cars";
}


$result = mysqli_query($con, $query);


if (mysqli_num_rows($result) > 0)
{

    while ($row = mysqli_fetch_array($result))
    {
?>


        <div class="col-md-4">
        <form method="post" action="products.php?action=add&c_id=<?php echo $row["c_id"]; ?>">
            <div class="card bg-dark bg-gradient text-white">
                <img src=<?php echo $row['imagepath']; ?> class="card-img-top" alt="Car">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?> </p>
                    <p class="card-text">$ <?php echo $row['price']; ?> </p>
                    <div class="d-flex flex-row ">
                        <div class="input-group mb-3 w-50">
                            <button class="btn btn-outline-primary" type="submit" name="add_to_cart" value="Add to cart">Buy</button>
                            <input type="number" name="quantity" class="form-control rounded-end bg-dark text-white border-primary" value="">
                            <input type="hidden" name="hidden_name" class="form-control" value=<?php echo $row['name'] ?>/>
                            <input type="hidden" name="hidden_price" class="form-control" value=<?php echo str_replace('/', '', $row['price']) ?>/>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>

    <?php
    }
}
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
