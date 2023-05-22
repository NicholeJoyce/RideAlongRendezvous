<?php
include '../includes/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['auth_id'];
    
    //Declared Variables
    $amount = $_POST['cashout'];
    $gcash_num = $_POST['gcash'];

    $sql = "SELECT * FROM userinfo INNER JOIN emoney ON userinfo.UserID = emoney.UserID WHERE userinfo.UserID = '$id'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $user_balance = $row['uBalance'];
 

    //computation
    $wholeNumber = floor($amount / 1000); //get the whole number
    $modulo = $amount % 1000;
    if ($modulo > 0 && $modulo <= 999) {
        $wholeNumber += 1;
        $wholeNumber *= 20;
    }else{
        $wholeNumber *= 20;
    }

    $resultCashOut = $amount + $wholeNumber;


    if ($resultCashOut > $user_balance) {
        $_SESSION['status'] = "Insufficient Ticket.";
        header('Location: ' . $home . 'user/dcashout.php');
    } else {



        $sql = "INSERT INTO emoney (UserID, TransactionType, gcashnum, Amount) VALUES ('$id', 'Cash Out' ,'$gcash_num', '$amount');";
        $result = $connection->query($sql);

        $_SESSION['status'] = "Your Transaction is waiting for Approval.";
        header('Location: ' . $home . 'user/dcashout.php');
    }
}

