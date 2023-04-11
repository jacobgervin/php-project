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
<div class="h-100 w-100 d-flex flex-row justify-content-center align-items-center">
    <div class=" p-4 bg-gradient rounded">
        <div>
        <form action="login_handler.php" method="post">
    <!-- Email input -->
    <div class="form-outline mb-4 text-white">
        <input type="email" name="email" id="email" class="form-control" />
        <label class="form-label" for="email">Email address</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4 text-white">
        <input type="password" name="password" class="form-control" />
        <label class="form-label" for="form2Example2">Password</label>
    </div>


    <div class="d-flex flex-row">
    <input type="submit" value="login" class="btn btn-primary btn-block mb-4">
    <a type="button" href="register.php" class="btn btn-primary btn-block mb-4 mx-4">Register</a>
    </div>
</div>
    </div>
</form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>