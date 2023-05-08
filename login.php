<?php

include 'includes/connection.php';
include 'includes/exist.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}
?>

<!DOCTYPE html>
<html lang="en">
<style>

.centerpic {
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-top: 20px;
  width: 350px;
  height: 350px;

}

</style>
<head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Dancing+Script:wght@700&family=Oswald&family=Pacifico&family=Shalimar&family=Sigmar&family=Varela+Round&family=Xanh+Mono:ital@1&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Along Rendezvous | Login Page </title>
    <link href="carpoollogo.png" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


<style>
body ,html{
    font-family: 'Bruno Ace Sc';
}


</style>
</head>

<body style="background: linear-gradient(to bottom left, #B0E0E6 10%, #BD1088 100%)">

    <div  class="container my-3 col-lg-5">

        <?php
        if (!empty($_SESSION['message'])) :
        ?>
            <div class="alert alert-<?= $bg ?> alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['bg']);
        endif ?>
<img src="carpoollogo.png" class="centerpic">
        <h1> Ride Along Rendezvous </h1>

        <hr>
        <form method="POST" action="config/login.php">
        
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email address</label>
                <input name="email" type="email" required class="form-control" id="inputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input minlength="8" required name="password" type="password" class="form-control" id="inputPassword">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color:#161B30">Login</button>
            <a href="register.html" class="btn btn-secondary">Register</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>