<?php
require "db.php";
global $con;
?>

<nav class="navbar navbar-dark navbar-expand-lg">
    <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-white" href="index.php">CarShop</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <div class="d-flex flex-column flex-md-row align-items-md-center w-100 justify-content-md-between">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active ">
                <a class="nav-link text-white" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Products
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li class="dropdown-item dropdown">
                        <a class="dropdown-toggle dropdown-item" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cars
                        </a>
                        <ul class="dropdown-menu bg-dark text-white">
                            <?php
                            $query = "SELECT DISTINCT type FROM cars";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0)
                            {
                                while ($row = mysqli_fetch_array($result))
                                {
                                    $type = $row['type'];
                                    ?>
                                    <li><a class="dropdown-item text-white" href="products.php?type=<?php echo urlencode($type); ?>"><?php echo $type; ?></a></li>

                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </ul>
            <div>
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    echo '<a href="dashboard.php" class="btn btn-outline-light">Dashboard</a>';
                }
                ?>
                <button type="button" class="btn ">
                    <?php
                    if (isset($_SESSION['authenticated'])) {
                        // User is authenticated, display logout button
                        echo '<form action="handle_logout.php" class="mb-0" method="post">';
                        echo '<input type="submit" value="Logout" class="btn btn-outline-light">';
                        echo '</form>';
                    }

                    else {
                        // User is not authenticated, display login button
                        echo '<a href="login.php" class="btn btn-outline-light">Login</a>';
                    }
                    ?>
                </button>
                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" style="height: 25px; width: 25px;">
                        <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
    </div>
</nav>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Item Name</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Price</th>
                            <th width="15%">Total</th>
                            <th width="5%">Action</th>
                        </tr>
                        <?php

                        if(!empty($_SESSION["shopping_cart"]))
                        {
                            $total = 0;
                            foreach($_SESSION["shopping_cart"] as $keys => $values)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $values["item_name"]; ?></td>
                                    <td><?php echo $values["item_quantity"]; ?></td>
                                    <td>$ <?php echo $values["item_price"]; ?></td>
                                    <td>$ <?php echo ($values["item_quantity"] *

                                            $values["item_price"]);?></td>
                                    <td><a  href="products.php?action=delete&c_id=<?php echo $values["item_id"]; ?>" name="remove"><span class="text-danger">Remove</span></a></td>
                                </tr>
                                <?php
                                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                            }
                            ?>
                            <tr>
                                <td colspan="3" align="right">Total</td>
                                <td align="right">$ <?php echo number_format($total, 2); ?></td>
                                <td></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>let dropdowns = document.querySelectorAll('.dropdown-toggle')
        dropdowns.forEach((dd)=>{
            dd.addEventListener('click', function (e) {
                var el = this.nextElementSibling
                el.style.display = el.style.display==='block'?'none':'block'
            })
        })</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</div>