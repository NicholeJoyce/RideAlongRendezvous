<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

// Retrieves User
$sql = "SELECT * FROM userinfo WHERE UserID=$id";
$result = $connection->query($sql);

// Retrieves Pending Car Approval
$car_sql = "SELECT * FROM car WHERE DriverID = '$id';";
$car_result = $connection->query($car_sql);
// echo $car_result->num_rows;
// return;

// Retrieves Passenger
$pass_sql = "SELECT * FROM passengerinfo WHERE UserID=$id";
$pass_result = $connection->query($pass_sql);
$pass_row = $pass_result->fetch_assoc();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // Check if the Account is Verified or Not
        if (is_null($row['TimeVerified'])) {
            $_SESSION['bg'] =  "warning";
            $_SESSION['message'] = "Your account is not yet verified. Check your email to verify account!";
            header('Location: ' . $home . '/login.php');
            return;
        }

        if (!empty($_SESSION['message'])) {
            $message = $_SESSION['message'];
            $bg = $_SESSION['bg'];
        }

        $type = $row['UserLevel'];
        $fname = $row['FirstName'];
        $lname = $row['LastName'];
        $contact_no = $row['ContactNum'];
        $balance= $row['uBalance'];
        $st = $row['Street'];
        $unitnum = $row['UnitNum'];
        $barangay = $row['Baranggay'];
        $municipality = $row['Municipality'];
        $zipcode = $row['ZipCode'];
        $province = $row['Province'];
        $verification = $row['TimeVerified'];
        $creation = $row['TimeCreated'];
        $creation = $row['TimeCreated'];
        $creation = $row['TimeCreated'];
        $creation = $row['TimeCreated'];
    }
} else {
    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Profile not found!";
    header('Location: ' . $home . '/login.php');
    return;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Profile - <?= $fname . ' ' . $lname ?> </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Dancing+Script:wght@700&family=Oswald&family=Pacifico&family=Shalimar&family=Sigmar&family=Varela+Round&family=Xanh+Mono:ital@1&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>

        body{
            font-family: 'Bruno Ace Sc';
        }
        h1, tr, th, td, a{
            font-family: 'Bruno Ace Sc';
        }

        .button{
            font-family: 'Bruno Ace Sc';
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

<?php
        if (!is_null($pass_row['TimeConfirmed'])) :
        ?>
          <div class="topnav">  <a href="car_register.php"> Register a Car </a> </div>
        <?php endif; ?>

        <div class="topnav"><a href="update.php" > Update Profile </a></div>

        <?php
        if ($car_result->num_rows > 0) :
        ?>
            <div class="topnav"> <a href="view_cars.php"> View Cars </a></div>
        <?php endif; ?>

        <div class="topnav"> <a href="../user/cashin.php" > Cash In </a></div>
        <?php
    if ($type == 'driver') :
    ?>
            <div class="topnav"> <a href="../user/dcashout.php"> Cash Out </a></div>
        <?php endif; ?>

        <div class="topnav"> <a href="../config/logout.php" > Logout </a></div>



</head>


<body style="background: linear-gradient(to bottom left, #B0E0E6 10%, #BD1088 100%)">

    <div class="container my-3 col-lg-5">

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

        <h1> Profile </h1>
        <table style="width:100%">
            <tr>
                <th> Name </th>
                <td> <?= $fname . ' ' . $lname ?> . <br> </td>
                
            </tr>
            
            <tr>
                <th> Address: </th>
                <td> <?= $st . ', '. $unitnum . ', '. $barangay . ', ' . $municipality . ', ' .$zipcode.', ' . $province?> </td>
            </tr>
            
            <tr>
                
                <th> Contact No: </th>
                <td> <?= $contact_no ?> </td>
            </tr>
            
            <tr>
                <th> User Balance: </th>
                <td> <?= $balance ?> </td>
            </tr>
        </table>

        <hr>
        <div class="button">


        

       

        </div>

       

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>