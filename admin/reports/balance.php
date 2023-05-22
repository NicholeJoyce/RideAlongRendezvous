<?php

include '../../includes/connection.php';
// Retrieves Registered Users


$sql = "SELECT * FROM userinfo WHERE UserLevel != 'Admin'";
$result = $connection->query($sql);

$sqlSum = "SELECT SUM(uBalance) AS 'TotalUserBalance' FROM userinfo";
$resultSum = $connection->query($sqlSum);
$rowSum = $resultSum->fetch_assoc();
$amount = $rowSum['TotalUserBalance'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool | Total Balance</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
    <hr>
    <h3 align="center">User Tickets</h3>

    <table class="table-responsive" style="width:100%">
        <hr>
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">User Available Ticket</th>

            </tr>
        </thead>
        <tbody>

            <?php
            if ($result->num_rows > 0) :
                $x = 1;
                while ($row = $result->fetch_assoc()) :
            ?>
                    <tr>
                        <th class="text-center"> <?= $x ?> </th>
                        <td class="text-center"> <?= $row['FirstName'] . " " . $row['LastName'] ?> </td>
                        <td class="text-center"> <?= $row['uBalance'] ?> </td>
                    </tr>
            <?php
                    $x++;
                endwhile;
            endif;
            ?>
    </table>
    <hr>
    <div class="container text">
            <div class="row">
                <div class="col" style="margin-left:780px; padding:-10px">
                    <h4>Total:</h4>
                </div>
                <div class="col" style="margin-right:150px;" >
                    <h4> <?= $amount ?> </h4>
                </div>
            </div>
        </div>
    <div align="right">
        <a href="../index.php" class="btn btn-warning"> Back </a>
    </div>




    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>