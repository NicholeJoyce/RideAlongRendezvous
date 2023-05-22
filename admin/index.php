<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

// Retrieves Pending Car Approval
$sql = "SELECT * FROM car 
INNER JOIN userinfo
ON car.DriverID = userinfo.UserID
WHERE TimeVerified IS NULL AND Status = 0;
";
$result = $connection->query($sql);

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="carpoollogo.png" rel="icon">
    <title> Admin Panel </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<style>

    
    .button{
        background-color:#161B30"
    }
    .topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
</style>

</head>
<div class="topnav">
        <a href="car_config/car_module.php" > Car Approval </a>
        <a href="id_config/id_module.php" > ID Approval </a>
        <a href="user_config/user_module.php"> List of Verified Users </a>
        <a href="cico/cashin_design.php"> Cash In Approval </a>
        <a href="cashout/cashout_design.php"> Cash Out Approval </a>
        <a href="reports/cashoutreps.php"> Cash Out Reports </a>
        <a href="reports/cashinreps.php"> Cash In Reports </a>
        <a href="reports/balance.php"> User Balance Reports Reports </a>
        <a href="../config/logout.php"> Logout </a>
        </div>

<body style="background: linear-gradient(to bottom left, #B0E0E6 10%, #BD1088 100%)">

    <div class="container my-3">

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

        <h1> Admin - Approval </h1>


        <hr>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>