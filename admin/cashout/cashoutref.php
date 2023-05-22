<?php

include '../../includes/connection.php';
include_once '../../includes/auth.php';

$id = $_SESSION['auth_id'];
$emoney_id = $_GET['EMoneyID'];
$user_id = $_GET['UserID'];

// Checks the Email & Password
$sql = "SELECT * FROM emoney INNER JOIN userinfo ON emoney.UserID = userinfo.UserID WHERE userinfo.UserID='$user_id' AND EMoneyID = '$emoney_id '";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$type = $row['UserLevel'];

$sqlstmnt = "SELECT * FROM userinfo WHERE UserId = '$id'";
$resultstmnt = $connection->query($sqlstmnt);
$rowstmnt = $resultstmnt->fetch_assoc();

if (is_null($rowstmnt['TimeVerified'])) {
    $pass_id_confirmed = 'false';
} else {
    $pass_id_confirmed = 'true';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Along Rendezvous | User Cash In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Dancing+Script:wght@700&family=Oswald&family=Pacifico&family=Shalimar&family=Sigmar&family=Varela+Round&family=Xanh+Mono:ital@1&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        /* Remove Arrows on Number Textfield */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        body,
        html {
            font-family: 'Bruno Ace Sc';
        }



        body {
            font-family: 'Bruno Ace Sc';
        }

        h1,
        tr,
        th,
        td,
        a {
            font-family: 'Bruno Ace Sc';
        }

        .button {
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
   </head>

<body style="background: linear-gradient(to bottom left, #B0E0E6 10%, #BD1088 100%)">


    <div class="container my-3 col-lg-5">
        <img src="../../carpoollogo.png" class="centerpic">

        <form action="cashoutapprove.php?EMoneyID=<?= $row['EMoneyID'] ?>&UserID=<?= $row['UserID'] ?>&Amount=<?= $row['Amount'] ?>" method="post">

            <h1 class="mb-3"> Enter GCash Reference </h1>
            <hr>

            <div class="row">

            </div>


            <div class="row">
                <div class="mb-3 col-8">

                    <label for="ref" class="form-label">Reference Number</label>
                    <input type="text" required name="refer" id="ref" class="form-control" required maxlength="8" minlength="8">
                </div>


                <div class="row">
                    <div class="col">
                        <input type="submit" name="register" value="Submit" class="btn btn-primary" style="background-color:#161B30">
                        <a href="../index.php" class="btn btn-secondary" style="background-color:#161B30"> Back </a>
                        <!-- <a href="../config/cashin.php" class="btn btn-secondary" style="background-color:#161B30"> CashIn </a> -->
                    </div>
                </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>